<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Hash;
use DB;
use Exception;
use Carbon\Carbon;
use Storage;


use App\Models\convenio;
use App\Models\processo_status;
use App\Models\processo_pendencia;
use App\Models\processo_arquivos;
use App\Models\clinica;
use App\User;
use App\Models\user_clinica;


class AdminController extends Controller {

    public function __construct() {


    }

    public function salvar_convenio(Request $request, convenio $convenio){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $convenio->id_clinica = $request->clinica;
                $convenio->nome_paciente = $request->nome_paciente;
                $convenio->tipo_convenio = $request->convenio;
                $convenio->tipo_plano = $request->plano;
                $convenio->numero_carterinha = $request->numero_carterinha;
                $convenio->cpf = $request->cpf;
                $convenio->dt_cadastro = Carbon::now();
                $convenio->protocolo = $request->protocolo;
                $convenio->valor_nf = $request->valor_nf;
                $convenio->valor_pago = $request->valor_pago;
                $convenio->dt_pagamento = $request->dt_pagqamento;
                $convenio->tel_paciente = $request->tel_paciente;
                $convenio->senha = $request->senha;
                $convenio->tipo_envio = $request->tipo_envio;
                $convenio->liberacao = $request->liberacao;
                $convenio->pix = $request->pix;
                $convenio->obs = $request->obs;

                if (!$convenio->save()) {
                    throw new Exception('Erro ao salvar novo convenio.');
                }

                DB::commit();
                return response()->json([
                    'status' => 'sucesso',
                    'recarrega' => 'true',
                    'msg' => 'Convenio foi inserido com sucesso.',
                ]);

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }

        }

    }


    public function status_processo(Request $request, processo_status $processo_status){


        if(Auth::check()){

            $processo_status = $processo_status->get();

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'processo_status' => $processo_status
            ];


            return view('app.admin.status_processo', $compact_args);

        }

    }


    public function alterar_status_processo(Request $request, convenio $convenio){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $convenio->where("id_convenio", $request->id_propcesso)
                         ->update(['status_situacao' => $request->id_processo_status]);


                DB::commit();
                return response()->json([
                    'status' => 'sucesso',
                    'recarrega' => 'true',
                    'msg' => 'Status do processo foi alterado com sucesso.',
                ]);

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }
        }

    }


    public function adicionar_pendecia(Request $request, processo_pendencia $processo_pendencia){


        if(Auth::check()){

            $processo_pendencia = $processo_pendencia->where('id_convenio', $request->id_propcesso)->first();

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'texto' => $processo_pendencia ? $processo_pendencia->texto : ""
            ];

            return view('app.admin.adicionar_pendecia', $compact_args);

        }

    }

    public function salvar_pendecia(Request $request, processo_pendencia $processo_pendencia){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $processo_pendencias = $processo_pendencia->where('id_convenio', $request->id_propcesso)->first();

                if($processo_pendencias){

                    $processo_pendencias->where("id_convenio", $request->id_propcesso)
                                        ->update(['texto' => $request->pendencia_texto]);

                }else{

                    $processo_pendencia->id_convenio = $request->id_propcesso;
                    $processo_pendencia->texto = $request->pendencia_texto;


                    if (!$processo_pendencia->save()) {
                        throw new Exception('Erro ao salvar novo texto da pendencia.');
                    }

                }

                DB::commit();
                return response()->json([
                    'status' => 'sucesso',
                    'recarrega' => 'true',
                    'msg' => 'Pendecia do processo foi incluso com sucesso.',
                ]);

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }
        }

    }


    public function upload(Request $request){

        if(Auth::check()){

            $compact_args = [
                'request' => $request,
                'class' => $this
            ];

            return view('app.admin.upload', $compact_args);

        }

    }


    public function salvar_upload(Request $request, processo_arquivos $processo_arquivos)
    {


        if(Auth::check()){

            // Define o valor default para a variável que contém o nome da imagem
            $nameFile = null;

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->image->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";

                // Faz o upload:
                $upload = $request->image->storeAs('upload_arquivos', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
                $path = $request->file('image')->storeAs('public/upload_arquivos', $nameFile);

                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if (!$upload){
                    return redirect()->back()
                                    ->with('error', 'Falha ao fazer upload')
                                    ->withInput();
                }

                DB::beginTransaction();
                try{

                    $processo_arquivos->id_convenio = $request->id_propcesso;
                    $processo_arquivos->path = $path;
                    $processo_arquivos->nome_real = $request->image->getClientOriginalName();

                    if (!$processo_arquivos->save()) {
                        throw new Exception('Erro ao salvar novo texto da pendencia.');
                    }

                    DB::commit();

                    return redirect()->route('home');

                }catch (Exception $e) {
                    DB::rollback();
                    dd($e);
                }
            }

        }

    }

    public function lista_upload(Request $request, processo_arquivos $processo_arquivos){

        if(Auth::check()){

            $processo_arquivos = $processo_arquivos->where("id_convenio", $request->id_propcesso);

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'processo_arquivos' => $processo_arquivos,
            ];

            return view('app.admin.lista_upload', $compact_args);

        }

    }

    public function download(Request $request, processo_arquivos $processo_arquivos){

        if(Auth::check()){

           $processo_arquivos = $processo_arquivos->where("id_processo_arquivos", $request->id_processo_arquivo)->first();

           $path = storage_path("app/".$processo_arquivos->path);

           // Return HTTP response to a client that initiates the file downolad
           return response()->download($path);

        }

    }

    public function dados_processo(Request $request, convenio $convenio, clinica $clinicas){

        if(Auth::check()){

            $convenio = $convenio->where("id_convenio", $request->id_propcesso)->first();

            $clinicas = $clinicas->get();

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'convenio' => $convenio,
                'clinicas' => $clinicas
            ];

            return view('app.admin.dados_processo', $compact_args);

        }

    }

    public function atualizar_processo(Request $request, convenio $convenio){

        if(Auth::check()){

            DB::beginTransaction();
            try{
                dd($request->all());
                $convenio = $convenio->where("id_convenio", $request->id_propcesso)
                                      ->update([
                                                'id_clinica'          => $request->clinica,
                                                'tipo_convenio'       => $request->convenio,
                                                'tipo_plano'          => $request->plano,
                                                'numero_carterinha'   => $request->numero_carterinha,
                                                'cpf'                 => $request->cpf,
                                                'nome_paciente'       => $request->nome_paciente,
                                                'protocolo'           => $request->protocolo,
                                                'valor_nf'            => $request->valor_nf,
                                                'dt_pagamento'        => $request->dt_pagqamento,
                                                'valor_pago'          => $request->valor_pago,
                                                'tel_paciente'        => $request->tel_paciente,
                                                'pix'                 => $request->pix,
                                                'senha'               => $request->senha,
                                                'tipo_envio'          => $request->tipo_envio,
                                                'liberacao'           => $request->liberacao,
                                                'obs'                 => $request->obs
                                     ]);


                if (!$convenio) {
                    throw new Exception('Erro ao alterar processo.');
                }


                DB::commit();
                return response()->json([
                    'status' => 'sucesso',
                    'recarrega' => 'true',
                    'msg' => 'Processo atualizado com sucesso.',
                ]);

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }

        }

    }


    public function excluir_processo(Request $request, convenio $convenio){


        if(Auth::check()){

            DB::beginTransaction();
            try{

                $convenio = $convenio->where("id_convenio", $request->id_processo)
                                      ->update([
                                                   'ativo' =>  0
                                               ]);


                if (!$convenio) {
                    throw new Exception('Erro ao alterar processo.');
                }


                DB::commit();
                return response()->json([
                    'status' => 'sucesso',
                    'recarrega' => 'true',
                    'msg' => 'Processo desativado com sucesso.',
                ]);

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }

        }

    }

    public function processo_pdf(Request $request){

        return view('app.admin.processo_pdf');

    }


    public function salvar_clinica(Request $request, clinica $clinicas){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $clinica = $clinicas->where('nome_clinica', strtoupper($request->nome_clinica))->first();

                if(!$clinica){

                    $clinicas->nome_clinica = strtoupper($request->nome_clinica);

                    if (!$clinicas->save()) {
                        throw new Exception('Erro ao salvar nova clinica.');
                    }

                    DB::commit();

                    return response()->json([
                        'status' => 'sucesso',
                        'recarrega' => 'true',
                        'msg' => 'Clinica Adicionada com sucesso',
                    ]);
                }else{

                    return response()->json([
                        'status' => 'erro',
                        'recarrega' => 'false',
                        'msg' => 'Clinica com esse nome já existe',
                    ]);

                }

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }
        }

    }

    public function salvar_clinica_usuario(Request $request, User $users, user_clinica $user_clinicas){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $user = $users->where('email', strtolower($request->email))->count();

                if($user == 0){

                    $users->name = strtoupper($request->nome_usuario_clinica);
                    $users->email = strtolower($request->email_usuario_clinica);
                    $users->password = Hash::make("123456");
                    $users->id_perfil = 2;

                    if (!$users->save()) {
                        throw new Exception('Erro ao salvar usuario.');
                    }else{
                        $user_clinicas->id_user = $users->id;
                        $user_clinicas->id_clinica = $request->id_clinica;

                        if (!$user_clinicas->save()) {
                            throw new Exception('Erro ao salvar novo usuario clinica.');
                        }
                    }

                    DB::commit();

                    return response()->json([
                        'status' => 'sucesso',
                        'recarrega' => 'true',
                        'msg' => 'Usuario Clinica Adicionada com sucesso',
                    ]);

                }else{

                    return response()->json([
                        'status' => 'erro',
                        'recarrega' => 'false',
                        'msg' => 'Usuario já exite com esse email',
                    ]);

                }

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }
        }

    }

    public function clinicas(Request $request, clinica $clinicas){

        if(Auth::check()){

            $clinica = $clinicas->orderBy('nome_clinica','asc')->paginate(10,['*'],'todas_clinicas_pag');
            $clinica->appends(Request::capture()->except('_token'))->render();

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'clinicas' => $clinica
            ];


            return view('app.admin.clinicas', $compact_args);

        }

    }


    public function ativar_desativar_clinica(Request $request, clinica $clinicas){

        if(Auth::check()){

            $clinica = $clinicas->where("id_clinica", $request->id_clinica)->first();

            if($request->ativar_deativar == 1){
                $corpo = "<div class='alert alert-danger'>Desejá desativar a clinica $clinica->nome_clinica ?</div>";
                $ativar_desativar = 1;
            }else{
                $corpo = "<div class='alert alert-info'>Desejá ativar a clinica $clinica->nome_clinica ?</div>";
                $ativar_desativar = 0;
            }

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'corpo' => $corpo,
                'ativar_desativar' => $ativar_desativar
            ];

            return view('app.admin.ativar_desativar_clinica', $compact_args);

        }

    }


    public function salvar_ativar_desativar_clinica(Request $request, clinica $clinicas){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $clinica = $clinicas->where("id_clinica", $request->id_clinica)->first();

                if($request->ativar_desativar == 1){
                    $clinica->ativo = 0;
                    $msg = "Clinica Destivada com sucesso";
                }else{
                    $clinica->ativo = 1;
                    $msg = "Clinica Ativada com sucesso";
                }

                if (!$clinica->save()) {
                    throw new Exception('Erro ao salvar ativar/desativar clinica.');
                }

                DB::commit();

                return response()->json([
                        'status' => 'sucesso',
                        'recarrega' => 'true',
                        'msg' => $msg
                ]);


            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }
        }

    }

    public function relatorio_usuario(Request $request, User $user , Clinica $clinicas){

        if(Auth::check()){

            $user = $user->orderBy('name','asc')->paginate(10,['*'],'todas_clinicas_pag');
            $user->appends(Request::capture()->except('_token'))->render();

            $clinicas = $clinicas->get();

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'users' => $user,
                'clinicas' => $clinicas,
            ];


            return view('app.admin.relatorio_usuario', $compact_args);

        }

    }

    public function ativar_desativar_usuario(Request $request, User $user){

        if(Auth::check()){

            $user = $user->where("id", $request->id_user)->first();

            if($request->ativar_deativar == 1){
                $corpo = "<div class='alert alert-danger'>Desejá desativar o usuario $user->name ?</div>";
                $ativar_desativar = 1;
            }else{
                $corpo = "<div class='alert alert-info'>Desejá ativar o usuario $user->name ?</div>";
                $ativar_desativar = 0;
            }

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'corpo' => $corpo,
                'ativar_desativar' => $ativar_desativar
            ];

            return view('app.admin.ativar_desativar_usuario', $compact_args);

        }

    }

    public function salvar_ativar_desativar_usuario(Request $request, User $user){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $user = $user->where("id", $request->id_user)->first();

                if($request->ativar_desativar == 1){
                    $user->ativo = 0;
                    $msg = "Usuario Destivado com sucesso";
                }else{
                    $user->ativo = 1;
                    $msg = "Usuario Ativado com sucesso";
                }

                if (!$user->save()) {
                    throw new Exception('Erro ao salvar ativar/desativar usuario.');
                }

                DB::commit();

                return response()->json([
                        'status' => 'sucesso',
                        'recarrega' => 'true',
                        'msg' => $msg
                ]);


            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }
        }

    }


    public function alterar_senha_usuario(Request $request, User $user){

        if(Auth::check()){

            $user = $user->where("id", $request->id_user)->first();

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'user' => $user
            ];

            return view('app.admin.alterar_senha_usuario', $compact_args);

        }

    }

    public function salvar_alterar_senha_usuario(Request $request, User $user){

        if(Auth::check()){

            DB::beginTransaction();
            try{

                $user = $user->where("id", $request->id_user)->first();
                $user->password = Hash::make($request->senha);
                if (!$user->save())
                    throw new Exception('Erro ao salvar usuario.');

                DB::commit();

                return response()->json([
                        'status' => 'sucesso',
                        'recarrega' => 'true',
                        'msg' => 'Senha alterada com sucesso'
                ]);


            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }
        }
    }


    public function deletar_clinica(Request $request, clinica $clinicas, user_clinica $user_clinicas, User $users, convenio $convenios){


        if(Auth::check()){

            DB::beginTransaction();
            try{

                $user_clinicas = $user_clinicas->where('id_clinica', $request->id_clinica)->get();
                foreach ($user_clinicas as $user_clinica) {
                    $user = $users->where('id', $user_clinica->id_user)->first();
                    $user->delete();
                }

                foreach ($user_clinicas as $user_clinica) {
                    $user_cli = $user_clinica->where('id_clinica', $request->id_clinica)->first();
                    $user_cli->delete();
                }

                $convenios = $convenios->where('id_clinica', $request->id_clinica)->get();
                foreach ($convenios as $convenio) {
                    $con = $convenio->where('id_clinica', $request->id_clinica)->first();
                    $con->delete();
                }

                $clinicas = $clinicas->where('id_clinica' , $request->id_clinica)->get();
                foreach ($clinicas as $clinica) {
                    $cli = $clinica->where('id_clinica', $request->id_clinica)->first();
                    $cli->delete();
                }

                DB::commit();
                return response()->json([
                    'status' => 'sucesso',
                    'recarrega' => 'true',
                    'msg' => 'Clinica deletada com sucesso.',
                ]);

            }catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 'erro',
                    'recarrega' => 'false',
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descrição: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
                ]);
            }

        }

    }


}

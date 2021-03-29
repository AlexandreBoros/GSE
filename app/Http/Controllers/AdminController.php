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
                $convenio->porcentagem_gse = $request->porcentagem_gse;
                $convenio->senha = $request->senha;

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

            //dd($processo_status);

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


}

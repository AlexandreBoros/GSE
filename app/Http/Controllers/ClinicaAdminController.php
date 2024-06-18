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


use App\Models\convenio;
use App\Models\processo_status;
use App\Models\processo_pendencia;
use App\Models\processo_arquivos;
use App\Models\permissions
;



class ClinicaAdminController extends Controller {

    public function __construct() {


    }

    public function index(Request $request){

        if(Auth::check()){


            $compact_args = [
                               'request' => $request,
                               'class' => $this
                            ];
     
             return view('app.clinica_admin.index', $compact_args);
 
         }


    }

    
    
    public function dashboard(Request $request){

        
        if(Auth::check()){


           $compact_args = [
                              'request' => $request,
                              'class' => $this
                           ];
    
            return view('app.clinica_admin.dashboard', $compact_args);

        }
        
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
                    'msg' => 'Por favor, tente novamente mais tarde.' . (env('APP_ENV')!='production'? ' Descri��o: '.$e->getMessage().' - Linha: '.$e->getLine() : '')
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
    
            return view('app.clinica_admin.adicionar_pendecia', $compact_args);

        }
        
    }

    public function upload(Request $request){

        if(Auth::check()){

            $compact_args = [
                'request' => $request,
                'class' => $this
            ];

            return view('app.clinica_admin.upload', $compact_args);

        }

    }


    public function salvar_upload(Request $request, processo_arquivos $processo_arquivos, convenio $convenio)
    {


        if(Auth::check()){

            // Define o valor default para a vari�vel que cont�m o nome da imagem
            $nameFile = null;
            
            if ($request->hasFile('image') && $request->file('image')->isValid()) {  

                // Define um aleat�rio para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));

                // Recupera a extens�o do arquivo
                $extension = $request->image->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";

                // Faz o upload:
                $upload = $request->image->storeAs('upload_arquivos', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
                $path = $request->file('image')->storeAs('public/upload_arquivos', $nameFile);

                // Verifica se N�O deu certo o upload (Redireciona de volta)
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

                    $convenio->where("id_convenio", $request->id_propcesso)
                             ->update(['status_situacao' => 5]);
            
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

            return view('app.clinica_admin.lista_upload', $compact_args);

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


}

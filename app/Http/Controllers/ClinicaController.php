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



class ClinicaController extends Controller {

    public function __construct() {


    }

    public function adicionar_pendecia(Request $request, processo_pendencia $processo_pendencia){

        
        if(Auth::check()){

            $processo_pendencia = $processo_pendencia->where('id_convenio', $request->id_propcesso)->first();
 
            $compact_args = [
                'request' => $request,
                'class' => $this,
                'texto' => $processo_pendencia ? $processo_pendencia->texto : ""
            ];
    
            return view('app.clinica.adicionar_pendecia', $compact_args);

        }
        
    }

    public function upload(Request $request){

        if(Auth::check()){

            $compact_args = [
                'request' => $request,
                'class' => $this
            ];

            return view('app.clinica.upload', $compact_args);

        }

    }


    public function salvar_upload(Request $request, processo_arquivos $processo_arquivos, convenio $convenio)
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

            return view('app.clinica.lista_upload', $compact_args);

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

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

}

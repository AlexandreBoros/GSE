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


class AdminController extends Controller {

    public function __construct() {


    }


   /* public function index(Request $request){

        if(Auth::check()){

            $user = Auth::user();

            $compact_args = [
                'request' => $request,
                'class' => $this,
                'nome' => $user->name
            ];

            return view('app.admin.index', $compact_args);

        }

    }*/


    public function salvar_convenio(Request $request, convenio $convenio){

        if(Auth::check()){
       
            DB::beginTransaction();
            try{

                $convenio->nome_clinica = $request->clinica;
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

}

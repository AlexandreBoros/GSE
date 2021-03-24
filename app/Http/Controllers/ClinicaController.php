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

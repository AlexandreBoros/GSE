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
use PDF;


use App\Models\convenio;
use App\Models\processo_status;
use App\Models\processo_pendencia;
use App\Models\processo_arquivos;
use App\Models\clinica;
use App\Models\user_clinica;


class PDFController extends Controller {

    public function __construct() {


    }

    public function generate_pdf(Request $request, convenio $convenio, clinica $clinicas, user_clinica $users_clinicas){

        if(Auth::check()){

            $dt_inicial = $request->data_inicial; 
            $dt_final   = $request->data_final; 

            switch ($request->tipo) {
                case 1:
                    if(empty($dt_inicial) || empty($dt_final)){

                        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                ->where("convenios.ativo", 1)
                                                ->where("status_situacao", "1")
                                                ->orderBy('dt_cadastro','desc')
                                                ->get();
        
                    }else{
                    
                        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                ->where("convenios.ativo", 1)
                                                ->where("status_situacao", "1")
                                                ->whereBetween('dt_cadastro', [$dt_inicial, $dt_final])
                                                ->orderBy('dt_cadastro','desc')
                                                ->get();
                    
                    }

                    $data = [
                        'convenios' => $convenios
                    ];
        
                    $pdf = PDF::loadView('app.admin.processo_pdf',  $data);
        
                    return $pdf->download('processo_analise.pdf');

                    break;

                
                case 2:
                        if(empty($dt_inicial) || empty($dt_final)){
    
                            $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                    ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                    ->where("convenios.ativo", 2)
                                                    ->where("status_situacao", "1")
                                                    ->orderBy('dt_cadastro','desc')
                                                    ->get();
            
                        }else{
                        
                            $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                    ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                    ->where("convenios.ativo", 2)
                                                    ->where("status_situacao", "1")
                                                    ->whereBetween('dt_cadastro', [$dt_inicial, $dt_final])
                                                    ->orderBy('dt_cadastro','desc')
                                                    ->get();
                        
                        }
    
                        $data = [
                            'convenios' => $convenios
                        ];
            
                        $pdf = PDF::loadView('app.admin.processo_pdf',  $data);
            
                        return $pdf->download('processo_pendente.pdf');
    
                        break;    
                
                default:
                    # code...
                    break;
            }

            
             
            

            
           


            

        }

    }


}

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

            $valor_total = 0;
            $valores_limpos = [];

            switch ($request->tipo) {
                case 1:
                    if(empty($dt_inicial) || empty($dt_final)){

                        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                ->where("convenios.ativo", 1)
                                                ->where("status_situacao", "1")
                                                ->orderBy('dt_cadastro','desc')
                                                ->get();

                        foreach ($convenios as $valor) {
                            $valor_total = str_replace("R$" , "" , $valor->valor_nf);   
                            $valor_total = str_replace("," , "" , $valor_total);   
                            $valor_total = str_replace("." , "" , $valor_total);   
                            array_push( $valores_limpos , $valor_total);
                        }                        

                                            
                    }else{
                    
                        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                ->where("convenios.ativo", 1)
                                                ->where("status_situacao", "1")
                                                ->whereBetween('dt_cadastro', [$dt_inicial, $dt_final])
                                                ->orderBy('dt_cadastro','desc')
                                                ->get();
                        
                        foreach ($convenios as $valor) {
                                $valor_total = str_replace("R$" , "" , $valor->valor_nf);   
                                $valor_total = str_replace("," , "" , $valor_total);   
                                $valor_total = str_replace("." , "" , $valor_total);   
                                array_push( $valores_limpos , $valor_total);
                        }             
                          
                                                        
                                                   

                                                       
                    
                    }

                    $valor = array_sum($valores_limpos);

                    $valor = substr_replace($valor, '.', -2, 0);

                    $valor = number_format($valor,2,",",".");

                    $data = [
                        'convenios' => $convenios,
                        'titulo'    => 'Relatório Processo Analise',
                        'titulo1'   => 'DADOS DOS PROCESSOS EM ANALISES',
                        'valor_total'   => $valor
                    ];
        
                    $pdf = PDF::loadView('app.admin.processo_pdf',  $data);

                    $nome = "processo_analise".$dt_inicial.".pdf";
            
                    return $pdf->download($nome);

                    break;

                
                case 2:
                        if(empty($dt_inicial) || empty($dt_final)){
    
                            $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                    ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                    ->where("convenios.ativo", 1)
                                                    ->where("status_situacao", "2")
                                                    ->orderBy('dt_cadastro','desc')
                                                    ->get();

                            foreach ($convenios as $valor) {
                                $valor_total = str_replace("R$" , "" , $valor->valor_nf);   
                                $valor_total = str_replace("," , "" , $valor_total);   
                                $valor_total = str_replace("." , "" , $valor_total);   
                                array_push( $valores_limpos , $valor_total);
                            }                                     
            
                        }else{
                        
                            $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                    ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                    ->where("convenios.ativo", 1)
                                                    ->where("status_situacao", "2")
                                                    ->whereBetween('dt_cadastro', [$dt_inicial, $dt_final])
                                                    ->orderBy('dt_cadastro','desc')
                                                    ->get();

                            foreach ($convenios as $valor) {
                                $valor_total = str_replace("R$" , "" , $valor->valor_nf);   
                                $valor_total = str_replace("," , "" , $valor_total);   
                                $valor_total = str_replace("." , "" , $valor_total);   
                                array_push( $valores_limpos , $valor_total);
                            }                          
                        
                        }

                        
                        $valor = array_sum($valores_limpos);

                        $valor = substr_replace($valor, '.', -2, 0);
    
                        $valor = number_format($valor,2,",",".");

                        $data = [
                            'convenios' => $convenios,
                            'titulo'    => 'Relatório Processos Pendentes',
                            'titulo1'   => 'DADOS DOS PROCESSOS PENDENTES',
                            'valor_total'   => $valor
                        ];
            
                        $pdf = PDF::loadView('app.admin.processo_pdf',  $data);

                        $nome = "processo_pendente".$dt_inicial.".pdf";
            
                        return $pdf->download($nome);
    
                        break;    


                case 3:
                    if(empty($dt_inicial) || empty($dt_final)){
        
                        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                        ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                        ->where("convenios.ativo", 1)
                                                        ->where("status_situacao", 3)
                                                        ->orderBy('dt_cadastro','desc')
                                                        ->get();
                        
                    foreach ($convenios as $valor) {
                        $valor_total = str_replace("R$" , "" , $valor->valor_pago);   
                        $valor_total = str_replace("," , "" , $valor_total);   
                        $valor_total = str_replace("." , "" , $valor_total);   
                        array_push( $valores_limpos , $valor_total);
                    }  


                
                    }else{
                            
                        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                        ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                        ->where("convenios.ativo", 1)
                                                        ->where("status_situacao", 3)
                                                        ->whereBetween('dt_cadastro', [$dt_inicial, $dt_final])
                                                        ->orderBy('dt_cadastro','desc')
                                                        ->get();

                        foreach ($convenios as $valor) {
                            $valor_total = str_replace("R$" , "" , $valor->valor_pago);   
                            $valor_total = str_replace("," , "" , $valor_total);   
                            $valor_total = str_replace("." , "" , $valor_total);   
                            array_push( $valores_limpos , $valor_total);
                        }                      
                            
                     }

                    $valor = array_sum($valores_limpos);

                    $valor = substr_replace($valor, '.', -2, 0);
 
                    $valor = number_format($valor,2,",",".");
        
                    $data = [
                        'convenios' => $convenios,
                        'titulo'    => 'Relatório Processos Baixados',
                        'titulo1'   => 'DADOS DOS PROCESSOS BAIXADOS',
                        'valor_total'   => $valor
                    ];
                
                    $pdf = PDF::loadView('app.admin.processo_pdf',  $data);
    
                    $nome = "processo_baixados".$dt_inicial.".pdf";
                
                    return $pdf->download($nome);
        
                    break;      
                    
                case 4:
                    if(empty($dt_inicial) || empty($dt_final)){
            
                        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                            ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                            ->where("convenios.ativo", 1)
                                                            ->where("status_situacao", 4)
                                                            ->orderBy('dt_cadastro','desc')
                                                            ->get();

                        foreach ($convenios as $valor) {
                            $valor_total = str_replace("R$" , "" , $valor->valor_pago);   
                            $valor_total = str_replace("," , "" , $valor_total);   
                            $valor_total = str_replace("." , "" , $valor_total);   
                            array_push( $valores_limpos , $valor_total);
                        }                                              
                    
                    }else{
                                
                            $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                                            ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                                            ->where("convenios.ativo", 1)
                                                            ->where("status_situacao", 4)
                                                            ->whereBetween('dt_cadastro', [$dt_inicial, $dt_final])
                                                            ->orderBy('dt_cadastro','desc')
                                                            ->get();


                            foreach ($convenios as $valor) {
                                $valor_total = str_replace("R$" , "" , $valor->valor_pago);   
                                $valor_total = str_replace("," , "" , $valor_total);   
                                $valor_total = str_replace("." , "" , $valor_total);   
                                array_push( $valores_limpos , $valor_total);
                            }                          
                                
                        }

                        $valor = array_sum($valores_limpos);

                        $valor = substr_replace($valor, '.', -2, 0);
 
                        $valor = number_format($valor,2,",",".");
            
                        $data = [
                            'convenios' => $convenios,
                            'titulo'    => 'Relatório Processos Pagos',
                            'titulo1'   => 'DADOS DOS PROCESSOS PAGOS',
                            'valor_total'   => $valor
                        ];
                    
                        $pdf = PDF::loadView('app.admin.processo_pdf',  $data);
        
                        $nome = "processo_pagos".$dt_inicial.".pdf";
                    
                        return $pdf->download($nome);
            
                        break;                 

                default:
                    # code...
                    break;
            }

            
             
            

            
           


            

        }

    }


}

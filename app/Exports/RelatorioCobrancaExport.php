<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\convenio;

class RelatorioCobrancaExport implements FromView
{

    public function __construct($request){
        
        $this->dt_inicial = $request->data_inicial;
        $this->dt_final   = $request->data_final;
        $this->id_clinica = $request->id_clinica;

        $this->valor = 0;
        $this->valores_limpos = [];

    }
     

    public function view(): View
    {
        $convenio = new convenio();
        if(empty($this->dt_inicial) || empty($this->dt_final)){
            $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                            ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                            ->where("convenios.ativo", 1)
                            ->where("status_situacao", 6)
                            ->whereBetween('dt_cadastro', [$this->dt_inicial, $this->dt_final])
                            ->orderBy('dt_cadastro','desc');
           
            if($this->id_clinica > 0){

                $convenios = $convenios->where("clinicas.id_clinica", $this->id_clinica);

            }     

            foreach ($convenios->get() as $valor) {
                $this->valor_total = str_replace("R$" , "" , $valor->valor_nf);
                $this->valor_total = str_replace("," , "" , $this->valor_total);
                $this->valor_total = str_replace("." , "" , $this->valor_total);
                array_push( $this->valores_limpos , $this->valor_total);
            }
            
        }else{

            $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                    ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                    ->where("convenios.ativo", 1)
                                    ->where("status_situacao", 6)
                                    ->whereBetween('dt_cadastro', [$this->dt_inicial, $this->dt_final])
                                    ->orderBy('dt_cadastro','desc');

            if($this->id_clinica > 0){

                $convenios = $convenios->where("clinicas.id_clinica", $this->id_clinica);

            }

            foreach ($convenios->get() as $valor) {
                $this->valor_total = str_replace("R$" , "" , $valor->valor_nf);
                $this->valor_total = str_replace("," , "" , $this->valor_total);
                $this->valor_total = str_replace("." , "" , $this->valor_total);
                array_push($this->valores_limpos, $this->valor_total);
            }

        } 
        
        $this->valor = array_sum($this->valores_limpos);

        $this->valor = substr_replace($this->valor, '.', -2, 0);

        $this->valor = number_format($this->valor,2,",",".");
            
        return view('app.admin.processo_pdf', [
            'convenios' => $convenios->get(),
            'titulo'    => 'Relatório Processos em Cobranças',
            'titulo1'   => 'DADOS DOS PROCESSOS EM COBRANÇAS',
            'valor_total' => $this->valor
        ]);
    }
}

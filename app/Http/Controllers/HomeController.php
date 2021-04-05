<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\convenio;
use App\Models\clinica;
use App\Models\user_clinica;
use App\Models\processo_status;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(convenio $convenios, clinica $clinicas, user_clinica $users_clinicas)
    {

        if(Auth::check()){

            $user = Auth::user();

            //dd($user->id_perfil);

            

            switch ($user->id_perfil) {
                case 1:
                    # Admin

                    $valor_total_analise = 0;
                    $valores_limpos_analise = [];


                    $procesos_analise = $convenios->where("convenios.ativo", 1)
                                                  ->where("status_situacao", "1");

                    foreach ($procesos_analise as $valor) {
                        $valor_total_analise = str_replace("R$" , "" , $valor->valor_nf);   
                        $valor_total_analise = str_replace("," , "" , $valor_total_analise);   
                        $valor_total_analise = str_replace("." , "" , $valor_total_analise);   
                        array_push($valores_limpos_analise , $valor_total_analise);
                    }     
                    
                    $valor_analise = array_sum($valores_limpos_analise);
                    $valor_analise = substr_replace($valor_analise, '.', -2, 0);
                    $valor_analise = number_format($valor_analise,2,",",".");


                    $procesos_pedente = $convenios->where("convenios.ativo", 1)
                                                  ->where("status_situacao", "2");


                    $procesos_baixado = $convenios->where("convenios.ativo", 1)
                                                  ->where("status_situacao", "3");


                    $procesos_pago = $convenios->where("convenios.ativo", 1)
                                                ->where("status_situacao", "4");


                    //Listar todos os convenios ordenados por data
                    $convenios = $convenios->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                           ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                           ->where("convenios.ativo", 1)
                                           ->orderBy('dt_cadastro','desc')
                                           ->paginate(50,['*'],'todos_convenios_pag');

                    $convenios->appends(Request::capture()->except('_token'))->render();

                    $clinicas = $clinicas->get(); 

                    
                    $compact_args = [
                        'class' => $this,
                        'clinicas' => $clinicas,
                        'convenios' => $convenios,
                        'procesos_analise' => $procesos_analise,
                        'valor_analise' => $valor_analise,
                        'procesos_pedente' => $procesos_pedente,
                        'procesos_baixado' => $procesos_baixado,
                        'procesos_pago' => $procesos_pago,

                    ];


                    return view('app.admin.index', $compact_args);
                break;

                case 2:
                    # Clinica

                    //Pegar a clinica 
                    $users_clinicas = $users_clinicas->where("id_user", $user->id)->first(); 


                    $clinicas = $clinicas->where("id_clinica", $users_clinicas->id_clinica)->first(); 

                    //dd($users_clinicas);
    
                    //Listar todos os convenios ordenados por data
                    $convenios = $convenios->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                           ->where("id_clinica",'=', $users_clinicas->id_clinica)
                                           ->where("convenios.ativo", 1)
                                           ->orderBy('dt_cadastro','desc')
                                           ->paginate(50,['*'],'todos_convenios_pag');

                    $convenios->appends(Request::capture()->except('_token'))->render();
    
    
    
                    $compact_args = [
                        'class' => $this,
                        'clinicas' => $clinicas,
                        'convenios' => $convenios
    
                    ];
    
    
                    return view('app.clinica.index', $compact_args);
                    break;    
                
                default:
                    return view('home');
                    break;
            }
            

        }else{

            return view('home');
            
        }

    }


    public function sair(){


        Auth::logout();
        
        return view('welcome');

    }
}

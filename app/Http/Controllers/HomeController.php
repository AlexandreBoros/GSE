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
    public function index(Request $request, convenio $convenios, clinica $clinicas, user_clinica $users_clinicas, processo_status $processo_status)
    {

        if(Auth::check()){

            $user = Auth::user();

            $usuario = $users_clinicas->where('id_user', $user->id)->first();

            if($usuario != null){
                $clinica = $clinicas->where('id_clinica', $usuario->id_clinica)->first();

                if($clinica->ativo == 0){
                    return view('desativado');
                }
            }

            switch ($user->id_perfil) {
                case 1:
                    # Admin
                    $procesos_analise = $convenios->where("convenios.ativo", 1)
                                                  ->where("status_situacao", "1");

                    $valor_total_analise = 0;
                    $valores_limpos_analise = [];


                    foreach ($procesos_analise->get() as $valor) {
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

                    
                    $valor_total_pedente = 0;
                    $valores_limpos_pedente = [];


                    foreach ($procesos_pedente->get() as $valor) {
                        $valor_total_pedente = str_replace("R$" , "" , $valor->valor_nf);   
                        $valor_total_pedente = str_replace("," , "" , $valor_total_pedente);   
                        $valor_total_pedente = str_replace("." , "" , $valor_total_pedente);   
                        array_push($valores_limpos_pedente , $valor_total_pedente);
                    }     

                                                            
                    $valor_pedente = array_sum($valores_limpos_pedente);
                    $valor_pedente = substr_replace($valor_pedente, '.', -2, 0);
                    $valor_pedente = number_format($valor_pedente,2,",",".");

                    $procesos_baixado = $convenios->where("convenios.ativo", 1)
                                                  ->where("status_situacao", "3");

                      
                    $valor_total_baixado = 0;
                    $valores_limpos_baixado = [];
                              
                              
                    foreach ($procesos_baixado->get() as $valor) {
                        $valor_total_baixado = str_replace("R$" , "" , $valor->valor_pago);   
                        $valor_total_baixado = str_replace("," , "" , $valor_total_baixado);   
                        $valor_total_baixado = str_replace("." , "" , $valor_total_baixado);   
                        array_push($valores_limpos_baixado , $valor_total_baixado);
                    }     
                              
                                                                                          
                    $valor_baixado = array_sum($valores_limpos_baixado);
                    $valor_baixado = substr_replace($valor_baixado, '.', -2, 0);
                    $valor_baixado = number_format($valor_baixado,2,",",".");
                                                            


                    $procesos_pago = $convenios->where("convenios.ativo", 1)
                                                ->where("status_situacao", "4");

                    $valor_total_pago = 0;
                    $valores_limpos_pago = [];
                                                          
                                                          
                    foreach ($procesos_pago->get() as $valor) {
                        $valor_total_pago = str_replace("R$" , "" , $valor->valor_pago);   
                        $valor_total_pago = str_replace("," , "" , $valor_total_pago);   
                        $valor_total_pago = str_replace("." , "" , $valor_total_pago);   
                        array_push($valores_limpos_pago , $valor_total_pago);
                    }     
                                                          
                                                                                                                      
                    $valor_pago = array_sum($valores_limpos_pago);
                    $valor_pago = substr_replace($valor_pago, '.', -2, 0);
                    $valor_pago = number_format($valor_pago,2,",",".");                            


                    //Listar todos os convenios ordenados por data
                    $convenios = $convenios->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                                           ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                                           ->where("convenios.ativo", 1);


                    if ($request->filled('seacrh_nome')) {
                        $convenios = $convenios->where('nome_paciente', 'like', '%'.$request->seacrh_nome.'%');
                    } 
                    
                    
                    if ($request->filled('seacrh_clinica')) {
                        $convenios = $convenios->where('clinicas.id_clinica', $request->seacrh_clinica);
                    } 

                    if ($request->filled('seacrh_convenio')) {
                        $convenios = $convenios->where('tipo_convenio', 'like', '%'.$request->seacrh_convenio.'%');
                    } 

                                        
                    $convenios =  $convenios->orderBy('dt_cadastro','desc')->paginate(50,['*'],'todos_convenios_pag');
                    $convenios->appends(Request::capture()->except('_token'))->render();

                    $clinicas = $clinicas->get(); 

                    
                    $compact_args = [
                        'class' => $this,
                        'clinicas' => $clinicas,
                        'convenios' => $convenios,
                        'procesos_analise' => $procesos_analise,
                        'valor_analise' => $valor_analise,
                        'procesos_pedente' => $procesos_pedente,
                        'valor_pedente' => $valor_pedente,
                        'procesos_baixado' => $procesos_baixado,
                        'valor_baixado' => $valor_baixado,
                        'procesos_pago' => $procesos_pago,
                        'valor_pago' => $valor_pago,

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
                                           ->where("convenios.ativo", 1);
                                         

                    


                    if ($request->filled('seacrh_nome')) {
                        $convenios = $convenios->where('nome_paciente', 'like', '%'.$request->seacrh_nome.'%');
                    } 

                    if ($request->filled('seacrh_convenio')) {
                        $convenios = $convenios->where('tipo_convenio', 'like', '%'.$request->seacrh_convenio.'%');
                    } 

                    if ($request->filled('id_processo_status')) {
                        $convenios = $convenios->where('status_situacao', $request->id_processo_status);
                    } 
    
    
                    $convenios =  $convenios->orderBy('dt_cadastro','desc')->paginate(50,['*'],'todos_convenios_pag');
                    $convenios->appends(Request::capture()->except('_token'))->render();


                    $compact_args = [
                        'class' => $this,
                        'clinicas' => $clinicas,
                        'convenios' => $convenios,
                        'processo_status' => $processo_status->get()
    
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

    public function clinica_desativada(){

        return view('clinica_desativada');

    }

}

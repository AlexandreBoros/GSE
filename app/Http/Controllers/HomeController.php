<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\convenio;

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
    public function index(convenio $convenios)
    {

        if(Auth::check()){

            $user = Auth::user();

            //dd($user->id_perfil);

            switch ($user->id_perfil) {
                case 1:
                    # Admin


                    //Listar todos os convenios ordenados por data
                    $convenios = $convenios->orderBy('dt_cadastro','desc')->paginate(10,['*'],'todos_convenios_pag');
                    $convenios->appends(Request::capture()->except('_token'))->render();



                    $compact_args = [
                        'class' => $this,
                        'convenios' => $convenios

                    ];


                    return view('app.admin.index', $compact_args);
                    break;
                
                default:
                    # code...
                    break;
            }
            

        }else{

            return view('home');
            
        }

    }
}

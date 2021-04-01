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


class PDFController extends Controller {

    public function __construct() {


    }

    public function generate_pdf_analise(Request $request, convenio $convenio){

        $convenios = $convenio->join("clinicas","clinicas.id_clinica","convenios.id_clinica")
                               ->join("processo_status","processo_status.id_processo_status","=","convenios.status_situacao")
                               ->where("convenios.ativo", 1)
                               ->where("status_situacao", "1")
                               ->get();


        $data = [
                   'convenios' => $convenios
        ];

        $pdf = PDF::loadView('app.admin.analise_pdf',  $data);

        return $pdf->download('processo_analise.pdf');

    }


}

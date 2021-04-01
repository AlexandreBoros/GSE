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

        $convenios = $convenio->where('status_situacao' , 1)->get();

        dd($convenios);

        $pdf = PDF::loadView('app.admin.analise_pdf',  $convenios);

        return $pdf->download('processo_analise.pdf');

    }


}

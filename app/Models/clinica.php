<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clinica extends Model {

    protected $table = 'u249304309_gse.clinicas';
    protected $primaryKey = 'id_clinica';
    public $timestamps = false;
    protected $guarded  = array();

   /*public function bares_categorias()
    {
        return $this->belongsTo(barescategorias::class,'id_bares_categorias');
    }*/


}

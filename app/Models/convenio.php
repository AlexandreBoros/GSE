<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class convenio extends Model {

    protected $table = 'gse.convenio';
    protected $primaryKey = 'id_convenio';
    public $timestamps = false;
    protected $guarded  = array();

   /*public function bares_categorias()
    {
        return $this->belongsTo(barescategorias::class,'id_bares_categorias');
    }*/


}

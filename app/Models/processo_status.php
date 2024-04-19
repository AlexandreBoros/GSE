<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class processo_status extends Model {

    protected $table = 'u249304309_gse.processo_status';
    protected $primaryKey = 'id_processo_status';
    public $timestamps = false;
    protected $guarded  = array();

   /*public function bares_categorias()
    {
        return $this->belongsTo(barescategorias::class,'id_bares_categorias');
    }*/


}

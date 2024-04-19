<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class processo_arquivos extends Model {

    protected $table = 'u249304309_gse.processo_arquivos';
    protected $primaryKey = 'id_processo_arquivos';
    public $timestamps = false;
    protected $guarded  = array();

   /*public function bares_categorias()
    {
        return $this->belongsTo(barescategorias::class,'id_bares_categorias');
    }*/


}

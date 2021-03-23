<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class processo_pendencia extends Model {

    protected $table = 'gse.processo_pendencia';
    protected $primaryKey = 'id_processo_pendencia';
    public $timestamps = false;
    protected $guarded  = array();

   /*public function bares_categorias()
    {
        return $this->belongsTo(barescategorias::class,'id_bares_categorias');
    }*/


}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model {

    protected $table = 'u249304309_gse.permissions';
    protected $primaryKey = 'id_permission';
    public $timestamps = false;
    protected $guarded  = array();

   /*public function bares_categorias()
    {
        return $this->belongsTo(barescategorias::class,'id_bares_categorias');
    }*/


}
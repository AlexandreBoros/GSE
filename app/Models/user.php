<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_error extends Model {

    protected $table = 'gse.user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded  = array();


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
{
    //
    use SoftDeletes;
    
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}

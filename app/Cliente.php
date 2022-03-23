<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    public function articulo(){
        return $this->hasOne(Articulo::class);
    }
    
    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
    
    
    public function perfils(){
        return $this->belongsToMany(Perfil::class);
    }
}

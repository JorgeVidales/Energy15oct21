<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    // use HasFactory;
    protected $table = 'estacion';
    protected $filable=['idCompania','cliente','estacion','direccion', 'condicion'];

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
}

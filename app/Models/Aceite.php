<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aceite extends Model
{
    use HasFactory;
    protected $table = 'aceites';
    protected $filable=['tipoAceite','marca','modelo'];

    public function maquinarias(){
        return $this->hasMany('App\Models\Maquinas');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinas extends Model
{
    use HasFactory;
    protected $table = 'maquinas';
    protected $filable=['tipo','idAceite', 'tipoaceite','marca', 'modelo','tag','volaceite'];

    public function aceite(){
        return $this->belongsTo('App\Models\Aceite');
    }
}

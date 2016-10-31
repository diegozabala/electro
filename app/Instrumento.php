<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property mixed  nombre
 * @property mixed cantidad
 * @property String descripcion
 * @property string estado
 */

class Instrumento extends Model
{
    protected $table="instrumentos";
    protected $fillable=['nombre','cantidad','descripcion','estado','tipo',
    ];
    
    public function prestamos(){
        return $this->hasMany('App\Prestamo');
    }
}

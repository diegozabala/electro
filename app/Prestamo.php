<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table="prestamos";

    protected  $fillable=[
        'user_id','estudiante_id','equipo_id','componente_id','cantidad_equipo','cantidad_componente','paquetes','estado','created_at','observaciones',
    ];


    public function estudiante(){
        return $this->belongsTo('App\Estudiante');
    }

    public function instrumento(){
        return $this->belongsTo('App\Instrumento');
    }

    public function componente(){
        return $this->belongsTo('App\Componente');
    }
}

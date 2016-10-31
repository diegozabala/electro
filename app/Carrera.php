<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table="carreras";

    protected  $fillable=[
        'id','nombre','facultad_id',
    ];

    public function estudiantes(){
        return $this->hasMany('App\Estudiante');
    }

    public function facultad(){
        return $this->belongsTo('App\Facultad');
    }
}

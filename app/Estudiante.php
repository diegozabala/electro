<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property mixed  nombre_estudiante
 * @property mixed apellido_estudiante
 * @property mixed numero_documento
 * @property String carrera_id
 * @property string imagen
 */
class Estudiante extends Model
{

    protected $table="estudiantes";
    
    protected $fillable = [
        'nombre_estudiante', 'apellido_estudiante','numero_documento','carrera_id','imagen',
    ];
    public function carrera(){
        return $this->belongsTo('App\Carrera');
    }

    public function prestamos(){
        return $this->hasMany('App\Prestamo');
    }

    public function scopeSearch($query, $name){
        return $query->where('name','LIKE','%$NAME%');
    }
}

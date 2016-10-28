<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**

 * @property mixed  nombre
 * @property mixed apellido
 * @property mixed cedula
 * @property String facultad
 * @property string imagen
 */
class Profesor extends Model
{

    protected $table="profesores";
    
    protected $fillable = [
        'nombre_profesor', 'apellido', 'cedula','facultad_id','imagen','numero','apellido_profesor'
    ];
    public function facultad(){
        return $this->belongsTo('App\Facultad');
    }

    public function scopeSearch($query, $name){
        return $query->where('name','LIKE','%$NAME%');
    }
}

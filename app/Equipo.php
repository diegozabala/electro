<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**

 * @property mixed  nombre
 * @property mixed placa
 * @property String descripcion
 * @property string estado
 */

class Equipo extends Model
{
    protected $table="equipos";
    protected $fillable=['nombre','placa','descripcion','estado','tipo'
    ];
    
    public function prestamos(){
        return $this->hasMany('App\Prestamo');
    }
}

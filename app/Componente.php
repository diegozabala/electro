<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property mixed  nombre
 * @property integer cantidad
 * @property String descripcion
 * @property string estado
 * @property string referencia
 */

class Componente extends Model
{
    protected $table="componentes";
    protected $fillable=['nombre','cantidad','descripcion','estado','referencia',
    ];
    
    public function prestamos(){
        return $this->hasMany('App\Prestamo');
    }
}

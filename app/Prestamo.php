<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table="prestamos";

    protected  $fillable=[
        'user_id','profesores_id','equipos_id','adicion', 'created_at','observaciones'
    ];

}

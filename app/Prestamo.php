<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table="prestamos";

    protected  $fillable=[
        'user_id','estudiante_id','instrumento_id','adicion','estado','created_at','observaciones',
    ];

}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * @property char password
     * @property mixed  name
     * @property mixed  apellido
     * @property string rol
     * @property string imagen
     * @property mixed  id
     * @property string cedula
     * @property mixed email
     */
    protected $table='users';
    protected $fillable = [
        'name', 'email', 'password','apellido','cedula','rol','imagen',
        'id','created_at','remember_token'
    ];
   

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

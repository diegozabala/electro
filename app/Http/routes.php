<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::get('/', function () {
        if (Auth::check())
        {
            return view('home');
        }
        else
            return view('auth.login');

    });


    Route::get('error', function(){
        abort(500);
    });



    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::resource('users', 'UsersController');
        Route::get('users/{id}/destroy', ['uses' => 'UsersController@destroy', 'as' => 'admin.user.destroy']);
        Route::get('user/{id}/show', ['uses' => 'UsersController@show', 'as' => 'admin.user.show']);
        Route::post('user/{id}/update', ['uses' => 'UsersController@update', 'as' => 'admin.users.update']);
        Route::get('users/{id}/pass', ['uses' => 'UsersController@pass', 'as' => 'admin.user.pass']);
        Route::post('users/{id}/pass1', ['uses' => 'UsersController@pass1', 'as' => 'admin.user.pass1']);

        Route::resource('instrumentos', 'InstrumentosController');
        Route::get('instrumentos/{id}/destroy', ['uses' => 'InstrumentosController@destroy', 'as' => 'admin.instrumentos.destroy']);
        Route::get('instrumentos/{id}/show', ['uses' => 'InstrumentosController@show', 'as' => 'admin.instrumentos.show']);
        Route::get('instrumentos/{id}/edit', ['uses' => 'InstrumentosController@edit', 'as' => 'admin.instrumentos.edit']);
        Route::post('instrumentos/{id}/update', ['uses' => 'InstrumentosController@update', 'as' => 'admin.instrumentos.update']);

        Route::resource('componentes', 'ComponentesController');
        Route::get('componentes/{id}/destroy', ['uses' => 'ComponentesController@destroy', 'as' => 'admin.componentes.destroy']);
        Route::get('componentes/{id}/show', ['uses' => 'ComponentesController@show', 'as' => 'admin.componentes.show']);
        Route::get('componentes{id}/edit', ['uses' => 'ComponentesController@edit', 'as' => 'admin.componentes.edit']);
        Route::post('componentes/{id}/update', ['uses' => 'ComponentesController@update', 'as' => 'admin.componentes.update']);

        Route::resource('estudiantes', 'EstudiantesController');
        Route::get('estudiantes/{id}/destroy', ['uses' => 'EstudiantesController@destroy', 'as' => 'admin.estudiantes.destroy']);
        Route::get('estudiantes/{id}/show', ['uses' => 'EstudiantesController@show', 'as' => 'admin.estudiantes.show']);
        Route::post('estudiantes/{id}/update', ['uses' => 'EstudiantesController@update', 'as' => 'admin.estudiantes.update']);
        Route::get('estudiantes/find',['uses' => 'EstudiantesController@find','as' => 'admin.estudiantes.find']);

        Route::resource('prestamos', 'PrestamosController');
        Route::get('prestamos/{id}/destroy', ['uses' => 'PrestamosController@destroy', 'as' => 'admin.prestamos.destroy']);
        Route::get('prestamos/{id}/show', ['uses' => 'PrestamosController@show', 'as' => 'admin.prestamos.show']);
        Route::get('prestamos/{id}/edit', ['uses' => 'PrestamosController@edit', 'as' => 'admin.prestamos.edit']);
        Route::post('prestamos/{id}/update', ['uses' => 'PrestamosController@update', 'as' => 'admin.prestamos.update']);
        Route::post('prestamos/find', ['uses' => 'PrestamosController@find', 'as' => 'admin.prestamos.find']);
        Route::post('prestamos/find1', ['uses' => 'PrestamosController@find1', 'as' => 'admin.prestamos.find1']);

    });

    Route::auth();



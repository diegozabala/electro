<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddPrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('estudiante_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->integer('equipo_id')->unsigned()->nullable();

            $table->integer('componente_id')->unsigned()->nullable();


            $table->integer('cantidad_equipo')->nullable();
            $table->integer('cantidad_componente')->nullable();
            $table->string('paquetes');
            $table->string('estado');
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });

        //Las llaves foraneas se tienen que crear en un Schema::table porque es donde se crean las relaciones
        //En el Schema::create solo se pueden crear columnas 
        Schema::table('prestamos', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('equipo_id')->references('id')->on('instrumentos');
            $table->foreign('componente_id')->references('id')->on('componentes');
   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('prestamos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("numero_documento")->unique();
            $table->string("nombre_estudiante");
            $table->string("apellido_estudiante");
            $table->string('imagen');
            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estudiantes');
    }
}

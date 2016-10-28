<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfesoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("cedula")->unique();
            $table->string("nombre_profesor");
            $table->string("apellido_profesor");
            $table->string('imagen');
            $table->string('numero');
            $table->integer('facultad_id')->unsigned();
            $table->foreign('facultad_id')->references('id')->on('facultades');
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
        Schema::drop('profesores');
    }
}

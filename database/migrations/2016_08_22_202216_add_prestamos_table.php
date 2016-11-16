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

            $table->integer('estudiante_id');
            $table->integer('user_id');
            $table->integer('equipo_id')->nullable();
            $table->integer('componente_id')->nullable();
            $table->integer('cantidad_equipo')->nullable();
            $table->integer('cantidad_componente')->nullable();
            $table->string('estado');
            $table->string('observaciones')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('prestamos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

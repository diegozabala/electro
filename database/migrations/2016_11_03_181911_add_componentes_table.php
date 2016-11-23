<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class AddComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre");
            $table->integer('cantidad');
            $table->string('referencia');
            $table->string("descripcion", 256);
            $table->string('estado');
            $table->timestamps();
        });

        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('BANANA',13,'CAIMAN','para conectar el generador','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('SONDA',5,'BNC MACHO','Para conectar el generador','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('RESISTENCIA',45,'5K','Medir corriente','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('RESISTENCIA',50,'10K','Medir corriente','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('RESISTENCIA',60,'2K','Medir corriente','disponible')");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('componentes');
    }
}

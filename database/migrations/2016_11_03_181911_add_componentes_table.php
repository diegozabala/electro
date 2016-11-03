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

        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('Bananas',13,'Caiman','para conectar el generador','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('Sondas',5,'BNC MACHO','Para conectar el generador','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('Resistencia',45,'5K','Medir corriente','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('Resistencia',50,'10K','Medir corriente','disponible')");
        DB::statement("INSERT INTO `componentes` (`nombre`,`cantidad`,`referencia`,`descripcion`,`estado`) VALUES ('Resistencia',60,'2K','Medir corriente','disponible')");

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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddInstrumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre");
            $table->integer('cantidad');
            $table->string('tipo');
            $table->string("descripcion", 256);
            $table->string('estado');
            $table->timestamps();
        });
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('OSCILOSCOPIO',12,'ANALÓGICO','para ver señales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('OSCILOSCOPIO',22,'DIGITAL','para ver señales digitales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('MULTIMETRO',19,'DIGITAL','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('MULTIMETRO',15,'ANALÓGICO','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('GENERADOR',8,'DIGITAL','Generar señales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('GENERADOR',11,'ANALÓGICO','Generar señales','disponible')");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('instrumentos');
    }
}

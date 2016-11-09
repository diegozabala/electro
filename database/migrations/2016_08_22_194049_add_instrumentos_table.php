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
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Osciloscopio',12,'Analógico','para ver señales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Osciloscopio',22,'Digital','para ver señales digitales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Multimetro',19,'Digital','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Multimetro',15,'Analógico','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Generador',8,'Digital','Generar señales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Generador',11,'Analogico','Generar señales','disponible')");

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

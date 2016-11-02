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
            $table->string('cantidad');
            $table->string('tipo');
            $table->string("descripcion", 256);
            $table->string('estado');
            $table->timestamps();
        });
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Osciloscopio','12','Analógico','para ver señales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Osciloscopio','25','Digital','para ver señales digitales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Multimetro','25','Digital','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Multimetro','15','Analógico','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Bananas','13','Caiman','para conectar el generador','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Bananas','5','Macho de 4MM','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Bananas','5','Hembra de 2MM','Medir corriente','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Generador de señales','8','Digital','Generar señales','disponible')");
        DB::statement("INSERT INTO `instrumentos` (`nombre`,`cantidad`,`tipo`,`descripcion`,`estado`) VALUES ('Generador de señales','11','Analogico','Generar señales','disponible')");

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
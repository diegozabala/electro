<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddFacultadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();

        });

        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Facultad de Ingeniería')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Facultad de Educación')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Facultad de Ciencias Humanas y Bellas Artes')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Facultad de Ciencias Básicas y Tecnologías')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Facultad de Ciencias Económicas y Administrativas')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Facultad Ciencias De La Salud')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Facultad de Ciencias Agroindustriales')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facultades', function (Blueprint $table) {
            //
        });
    }
}

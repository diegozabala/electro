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

        });
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Ingeniería de Sistemas y Computación')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Ingeniería Civil')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Ingeniería Electrónica')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Técnología en Obras Civiles')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Tecnología en Topografía')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Biología y Educación Ambiental')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Eduación Física y deportes')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Español y Deportes')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Lenguas Modernas')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Matemáticas')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Ciencias Sociales con énfasis en Eduacación Basica')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Pedadogía infaltil')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Licenciatura en Pedagogía Social para la rehabilitación')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Artes visuales')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Comunicación Social-Periodismo')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Ciencia de la información y la Documentación')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Filosofía')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Gerontología')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Trabajo Social')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Física')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Química')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Tecnología en Instrumentación Electrónica')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Biología')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Administración Financiera Distancia')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Administración de Negocios Distancia')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Administración de Negocios')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Contaduría Pública')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Economía')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Medicina')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Seguridad y Salud en el Trabajo Distancia')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Enfermería')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Ingeniería de alimentos')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Tecnología Agroindustrial Distancia')");
        DB::statement("INSERT INTO `facultades` (`nombre`) VALUES ('Tecnología Agropecuaria Distancia')");
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

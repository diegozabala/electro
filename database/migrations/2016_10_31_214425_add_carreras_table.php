<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('facultad_id');

        });
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (1,'Ingeniería de Sistemas y Computación')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (1,'Ingeniería Civil')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (1,'Ingeniería Electrónica')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (1,'Técnología en Obras Civiles')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (1,'Tecnología en Topografía')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Biología y Educación Ambiental')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Eduación Física y deportes')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Español y Deportes')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Lenguas Modernas')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Matemáticas')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Ciencias Sociales con énfasis en Eduacación Basica')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Pedadogía infaltil')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (2,'Licenciatura en Pedagogía Social para la rehabilitación')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (3,'Artes visuales')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (3,'Comunicación Social-Periodismo')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (3,'Ciencia de la información y la Documentación')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (3,'Filosofía')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (3,'Gerontología')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (3,'Trabajo Social')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (4,'Física')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (4,'Química')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (4,'Tecnología en Instrumentación Electrónica')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (4,'Biología')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (5,'Administración Financiera Distancia')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (5,'Administración de Negocios Distancia')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (5,'Administración de Negocios')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (5,'Contaduría Pública')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (5,'Economía')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (6,'Medicina')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (6,'Seguridad y Salud en el Trabajo Distancia')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (6,'Enfermería')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (7,'Ingeniería de alimentos')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (7,'Tecnología Agroindustrial Distancia')");
        DB::statement("INSERT INTO `carreras` (`facultad_id`,`nombre`) VALUES (7,'Tecnología Agropecuaria Distancia')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carreras', function (Blueprint $table) {
            //
        });
    }
}

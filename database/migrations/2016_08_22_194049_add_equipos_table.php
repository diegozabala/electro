<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre");
            $table->string('placa');
            $table->string('tipo');
            $table->string("descripcion", 256);
            $table->string('estado');
            $table->timestamps();
        });
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 19','59298','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 7','55787','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 6','55789','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 9','55792','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 4','55793','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 2','55790','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 10','55795','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 8','40272','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 3','40271','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 5','55796','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 20','59304','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 13','59299','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 11','59300','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 15','59302','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 12','59294','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 17','59303','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 14','59295','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 18','59301','pc','Hp','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 1','5591','pc','DELL','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Portatil 16','59297','pc','Hp','disponible')");





        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 7','57433','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 12','43137','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 11','48683','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 13','54195','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 5','54196','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 4','54186','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 3','54192','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 8','57432','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 1','50645','VB','EPSON','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('VB 6','54185','VB','EPSON','disponible')");



        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Apuntador 2','58026','apuntador','Targus','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Apuntador 8','62608','apuntador','Logitech','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Apuntador 1','58025','apuntador','Targus','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Apuntador 6','62610','apuntador','Logitech','disponible')");
        DB::statement("INSERT INTO `equipos` (`nombre`,`placa`,`tipo`,`descripcion`,`estado`)
    VALUES ('Apuntador 7','62606','apuntador','Logitech','disponible')");






    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('equipos');
    }
}

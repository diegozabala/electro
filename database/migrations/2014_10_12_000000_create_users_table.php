<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->char('password',60);
            $table->string('apellido');
            $table->string('cedula');
            $table->string('imagen'
            );
            $table->enum('rol', [
                'admin',
                'auxiliar'
            ])->default('auxiliar');
            $table->rememberToken();
            $table->timestamps();
        });
        $pass=bcrypt('universidad@gmail.com');
        DB::statement("INSERT INTO `users` (`name`,`email`,`password`,`apellido`,`cedula`,`imagen`,`rol`) VALUES ('ROOT','universidad@gmail.com','$pass','','12345','hulk.png','admin')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

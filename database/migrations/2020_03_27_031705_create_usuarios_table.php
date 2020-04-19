<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('correo');
            $table->string('usuario');
            $table->string('password');
            $table->string('nro_documento');
            $table->integer('estado');
            $table->integer('usuario_creador');
            $table->bigInteger('fk_perfil')->unsigned();
            $table->foreign('fk_perfil')->references('id')->on('perfiles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}

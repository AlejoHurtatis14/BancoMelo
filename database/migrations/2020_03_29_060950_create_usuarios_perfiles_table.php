<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosPerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_perfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('estado');
            $table->bigInteger('fk_usuario')->unsigned();
            $table->foreign('fk_usuario')->references('id')->on('usuarios');
            $table->bigInteger('fk_perfil')->unsigned();
            $table->foreign('fk_perfil')->references('id')->on('perfiles');
            $table->bigInteger('fk_usuario_creador')->unsigned();
            $table->foreign('fk_usuario_creador')->references('id')->on('usuarios');
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
        Schema::dropIfExists('usuarios_perfiles');
    }
}

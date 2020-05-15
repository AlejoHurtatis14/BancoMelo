<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fk_usuario')->unsigned();
            $table->foreign('fk_usuario')->references('id')->on('usuarios');
            $table->string('password');
            $table->string('nombre');
            $table->float('saldo', 20);
            $table->integer('estado');
            $table->string('fk_tipo_cuenta');
            $table->integer('usuario_creador');
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
        Schema::dropIfExists('cuentas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('saldo');
            $table->string('codigo');
            $table->string('estado');
            $table->bigInteger('fk_cuenta')->unsigned();
            $table->foreign('fk_cuenta')->references('id')->on('cuentas');
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
        Schema::dropIfExists('codigo_solicituds');
    }
}

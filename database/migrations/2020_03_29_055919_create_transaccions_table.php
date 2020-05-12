<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('monto');
            $table->float('saldo_anterior');
            $table->float('saldo_Actual');
            $table->integer('fk_usuario_creador');
            $table->bigInteger('fk_cuenta')->unsigned();
            $table->foreign('fk_cuenta')->references('id')->on('cuentas');
            $table->string('fk_codigo');
            //$table->bigInteger('fk_codigo')->unsigned();
            //$table->foreign('fk_codigo')->references('id')->on('codigo_solicituds');
            $table->bigInteger('fk_tipo_transaccion')->unsigned();
            $table->foreign('fk_tipo_transaccion')->references('id')->on('tipo_transacciones');
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
        Schema::dropIfExists('transaccions');
    }
}

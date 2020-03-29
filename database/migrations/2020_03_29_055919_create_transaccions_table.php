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
            $table->string('monto');
            $table->string('saldo_anterior');
            $table->string('saldo_Actual');
            $table->string('fk_usuario_creador');
            $table->bigInteger('fk_cuenta')->unsigned();
            $table->foreign('fk_cuenta')->references('id')->on('cuentas');
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

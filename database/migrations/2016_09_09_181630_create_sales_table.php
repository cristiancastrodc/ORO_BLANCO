<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('tipo_comprobante', ['boleta', 'factura']);
            $table->string('serie_comprobante', 4);
            $table->string('numero_comprobante', 8);
            $table->dateTime('fecha_hora_emision');
            $table->integer('id_usuario');
            $table->integer('id_cliente');

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_cliente')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
    }
}

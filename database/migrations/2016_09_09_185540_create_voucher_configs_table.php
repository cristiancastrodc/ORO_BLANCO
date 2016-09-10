<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('tipo_comprobante', ['boleta', 'factura']);
            $table->string('serie_comprobante', 4);
            $table->string('numero_actual', 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('voucher_configs');
    }
}

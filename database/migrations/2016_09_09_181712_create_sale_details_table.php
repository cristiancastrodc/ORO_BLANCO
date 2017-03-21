<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_venta');
            $table->integer('id_producto');
            $table->string('descripcion_corta', 30);
            $table->decimal('cantidad', 6, 2);
            $table->decimal('precio_unitario', 10, 4);
            $table->decimal('precio_total', 10, 4);

            $table->foreign('id_venta')->references('id')->on('sales');
            $table->foreign('id_producto')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sale_details');
    }
}

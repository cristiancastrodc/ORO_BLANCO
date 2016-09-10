<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_amounts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_venta');
            $table->decimal('sub_total', 10, 4);
            $table->decimal('igv', 10, 4);
            $table->decimal('total', 10, 4);

            $table->foreign('id_venta')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sale_amounts');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ruc', 11);
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('eslogan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_configs');
    }
}

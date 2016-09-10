<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
    #protected $fillable = ['', '', '', 'ingresos', 'egresos', 'monto_actual', 'fecha_hora_fin', 'estado'];
            $table->dateTime('fecha_hora_inicio');
            $table->integer('id_usuario');
            $table->decimal('monto_inicial', 10, 4);
            $table->decimal('ingresos', 10, 4);
            $table->decimal('egresos', 10, 4);
            $table->decimal('monto_actual', 10, 4);
            $table->dateTime('fecha_hora_fin');
            $table->enum('estado', ['abierta', 'cerrada']);

            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sale_sessions');
    }
}

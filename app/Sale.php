<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_comprobante', 'serie_comprobante', 'numero_comprobante', 'fecha_hora_emision', 'id_usuario', 'id_cliente'];
}

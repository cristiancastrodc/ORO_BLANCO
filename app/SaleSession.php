<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleSession extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sale_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha_hora_inicio', 'id_usuario', 'monto_inicial', 'ingresos', 'egresos', 'monto_actual', 'fecha_hora_fin', 'estado'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherConfig extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vouchers_config';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_comprobante', 'serie_comprobante', 'numero_actual'];
}

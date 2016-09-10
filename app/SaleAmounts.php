<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleAmounts extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sale_amounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_venta', 'sub_total', 'igv', 'total'];
}

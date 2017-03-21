<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessConfig extends Model
{   
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_configs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ruc', 'razon_social', 'direccion', 'telefono','eslogan'];
}

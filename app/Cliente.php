<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = ['nombre', 'telefono', 'correo', 'direccion' , 'observaciones', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }

    public function fichas()
    {
        return $this->hasMany('App\Ficha');
    }

}

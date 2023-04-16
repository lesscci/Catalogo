<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Proveedor extends Model
{
    use HasApiTokens,   HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
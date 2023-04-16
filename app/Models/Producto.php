<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Producto extends Model
{
    use HasApiTokens;
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'proveedor_id'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
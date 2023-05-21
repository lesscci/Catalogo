<?php

namespace App\Models;
use App\Models\Seller;
use App\Models\Category;
use App\Models\Transaction;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    const PRODUCTO_DISPONIBLE = 'disponible';
    const  PRODUCTO_NO_DISPONIBLE = 'no disponible';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status', 
        'image',
        'seller_id'
    ];

    public function estaDisponible()
    {
        return $this->status == Product::PRODUCTO_DISPONIBLE;
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    protected $hidden = [
        'pivot'
    ];


}
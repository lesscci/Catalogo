<?php

namespace App\Models;


use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO ='0';

    const USUARIO_ADMIN = 'true';
    const USUARIO_NORMAL = 'false';

    protected $table = 'users';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

public function esVerificado(){
    return $this->verified == User::USUARIO_VERIFICADO;
}

public function esAdministrador(){
    return $this->admin == User::USUARIO_ADMIN;
}

public static function generarVerificationToken(){
    return Str::random(40);
}


//funciones para cambiar Mayusculsa/Min
public function setNameAttribute($valor)
{
    $this->attributes['name'] = strtolower($valor);
}

public function getNameAttribute($valor)
{
    return ucwords($valor);
}

public function setEmailAttribute($valor)
{
    $this->attributes['email'] = strtolower($valor);
}


}

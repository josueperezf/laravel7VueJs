<?php

namespace App;

use App\Receta;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /** evento que se ejecuta cuando un usuario es creado */
    protected static function booted()
    {
        // parent::boot();
        static::created(function ($user) {
            $user->perfil()->create();
        });
    }

    /**Relacion  de 1 a mucho de usuario a recetas*/
    public function recetas() {
        return $this->hasMany(Receta::class);
    }
    public function perfil() {
        return $this->hasOne(Perfil::class);
    }

    // recetas a la que el usuaerio le a dado me gusta
    // relacion de n:m  like esto esta en tabla pivote
    public function meGusta() {
        return $this->belongsToMany(Receta::class, 'like_recetas');
    }
}

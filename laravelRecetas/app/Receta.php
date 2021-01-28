<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo','ingredientes','preparacion','imagen','user_id','categoria_id',
    ];
    //obtiene informacion de lA categoria via FK
    public function categoria() {
        return $this->belongsTo(CategoriaReceta::class);
    }
    //obtiene informacion del usuario via FK
    public function autor() {
        return $this->belongsTo(User::class,'user_id');
    }

    // likes de una receta relacion de  muchos a muchos
    // receta puede tener muchos like esto esta en tabla pivote
    public function likes() {
        return $this->belongsToMany(User::class, 'like_recetas');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaReceta extends Model
{
    public function recetas() {
        return $this->hasMany(Receta::class,'categoria_id');
    }
}

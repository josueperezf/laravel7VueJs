<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'imagen_principal',
        'direccion',
        'latitud',
        'longitud',
        'telefono',
        'descripcion',
        'apertura',
        'cierre',
        'uuid',
        'categoria_id',
        'user_id',
    ];
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}

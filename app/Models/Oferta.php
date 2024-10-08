<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',

        'salario',
        'ubicacion',
        'fecha_vencimiento',
        'user_id',
    ];

    // Definir la relación con postulaciones
    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}

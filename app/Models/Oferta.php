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
        'fecha_hora_inicio',  // Nuevo campo
        'fecha_hora_fin',     // Nuevo campo
        'fecha_vencimiento',
        'user_id',
    ];

    // Definir que estos campos deben ser tratados como fechas
    protected $casts = [
        'fecha_hora_inicio' => 'datetime',
        'fecha_hora_fin' => 'datetime',
    ];

    // Relación con el modelo User (Creador de la oferta)
    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con postulaciones
    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}

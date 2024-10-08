<?php

namespace App\Http\Controllers;

use App\Models\Postulacion;
use Illuminate\Http\Request;

class PostulacionController extends Controller
{
    public function cambiarEstado(Request $request, Postulacion $postulacion)
    {
        // Validar que el estado sea válido
        $request->validate([
            'estado' => 'required|in:pendiente,aceptado,rechazado',
        ]);

        // Actualizar el estado de la postulación
        $postulacion->estado = $request->estado;
        $postulacion->save();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'El estado de la postulación ha sido actualizado.');
    }
}

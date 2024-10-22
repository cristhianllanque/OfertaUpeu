<?php

namespace App\Http\Controllers;

use App\Models\Postulacion;
use Illuminate\Http\Request;

class PostulacionController extends Controller
{
    /**
     * Cambiar el estado de la postulación.
     */
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

    /**
     * Cancelar la postulación.
     */
    public function cancelarPostulacion($id)
    {
        $postulacion = Postulacion::findOrFail($id);

        // Verificar que la postulación pertenezca al usuario autenticado
        if ($postulacion->user_id !== auth()->id()) {
            return redirect()->back()->with('alert', 'No tienes permisos para cancelar esta postulación.');
        }

        // Eliminar la postulación
        $postulacion->delete();

        // Redirigir a la lista de postulaciones con un mensaje de éxito
        return redirect()->route('postulaciones.index')->with('success', 'Has cancelado tu postulación a esta oferta.');
    }

    /**
     * Mostrar la lista de postulaciones.
     */
    public function index()
    {
        // Obtener las postulaciones del usuario autenticado
        $postulaciones = Postulacion::where('user_id', auth()->id())->with('oferta')->get();
        
        // Retornar la vista de las postulaciones
        return view('postulaciones.index', compact('postulaciones'));
    }

    /**
     * Generar el reporte general de las postulaciones del usuario.
     */
    public function generarReporte()
    {
        // Obtener todas las postulaciones del usuario autenticado
        $postulaciones = Postulacion::where('user_id', auth()->id())->with('oferta')->get();

        // Verificar si hay postulaciones
        if ($postulaciones->isEmpty()) {
            return redirect()->route('postulaciones.index')->with('alert', 'No hay postulaciones para generar un reporte.');
        }

        // Generar el PDF utilizando mPDF o cualquier otra biblioteca que estés utilizando
        $mpdf = new \Mpdf\Mpdf(); // Instanciar mPDF
        $html = view('postulaciones.reporte', compact('postulaciones'))->render(); // Renderizar la vista como HTML
        $mpdf->WriteHTML($html); // Escribir el HTML en el PDF

        return $mpdf->Output('reporte_postulaciones.pdf', 'D'); // Forzar descarga del PDF
    }
}

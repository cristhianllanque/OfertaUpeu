<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mpdf\Mpdf;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now('America/Lima'); // Zona horaria de Lima

        // Si el usuario tiene el rol de "empresa", puede ver todas sus ofertas
        if (auth()->user()->hasRole('empresa')) {
            $ofertas = Oferta::where('user_id', auth()->id())->with('creador')->get();
        } else {
            // Los postulantes pueden ver todas las ofertas, pero no pueden postularse si la fecha_hora_inicio no ha llegado
            $ofertas = Oferta::with('creador')->get()->map(function ($oferta) use ($now) {
                // Asegurarse que la oferta se maneje con la zona horaria correcta
                $oferta->puede_ver_detalles = Carbon::parse($oferta->fecha_hora_inicio, 'America/Lima')->lte($now);
                return $oferta;
            });
        }

        return view('ofertas.index', compact('ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ofertas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'salario' => 'required|numeric',
            'ubicacion' => 'required',
            'fecha_vencimiento' => 'required|date',
            'fecha_hora_inicio' => 'nullable|date',
            'fecha_hora_fin' => 'nullable|date|after:fecha_hora_inicio',
        ]);

        // Guardar con la zona horaria correcta
        Oferta::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'salario' => $request->salario,
            'ubicacion' => $request->ubicacion,
            'fecha_vencimiento' => Carbon::parse($request->fecha_vencimiento, 'America/Lima'),
            'fecha_hora_inicio' => Carbon::parse($request->fecha_hora_inicio, 'America/Lima'),
            'fecha_hora_fin' => Carbon::parse($request->fecha_hora_fin, 'America/Lima'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('ofertas.index')->with('success', 'Oferta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
        $now = Carbon::now('America/Lima'); // Obtener la fecha y hora actual en Lima

        // Verificar si la oferta ya está disponible para postulación
        $puedePostularse = Carbon::parse($oferta->fecha_hora_inicio, 'America/Lima')->lte($now);

        return view('ofertas.show', compact('oferta', 'puedePostularse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oferta $oferta)
    {
        return view('ofertas.edit', compact('oferta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oferta $oferta)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'salario' => 'required|numeric',
            'ubicacion' => 'required',
            'fecha_vencimiento' => 'required|date',
            'fecha_hora_inicio' => 'nullable|date',
            'fecha_hora_fin' => 'nullable|date|after:fecha_hora_inicio',
        ]);

        // Actualizar la oferta con la nueva zona horaria
        $oferta->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'salario' => $request->salario,
            'ubicacion' => $request->ubicacion,
            'fecha_vencimiento' => Carbon::parse($request->fecha_vencimiento, 'America/Lima'),
            'fecha_hora_inicio' => Carbon::parse($request->fecha_hora_inicio, 'America/Lima'),
            'fecha_hora_fin' => Carbon::parse($request->fecha_hora_fin, 'America/Lima'),
        ]);

        return redirect()->route('ofertas.index')->with('success', 'Oferta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oferta $oferta)
    {
        $oferta->delete();

        return redirect()->route('ofertas.index')->with('success', 'Oferta eliminada exitosamente.');
    }

    /**
     * Postularse a una oferta.
     */
    public function postularse($id)
    {
        $oferta = Oferta::findOrFail($id);
        $now = Carbon::now('America/Lima'); // Obtener la hora actual de Lima

        // Verificar si ya ha pasado la fecha_hora_inicio para permitir la postulación
        if (Carbon::parse($oferta->fecha_hora_inicio, 'America/Lima')->gt($now)) {
            return redirect()->route('ofertas.show', $oferta->id)->with('alert', 'Esta oferta aún no está habilitada para postulación. Estará disponible en ' . $oferta->fecha_hora_inicio->diffForHumans());
        }

        // Verificar si el usuario ya se ha postulado a esta oferta
        $existePostulacion = Postulacion::where('user_id', auth()->id())
                                    ->where('oferta_id', $oferta->id)
                                    ->exists();

        if ($existePostulacion) {
            return redirect()->route('ofertas.show', $oferta->id)
                             ->with('alert', 'Ya te has postulado a esta oferta.');
        }

        Postulacion::create([
            'user_id' => auth()->id(),
            'oferta_id' => $oferta->id,
        ]);

        return redirect()->route('ofertas.show', $oferta->id)->with('success', 'Te has postulado correctamente a esta oferta.');
    }

    /**
     * Mostrar las postulaciones del usuario.
     */
    public function misPostulaciones()
    {
        $postulaciones = Postulacion::where('user_id', auth()->id())->with('oferta')->get();
        return view('ofertas.mis-postulaciones', compact('postulaciones'));
    }

    /**
     * Mostrar las postulaciones gestionadas por la empresa.
     */
    public function gestionarPostulaciones()
    {
        $ofertas = Oferta::where('user_id', auth()->id())->with('postulaciones.user')->get();
        return view('ofertas.gestionar-postulaciones', compact('ofertas'));
    }

    /**
     * Actualizar el estado de una postulación y rechazar a los demás postulantes de la oferta.
     */
    public function actualizarEstado(Request $request, $id)
    {
        $postulacion = Postulacion::findOrFail($id);
        $estado = $request->input('estado');

        // Si se acepta una postulación, rechazar automáticamente a los demás postulantes de la misma oferta
        if ($estado === 'aceptado') {
            Postulacion::where('oferta_id', $postulacion->oferta_id)
                        ->where('id', '!=', $postulacion->id)
                        ->update(['estado' => 'rechazado']);
        }

        // Actualizar el estado del postulante seleccionado
        $postulacion->estado = $estado;
        $postulacion->save();

        return redirect()->route('gestionar-postulaciones')->with('success', 'Estado actualizado correctamente.');
    }

    /**
     * Ver el detalle de un postulante.
     */
    public function verPostulante($id)
    {
        $postulacion = Postulacion::with('user', 'oferta')->findOrFail($id);
        return view('ofertas.ver-postulante', compact('postulacion'));
    }

    /**
     * Generar el reporte en PDF de la oferta.
     */
    public function generarReporte($id)
    {
        $oferta = Oferta::with('postulaciones.user')->findOrFail($id);

        $mpdf = new Mpdf();
        $html = view('ofertas.reporte', compact('oferta'))->render();
        $mpdf->WriteHTML($html);

        return $mpdf->Output('reporte_oferta_' . $oferta->id . '.pdf', 'D');
    }
}

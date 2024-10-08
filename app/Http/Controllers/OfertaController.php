<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Postulacion; // Importar el modelo de Postulacion
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ofertas = Oferta::all();
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
            'part_time' => 'boolean',
            'full_time' => 'boolean',
            'salario' => 'required|numeric',
            'ubicacion' => 'required',
            'fecha_vencimiento' => 'required|date',
        ]);

        // Asignar el user_id del usuario autenticado al crear la oferta
        Oferta::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'part_time' => $request->part_time,
            'full_time' => $request->full_time,
            'salario' => $request->salario,
            'ubicacion' => $request->ubicacion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'user_id' => auth()->id(), // Aquí se asigna el user_id del usuario autenticado
        ]);

        return redirect()->route('ofertas.index')->with('success', 'Oferta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
        return view('ofertas.show', compact('oferta'));
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
            'part_time' => 'boolean',
            'full_time' => 'boolean',
            'salario' => 'required|numeric',
            'ubicacion' => 'required',
            'fecha_vencimiento' => 'required|date',
        ]);

        $oferta->update($request->all());

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

        // Verificar si el usuario ya se ha postulado a esta oferta
        $existePostulacion = Postulacion::where('user_id', auth()->id())
                                    ->where('oferta_id', $oferta->id)
                                    ->exists();

        if ($existePostulacion) {
            // Si ya está postulado, redirigir con un mensaje de alerta
            return redirect()->route('ofertas.show', $oferta->id)
                             ->with('alert', 'Ya te has postulado a esta oferta.');
        }

        // Guardar la postulación
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
     * Mostrar las gestionarPostulaciones.
     */
    public function gestionarPostulaciones()
    {
        $ofertas = Oferta::where('user_id', auth()->id())->with('postulaciones.user')->get(); // Obtener las ofertas de la empresa con sus postulaciones
        return view('ofertas.gestionar-postulaciones', compact('ofertas'));
    }

    /**
     * Actualizar el estado de una postulación.
     */
    public function actualizarEstado(Request $request, $id)
    {
        $postulacion = Postulacion::findOrFail($id);
        $postulacion->estado = $request->input('estado');
        $postulacion->save();

        return redirect()->route('gestionar-postulaciones')->with('success', 'Estado actualizado correctamente.');
    }
}

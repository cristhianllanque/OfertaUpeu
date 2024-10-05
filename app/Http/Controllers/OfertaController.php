<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
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

        Oferta::create($request->all());

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
     * Postularse a una oferta (método añadido)
     */
    public function postularse($id)
    {
        $oferta = Oferta::findOrFail($id);

        // Aquí puedes añadir la lógica de postulación, por ejemplo, guardar en una tabla pivot.
        // Por simplicidad, lo dejaremos como un mensaje de éxito.
     return redirect()->route('ofertas.index')->with('success', 'Te has postulado correctamente a esta oferta.');
    }
}

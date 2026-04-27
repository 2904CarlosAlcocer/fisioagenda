<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::latest()->get();

        return view('salas.index', compact('salas'));
    }

    public function create()
    {
        return view('salas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'ubicacion' => 'nullable|max:255',
            'capacidad' => 'nullable|integer|min:1',
            'estado' => 'required',
            'descripcion' => 'nullable',
        ]);

        Sala::create($request->all());

        return redirect()->route('salas.index')
            ->with('success', 'Sala registrada correctamente');
    }

    public function show(Sala $sala)
    {
        return redirect()->route('salas.index');
    }

    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'ubicacion' => 'nullable|max:255',
            'capacidad' => 'nullable|integer|min:1',
            'estado' => 'required',
            'descripcion' => 'nullable',
        ]);

        $sala->update($request->all());

        return redirect()->route('salas.index')
            ->with('success', 'Sala actualizada correctamente');
    }

    public function destroy(Sala $sala)
    {
        $sala->delete();

        return redirect()->route('salas.index')
            ->with('success', 'Sala eliminada correctamente');
    }
}
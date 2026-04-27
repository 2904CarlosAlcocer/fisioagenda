<?php

namespace App\Http\Controllers;

use App\Models\Fisioterapeuta;
use App\Models\User;
use Illuminate\Http\Request;

class FisioterapeutaController extends Controller
{
    public function index()
    {
        $fisioterapeutas = Fisioterapeuta::with('user')
            ->latest()
            ->get();

        return view('fisioterapeutas.index', compact('fisioterapeutas'));
    }

    public function create()
    {
        $usuarios = User::orderBy('name')->get();

        return view('fisioterapeutas.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:fisioterapeutas,user_id',
            'especialidad' => 'nullable|max:255',
            'telefono' => 'nullable|max:50',
            'horario' => 'nullable|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Fisioterapeuta::create($request->all());

        return redirect()->route('fisioterapeutas.index')
            ->with('success', 'Fisioterapeuta registrada correctamente');
    }

    public function show(Fisioterapeuta $fisioterapeuta)
    {
        return redirect()->route('fisioterapeutas.index');
    }

    public function edit(Fisioterapeuta $fisioterapeuta)
    {
        $usuarios = User::orderBy('name')->get();

        return view('fisioterapeutas.edit', compact('fisioterapeuta', 'usuarios'));
    }

    public function update(Request $request, Fisioterapeuta $fisioterapeuta)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:fisioterapeutas,user_id,' . $fisioterapeuta->id,
            'especialidad' => 'nullable|max:255',
            'telefono' => 'nullable|max:50',
            'horario' => 'nullable|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $fisioterapeuta->update($request->all());

        return redirect()->route('fisioterapeutas.index')
            ->with('success', 'Fisioterapeuta actualizada correctamente');
    }

    public function destroy(Fisioterapeuta $fisioterapeuta)
    {
        $fisioterapeuta->delete();

        return redirect()->route('fisioterapeutas.index')
            ->with('success', 'Fisioterapeuta eliminada correctamente');
    }
}
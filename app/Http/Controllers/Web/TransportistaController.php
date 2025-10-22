<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transportista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransportistaController extends Controller
{
    public function index(Request $request)
    {
        $q = Transportista::query();

        if ($s = $request->get('search')) {
            $q->where(function ($qq) use ($s) {
                $qq->where('nombre', 'like', "%{$s}%")
                   ->orWhere('nit', 'like', "%{$s}%")
                   ->orWhere('telefono', 'like', "%{$s}%")
                   ->orWhere('email', 'like', "%{$s}%");
            });
        }
        if ($tipo = $request->get('tipo')) {
            if ($tipo !== 'todos') {
                $q->where('tipo', $tipo);
            }
        }
        $transportistas = $q->latest()->paginate(12)->withQueryString();

        return view('transportistas.index', compact('transportistas'));
    }

    public function create()
    {
        return view('transportistas.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:150',
            'tipo' => 'required|in:empresa,independiente',
            'nit' => 'nullable|string|max:30',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:255',
            'active' => 'sometimes|boolean',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $transportista = Transportista::create($data);

        return redirect()->route('transportistas.show', $transportista->id)
            ->with('success', 'Transportista creado correctamente.');
    }

    public function show($id)
    {
        $transportista = Transportista::with('camiones')->findOrFail($id);
        return view('transportistas.show', compact('transportista'));
    }

    public function edit($id)
    {
        $transportista = Transportista::findOrFail($id);
        return view('transportistas.edit', compact('transportista'));
    }

    public function update(Request $request, $id)
    {
        $transportista = Transportista::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:150',
            'tipo' => 'required|in:empresa,independiente',
            'nit' => 'nullable|string|max:30',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:255',
            'active' => 'sometimes|boolean',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $transportista->update($data);

        return redirect()->route('transportistas.show', $transportista->id)
            ->with('success', 'Transportista actualizado.');
    }

    public function destroy($id)
    {
        $transportista = Transportista::findOrFail($id);
        $transportista->delete();

        return redirect()->route('transportistas.index')
            ->with('success', 'Transportista eliminado.');
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bodega;
use App\Models\Predio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BodegaController extends Controller
{
    public function index(Request $request)
    {
        $q = Bodega::with('predio');
        
        if ($s = $request->get('search')) {
            $q->where('nombre', 'like', "%{$s}%")
              ->orWhereHas('predio', function($qq) use ($s) {
                  $qq->where('nombre', 'like', "%{$s}%");
              });
        }

        $bodegas = $q->latest()->paginate(12)->withQueryString();
        return view('bodegas.index', compact('bodegas'));
    }

    public function create()
    {
        $predios = Predio::where('active', true)->orderBy('nombre')->get();
        return view('bodegas.create', compact('predios'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'predio_id' => 'required|exists:predios,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string|max:500',
            'active' => 'sometimes|boolean',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $bodega = Bodega::create($data);

        return redirect()->route('bodegas.show', $bodega->id)->with('success', 'Bodega creada correctamente.');
    }

    public function show($id)
    {
        $bodega = Bodega::with('predio')->findOrFail($id);
        return view('bodegas.show', compact('bodega'));
    }

    public function edit($id)
    {
        $bodega = Bodega::findOrFail($id);
        $predios = Predio::where('active', true)->orderBy('nombre')->get();
        return view('bodegas.edit', compact('bodega', 'predios'));
    }

    public function update(Request $request, $id)
    {
        $bodega = Bodega::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'predio_id' => 'required|exists:predios,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string|max:500',
            'active' => 'sometimes|boolean',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $bodega->update($data);

        return redirect()->route('bodegas.show', $bodega->id)->with('success', 'Bodega actualizada.');
    }

    public function destroy($id)
    {
        $bodega = Bodega::findOrFail($id);
        $bodega->delete();
        return redirect()->route('bodegas.index')->with('success', 'Bodega eliminada.');
    }
}

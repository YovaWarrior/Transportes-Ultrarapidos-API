<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bodega;
use App\Models\Predio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'Bodega',
            'model_id' => $bodega->id,
            'description' => 'Bodega creada: ' . $bodega->nombre,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => 'Bodega',
            'model_id' => $bodega->id,
            'description' => 'Bodega actualizada: ' . $bodega->nombre,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('bodegas.show', $bodega->id)->with('success', 'Bodega actualizada.');
    }

    public function destroy($id)
    {
        $bodega = Bodega::findOrFail($id);
        $nombreBodega = $bodega->nombre;
        $bodega->delete();

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => 'Bodega',
            'model_id' => $id,
            'description' => 'Bodega eliminada: ' . $nombreBodega,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('bodegas.index')->with('success', 'Bodega eliminada.');
    }
}

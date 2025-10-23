<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Predio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PredioController extends Controller
{
    public function index(Request $request)
    {
        $q = Predio::withCount('bodegas');
        
        if ($s = $request->get('search')) {
            $q->where('nombre', 'like', "%{$s}%")
              ->orWhere('pais', 'like', "%{$s}%");
        }

        $predios = $q->latest()->paginate(12)->withQueryString();
        return view('predios.index', compact('predios'));
    }

    public function create()
    {
        return view('predios.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:150',
            'pais' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:30',
            'active' => 'sometimes|boolean',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $predio = Predio::create($data);

        // Registrar actividad
        \DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'Predio',
            'model_id' => $predio->id,
            'description' => 'Predio creado: ' . $predio->nombre,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('predios.show', $predio->id)->with('success', 'Predio creado correctamente.');
    }

    public function show($id)
    {
        $predio = Predio::with('bodegas')->findOrFail($id);
        return view('predios.show', compact('predio'));
    }

    public function edit($id)
    {
        $predio = Predio::findOrFail($id);
        return view('predios.edit', compact('predio'));
    }

    public function update(Request $request, $id)
    {
        $predio = Predio::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:150',
            'pais' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:30',
            'active' => 'sometimes|boolean',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $predio->update($data);

        // Registrar actividad
        \DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => 'Predio',
            'model_id' => $predio->id,
            'description' => 'Predio actualizado: ' . $predio->nombre,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('predios.show', $predio->id)->with('success', 'Predio actualizado.');
    }

    public function destroy($id)
    {
        $predio = Predio::findOrFail($id);
        $nombrePredio = $predio->nombre;
        $predio->delete();

        // Registrar actividad
        \DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => 'Predio',
            'model_id' => $id,
            'description' => 'Predio eliminado: ' . $nombrePredio,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('predios.index')->with('success', 'Predio eliminado.');
    }
}

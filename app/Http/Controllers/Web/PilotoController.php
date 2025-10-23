<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Piloto;
use App\Models\Transportista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PilotoController extends Controller
{
    public function index(Request $request)
    {
        $q = Piloto::with('transportista');
        
        if ($s = $request->get('search')) {
            $q->where('nombre', 'like', "%{$s}%")
              ->orWhere('licencia', 'like', "%{$s}%")
              ->orWhere('dpi', 'like', "%{$s}%")
              ->orWhereHas('transportista', function($qq) use ($s) {
                  $qq->where('nombre', 'like', "%{$s}%");
              });
        }

        $pilotos = $q->latest()->paginate(12)->withQueryString();
        return view('pilotos.index', compact('pilotos'));
    }

    public function create()
    {
        $transportistas = Transportista::where('active', true)->orderBy('nombre')->get();
        return view('pilotos.create', compact('transportistas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transportista_id' => 'required|exists:transportistas,id',
            'nombre' => 'required|string|max:150',
            'licencia' => 'nullable|string|max:50',
            'dpi' => 'nullable|string|max:30',
            'telefono' => 'nullable|string|max:30',
            'active' => 'sometimes|boolean',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $piloto = Piloto::create($data);

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'Piloto',
            'model_id' => $piloto->id,
            'description' => 'Piloto creado: ' . $piloto->nombre,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pilotos.show', $piloto->id)->with('success', 'Piloto creado correctamente.');
    }

    public function show($id)
    {
        $piloto = Piloto::with('transportista')->findOrFail($id);
        return view('pilotos.show', compact('piloto'));
    }

    public function edit($id)
    {
        $piloto = Piloto::findOrFail($id);
        $transportistas = Transportista::where('active', true)->orderBy('nombre')->get();
        return view('pilotos.edit', compact('piloto', 'transportistas'));
    }

    public function update(Request $request, $id)
    {
        $piloto = Piloto::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'transportista_id' => 'required|exists:transportistas,id',
            'nombre' => 'required|string|max:150',
            'licencia' => 'nullable|string|max:50',
            'dpi' => 'nullable|string|max:30',
            'telefono' => 'nullable|string|max:30',
            'active' => 'sometimes|boolean',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['active'] = $request->boolean('active');
        $piloto->update($data);

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => 'Piloto',
            'model_id' => $piloto->id,
            'description' => 'Piloto actualizado: ' . $piloto->nombre,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pilotos.show', $piloto->id)->with('success', 'Piloto actualizado.');
    }

    public function destroy($id)
    {
        $piloto = Piloto::findOrFail($id);
        $nombrePiloto = $piloto->nombre;
        $piloto->delete();

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => 'Piloto',
            'model_id' => $id,
            'description' => 'Piloto eliminado: ' . $nombrePiloto,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pilotos.index')->with('success', 'Piloto eliminado.');
    }
}

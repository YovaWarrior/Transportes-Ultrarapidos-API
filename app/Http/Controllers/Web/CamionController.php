<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use App\Models\Transportista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CamionController extends Controller
{
    /**
     * Display a listing of camiones.
     */
    public function index(Request $request)
    {
        $query = Camion::with('transportista');

        // Búsqueda por texto
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('placa', 'LIKE', "%{$search}%")
                  ->orWhere('marca', 'LIKE', "%{$search}%")
                  ->orWhere('modelo', 'LIKE', "%{$search}%");
            });
        }

        // Filtro por estado
        if ($request->filled('estado') && $request->estado !== 'todos') {
            $query->where('estado', $request->estado);
        }

        // Filtro por tipo
        if ($request->filled('tipo') && $request->tipo !== 'todos') {
            $query->where('tipo', $request->tipo);
        }

        $camiones = $query->latest()->paginate(10)->withQueryString();

        // Estadísticas
        $totalCamiones = Camion::count();
        $activos = Camion::where('estado', 'activo')->count();
        $mantenimiento = Camion::where('estado', 'mantenimiento')->count();
        $fueraServicio = Camion::where('estado', 'fuera_servicio')->count();

        return view('camiones.index', compact(
            'camiones',
            'totalCamiones',
            'activos',
            'mantenimiento',
            'fueraServicio'
        ));
    }

    /**
     * Show the form for creating a new camion.
     */
    public function create()
    {
        $transportistas = Transportista::where('active', true)->orderBy('nombre')->get();
        
        return view('camiones.create', compact('transportistas'));
    }

    /**
     * Store a newly created camion.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'placa' => ['required', 'string', 'max:20', 'unique:camiones,placa', 'regex:/^(P|C|TC|M|A|O|CD|CC)-\d{3}[A-Z]{3}$/'],
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'año' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'tipo' => 'required|in:plataforma,furgón,refrigerado,tanque,carga_general',
            'capacidad' => 'required|numeric|min:0',
            'estado' => 'required|in:activo,mantenimiento,fuera_servicio',
            'transportista_id' => 'required|exists:transportistas,id',
        ], [
            'placa.regex' => 'El formato de placa no es válido. Debe ser: P-001AAA, C-001AAA, etc.',
            'placa.unique' => 'Esta placa ya está registrada.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $camion = Camion::create($request->all());

        // Registrar actividad
        \DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'Camion',
            'model_id' => $camion->id,
            'description' => 'Camión creado: ' . $camion->placa,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('camiones.index')
            ->with('success', 'Camión registrado exitosamente.');
    }

    /**
     * Display the specified camion.
     */
    public function show($id)
    {
        $camion = Camion::with(['transportista', 'ordenesTrabajos'])->findOrFail($id);

        return view('camiones.show', compact('camion'));
    }

    /**
     * Show the form for editing the specified camion.
     */
    public function edit($id)
    {
        $camion = Camion::findOrFail($id);
        $transportistas = Transportista::where('active', true)->orderBy('nombre')->get();

        return view('camiones.edit', compact('camion', 'transportistas'));
    }

    /**
     * Update the specified camion.
     */
    public function update(Request $request, $id)
    {
        $camion = Camion::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'placa' => ['required', 'string', 'max:20', 'unique:camiones,placa,' . $id, 'regex:/^(P|C|TC|M|A|O|CD|CC)-\d{3}[A-Z]{3}$/'],
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'año' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'tipo' => 'required|in:plataforma,furgón,refrigerado,tanque,carga_general',
            'capacidad' => 'required|numeric|min:0',
            'estado' => 'required|in:activo,mantenimiento,fuera_servicio',
            'transportista_id' => 'required|exists:transportistas,id',
        ], [
            'placa.regex' => 'El formato de placa no es válido. Debe ser: P-001AAA, C-001AAA, etc.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $camion->update($request->all());

        // Registrar actividad
        \DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => 'Camion',
            'model_id' => $camion->id,
            'description' => 'Camión actualizado: ' . $camion->placa,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('camiones.show', $camion->id)
            ->with('success', 'Camión actualizado exitosamente.');
    }

    /**
     * Remove the specified camion.
     */
    public function destroy($id)
    {
        $camion = Camion::findOrFail($id);
        
        // Verificar si tiene órdenes asociadas
        if ($camion->ordenesTrabajos()->count() > 0) {
            return redirect()->back()
                ->with('error', 'No se puede eliminar el camión porque tiene órdenes de trabajo asociadas.');
        }

        $placaCamion = $camion->placa;
        $camion->delete();

        // Registrar actividad
        \DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => 'Camion',
            'model_id' => $id,
            'description' => 'Camión eliminado: ' . $placaCamion,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('camiones.index')
            ->with('success', 'Camión eliminado exitosamente.');
    }
}

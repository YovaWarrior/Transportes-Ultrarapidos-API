<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\OrdenTrabajo;
use App\Models\Camion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OrdenTrabajoController extends Controller
{
    public function index(Request $request)
    {
        $q = OrdenTrabajo::with('camion');

        if ($s = $request->get('search')) {
            $q->where('numero_orden', 'like', "%{$s}%")
              ->orWhereHas('camion', function ($qq) use ($s) {
                  $qq->where('placa', 'like', "%{$s}%")
                     ->orWhere('marca', 'like', "%{$s}%")
                     ->orWhere('modelo', 'like', "%{$s}%");
              });
        }
        if ($estado = $request->get('estado')) {
            if ($estado !== 'todos') {
                $q->where('estado', $estado);
            }
        }

        $ordenes = $q->latest()->paginate(12)->withQueryString();

        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $camiones = Camion::orderBy('placa')->get();
        $pilotos = \App\Models\Piloto::where('active', true)->orderBy('nombre')->get();
        $predios = \App\Models\Predio::where('active', true)->orderBy('nombre')->get();
        $bodegas = \App\Models\Bodega::where('active', true)->with('predio')->orderBy('nombre')->get();
        $estados = ['pendiente','en_proceso','completada','cancelada'];
        return view('ordenes.create', compact('camiones','pilotos','predios','bodegas','estados'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'camion_id' => 'required|exists:camiones,id',
            'piloto_id' => 'nullable|exists:pilotos,id',
            'predio_id' => 'nullable|exists:predios,id',
            'bodega_id' => 'nullable|exists:bodegas,id',
            'estado' => 'required|in:pendiente,en_proceso,completada,cancelada',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $validator->validated();
        // Auto-generate numero_orden: OT-YYYYMMDD-####
        $today = now()->format('Ymd');
        $lastOrden = OrdenTrabajo::where('numero_orden', 'like', "OT-{$today}-%")->latest('id')->first();
        $sequence = 1;
        if ($lastOrden) {
            $parts = explode('-', $lastOrden->numero_orden);
            if (count($parts) === 3) {
                $sequence = intval($parts[2]) + 1;
            }
        }
        $data['numero_orden'] = sprintf('OT-%s-%04d', $today, $sequence);
        
        $orden = OrdenTrabajo::create($data);

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'OrdenTrabajo',
            'model_id' => $orden->id,
            'description' => 'Orden de trabajo creada: ' . $orden->numero_orden,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('ordenes.show', $orden->id)->with('success', 'Orden creada correctamente.');
    }

    public function show($id)
    {
        $orden = OrdenTrabajo::with(['camion','ingresoCamion','egresoCamion','valesCombustible'])->findOrFail($id);
        return view('ordenes.show', compact('orden'));
    }

    public function edit($id)
    {
        $orden = OrdenTrabajo::findOrFail($id);
        $camiones = Camion::orderBy('placa')->get();
        $pilotos = \App\Models\Piloto::where('active', true)->orderBy('nombre')->get();
        $predios = \App\Models\Predio::where('active', true)->orderBy('nombre')->get();
        $bodegas = \App\Models\Bodega::where('active', true)->with('predio')->orderBy('nombre')->get();
        $estados = ['pendiente','en_proceso','completada','cancelada'];
        return view('ordenes.edit', compact('orden','camiones','pilotos','predios','bodegas','estados'));
    }

    public function update(Request $request, $id)
    {
        $orden = OrdenTrabajo::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'camion_id' => 'required|exists:camiones,id',
            'piloto_id' => 'nullable|exists:pilotos,id',
            'predio_id' => 'nullable|exists:predios,id',
            'bodega_id' => 'nullable|exists:bodegas,id',
            'estado' => 'required|in:pendiente,en_proceso,completada,cancelada',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $orden->update($validator->validated());

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => 'OrdenTrabajo',
            'model_id' => $orden->id,
            'description' => 'Orden de trabajo actualizada: ' . $orden->numero_orden,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('ordenes.show', $orden->id)->with('success', 'Orden actualizada.');
    }

    public function destroy($id)
    {
        $orden = OrdenTrabajo::findOrFail($id);
        $numeroOrden = $orden->numero_orden;
        $orden->delete();

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => 'OrdenTrabajo',
            'model_id' => $id,
            'description' => 'Orden de trabajo eliminada: ' . $numeroOrden,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('ordenes.index')->with('success', 'Orden eliminada.');
    }
}

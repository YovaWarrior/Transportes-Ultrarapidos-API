<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrdenTrabajo;
use App\Models\IngresoCamion;
use App\Models\EgresoCamion;
use Illuminate\Http\Request;

class OrdenTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenTrabajo::with([
            'camion.transportista', 
            'piloto', 
            'predio', 
            'bodega',
            'ingresoCamion',
            'egresoCamion'
        ])->get();
        
        return response()->json([
            'success' => true,
            'data' => $ordenes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'piloto_id' => 'required|exists:pilotos,id',
            'predio_id' => 'required|exists:predios,id',
            'bodega_id' => 'required|exists:bodegas,id',
        ]);

        // Generar número de orden automático
        $numeroOrden = 'ORD-' . date('Y') . '-' . str_pad(OrdenTrabajo::count() + 1, 6, '0', STR_PAD_LEFT);

        $orden = OrdenTrabajo::create([
            'numero_orden' => $numeroOrden,
            'camion_id' => $request->camion_id,
            'piloto_id' => $request->piloto_id,
            'predio_id' => $request->predio_id,
            'bodega_id' => $request->bodega_id,
            'estado' => 'pendiente'
        ]);

        $orden->load(['camion.transportista', 'piloto', 'predio', 'bodega']);

        return response()->json([
            'success' => true,
            'message' => 'Orden de trabajo creada exitosamente',
            'data' => $orden
        ], 201);
    }

    public function show($id)
    {
        $orden = OrdenTrabajo::with([
            'camion.transportista', 
            'piloto', 
            'predio', 
            'bodega',
            'ingresoCamion',
            'egresoCamion',
            'valesCombustible'
        ])->find($id);

        if (!$orden) {
            return response()->json([
                'success' => false,
                'message' => 'Orden de trabajo no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $orden
        ]);
    }

    public function registrarIngreso(Request $request, $id)
    {
        $orden = OrdenTrabajo::find($id);

        if (!$orden) {
            return response()->json([
                'success' => false,
                'message' => 'Orden de trabajo no encontrada'
            ], 404);
        }

        $request->validate([
            'origen' => 'required|string|max:255',
            'tipo_carga' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        $ingreso = IngresoCamion::create([
            'orden_trabajo_id' => $orden->id,
            'origen' => $request->origen,
            'tipo_carga' => $request->tipo_carga,
            'fecha_ingreso' => $request->fecha_ingreso,
            'user_id' => auth()->id(),
            'observaciones' => $request->observaciones,
        ]);

        $orden->update(['estado' => 'en_proceso']);

        return response()->json([
            'success' => true,
            'message' => 'Ingreso registrado exitosamente',
            'data' => $ingreso
        ]);
    }

    public function registrarEgreso(Request $request, $id)
    {
        $orden = OrdenTrabajo::find($id);

        if (!$orden) {
            return response()->json([
                'success' => false,
                'message' => 'Orden de trabajo no encontrada'
            ], 404);
        }

        $request->validate([
            'destino' => 'required|string|max:255',
            'tipo_carga' => 'required|string|max:255',
            'fecha_egreso' => 'required|date',
            'kilometraje' => 'nullable|integer|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $egreso = EgresoCamion::create([
            'orden_trabajo_id' => $orden->id,
            'destino' => $request->destino,
            'tipo_carga' => $request->tipo_carga,
            'fecha_egreso' => $request->fecha_egreso,
            'user_id' => auth()->id(),
            'kilometraje' => $request->kilometraje,
            'observaciones' => $request->observaciones,
        ]);

        $orden->update(['estado' => 'completada']);

        return response()->json([
            'success' => true,
            'message' => 'Egreso registrado exitosamente',
            'data' => $egreso
        ]);
    }

    public function update(Request $request, $id)
    {
        $orden = OrdenTrabajo::find($id);

        if (!$orden) {
            return response()->json([
                'success' => false,
                'message' => 'Orden de trabajo no encontrada'
            ], 404);
        }

        $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,completada,cancelada',
        ]);

        $orden->update($request->only('estado'));

        return response()->json([
            'success' => true,
            'message' => 'Orden de trabajo actualizada exitosamente',
            'data' => $orden
        ]);
    }

    public function destroy($id)
    {
        $orden = OrdenTrabajo::find($id);

        if (!$orden) {
            return response()->json([
                'success' => false,
                'message' => 'Orden de trabajo no encontrada'
            ], 404);
        }

        $orden->delete();

        return response()->json([
            'success' => true,
            'message' => 'Orden de trabajo eliminada exitosamente'
        ]);
    }
}
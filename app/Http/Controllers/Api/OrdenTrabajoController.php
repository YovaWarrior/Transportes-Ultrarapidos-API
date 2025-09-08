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
    try {
        // Generar número de orden automático
        $numeroOrden = 'ORD-' . date('Y') . '-' . str_pad(OrdenTrabajo::count() + 1, 6, '0', STR_PAD_LEFT);

        $orden = new OrdenTrabajo();
        $orden->numero_orden = $numeroOrden;
        $orden->camion_id = $request->camion_id;
        $orden->piloto_id = $request->piloto_id;
        $orden->predio_id = $request->predio_id ?? 1; // Valor por defecto
        $orden->bodega_id = $request->bodega_id ?? 1; // Valor por defecto
        $orden->estado = $request->estado ?? 'pendiente';
        $orden->save();

        return response()->json([
            'success' => true,
            'message' => 'Orden de trabajo creada exitosamente',
            'data' => $orden
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
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

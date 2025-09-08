<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use Illuminate\Http\Request;

class CamionController extends Controller
{
    public function index()
    {
        $camiones = Camion::with('transportista')->get();

        return response()->json([
            'success' => true,
            'data' => $camiones
        ]);
    }

    public function store(Request $request)
{
    try {
        $camion = new Camion();
        $camion->transportista_id = $request->transportista_id;
        $camion->placa = $request->placa;
        $camion->tipo = $request->tipo ?? 'carga';
        $camion->capacidad = $request->capacidad ?? 0;
        $camion->estado = $request->estado ?? 'activo';
        $camion->año = $request->año ?? date('Y');
        $camion->marca = $request->marca ?? 'Sin especificar';
        $camion->modelo = $request->modelo ?? 'Sin especificar';
        $camion->save();

        return response()->json([
            'success' => true,
            'message' => 'Camión creado exitosamente',
            'data' => $camion
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
        $camion = Camion::with(['transportista', 'ordenesTrabajos'])->find($id);

        if (!$camion) {
            return response()->json([
                'success' => false,
                'message' => 'Camión no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $camion
        ]);
    }

    public function update(Request $request, $id)
{
    $camion = Camion::find($id);

    if (!$camion) {
        return response()->json([
            'success' => false,
            'message' => 'Camión no encontrado'
        ], 404);
    }

    $request->validate([
        'transportista_id' => 'required|exists:transportistas,id',
        'placa' => 'required|string|unique:camiones,placa,' . $id,
    ]);

    $camion->update($request->all());

    return response()->json([
        'success' => true,
        'message' => 'Camión actualizado exitosamente',
        'data' => $camion
    ]);
}

    public function destroy($id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return response()->json([
                'success' => false,
                'message' => 'Camión no encontrado'
            ], 404);
        }

        $camion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Camión eliminado exitosamente'
        ]);
    }
}

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
    $request->validate([
        'transportista_id' => 'required|exists:transportistas,id',
        'placa' => 'required|string|unique:camiones,placa',
    ]);

    $camion = Camion::create($request->all());

    return response()->json([
        'success' => true,
        'message' => 'Camión creado exitosamente',
        'data' => $camion
    ], 201);
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

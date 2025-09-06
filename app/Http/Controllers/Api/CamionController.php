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
            'tipo' => 'required|string|max:100',
            'capacidad' => 'required|numeric|min:0',
            'estado' => 'required|in:activo,mantenimiento,fuera_servicio',
            'año' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'marca' => 'nullable|string|max:100',
            'modelo' => 'nullable|string|max:100',
        ]);

        $camion = Camion::create($request->all());
        $camion->load('transportista');

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
            'tipo' => 'required|string|max:100',
            'capacidad' => 'required|numeric|min:0',
            'estado' => 'required|in:activo,mantenimiento,fuera_servicio',
            'año' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'marca' => 'nullable|string|max:100',
            'modelo' => 'nullable|string|max:100',
        ]);

        $camion->update($request->all());
        $camion->load('transportista');

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
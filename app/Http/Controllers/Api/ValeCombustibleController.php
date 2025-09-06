<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ValeCombustible;
use Illuminate\Http\Request;

class ValeCombustibleController extends Controller
{
    public function index()
    {
        $vales = ValeCombustible::with(['ordenTrabajo.camion', 'ordenTrabajo.piloto', 'usuario'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $vales
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'orden_trabajo_id' => 'required|exists:ordenes_trabajo,id',
            'cantidad_galones' => 'required|numeric|min:0',
            'fecha_vale' => 'required|date',
            'precio_galon' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        
        // Calcular total si se proporciona precio por galón
        if ($request->precio_galon) {
            $data['total'] = $request->cantidad_galones * $request->precio_galon;
        }

        $vale = ValeCombustible::create($data);
        $vale->load(['ordenTrabajo.camion', 'ordenTrabajo.piloto', 'usuario']);

        return response()->json([
            'success' => true,
            'message' => 'Vale de combustible creado exitosamente',
            'data' => $vale
        ], 201);
    }

    public function show(string $id)
    {
        $vale = ValeCombustible::with(['ordenTrabajo.camion', 'ordenTrabajo.piloto', 'usuario'])->find($id);

        if (!$vale) {
            return response()->json([
                'success' => false,
                'message' => 'Vale de combustible no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $vale
        ]);
    }

    public function update(Request $request, string $id)
    {
        $vale = ValeCombustible::find($id);

        if (!$vale) {
            return response()->json([
                'success' => false,
                'message' => 'Vale de combustible no encontrado'
            ], 404);
        }

        $request->validate([
            'cantidad_galones' => 'required|numeric|min:0',
            'fecha_vale' => 'required|date',
            'precio_galon' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Recalcular total si se actualiza precio por galón
        if ($request->precio_galon) {
            $data['total'] = $request->cantidad_galones * $request->precio_galon;
        }

        $vale->update($data);
        $vale->load(['ordenTrabajo.camion', 'ordenTrabajo.piloto', 'usuario']);

        return response()->json([
            'success' => true,
            'message' => 'Vale de combustible actualizado exitosamente',
            'data' => $vale
        ]);
    }

    public function destroy(string $id)
    {
        $vale = ValeCombustible::find($id);

        if (!$vale) {
            return response()->json([
                'success' => false,
                'message' => 'Vale de combustible no encontrado'
            ], 404);
        }

        $vale->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vale de combustible eliminado exitosamente'
        ]);
    }
}
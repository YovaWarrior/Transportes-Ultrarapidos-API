<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Piloto;
use Illuminate\Http\Request;

class PilotoController extends Controller
{
    public function index()
    {
        $pilotos = Piloto::with('transportista')->get();
        
        return response()->json([
            'success' => true,
            'data' => $pilotos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'transportista_id' => 'required|exists:transportistas,id',
            'nombre' => 'required|string|max:255',
            'licencia' => 'required|string|unique:pilotos,licencia',
            'telefono' => 'nullable|string|max:20',
            'dpi' => 'nullable|string|max:20',
        ]);

        $piloto = Piloto::create($request->all());
        $piloto->load('transportista');

        return response()->json([
            'success' => true,
            'message' => 'Piloto creado exitosamente',
            'data' => $piloto
        ], 201);
    }

    public function show($id)
    {
        $piloto = Piloto::with(['transportista', 'ordenesTrabajos'])->find($id);

        if (!$piloto) {
            return response()->json([
                'success' => false,
                'message' => 'Piloto no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $piloto
        ]);
    }

    public function update(Request $request, $id)
    {
        $piloto = Piloto::find($id);

        if (!$piloto) {
            return response()->json([
                'success' => false,
                'message' => 'Piloto no encontrado'
            ], 404);
        }

        $request->validate([
            'transportista_id' => 'required|exists:transportistas,id',
            'nombre' => 'required|string|max:255',
            'licencia' => 'required|string|unique:pilotos,licencia,' . $id,
            'telefono' => 'nullable|string|max:20',
            'dpi' => 'nullable|string|max:20',
        ]);

        $piloto->update($request->all());
        $piloto->load('transportista');

        return response()->json([
            'success' => true,
            'message' => 'Piloto actualizado exitosamente',
            'data' => $piloto
        ]);
    }

    public function destroy($id)
    {
        $piloto = Piloto::find($id);

        if (!$piloto) {
            return response()->json([
                'success' => false,
                'message' => 'Piloto no encontrado'
            ], 404);
        }

        $piloto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Piloto eliminado exitosamente'
        ]);
    }
}
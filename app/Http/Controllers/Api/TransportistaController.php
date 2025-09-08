<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transportista;
use Illuminate\Http\Request;

class TransportistaController extends Controller
{
    public function index()
{
    try {
        // Probar sin relaciones primero
        $transportistas = Transportista::all();

        return response()->json([
            'success' => true,
            'data' => $transportistas,
            'count' => $transportistas->count()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500);
    }
}

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:empresa,independiente',
            'nit' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $transportista = Transportista::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Transportista creado exitosamente',
            'data' => $transportista
        ], 201);
    }

    public function show($id)
    {
        $transportista = Transportista::with(['camiones', 'pilotos'])->find($id);

        if (!$transportista) {
            return response()->json([
                'success' => false,
                'message' => 'Transportista no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transportista
        ]);
    }

    public function update(Request $request, $id)
    {
        $transportista = Transportista::find($id);

        if (!$transportista) {
            return response()->json([
                'success' => false,
                'message' => 'Transportista no encontrado'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:empresa,independiente',
            'nit' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $transportista->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Transportista actualizado exitosamente',
            'data' => $transportista
        ]);
    }

    public function destroy($id)
    {
        $transportista = Transportista::find($id);

        if (!$transportista) {
            return response()->json([
                'success' => false,
                'message' => 'Transportista no encontrado'
            ], 404);
        }

        $transportista->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transportista eliminado exitosamente'
        ]);
    }
}

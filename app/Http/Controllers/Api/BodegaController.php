<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    public function index()
    {
        $bodegas = Bodega::all();
        return response()->json(['success' => true, 'data' => $bodegas]);
    }

    public function store(Request $request)
    {
        try {
            $bodega = new Bodega();
            $bodega->predio_id = $request->predio_id ?? 1;
            $bodega->nombre = $request->nombre;
            $bodega->descripcion = $request->descripcion;
            $bodega->save();

            return response()->json([
                'success' => true,
                'message' => 'Bodega creada exitosamente',
                'data' => $bodega
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Predio;
use Illuminate\Http\Request;

class PredioController extends Controller
{
    public function index()
    {
        $predios = Predio::all();
        return response()->json(['success' => true, 'data' => $predios]);
    }

    public function store(Request $request)
    {
        try {
            $predio = new Predio();
            $predio->nombre = $request->nombre;
            $predio->pais = $request->pais ?? 'Guatemala';
            $predio->direccion = $request->direccion;
            $predio->telefono = $request->telefono;
            $predio->save();

            return response()->json([
                'success' => true,
                'message' => 'Predio creado exitosamente',
                'data' => $predio
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}

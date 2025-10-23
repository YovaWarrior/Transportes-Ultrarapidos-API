<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ValeCombustible;
use App\Models\OrdenTrabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ValeCombustibleController extends Controller
{
    /**
     * Listado de vales de combustible
     */
    public function index(Request $request)
    {
        $query = ValeCombustible::with(['ordenTrabajo.camion'])
            ->latest('fecha_vale');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->whereHas('ordenTrabajo.camion', function ($q) use ($s) {
                $q->where('placa', 'like', "%{$s}%")
                  ->orWhere('marca', 'like', "%{$s}%")
                  ->orWhere('modelo', 'like', "%{$s}%");
            });
        }

        if ($request->filled('desde')) {
            $query->whereDate('fecha_vale', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_vale', '<=', $request->hasta);
        }

        $vales = $query->paginate(12)->withQueryString();

        // Totales rápidos
        $totalGalones = (clone $query)->sum('cantidad_galones');
        $totalMonto = (clone $query)->sum('total');

        return view('combustible.index', compact('vales', 'totalGalones', 'totalMonto'));
    }

    /**
     * Formulario para crear vale
     */
    public function create()
    {
        $ordenes = OrdenTrabajo::with('camion')
            ->orderByDesc('id')
            ->limit(100)
            ->get();

        return view('combustible.create', compact('ordenes'));
    }

    /**
     * Guardar vale
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orden_trabajo_id' => 'required|exists:ordenes_trabajo,id',
            'cantidad_galones' => 'required|numeric|min:0.01',
            'precio_galon' => 'required|numeric|min:0',
            'fecha_vale' => 'required|date',
            'observaciones' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $total = round($request->cantidad_galones * $request->precio_galon, 2);

        $vale = ValeCombustible::create([
            'orden_trabajo_id' => $request->orden_trabajo_id,
            'cantidad_galones' => $request->cantidad_galones,
            'precio_galon' => $request->precio_galon,
            'total' => $total,
            'fecha_vale' => $request->fecha_vale,
            'observaciones' => $request->observaciones,
            'user_id' => auth()->id(),
        ]);

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'ValeCombustible',
            'model_id' => $vale->id,
            'description' => 'Vale de combustible creado: ' . $vale->cantidad_galones . ' gal - Q' . $vale->total,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('combustible.show', $vale->id)
            ->with('success', 'Vale de combustible registrado correctamente.');
    }

    /**
     * Mostrar detalle
     */
    public function show($id)
    {
        $vale = ValeCombustible::with('ordenTrabajo.camion')->findOrFail($id);
        return view('combustible.show', compact('vale'));
    }
}

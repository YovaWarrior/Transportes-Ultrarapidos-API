<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\IngresoCamion;
use App\Models\EgresoCamion;
use App\Models\OrdenTrabajo;
use App\Models\Camion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    /**
     * Listado de movimientos (ingresos y egresos recientes)
     */
    public function index(Request $request)
    {
        $ingresos = IngresoCamion::with(['ordenTrabajo.camion'])
            ->latest('fecha_ingreso')
            ->paginate(10, ['*'], 'ingresos_page');

        $egresos = EgresoCamion::with(['ordenTrabajo.camion'])
            ->latest('fecha_egreso')
            ->paginate(10, ['*'], 'egresos_page');

        return view('movimientos.index', compact('ingresos', 'egresos'));
    }

    /**
     * Formulario de registro de ingreso
     */
    public function createIngreso()
    {
        $ordenes = OrdenTrabajo::with('camion')
            ->orderByDesc('id')
            ->limit(50)
            ->get();

        return view('movimientos.create_ingreso', compact('ordenes'));
    }

    /**
     * Guardar ingreso
     */
    public function storeIngreso(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orden_trabajo_id' => 'required|exists:ordenes_trabajo,id',
            'origen' => 'required|string|max:100',
            'tipo_carga' => 'required|string|max:100',
            'fecha_ingreso' => 'required|date',
            'observaciones' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ingreso = IngresoCamion::create([
            'orden_trabajo_id' => $request->orden_trabajo_id,
            'origen' => $request->origen,
            'tipo_carga' => $request->tipo_carga,
            'fecha_ingreso' => $request->fecha_ingreso,
            'observaciones' => $request->observaciones,
            'user_id' => auth()->id(),
        ]);

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'IngresoCamion',
            'model_id' => $ingreso->id,
            'description' => 'Ingreso registrado desde: ' . $ingreso->origen,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('movimientos.index')->with('success', 'Ingreso registrado correctamente.');
    }

    /**
     * Formulario de registro de egreso
     */
    public function createEgreso()
    {
        $ordenes = OrdenTrabajo::with('camion')
            ->orderByDesc('id')
            ->limit(50)
            ->get();

        return view('movimientos.create_egreso', compact('ordenes'));
    }

    /**
     * Guardar egreso
     */
    public function storeEgreso(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orden_trabajo_id' => 'required|exists:ordenes_trabajo,id',
            'destino' => 'required|string|max:100',
            'tipo_carga' => 'required|string|max:100',
            'fecha_egreso' => 'required|date',
            'kilometraje' => 'nullable|integer|min:0',
            'observaciones' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $egreso = EgresoCamion::create([
            'orden_trabajo_id' => $request->orden_trabajo_id,
            'destino' => $request->destino,
            'tipo_carga' => $request->tipo_carga,
            'fecha_egreso' => $request->fecha_egreso,
            'kilometraje' => $request->kilometraje,
            'observaciones' => $request->observaciones,
            'user_id' => auth()->id(),
        ]);

        // Registrar actividad
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'EgresoCamion',
            'model_id' => $egreso->id,
            'description' => 'Egreso registrado hacia: ' . $egreso->destino,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('movimientos.index')->with('success', 'Egreso registrado correctamente.');
    }

    /**
     * Mostrar detalle de un movimiento por tipo
     */
    public function show($tipo, $id)
    {
        if ($tipo === 'ingreso') {
            $mov = IngresoCamion::with('ordenTrabajo.camion')->findOrFail($id);
        } else {
            $mov = EgresoCamion::with('ordenTrabajo.camion')->findOrFail($id);
        }

        return view('movimientos.show', [
            'tipo' => $tipo,
            'movimiento' => $mov,
        ]);
    }
}

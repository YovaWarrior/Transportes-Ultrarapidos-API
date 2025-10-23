<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use App\Models\IngresoCamion;
use App\Models\EgresoCamion;
use App\Models\ValeCombustible;
use App\Models\OrdenTrabajo;
use App\Models\Predio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $totalCamiones = Camion::count();
        $totalIngresos = IngresoCamion::count();
        $totalEgresos = EgresoCamion::count();
        $totalVales = ValeCombustible::count();

        return view('reportes.index', compact('totalCamiones', 'totalIngresos', 'totalEgresos', 'totalVales'));
    }

    public function exportCamiones(Request $request)
    {
        $camiones = Camion::with('transportista')->get();

        $filename = 'camiones_' . now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://output', 'w');

        ob_start();
        // Header CSV
        fputcsv($handle, ['Placa', 'Marca', 'Modelo', 'Año', 'Tipo', 'Capacidad', 'Estado', 'Transportista']);

        foreach ($camiones as $c) {
            fputcsv($handle, [
                $c->placa,
                $c->marca,
                $c->modelo,
                $c->año,
                $c->tipo,
                $c->capacidad,
                $c->estado,
                $c->transportista->nombre ?? 'N/A',
            ]);
        }

        fclose($handle);
        $csv = ob_get_clean();

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function exportMovimientos(Request $request)
    {
        $ingresos = IngresoCamion::with('ordenTrabajo.camion')->get();
        $egresos = EgresoCamion::with('ordenTrabajo.camion')->get();

        $filename = 'movimientos_' . now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://output', 'w');

        ob_start();
        fputcsv($handle, ['Tipo', 'Fecha', 'Orden', 'Camión', 'Origen/Destino', 'Tipo Carga', 'Kilometraje', 'Observaciones']);

        foreach ($ingresos as $i) {
            fputcsv($handle, [
                'Ingreso',
                $i->fecha_ingreso?->format('Y-m-d H:i'),
                $i->ordenTrabajo->numero_orden ?? $i->orden_trabajo_id,
                $i->ordenTrabajo->camion->placa ?? 'N/A',
                $i->origen,
                $i->tipo_carga,
                '',
                $i->observaciones,
            ]);
        }

        foreach ($egresos as $e) {
            fputcsv($handle, [
                'Egreso',
                $e->fecha_egreso?->format('Y-m-d H:i'),
                $e->ordenTrabajo->numero_orden ?? $e->orden_trabajo_id,
                $e->ordenTrabajo->camion->placa ?? 'N/A',
                $e->destino,
                $e->tipo_carga,
                $e->kilometraje,
                $e->observaciones,
            ]);
        }

        fclose($handle);
        $csv = ob_get_clean();

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function exportCombustible(Request $request)
    {
        $vales = ValeCombustible::with('ordenTrabajo.camion')->get();

        $filename = 'combustible_' . now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://output', 'w');

        ob_start();
        fputcsv($handle, ['Fecha', 'Orden', 'Camión', 'Galones', 'Precio/gal', 'Total', 'Observaciones']);

        foreach ($vales as $v) {
            fputcsv($handle, [
                $v->fecha_vale?->format('Y-m-d H:i'),
                $v->ordenTrabajo->numero_orden ?? $v->orden_trabajo_id,
                $v->ordenTrabajo->camion->placa ?? 'N/A',
                number_format($v->cantidad_galones, 2, '.', ''),
                number_format($v->precio_galon, 2, '.', ''),
                number_format($v->total, 2, '.', ''),
                $v->observaciones,
            ]);
        }

        fclose($handle);
        $csv = ob_get_clean();

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    // ============ REPORTES AVANZADOS ============

    public function reporteIngresos(Request $request)
    {
        $predios = Predio::all();
        $query = IngresoCamion::with(['ordenTrabajo.camion', 'ordenTrabajo.predio']);

        if ($request->filled('predio_id')) {
            $query->whereHas('ordenTrabajo', function($q) use ($request) {
                $q->where('predio_id', $request->predio_id);
            });
        }
        if ($request->filled('desde')) {
            $query->whereDate('fecha_ingreso', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_ingreso', '<=', $request->hasta);
        }

        $ingresos = $query->latest('fecha_ingreso')->paginate(20)->withQueryString();
        return view('reportes.ingresos', compact('ingresos', 'predios'));
    }

    public function reporteEgresos(Request $request)
    {
        $predios = Predio::all();
        $query = EgresoCamion::with(['ordenTrabajo.camion', 'ordenTrabajo.predio']);

        if ($request->filled('predio_id')) {
            $query->whereHas('ordenTrabajo', function($q) use ($request) {
                $q->where('predio_id', $request->predio_id);
            });
        }
        if ($request->filled('desde')) {
            $query->whereDate('fecha_egreso', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_egreso', '<=', $request->hasta);
        }

        $egresos = $query->latest('fecha_egreso')->paginate(20)->withQueryString();
        return view('reportes.egresos', compact('egresos', 'predios'));
    }

    public function reporteVales(Request $request)
    {
        $camiones = Camion::orderBy('placa')->get();
        $pilotos = \App\Models\Piloto::orderBy('nombre')->get();
        
        $query = ValeCombustible::with(['ordenTrabajo.camion', 'ordenTrabajo.piloto']);

        if ($request->filled('camion_id')) {
            $query->whereHas('ordenTrabajo', function($q) use ($request) {
                $q->where('camion_id', $request->camion_id);
            });
        }
        if ($request->filled('piloto_id')) {
            $query->whereHas('ordenTrabajo', function($q) use ($request) {
                $q->where('piloto_id', $request->piloto_id);
            });
        }
        if ($request->filled('desde')) {
            $query->whereDate('fecha_vale', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_vale', '<=', $request->hasta);
        }

        $vales = $query->latest('fecha_vale')->paginate(20)->withQueryString();
        $totalGalones = (clone $query)->sum('cantidad_galones');
        $totalMonto = (clone $query)->sum('total');

        return view('reportes.vales', compact('vales', 'camiones', 'pilotos', 'totalGalones', 'totalMonto'));
    }

    public function reporteViajes(Request $request)
    {
        $camiones = Camion::with(['ordenesTrabajos' => function($q) use ($request) {
            if ($request->filled('desde')) {
                $q->whereDate('created_at', '>=', $request->desde);
            }
            if ($request->filled('hasta')) {
                $q->whereDate('created_at', '<=', $request->hasta);
            }
        }])->get();

        $data = $camiones->map(function($camion) {
            $totalViajes = $camion->ordenesTrabajos->count();
            $kmRecorridos = $camion->ordenesTrabajos->sum(function($orden) {
                return $orden->egresoCamion->kilometraje ?? 0;
            });
            
            return [
                'camion' => $camion,
                'total_viajes' => $totalViajes,
                'km_recorridos' => $kmRecorridos,
            ];
        })->sortByDesc('total_viajes');

        return view('reportes.viajes', compact('data'));
    }

    public function reporteActividad(Request $request)
    {
        // Obtener todos los usuarios con sus estadísticas de actividad
        $usuarios = \App\Models\User::all()->map(function($user) {
            // Contar acciones por tipo desde activity_logs
            $totalAcciones = DB::table('activity_logs')
                ->where('user_id', $user->id)
                ->count();
            
            $acciones = DB::table('activity_logs')
                ->where('user_id', $user->id)
                ->select('action', DB::raw('count(*) as total'))
                ->groupBy('action')
                ->pluck('total', 'action');
            
            // Última actividad - usando ORDER BY id DESC para asegurar el más reciente
            $ultimaActividad = DB::table('activity_logs')
                ->where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->first();
            
            return [
                'usuario' => $user,
                'total_acciones' => $totalAcciones,
                'login' => $acciones['login'] ?? 0,
                'logout' => $acciones['logout'] ?? 0,
                'create' => $acciones['create'] ?? 0,
                'update' => $acciones['update'] ?? 0,
                'delete' => $acciones['delete'] ?? 0,
                // Usar Carbon::parse que automáticamente usa la timezone de la app
                'ultima_actividad' => $ultimaActividad ? \Carbon\Carbon::parse($ultimaActividad->created_at) : null,
            ];
        })->sortByDesc('total_acciones');

        return view('reportes.actividad', compact('usuarios'));
    }
}

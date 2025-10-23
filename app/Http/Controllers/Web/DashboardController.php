<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use App\Models\OrdenTrabajo;
use App\Models\Piloto;
use App\Models\Transportista;
use App\Models\ValeCombustible;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        // Dashboard específico para pilotos
        if ($user->isPiloto()) {
            return $this->pilotoDashboard();
        }

        // Dashboard para Admin y Operativo
        // Estadísticas de camiones
        $totalCamiones = Camion::count();
        $activos = Camion::where('estado', 'activo')->count();
        $mantenimiento = Camion::where('estado', 'mantenimiento')->count();
        $fueraServicio = Camion::where('estado', 'fuera_servicio')->count();

        // Distribución por tipo
        $tipoDistribucion = Camion::select('tipo', DB::raw('count(*) as total'))
            ->groupBy('tipo')
            ->get();
        
        $tipoLabels = $tipoDistribucion->pluck('tipo')->map(function($tipo) {
            return ucfirst($tipo);
        })->toArray();
        
        $tipoData = $tipoDistribucion->pluck('total')->toArray();

        // Últimas órdenes de trabajo
        $ultimasOrdenes = OrdenTrabajo::with('camion')
            ->latest()
            ->limit(5)
            ->get();

        // Estadísticas adicionales
        $totalTransportistas = Transportista::where('active', true)->count();
        $ordenesPendientes = OrdenTrabajo::where('estado', 'pendiente')->count();
        $valesHoy = ValeCombustible::whereDate('created_at', today())->count();

        return view('dashboard', compact(
            'totalCamiones',
            'activos',
            'mantenimiento',
            'fueraServicio',
            'tipoLabels',
            'tipoData',
            'ultimasOrdenes',
            'totalTransportistas',
            'ordenesPendientes',
            'valesHoy'
        ));
    }

    /**
     * Dashboard específico para pilotos
     */
    private function pilotoDashboard()
    {
        $user = auth()->user();
        
        // Buscar el piloto por nombre (asumiendo que el nombre del user coincide con el nombre del piloto)
        $piloto = Piloto::where('nombre', 'like', '%' . $user->name . '%')->first();
        
        if (!$piloto) {
            // Si no se encuentra el piloto, mostrar mensaje
            return view('dashboard-piloto', [
                'piloto' => null,
                'misOrdenes' => collect([]),
                'ordenesCompletadas' => 0,
                'ordenesPendientes' => 0,
                'ordenesProceso' => 0,
                'valesCombustible' => 0,
                'kmRecorridos' => 0,
            ]);
        }

        // Mis órdenes de trabajo
        $misOrdenes = OrdenTrabajo::where('piloto_id', $piloto->id)
            ->with(['camion', 'predio', 'bodega'])
            ->latest()
            ->limit(10)
            ->get();

        // Estadísticas del piloto
        $ordenesCompletadas = OrdenTrabajo::where('piloto_id', $piloto->id)
            ->where('estado', 'completada')
            ->count();

        $ordenesPendientes = OrdenTrabajo::where('piloto_id', $piloto->id)
            ->where('estado', 'pendiente')
            ->count();

        $ordenesProceso = OrdenTrabajo::where('piloto_id', $piloto->id)
            ->where('estado', 'en_proceso')
            ->count();

        // Vales de combustible del piloto
        $valesCombustible = ValeCombustible::whereHas('ordenTrabajo', function($q) use ($piloto) {
            $q->where('piloto_id', $piloto->id);
        })->count();

        // Kilómetros recorridos
        $kmRecorridos = DB::table('egresos_camion')
            ->join('ordenes_trabajo', 'egresos_camion.orden_trabajo_id', '=', 'ordenes_trabajo.id')
            ->where('ordenes_trabajo.piloto_id', $piloto->id)
            ->sum('egresos_camion.kilometraje');

        return view('dashboard-piloto', compact(
            'piloto',
            'misOrdenes',
            'ordenesCompletadas',
            'ordenesPendientes',
            'ordenesProceso',
            'valesCombustible',
            'kmRecorridos'
        ));
    }
}

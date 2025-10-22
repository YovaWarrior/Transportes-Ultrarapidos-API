<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use App\Models\OrdenTrabajo;
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
}

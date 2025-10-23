<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\CamionController;
use App\Http\Controllers\Web\MovimientoController;
use App\Http\Controllers\Web\ValeCombustibleController;
use App\Http\Controllers\Web\TransportistaController;
use App\Http\Controllers\Web\OrdenTrabajoController;
use App\Http\Controllers\Web\ReporteController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PredioController;
use App\Http\Controllers\Web\BodegaController;
use App\Http\Controllers\Web\PilotoController;
use App\Http\Controllers\Web\ActivityLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes (Public)
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Require Authentication)
Route::middleware(['role'])->group(function () {
    
    // Dashboard - Todos los roles
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ========================================
    // OPERATIVO Y ADMIN - Crear y Editar
    // ========================================
    Route::middleware(['role:admin,operativo'])->group(function () {
        // Camiones
        Route::get('/camiones/create', [CamionController::class, 'create'])->name('camiones.create');
        Route::post('/camiones', [CamionController::class, 'store'])->name('camiones.store');
        Route::get('/camiones/{camion}/edit', [CamionController::class, 'edit'])->name('camiones.edit');
        Route::put('/camiones/{camion}', [CamionController::class, 'update'])->name('camiones.update');
        
        // Transportistas
        Route::get('/transportistas/create', [TransportistaController::class, 'create'])->name('transportistas.create');
        Route::post('/transportistas', [TransportistaController::class, 'store'])->name('transportistas.store');
        Route::get('/transportistas/{transportista}/edit', [TransportistaController::class, 'edit'])->name('transportistas.edit');
        Route::put('/transportistas/{transportista}', [TransportistaController::class, 'update'])->name('transportistas.update');
        
        // Pilotos
        Route::get('/pilotos/create', [PilotoController::class, 'create'])->name('pilotos.create');
        Route::post('/pilotos', [PilotoController::class, 'store'])->name('pilotos.store');
        Route::get('/pilotos/{piloto}/edit', [PilotoController::class, 'edit'])->name('pilotos.edit');
        Route::put('/pilotos/{piloto}', [PilotoController::class, 'update'])->name('pilotos.update');
        
        // Predios
        Route::get('/predios/create', [PredioController::class, 'create'])->name('predios.create');
        Route::post('/predios', [PredioController::class, 'store'])->name('predios.store');
        Route::get('/predios/{predio}/edit', [PredioController::class, 'edit'])->name('predios.edit');
        Route::put('/predios/{predio}', [PredioController::class, 'update'])->name('predios.update');
        
        // Bodegas
        Route::get('/bodegas/create', [BodegaController::class, 'create'])->name('bodegas.create');
        Route::post('/bodegas', [BodegaController::class, 'store'])->name('bodegas.store');
        Route::get('/bodegas/{bodega}/edit', [BodegaController::class, 'edit'])->name('bodegas.edit');
        Route::put('/bodegas/{bodega}', [BodegaController::class, 'update'])->name('bodegas.update');
        
        // Órdenes
        Route::get('/ordenes/create', [OrdenTrabajoController::class, 'create'])->name('ordenes.create');
        Route::post('/ordenes', [OrdenTrabajoController::class, 'store'])->name('ordenes.store');
        Route::get('/ordenes/{ordene}/edit', [OrdenTrabajoController::class, 'edit'])->name('ordenes.edit');
        Route::put('/ordenes/{ordene}', [OrdenTrabajoController::class, 'update'])->name('ordenes.update');
        
        // Combustible
        Route::get('/combustible/crear', [ValeCombustibleController::class, 'create'])->name('combustible.create');
        Route::post('/combustible', [ValeCombustibleController::class, 'store'])->name('combustible.store');
        
        // Movimientos (Ingresos/Egresos)
        Route::get('/movimientos/ingresos/crear', [MovimientoController::class, 'createIngreso'])->name('movimientos.ingresos.create');
        Route::post('/movimientos/ingresos', [MovimientoController::class, 'storeIngreso'])->name('movimientos.ingresos.store');
        Route::get('/movimientos/egresos/crear', [MovimientoController::class, 'createEgreso'])->name('movimientos.egresos.create');
        Route::post('/movimientos/egresos', [MovimientoController::class, 'storeEgreso'])->name('movimientos.egresos.store');
    });

    // ========================================
    // SOLO ADMIN - Eliminar
    // ========================================
    Route::middleware(['role:admin'])->group(function () {
        Route::delete('/camiones/{camion}', [CamionController::class, 'destroy'])->name('camiones.destroy');
        Route::delete('/transportistas/{transportista}', [TransportistaController::class, 'destroy'])->name('transportistas.destroy');
        Route::delete('/pilotos/{piloto}', [PilotoController::class, 'destroy'])->name('pilotos.destroy');
        Route::delete('/predios/{predio}', [PredioController::class, 'destroy'])->name('predios.destroy');
        Route::delete('/bodegas/{bodega}', [BodegaController::class, 'destroy'])->name('bodegas.destroy');
        Route::delete('/ordenes/{ordene}', [OrdenTrabajoController::class, 'destroy'])->name('ordenes.destroy');
        
        // Activity Logs
        Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');
    });

    // ========================================
    // RUTAS SOLO LECTURA - Todos los roles
    // ========================================
    Route::get('/camiones', [CamionController::class, 'index'])->name('camiones.index');
    Route::get('/camiones/{camion}', [CamionController::class, 'show'])->name('camiones.show');
    
    Route::get('/transportistas', [TransportistaController::class, 'index'])->name('transportistas.index');
    Route::get('/transportistas/{transportista}', [TransportistaController::class, 'show'])->name('transportistas.show');
    
    Route::get('/pilotos', [PilotoController::class, 'index'])->name('pilotos.index');
    Route::get('/pilotos/{piloto}', [PilotoController::class, 'show'])->name('pilotos.show');
    
    Route::get('/predios', [PredioController::class, 'index'])->name('predios.index');
    Route::get('/predios/{predio}', [PredioController::class, 'show'])->name('predios.show');
    
    Route::get('/bodegas', [BodegaController::class, 'index'])->name('bodegas.index');
    Route::get('/bodegas/{bodega}', [BodegaController::class, 'show'])->name('bodegas.show');
    
    Route::get('/ordenes', [OrdenTrabajoController::class, 'index'])->name('ordenes.index');
    Route::get('/ordenes/{ordene}', [OrdenTrabajoController::class, 'show'])->name('ordenes.show');
    
    Route::get('/combustible', [ValeCombustibleController::class, 'index'])->name('combustible.index');
    Route::get('/combustible/{id}', [ValeCombustibleController::class, 'show'])->name('combustible.show');
    
    Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');
    Route::get('/movimientos/{tipo}/{id}', [MovimientoController::class, 'show'])->name('movimientos.show');
    
    // Reportes - Todos pueden ver y exportar
    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/', [ReporteController::class, 'index'])->name('index');
        Route::get('/exportar/camiones', [ReporteController::class, 'exportCamiones'])->name('export.camiones');
        Route::get('/exportar/movimientos', [ReporteController::class, 'exportMovimientos'])->name('export.movimientos');
        Route::get('/exportar/combustible', [ReporteController::class, 'exportCombustible'])->name('export.combustible');
        Route::get('/ingresos', [ReporteController::class, 'reporteIngresos'])->name('ingresos');
        Route::get('/egresos', [ReporteController::class, 'reporteEgresos'])->name('egresos');
        Route::get('/vales', [ReporteController::class, 'reporteVales'])->name('vales');
        Route::get('/viajes', [ReporteController::class, 'reporteViajes'])->name('viajes');
        Route::get('/actividad', [ReporteController::class, 'reporteActividad'])->name('actividad');
    });

}); // End of protected routes middleware group

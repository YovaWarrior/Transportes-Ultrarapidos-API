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
    
// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Camiones - Resource completo
Route::resource('camiones', CamionController::class);

// Movimientos (Ingresos / Egresos)
Route::prefix('movimientos')->name('movimientos.')->group(function () {
    Route::get('/', [MovimientoController::class, 'index'])->name('index');
    // Ingresos
    Route::get('/ingresos/crear', [MovimientoController::class, 'createIngreso'])->name('ingresos.create');
    Route::post('/ingresos', [MovimientoController::class, 'storeIngreso'])->name('ingresos.store');
    // Egresos
    Route::get('/egresos/crear', [MovimientoController::class, 'createEgreso'])->name('egresos.create');
    Route::post('/egresos', [MovimientoController::class, 'storeEgreso'])->name('egresos.store');
    // Detalle
    Route::get('/{tipo}/{id}', [MovimientoController::class, 'show'])->name('show');
});

// Transportistas CRUD
Route::resource('transportistas', TransportistaController::class);

// Pilotos CRUD
Route::resource('pilotos', PilotoController::class);

// Predios CRUD
Route::resource('predios', PredioController::class);

// Bodegas CRUD
Route::resource('bodegas', BodegaController::class);

// Órdenes de Trabajo CRUD
Route::resource('ordenes', OrdenTrabajoController::class);

// Combustible (Vales)
Route::prefix('combustible')->name('combustible.')->group(function () {
    Route::get('/', [ValeCombustibleController::class, 'index'])->name('index');
    Route::get('/crear', [ValeCombustibleController::class, 'create'])->name('create');
    Route::post('/', [ValeCombustibleController::class, 'store'])->name('store');
    Route::get('/{id}', [ValeCombustibleController::class, 'show'])->name('show');
});

// Reportes y Exportaciones
Route::prefix('reportes')->name('reportes.')->group(function () {
    Route::get('/', [ReporteController::class, 'index'])->name('index');
    Route::get('/exportar/camiones', [ReporteController::class, 'exportCamiones'])->name('export.camiones');
    Route::get('/exportar/movimientos', [ReporteController::class, 'exportMovimientos'])->name('export.movimientos');
    Route::get('/exportar/combustible', [ReporteController::class, 'exportCombustible'])->name('export.combustible');
    
    // Reportes avanzados
    Route::get('/ingresos', [ReporteController::class, 'reporteIngresos'])->name('ingresos');
    Route::get('/egresos', [ReporteController::class, 'reporteEgresos'])->name('egresos');
    Route::get('/vales', [ReporteController::class, 'reporteVales'])->name('vales');
    Route::get('/viajes', [ReporteController::class, 'reporteViajes'])->name('viajes');
    Route::get('/actividad', [ReporteController::class, 'reporteActividad'])->name('actividad');
});

// Activity Logs (Solo Admin)
Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index')->middleware('role:admin');

}); // End of protected routes middleware group

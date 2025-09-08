<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransportistaController;
use App\Http\Controllers\Api\CamionController;
use App\Http\Controllers\Api\PilotoController;
use App\Http\Controllers\Api\OrdenTrabajoController;
use App\Http\Controllers\Api\ValeCombustibleController;
use App\Http\Controllers\Api\PredioController;
use App\Http\Controllers\Api\BodegaController;
use App\Http\Controllers\Api\AuthController;

// Rutas de autenticación (disponibles pero no requeridas)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas SIN autenticación (temporal)
Route::apiResource('transportistas', TransportistaController::class);
Route::apiResource('camiones', CamionController::class);
Route::apiResource('pilotos', PilotoController::class);
Route::apiResource('ordenes', OrdenTrabajoController::class);
Route::apiResource('vales-combustible', ValeCombustibleController::class);
Route::apiResource('predios', PredioController::class);
Route::apiResource('bodegas', BodegaController::class);

Route::post('/ordenes/{id}/ingreso', [OrdenTrabajoController::class, 'registrarIngreso']);
Route::post('/ordenes/{id}/egreso', [OrdenTrabajoController::class, 'registrarEgreso']);

Route::get('/migrate', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return response()->json([
            'success' => true,
            'message' => 'Migraciones ejecutadas correctamente',
            'output' => Artisan::output()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al ejecutar migraciones',
            'error' => $e->getMessage()
        ], 500);
    }
});

Route::get('/db-structure', function () {
    try {
        $tables = ['camiones', 'transportistas', 'pilotos', 'ordenes_trabajo', 'predios', 'bodegas'];
        $structure = [];

        foreach ($tables as $table) {
            $columns = DB::select("DESCRIBE $table");
            $structure[$table] = $columns;
        }

        return response()->json([
            'success' => true,
            'data' => $structure
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});

Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando correctamente',
        'timestamp' => now(),
        'laravel_version' => app()->version()
    ]);
});

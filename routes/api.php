<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransportistaController;
use App\Http\Controllers\Api\CamionController;
use App\Http\Controllers\Api\PilotoController;
use App\Http\Controllers\Api\OrdenTrabajoController;
use App\Http\Controllers\Api\ValeCombustibleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Rutas protegidas con autenticación
Route::middleware('auth:api')->group(function () {
    Route::apiResource('transportistas', TransportistaController::class);
    Route::apiResource('camiones', CamionController::class);
    Route::apiResource('pilotos', PilotoController::class);
    Route::apiResource('ordenes', OrdenTrabajoController::class);
    Route::apiResource('vales-combustible', ValeCombustibleController::class);
    
    Route::post('/ordenes/{id}/ingreso', [OrdenTrabajoController::class, 'registrarIngreso']);
    Route::post('/ordenes/{id}/egreso', [OrdenTrabajoController::class, 'registrarEgreso']);
});

Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando correctamente',
        'timestamp' => now(),
        'laravel_version' => app()->version()
    ]);
});
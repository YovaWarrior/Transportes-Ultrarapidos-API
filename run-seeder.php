<?php

/**
 * Script temporal para ejecutar seeder en producción
 * ELIMINAR DESPUÉS DE USAR POR SEGURIDAD
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

try {
    // Ejecutar seeder
    Artisan::call('db:seed', [
        '--class' => 'UsersSeeder',
        '--force' => true
    ]);
    
    echo "<h1>✅ Usuarios de Prueba Creados</h1>";
    echo "<pre>";
    echo Artisan::output();
    echo "</pre>";
    
    echo "<h2>Credenciales:</h2>";
    echo "<ul>";
    echo "<li><strong>Admin:</strong> admin@transportes.com / admin123</li>";
    echo "<li><strong>Operativo:</strong> operativo@transportes.com / operativo123</li>";
    echo "<li><strong>Piloto:</strong> piloto@transportes.com / piloto123</li>";
    echo "</ul>";
    
    echo "<p style='color: red;'><strong>⚠️ IMPORTANTE: Elimina este archivo run-seeder.php por seguridad.</strong></p>";
    
} catch (Exception $e) {
    echo "<h1>❌ Error</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}

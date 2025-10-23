<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--keep=7 : Days to keep old backups}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear backup de la base de datos MySQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 Iniciando backup de la base de datos...');

        // Obtener configuración de la base de datos
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');

        // Crear directorio de backups si no existe
        $backupPath = storage_path('app/backups');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
            $this->info('📁 Directorio de backups creado');
        }

        // Nombre del archivo
        $filename = 'backup_' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupPath . '/' . $filename;

        // Buscar mysqldump (compatible con Windows/Linux)
        $mysqldump = $this->findMysqldump();
        
        if (!$mysqldump) {
            $this->error('❌ mysqldump no encontrado. Instala MySQL o agrega al PATH.');
            return 1;
        }

        // Comando mysqldump (manejar contraseña vacía)
        if (empty($password)) {
            $command = sprintf(
                '%s --user=%s --host=%s --port=%s %s > %s 2>&1',
                $mysqldump,
                escapeshellarg($username),
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($database),
                escapeshellarg($filepath)
            );
        } else {
            $command = sprintf(
                '%s --user=%s --password=%s --host=%s --port=%s %s > %s 2>&1',
                $mysqldump,
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($database),
                escapeshellarg($filepath)
            );
        }

        // Ejecutar backup
        exec($command, $output, $returnVar);

        if ($returnVar === 0 && file_exists($filepath)) {
            $size = round(filesize($filepath) / 1024 / 1024, 2);
            $this->info("✅ Backup creado exitosamente: {$filename}");
            $this->info("📦 Tamaño: {$size} MB");

            // Registrar en activity_logs
            \DB::table('activity_logs')->insert([
                'user_id' => null,
                'action' => 'backup',
                'model_type' => 'Database',
                'model_id' => null,
                'description' => "Backup de base de datos creado: {$filename} ({$size} MB)",
                'ip_address' => '127.0.0.1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Limpiar backups antiguos
            $this->cleanOldBackups($backupPath, $this->option('keep'));

            return 0;
        } else {
            $this->error('❌ Error al crear el backup');
            return 1;
        }
    }

    /**
     * Buscar mysqldump en el sistema (Windows/Linux)
     */
    private function findMysqldump()
    {
        // Intentar mysqldump directo (si está en PATH)
        exec('mysqldump --version 2>&1', $output, $return);
        if ($return === 0) {
            return 'mysqldump';
        }

        // Rutas comunes en Windows (WAMP/XAMPP/MySQL)
        $windowsPaths = [
            'E:/wamp64/bin/mysql/mysql8.0.32/bin/mysqldump.exe',
            'E:/wamp64/bin/mysql/mysql8.0.31/bin/mysqldump.exe',
            'E:/wamp64/bin/mysql/mysql8.0.30/bin/mysqldump.exe',
            'C:/wamp64/bin/mysql/mysql8.0.32/bin/mysqldump.exe',
            'C:/xampp/mysql/bin/mysqldump.exe',
            'C:/Program Files/MySQL/MySQL Server 8.0/bin/mysqldump.exe',
            'C:/Program Files/MySQL/MySQL Server 5.7/bin/mysqldump.exe',
        ];

        foreach ($windowsPaths as $path) {
            if (file_exists($path)) {
                return '"' . $path . '"';
            }
        }

        // Buscar en directorio de MySQL de WAMP/XAMPP
        $searchDirs = ['E:/wamp64/bin/mysql', 'C:/wamp64/bin/mysql', 'C:/xampp/mysql'];
        foreach ($searchDirs as $dir) {
            if (is_dir($dir)) {
                $found = glob($dir . '/mysql*/bin/mysqldump.exe');
                if (!empty($found)) {
                    return '"' . $found[0] . '"';
                }
            }
        }

        return null;
    }

    /**
     * Limpiar backups antiguos
     */
    private function cleanOldBackups($path, $daysToKeep)
    {
        $files = glob($path . '/backup_*.sql');
        $now = time();
        $deleted = 0;

        foreach ($files as $file) {
            if (is_file($file)) {
                $fileTime = filemtime($file);
                $daysOld = ($now - $fileTime) / 86400;

                if ($daysOld > $daysToKeep) {
                    unlink($file);
                    $deleted++;
                }
            }
        }

        if ($deleted > 0) {
            $this->info("🗑️  {$deleted} backup(s) antiguo(s) eliminado(s)");
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--keep=7 : Number of days to keep backups}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database to storage/backups';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando backup de base de datos...');

        $database = config('database.connections.' . config('database.default') . '.database');
        $username = config('database.connections.' . config('database.default') . '.username');
        $password = config('database.connections.' . config('database.default') . '.password');
        $host = config('database.connections.' . config('database.default') . '.host');
        $driver = config('database.default');

        // Crear directorio de backups si no existe
        $backupDir = storage_path('backups');
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $filename = 'backup_' . $database . '_' . date('Y-m-d_His') . '.sql';
        $filepath = $backupDir . '/' . $filename;

        try {
            if ($driver === 'mysql') {
                // MySQL backup
                $command = sprintf(
                    'mysqldump --user=%s --password=%s --host=%s %s > %s',
                    escapeshellarg($username),
                    escapeshellarg($password),
                    escapeshellarg($host),
                    escapeshellarg($database),
                    escapeshellarg($filepath)
                );
                
                exec($command, $output, $returnVar);
                
                if ($returnVar === 0) {
                    $this->info("✓ Backup creado exitosamente: {$filename}");
                    $this->info("Ubicación: {$filepath}");
                } else {
                    $this->error('Error al crear el backup.');
                    return 1;
                }
            } elseif ($driver === 'sqlite') {
                // SQLite backup
                $dbPath = database_path('database.sqlite');
                copy($dbPath, $filepath);
                $this->info("✓ Backup creado exitosamente: {$filename}");
            } else {
                $this->error("Driver {$driver} no soportado para backup automático.");
                return 1;
            }

            // Limpiar backups antiguos
            $keep = (int) $this->option('keep');
            $this->cleanOldBackups($backupDir, $keep);

            $this->info("✓ Proceso de backup completado.");
            return 0;

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }

    protected function cleanOldBackups($directory, $days)
    {
        $files = glob($directory . '/backup_*.sql');
        $now = time();
        $deleted = 0;

        foreach ($files as $file) {
            if (is_file($file)) {
                if ($now - filemtime($file) >= 60 * 60 * 24 * $days) {
                    unlink($file);
                    $deleted++;
                }
            }
        }

        if ($deleted > 0) {
            $this->info("✓ Eliminados {$deleted} backups antiguos (más de {$days} días).");
        }
    }
}

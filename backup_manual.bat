@echo off
REM Script de backup manual para Windows
echo ========================================
echo BACKUP DE BASE DE DATOS - Transportes
echo ========================================
echo.

REM Configuración
set DB_USER=root
set DB_PASS=
set DB_NAME=transportes_db
set DB_HOST=localhost

REM Ruta de mysqldump (ajusta según tu instalación)
set MYSQLDUMP="E:\wamp64\bin\mysql\mysql8.0.32\bin\mysqldump.exe"

REM Directorio de backups
set BACKUP_DIR=%~dp0storage\app\backups
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

REM Nombre del archivo
set FILENAME=backup_%DB_NAME%_%date:~-4,4%%date:~-7,2%%date:~-10,2%_%time:~0,2%%time:~3,2%%time:~6,2%.sql
set FILENAME=%FILENAME: =0%

echo Creando backup: %FILENAME%
echo.

REM Ejecutar backup
if "%DB_PASS%"=="" (
    %MYSQLDUMP% --user=%DB_USER% --host=%DB_HOST% %DB_NAME% > "%BACKUP_DIR%\%FILENAME%"
) else (
    %MYSQLDUMP% --user=%DB_USER% --password=%DB_PASS% --host=%DB_HOST% %DB_NAME% > "%BACKUP_DIR%\%FILENAME%"
)

if %errorlevel% == 0 (
    echo ✓ Backup creado exitosamente
    echo Ubicación: %BACKUP_DIR%\%FILENAME%
    
    REM Calcular tamaño
    for %%A in ("%BACKUP_DIR%\%FILENAME%") do set SIZE=%%~zA
    echo Tamaño: %SIZE% bytes
) else (
    echo ✗ Error al crear backup
    echo.
    echo SOLUCIÓN:
    echo 1. Verifica la ruta de mysqldump en la línea 14
    echo 2. Ajusta según tu instalación de WAMP/XAMPP
    echo 3. Ejemplo WAMP: E:\wamp64\bin\mysql\mysqlX.X.XX\bin\mysqldump.exe
    echo 4. Ejemplo XAMPP: C:\xampp\mysql\bin\mysqldump.exe
)

echo.
echo Presiona cualquier tecla para salir...
pause >nul

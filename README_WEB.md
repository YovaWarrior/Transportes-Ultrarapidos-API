# Transportes Ultrarrápidos S.A. - Sistema Web

## 📋 Descripción del Proyecto

Sistema integral para el control de flota y predios de Transportes Ultrarrápidos S.A., con presencia en Guatemala y El Salvador. El sistema gestiona camiones, transportistas, pilotos, órdenes de trabajo, movimientos (ingresos/egresos), vales de combustible, predios y bodegas.

---

## ✨ Características Principales

### Módulos Implementados

1. **Autenticación y Roles**
   - Sistema de login/logout con sesiones
   - 3 roles: Admin, Operativo, Piloto
   - Middleware de protección por roles
   - Activity logs automáticos (login/logout)

2. **Camiones**
   - CRUD completo
   - Asociación con transportista
   - Filtros y búsqueda
   - Estados: activo, mantenimiento, inactivo

3. **Transportistas**
   - CRUD completo
   - Tipo: empresa o independiente
   - Camiones asociados

4. **Pilotos**
   - CRUD completo
   - Asociación con transportista
   - Licencia y datos de contacto

5. **Predios y Bodegas**
   - 4 predios (2 Guatemala, 2 El Salvador)
   - Bodegas asociadas a predios
   - CRUD completo

6. **Órdenes de Trabajo**
   - Auto-generación de número (OT-YYYYMMDD-####)
   - Vinculación: camión, piloto, predio, bodega
   - Estados: abierta, en_proceso, cerrada

7. **Movimientos**
   - Ingresos de camiones
   - Egresos de camiones
   - Asociados a órdenes de trabajo
   - Preselección de orden desde detalle

8. **Combustible (Vales)**
   - Registro de vales con cálculo automático
   - Asociación a orden y piloto
   - Totales dinámicos

9. **Reportes Avanzados**
   - Ingresos por predio (filtros: fecha, predio)
   - Egresos por predio (filtros: fecha, predio)
   - Vales por camión/piloto (con totales)
   - Viajes por camión (total viajes + km)
   - Actividad por usuario

10. **Security & Logs**
    - Tabla `activity_logs` para auditoría
    - Logs de login/logout automáticos
    - Viewer de logs (solo admin)
    - Comando de backup: `php artisan db:backup`

---

## 🚀 Instalación

### Requisitos

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL / SQLite
- WAMP/XAMPP o servidor similar

### Pasos

1. **Clonar repositorio**
```bash
cd c:/Users/bumme/Documents/Proyectos
git clone <url-del-repo> Transportes-Ultrarapidos-API
cd Transportes-Ultrarapidos-API
```

2. **Instalar dependencias**
```bash
composer install
npm install
```

3. **Configurar entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos** (`.env`)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transportes_db
DB_USERNAME=root
DB_PASSWORD=tu_password
```

**Para Google Cloud SQL:**
```env
DB_CONNECTION=mysql
DB_HOST=<IP_PUBLICA_O_PROXY>
DB_PORT=3306
DB_DATABASE=transportes_db
DB_USERNAME=<usuario>
DB_PASSWORD=<password>
```

5. **Migrar y poblar base de datos**
```bash
php artisan migrate --seed
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=PrediosBodegasSeeder
```

6. **Compilar assets**
```bash
npm run build
# O para desarrollo:
npm run dev
```

7. **Iniciar servidor**
```bash
php artisan serve
```

Acceder a: `http://127.0.0.1:8000`

---

## 👥 Usuarios de Prueba

| Rol | Email | Password |
|-----|-------|----------|
| Admin | admin@transportes.com | admin123 |
| Operativo | operativo@transportes.com | operativo123 |
| Piloto | piloto@transportes.com | piloto123 |

---

## 📊 Estructura de Módulos

### Rutas Principales

- `/` - Dashboard
- `/login` - Login
- `/camiones` - Gestión de camiones
- `/transportistas` - Gestión de transportistas
- `/pilotos` - Gestión de pilotos
- `/predios` - Gestión de predios
- `/bodegas` - Gestión de bodegas
- `/ordenes` - Órdenes de trabajo
- `/movimientos` - Ingresos/Egresos
- `/combustible` - Vales de combustible
- `/reportes` - Reportes y exportaciones
- `/logs` - Activity logs (solo admin)

### Exportaciones CSV

- `/reportes/exportar/camiones`
- `/reportes/exportar/movimientos`
- `/reportes/exportar/combustible`

### Reportes Avanzados

- `/reportes/ingresos` - Ingresos por predio
- `/reportes/egresos` - Egresos por predio
- `/reportes/vales` - Vales detallados
- `/reportes/viajes` - Viajes por camión
- `/reportes/actividad` - Actividad de usuarios

---

## 🛡️ Seguridad

### Activity Logs

Todos los login/logout se registran automáticamente en `activity_logs`:
- Usuario
- Acción (login, logout, created, updated, deleted)
- Modelo afectado
- IP y User Agent
- Timestamp

**Ver logs:** Sidebar → "Logs Sistema" (solo admin)

### Backup de Base de Datos

**Crear backup manual:**
```bash
php artisan db:backup
```

**Con retención personalizada:**
```bash
php artisan db:backup --keep=14
```

Los backups se guardan en `storage/backups/`

**Automatizar con cron:**
```
0 2 * * * cd /path/to/project && php artisan db:backup --keep=30
```

---

## 📁 Estructura del Proyecto

```
app/
├── Console/Commands/
│   └── BackupDatabase.php
├── Http/
│   ├── Controllers/Web/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── CamionController.php
│   │   ├── TransportistaController.php
│   │   ├── PilotoController.php
│   │   ├── PredioController.php
│   │   ├── BodegaController.php
│   │   ├── OrdenTrabajoController.php
│   │   ├── MovimientoController.php
│   │   ├── ValeCombustibleController.php
│   │   ├── ReporteController.php
│   │   └── ActivityLogController.php
│   └── Middleware/
│       └── CheckRole.php
├── Models/
│   ├── User.php
│   ├── Camion.php
│   ├── Transportista.php
│   ├── Piloto.php
│   ├── Predio.php
│   ├── Bodega.php
│   ├── OrdenTrabajo.php
│   ├── IngresoCamion.php
│   ├── EgresoCamion.php
│   ├── ValeCombustible.php
│   └── ActivityLog.php

resources/views/
├── layouts/
│   └── app.blade.php
├── auth/
│   └── login.blade.php
├── camiones/
├── transportistas/
├── pilotos/
├── predios/
├── bodegas/
├── ordenes/
├── movimientos/
├── combustible/
├── reportes/
└── logs/

database/
├── migrations/
└── seeders/
    ├── UserSeeder.php
    ├── PrediosBodegasSeeder.php
    └── DatosInicialesSeeder.php
```

---

## 🔧 Comandos Útiles

### Desarrollo
```bash
npm run dev          # Compilar assets en modo watch
php artisan serve    # Iniciar servidor local
```

### Producción
```bash
npm run build        # Compilar assets para producción
php artisan optimize # Cachear configuración y rutas
```

### Base de Datos
```bash
php artisan migrate            # Ejecutar migraciones pendientes
php artisan migrate:fresh      # Limpiar y re-migrar
php artisan migrate:fresh --seed  # + ejecutar seeders
php artisan db:seed            # Solo ejecutar seeders
php artisan db:backup          # Crear backup
```

### Caché
```bash
php artisan config:clear   # Limpiar cache de configuración
php artisan route:clear    # Limpiar cache de rutas
php artisan view:clear     # Limpiar cache de vistas
php artisan optimize:clear # Limpiar todo el cache
```

---

## 🌐 Despliegue en Google Cloud

### 1. Preparar Cloud SQL (MySQL)

```sql
CREATE DATABASE transportes_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;
```

### 2. Configurar `.env` para producción

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com

DB_CONNECTION=mysql
DB_HOST=<CLOUD_SQL_IP>
DB_PORT=3306
DB_DATABASE=transportes_db
DB_USERNAME=<usuario>
DB_PASSWORD=<password_seguro>
```

### 3. Migrar en producción

```bash
php artisan migrate --force
php artisan db:seed --class=UserSeeder --force
php artisan db:seed --class=PrediosBodegasSeeder --force
```

### 4. Optimizar

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. Configurar cron para backups

```bash
0 3 * * * cd /var/www/html && php artisan db:backup --keep=30
```

---

## 📚 Características Técnicas

- **Framework**: Laravel 11
- **Frontend**: Blade + Tailwind CSS 3 + Alpine.js
- **Base de Datos**: MySQL / SQLite
- **Autenticación**: Laravel Session + Middleware personalizado
- **Reportes**: CSV nativo (sin librerías externas)
- **Logs**: Sistema de auditoría personalizado
- **Backup**: Comando artisan con soporte MySQL/SQLite

---

## 🎯 Roadmap Futuro (Opcional)

- [ ] Gráficos en dashboard (Chart.js)
- [ ] Notificaciones en tiempo real
- [ ] API REST con Laravel Passport (ya configurado)
- [ ] App móvil para pilotos
- [ ] Exportación PDF de reportes
- [ ] Geolocalización de camiones
- [ ] Alertas de mantenimiento preventivo

---

## 📞 Soporte

Para dudas o reportes de bugs, contactar al equipo de desarrollo.

**Versión**: 1.0.0  
**Última actualización**: Octubre 2025  
**Desarrollado para**: Transportes Ultrarrápidos S.A.

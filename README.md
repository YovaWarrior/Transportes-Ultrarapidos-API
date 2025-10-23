# 🚛 Sistema Integral de Control de Flota y Predios

**Transportes Ultrarrápidos S.A.**

Sistema computarizado para el registro, control y monitoreo de flota de camiones y operaciones logísticas en Centroamérica.

---

## 📋 Descripción del Proyecto

Sistema desarrollado para **Transportes Ultrarrápidos S.A.**, empresa especializada en transporte regional de mercancías en Guatemala y El Salvador. Centraliza información en tiempo real, optimiza procesos y mejora la trazabilidad de operaciones.

### 🎯 Objetivo
Reemplazar procesos manuales en papel con un sistema digital robusto que permita:
- Control completo de flota de camiones
- Gestión de predios y bodegas
- Registro de ingresos/egresos
- Vales de combustible
- Reportes operativos y de productividad
- Auditoría completa de actividad

---

## ✨ Características Principales

### 🔐 Sistema de Roles
- **Administrador**: Control total del sistema
- **Operativo**: Gestión de operaciones (sin eliminar)
- **Piloto**: Solo lectura

### 📦 Módulos Implementados

#### 1. **Transportistas y Flota**
- Registro de transportistas (empresa/independiente)
- Múltiples camiones por transportista
- Detalles completos: placa, tipo, capacidad, estado
- Validación de placas guatemaltecas

#### 2. **Predios y Bodegas**
- Gestión de predios (Guatemala, El Salvador)
- Múltiples bodegas por predio
- Estado activo/inactivo

#### 3. **Órdenes de Trabajo**
- Generación automática de número: `OT-YYYYMMDD-####`
- Asociación: Camión + Piloto + Predio + Bodega
- Estados: pendiente, en_proceso, completada, cancelada

#### 4. **Ingresos y Egresos**
- Registro de entrada de camiones (origen, carga, fecha/hora)
- Registro de salida (destino, carga, kilometraje)
- Trazabilidad completa

#### 5. **Vales de Combustible**
- Asociado a orden de trabajo
- Cálculo automático de total
- Filtros por fecha, camión, piloto

#### 6. **Reportes**
- Ingresos/egresos mensuales por predio
- Consumo de combustible
- Viajes por camión
- Actividad por usuario
- Reporte de productividad
- Exportación a CSV

#### 7. **Auditoría y Seguridad**
- Logs de todas las acciones
- Registro de login/logout
- IP y fecha/hora de cada acción
- Backup automático de base de datos

---

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Blade + Tailwind CSS
- **Base de Datos**: MySQL 8.0
- **Autenticación**: Laravel Sanctum
- **Hosting**: Google Cloud (App Engine + Cloud SQL)

---

## 📁 Estructura del Proyecto

```
Transportes-Ultrarapidos-API/
├── app/
│   ├── Console/Commands/
│   │   └── DatabaseBackup.php          # Comando de backup automático
│   ├── Http/
│   │   ├── Controllers/Web/
│   │   │   ├── CamionController.php
│   │   │   ├── TransportistaController.php
│   │   │   ├── PilotoController.php
│   │   │   ├── OrdenTrabajoController.php
│   │   │   ├── MovimientoController.php
│   │   │   ├── ValeCombustibleController.php
│   │   │   ├── ReporteController.php
│   │   │   └── ActivityLogController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
├── database/migrations/
├── resources/views/
│   ├── layouts/
│   ├── camiones/
│   ├── pilotos/
│   ├── ordenes/
│   ├── reportes/
│   └── logs/
├── routes/web.php
├── .env
├── backup_manual.bat                   # Script de backup manual (Windows)
├── DEPLOY_GOOGLE_CLOUD.md             # Guía completa de despliegue
├── RESUMEN_DEPLOY.md                  # Resumen ejecutivo
└── README.md
```

---

## ⚡ Instalación Local

### Requisitos
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js (opcional)

### Pasos

```bash
# 1. Clonar repositorio
git clone https://github.com/TU_USUARIO/transportes-ultrarapidos.git
cd transportes-ultrarapidos

# 2. Instalar dependencias
composer install

# 3. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 4. Configurar base de datos en .env
DB_DATABASE=transportes_db
DB_USERNAME=root
DB_PASSWORD=

# 5. Migrar base de datos
php artisan migrate --seed

# 6. Iniciar servidor
php artisan serve
```

Acceder a: `http://localhost:8000`

**Usuario Admin por defecto:**
- Email: `admin@transportes.com`
- Password: `password123`

---

## 🚀 Despliegue a Producción

### Google Cloud (Recomendado)

Ver guía completa: **[DEPLOY_GOOGLE_CLOUD.md](DEPLOY_GOOGLE_CLOUD.md)**

Resumen:
```bash
# 1. Instalar gcloud CLI
# 2. Autenticar
gcloud auth login

# 3. Deploy
gcloud app deploy
```

### Otros Servicios
- **Heroku**: Compatible
- **AWS**: Elastic Beanstalk o EC2
- **DigitalOcean**: App Platform o Droplet
- **Servidor VPS**: Nginx + PHP-FPM

---

## 💾 Backup

### Manual (Windows)
Doble click en: `backup_manual.bat`

### Automático (Comando)
```bash
php artisan db:backup
```

Backups se guardan en: `storage/app/backups/`

---

## 📊 Capturas de Pantalla

### Dashboard
![Dashboard](docs/screenshots/dashboard.png)

### Gestión de Flota
![Camiones](docs/screenshots/camiones.png)

### Reportes
![Reportes](docs/screenshots/reportes.png)

*(Agregar screenshots al deployar)*

---

## 🧪 Testing

```bash
# Ejecutar tests
php artisan test

# Con coverage
php artisan test --coverage
```

---

## 📈 Roadmap

- [x] Sistema de roles completo
- [x] CRUD de todos los módulos
- [x] Reportes operativos
- [x] Logs de auditoría
- [x] Backup automático
- [ ] Notificaciones en tiempo real
- [ ] Gráficas interactivas
- [ ] Exportación a PDF
- [ ] API REST para móvil
- [ ] App móvil (Flutter)

---

## 🤝 Contribución

Este es un proyecto privado para Transportes Ultrarrápidos S.A.

Para cambios internos:
1. Fork el repositorio
2. Crea tu branch (`git checkout -b feature/NuevaCaracteristica`)
3. Commit cambios (`git commit -m 'Agregar nueva característica'`)
4. Push (`git push origin feature/NuevaCaracteristica`)
5. Abre un Pull Request

---

## 📄 Licencia

Proyecto privado - Todos los derechos reservados © 2025 Transportes Ultrarrápidos S.A.

---

## 📞 Soporte

**Desarrollador**: [Tu Nombre]
**Email**: tu-email@ejemplo.com
**Empresa**: Transportes Ultrarrápidos S.A.

---

## 🙏 Agradecimientos

- Laravel Framework
- Tailwind CSS
- Google Cloud Platform
- Comunidad Open Source

---

**Desarrollado con ❤️ para Transportes Ultrarrápidos S.A.**

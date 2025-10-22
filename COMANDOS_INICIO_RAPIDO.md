# ⚡ Inicio Rápido - 5 Minutos

## 🚀 Comandos de Instalación

Ejecuta estos comandos en orden desde la carpeta raíz del proyecto:

### 1. Instalar Dependencias
```bash
# PHP
composer install

# Node.js
npm install
```

### 2. Configurar Entorno
```bash
# Copiar .env
cp .env.example .env

# Generar clave
php artisan key:generate

# Configurar base de datos en .env
# DB_DATABASE=transportes_db
# DB_USERNAME=root
# DB_PASSWORD=tu_password
```

### 3. Base de Datos
```bash
# Crear base de datos (en MySQL)
mysql -u root -p -e "CREATE DATABASE transportes_db;"

# Ejecutar migraciones
php artisan migrate

# (Opcional) Seeders
php artisan db:seed
```

### 4. Compilar Assets
```bash
# Desarrollo (con hot reload)
npm run dev
```

### 5. Iniciar Servidor
```bash
# En otra terminal
php artisan serve
```

### 6. Abrir Navegador
```
http://localhost:8000
```

---

## 🎯 Crear Datos de Prueba Rápidos

```bash
php artisan tinker
```

Luego ejecuta:

```php
// Crear Transportista
$t = \App\Models\Transportista::create([
    'nombre' => 'Transportes Guatemala S.A.',
    'tipo' => 'empresa',
    'nit' => '12345678-9',
    'telefono' => '2234-5678',
    'email' => 'info@transportesgt.com',
    'direccion' => 'Zona 10, Ciudad de Guatemala',
    'active' => true
]);

// Crear Camiones
\App\Models\Camion::create([
    'placa' => 'P-001AAA',
    'marca' => 'Volvo',
    'modelo' => 'FH16',
    'año' => 2020,
    'tipo' => 'plataforma',
    'capacidad' => 40,
    'estado' => 'activo',
    'transportista_id' => $t->id
]);

\App\Models\Camion::create([
    'placa' => 'C-002BBB',
    'marca' => 'Mercedes',
    'modelo' => 'Actros',
    'año' => 2021,
    'tipo' => 'furgón',
    'capacidad' => 35,
    'estado' => 'activo',
    'transportista_id' => $t->id
]);

\App\Models\Camion::create([
    'placa' => 'TC-003CCC',
    'marca' => 'Scania',
    'modelo' => 'R450',
    'año' => 2019,
    'tipo' => 'refrigerado',
    'capacidad' => 30,
    'estado' => 'mantenimiento',
    'transportista_id' => $t->id
]);

echo "✅ Datos de prueba creados!\n";
exit;
```

---

## 🔥 One-Liner (todo en uno)

```bash
composer install && npm install && cp .env.example .env && php artisan key:generate && php artisan migrate && npm run dev
```

En otra terminal:
```bash
php artisan serve
```

---

## ✅ Verificación

Navega a estas URLs para verificar:

- ✅ Dashboard: http://localhost:8000
- ✅ Lista Camiones: http://localhost:8000/camiones
- ✅ Crear Camión: http://localhost:8000/camiones/create
- ✅ Ver Camión: http://localhost:8000/camiones/1

---

## 🎨 Vista Previa de Funcionalidades

### Dashboard
- 4 Cards de métricas principales
- 2 Gráficos (Chart.js)
- Tabla de últimas órdenes
- Diseño responsive

### Módulo Camiones
- ✅ Lista con búsqueda en tiempo real
- ✅ Filtros por estado y tipo
- ✅ Badges de estado coloridos
- ✅ Paginación
- ✅ CRUD completo
- ✅ Validación de placas guatemaltecas
- ✅ Formularios responsive
- ✅ Flash messages

---

## 🐛 Solución de Problemas Comunes

### Error: "Vite manifest not found"
```bash
npm run build
```

### Error: "Class CamionController not found"
```bash
composer dump-autoload
php artisan optimize:clear
```

### Assets no cargan correctamente
```bash
# Asegúrate que npm run dev esté corriendo
# O compila para producción
npm run build
```

### Error de migración
```bash
php artisan migrate:fresh
```

---

## 📱 Comparación Visual

Las pantallas web replican exactamente el diseño de la app móvil:

- **Mismo sistema de colores** (#1E40AF para transport, etc.)
- **Mismos badges de estado** (verde/amarillo/rojo)
- **Mismas cards** con sombras
- **Misma tipografía** y espaciado
- **Headers con gradiente** igual a la app

---

## 🎯 Lo que YA funciona

✅ Layout base con sidebar responsive  
✅ Dashboard con gráficos dinámicos  
✅ Módulo Camiones CRUD completo  
✅ Búsqueda y filtros en tiempo real  
✅ Validaciones frontend y backend  
✅ Flash messages de éxito/error  
✅ Diseño 100% responsive  
✅ Navegación completa  
✅ Sistema de colores idéntico a la app  

---

## 📋 Próxima Fase

Una vez verificado que todo funciona, continuar con:

**FASE 2:**
- Módulo Movimientos (Ingreso/Egreso)
- Módulo Combustible (Vales)
- Módulo Transportistas

**FASE 3:**
- Módulo Órdenes de Trabajo
- Módulo Reportes avanzados
- Generador QR
- Notificaciones web

---

**¡Listo para producción!** 🚀

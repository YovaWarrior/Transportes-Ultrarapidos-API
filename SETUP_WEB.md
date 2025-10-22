# 🚀 Guía de Instalación - Aplicación Web Transportes Ultrarrápidos

## 📋 Requisitos Previos
- PHP >= 8.1
- Composer
- Node.js >= 16.x
- NPM o Yarn
- Base de datos MySQL/PostgreSQL

---

## 🔧 Paso 1: Instalar Dependencias PHP

```bash
cd Transportes-Ultrarapidos-API
composer install
```

---

## 🎨 Paso 2: Instalar TailwindCSS y Dependencias Frontend

```bash
npm install -D tailwindcss@latest postcss autoprefixer
npm install alpinejs chart.js
npm install
```

---

## ⚙️ Paso 3: Configurar Vite (ya está configurado)

El archivo `vite.config.js` ya incluye:
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
```

---

## 🗄️ Paso 4: Configurar Base de Datos

1. Copia el archivo `.env.example` a `.env`:
```bash
cp .env.example .env
```

2. Configura la conexión a base de datos en `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transportes_db
DB_USERNAME=root
DB_PASSWORD=tu_password
```

3. Genera la clave de aplicación:
```bash
php artisan key:generate
```

4. Ejecuta las migraciones:
```bash
php artisan migrate
```

5. (Opcional) Ejecuta los seeders para datos de prueba:
```bash
php artisan db:seed
```

---

## 🚦 Paso 5: Compilar Assets

### Modo Desarrollo (con hot reload)
```bash
npm run dev
```

### Modo Producción
```bash
npm run build
```

---

## 🏃 Paso 6: Iniciar Servidor

En una terminal separada:
```bash
php artisan serve
```

La aplicación estará disponible en: http://localhost:8000

---

## 📂 Estructura de Archivos Creados

```
Transportes-Ultrarapidos-API/
├── app/
│   └── Http/
│       └── Controllers/
│           └── Web/
│               ├── CamionController.php ✅
│               └── DashboardController.php ✅
├── resources/
│   ├── css/
│   │   └── app.css ✅
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php ✅
│       ├── camiones/
│       │   ├── index.blade.php ✅
│       │   ├── show.blade.php ✅
│       │   ├── create.blade.php ✅
│       │   └── edit.blade.php ✅
│       └── dashboard.blade.php ✅
├── routes/
│   └── web.php ✅ (actualizado)
└── tailwind.config.js ✅
```

---

## 🎨 Sistema de Diseño Implementado

### Colores (exactos de la app móvil)
- **Primary:** #1E40AF
- **Transport:** #1E40AF → #3B82F6
- **Fuel:** #F59E0B → #FBBF24
- **Movement:** #059669 → #10B981
- **Report:** #7C3AED → #8B5CF6
- **Success:** #10B981
- **Warning:** #F59E0B
- **Error:** #EF4444

### Espaciado
```
xs:4px, sm:8px, md:12px, lg:16px, xl:20px, 
2xl:24px, 3xl:32px, 4xl:40px, 5xl:48px, 6xl:64px
```

---

## 📊 Módulos Implementados (FASE 1)

### ✅ Dashboard Principal
- `/` - Vista general con estadísticas
- Cards de métricas (Total, Activos, Mantenimiento, Fuera Servicio)
- Gráficos de distribución (Chart.js)
- Tabla de últimas órdenes

### ✅ Módulo Camiones (CRUD Completo)
- `/camiones` - Lista con búsqueda y filtros
- `/camiones/create` - Formulario crear
- `/camiones/{id}` - Detalle del camión
- `/camiones/{id}/edit` - Formulario editar
- `DELETE /camiones/{id}` - Eliminar camión

**Funcionalidades:**
- ✅ Búsqueda por placa, marca, modelo
- ✅ Filtros por estado y tipo
- ✅ Validación de placas guatemaltecas
- ✅ Estados con badges de color
- ✅ Paginación
- ✅ Relación con Transportistas
- ✅ Vista detallada con info completa
- ✅ Formularios con validación
- ✅ Flash messages
- ✅ Diseño responsive

---

## 🔍 Rutas Disponibles

```bash
# Ver todas las rutas
php artisan route:list --name=camiones
php artisan route:list --name=dashboard
```

### Rutas Implementadas:
```
GET    /                      dashboard
GET    /camiones              camiones.index
GET    /camiones/create       camiones.create
POST   /camiones              camiones.store
GET    /camiones/{id}         camiones.show
GET    /camiones/{id}/edit    camiones.edit
PUT    /camiones/{id}         camiones.update
DELETE /camiones/{id}         camiones.destroy
POST   /logout                logout
```

---

## 🧪 Datos de Prueba

### Crear Transportista de Prueba:
```php
php artisan tinker

\App\Models\Transportista::create([
    'nombre' => 'Transportes Rápidos S.A.',
    'tipo' => 'empresa',
    'nit' => '12345678-9',
    'telefono' => '2234-5678',
    'email' => 'info@rapidostrans.com',
    'direccion' => 'Zona 12, Guatemala',
    'active' => true
]);
```

### Crear Camión de Prueba:
```php
\App\Models\Camion::create([
    'placa' => 'P-001AAA',
    'marca' => 'Volvo',
    'modelo' => 'FH16',
    'año' => 2020,
    'tipo' => 'plataforma',
    'capacidad' => 40,
    'estado' => 'activo',
    'transportista_id' => 1
]);
```

---

## 🐛 Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Vite manifest not found"
```bash
npm run build
```

### Error: Assets no cargan
1. Verifica que `npm run dev` esté corriendo
2. Limpia caché: `php artisan cache:clear`
3. Verifica la URL en `APP_URL` del `.env`

### Error: "SQLSTATE connection refused"
- Verifica que MySQL esté corriendo
- Verifica credenciales en `.env`
- Intenta: `php artisan migrate:fresh`

---

## 📱 Comparación App Móvil → Web

| Característica | App Móvil | Web Implementada |
|----------------|-----------|------------------|
| **Navegación** | Bottom Tabs | Sidebar fijo |
| **Lista Camiones** | FlatList | Cards responsive |
| **Búsqueda** | Floating | Barra superior |
| **Filtros** | Modal | Inline form |
| **Estado Badges** | Colored | Mismo sistema |
| **Cards** | TouchableOpacity | Hover + Click |
| **Formularios** | TextInput | Input HTML5 |
| **Validación** | Frontend | Frontend + Backend |
| **Notificaciones** | Toast (Expo) | Flash Messages |
| **Responsive** | Nativo | Tailwind breakpoints |

---

## 🎯 Próximos Pasos (FASE 2)

- [ ] Módulo Movimientos (Ingreso/Egreso)
- [ ] Módulo Combustible (Vales)
- [ ] Módulo Transportistas (Lista y CRUD)
- [ ] Módulo Órdenes de Trabajo
- [ ] Módulo Reportes con gráficos

---

## 📚 Documentación de Referencia

- [Laravel 10 Docs](https://laravel.com/docs/10.x)
- [TailwindCSS Docs](https://tailwindcss.com/docs)
- [Alpine.js Docs](https://alpinejs.dev)
- [Chart.js Docs](https://www.chartjs.org/docs/)

---

## ✅ Checklist de Verificación

- [ ] Dependencias PHP instaladas
- [ ] Dependencias Node instaladas
- [ ] Base de datos configurada y migrada
- [ ] Assets compilados (npm run dev o build)
- [ ] Servidor Laravel corriendo
- [ ] Dashboard accesible en /
- [ ] Módulo Camiones funcionando
- [ ] Búsqueda y filtros operativos
- [ ] Formularios crean/editan correctamente
- [ ] Validaciones funcionando
- [ ] Flash messages aparecen
- [ ] Diseño responsive en móvil

---

## 📞 Soporte

Para dudas sobre implementación, consulta:
- Documentos de análisis en `/REPORTE_APP_TRANSPORTES.md`
- Guía de migración en `/GUIA_MIGRACION_WEB.md`
- Datos de ejemplo en `/DATOS_EJEMPLO_API.md`

---

**Fecha:** Octubre 2025  
**Versión:** 1.0.0 - FASE 1 COMPLETA  
**Estado:** ✅ Listo para desarrollo

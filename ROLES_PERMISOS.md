# 🔐 Sistema de Roles y Permisos

## 📋 Roles Disponibles

El sistema tiene 3 roles de usuario con diferentes niveles de acceso:

### 1. 👑 **ADMIN** (Administrador)
**Permisos completos del sistema**

✅ **Puede:**
- Ver TODO el contenido
- Crear nuevos registros
- Editar registros existentes
- **ELIMINAR registros** (solo admin)
- Acceder a los LOGS del sistema
- Exportar reportes

🔑 **Credenciales de prueba:**
- Email: `admin@transportes.com`
- Password: `admin123`

---

### 2. 🏢 **OPERATIVO** (Operador)
**Gestión operativa sin eliminaciones**

✅ **Puede:**
- Ver TODO el contenido
- Crear nuevos registros
- Editar registros existentes
- Exportar reportes

❌ **NO Puede:**
- Eliminar registros
- Acceder a logs del sistema

🔑 **Credenciales de prueba:**
- Email: `operativo@transportes.com`
- Password: `operativo123`

---

### 3. 👁️ **PILOTO** (Solo Lectura)
**Acceso de solo visualización**

✅ **Puede:**
- Ver TODO el contenido
- Exportar reportes

❌ **NO Puede:**
- Crear registros
- Editar registros
- Eliminar registros
- Acceder a logs del sistema

🔑 **Credenciales de prueba:**
- Email: `piloto@transportes.com`
- Password: `piloto123`

---

## 🎯 Tabla de Permisos por Módulo

| Módulo | Admin | Operativo | Piloto |
|--------|-------|-----------|--------|
| **Dashboard** | ✅ Ver | ✅ Ver | ✅ Ver |
| **Camiones** | ✅ CRUD completo | ✅ Ver, Crear, Editar | ✅ Solo Ver |
| **Transportistas** | ✅ CRUD completo | ✅ Ver, Crear, Editar | ✅ Solo Ver |
| **Pilotos** | ✅ CRUD completo | ✅ Ver, Crear, Editar | ✅ Solo Ver |
| **Predios** | ✅ CRUD completo | ✅ Ver, Crear, Editar | ✅ Solo Ver |
| **Bodegas** | ✅ CRUD completo | ✅ Ver, Crear, Editar | ✅ Solo Ver |
| **Órdenes** | ✅ CRUD completo | ✅ Ver, Crear, Editar | ✅ Solo Ver |
| **Combustible** | ✅ CRUD completo | ✅ Ver, Crear | ✅ Solo Ver |
| **Movimientos** | ✅ CRUD completo | ✅ Ver, Crear | ✅ Solo Ver |
| **Reportes** | ✅ Ver y Exportar | ✅ Ver y Exportar | ✅ Ver y Exportar |
| **Logs Sistema** | ✅ Ver | ❌ Sin acceso | ❌ Sin acceso |

---

## 🛠️ Implementación Técnica

### Middleware de Roles
El sistema usa el middleware `CheckRole` que verifica:
1. Si el usuario está autenticado
2. Si la cuenta está activa
3. Si el usuario tiene el rol requerido

### Rutas Protegidas
Las rutas están organizadas en 3 grupos:

```php
// 1. Todos los roles autenticados
Route::middleware(['role'])->group(function () {
    // Rutas de solo lectura (index, show)
});

// 2. Admin y Operativo
Route::middleware(['role:admin,operativo'])->group(function () {
    // Rutas de crear y editar (create, store, edit, update)
});

// 3. Solo Admin
Route::middleware(['role:admin'])->group(function () {
    // Rutas de eliminar (destroy)
    // Logs del sistema
});
```

### Métodos Helper en el Modelo User

```php
$user->isAdmin()      // true si es admin
$user->isOperativo()  // true si es operativo
$user->isPiloto()     // true si es piloto
$user->canCreate()    // true si puede crear (admin u operativo)
$user->canEdit()      // true si puede editar (admin u operativo)
$user->canDelete()    // true si puede eliminar (solo admin)
$user->canOnlyView()  // true si solo puede ver (piloto)
```

### Uso en Vistas Blade

```blade
@auth
    {{-- Botón de crear (solo admin y operativo) --}}
    @if(auth()->user()->canCreate())
        <a href="{{ route('camiones.create') }}" class="btn">
            Nuevo Camión
        </a>
    @endif

    {{-- Botón de editar (solo admin y operativo) --}}
    @if(auth()->user()->canEdit())
        <a href="{{ route('camiones.edit', $camion) }}" class="btn">
            Editar
        </a>
    @endif

    {{-- Botón de eliminar (solo admin) --}}
    @if(auth()->user()->canDelete())
        <form method="POST" action="{{ route('camiones.destroy', $camion) }}">
            @csrf @method('DELETE')
            <button type="submit" class="btn-danger">Eliminar</button>
        </form>
    @endif
@endauth
```

---

## 🔒 Seguridad

### Protección en el Backend
- ✅ Middleware verifica roles en TODAS las rutas protegidas
- ✅ Si un usuario intenta acceder sin permiso → Error 403
- ✅ Las rutas DELETE solo son accesibles por Admin
- ✅ Validación en el servidor, NO solo en el frontend

### Protección en el Frontend
- ✅ Botones y enlaces se ocultan según permisos
- ✅ Formularios de creación/edición solo para usuarios autorizados
- ✅ Mensajes claros cuando no hay permisos

---

## 📝 Notas Importantes

1. **Los permisos se validan en el SERVIDOR** (backend), no solo en las vistas
2. **Si un piloto intenta acceder directamente a una URL de crear/editar** → Error 403
3. **Los roles se asignan en la tabla `users`** con el campo `role`
4. **Solo Admin puede desactivar usuarios** con el campo `active`
5. **Los logs del sistema solo son visibles para Admin**

---

## ⚙️ Cómo Cambiar el Rol de un Usuario

### Opción 1: Desde la Base de Datos
```sql
UPDATE users SET role = 'admin' WHERE email = 'usuario@ejemplo.com';
```

### Opción 2: Desde Tinker (Laravel CLI)
```bash
php artisan tinker
```
```php
$user = User::where('email', 'usuario@ejemplo.com')->first();
$user->role = 'admin';
$user->save();
```

---

## 🧪 Probar los Roles

1. **Inicia sesión con cada rol:**
   - Admin → Ve TODOS los botones (Nuevo, Editar, Eliminar)
   - Operativo → Ve botones de Nuevo y Editar (NO Eliminar)
   - Piloto → NO ve botones de acciones, solo puede ver

2. **Intenta acceder directamente a URLs protegidas:**
   - Como Piloto: `http://127.0.0.1:8000/camiones/create` → Error 403
   - Como Operativo: `http://127.0.0.1:8000/camiones/1` (DELETE) → Error 403
   - Como Admin: Todo funciona ✅

---

## 🎨 Diseño Visual de Roles

En la página de login, cada rol tiene un color distintivo:
- 🟣 **Admin** → Púrpura
- 🔵 **Operativo** → Azul
- 🟢 **Piloto** → Teal/Verde

---

**Sistema implementado el 22/10/2025** 🚀

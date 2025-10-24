# 🔧 SOLUCIÓN AL ERROR 500 EN LOGIN

## ❌ **PROBLEMA IDENTIFICADO:**

La tabla `users` **NO tiene las columnas** necesarias para el login:
- ❌ Falta columna `role`
- ❌ Falta columna `active`
- ❌ Passport no está instalado
- ❌ Usuarios no están en la base de datos

---

## ✅ **SOLUCIÓN COMPLETA (3 PASOS):**

### **PASO 1: Subir cambios a GitHub**

```bash
git add .
git commit -m "fix: Add role and active columns to users table and fix login"
git push origin master
```

### **PASO 2: Deploy en Google Cloud**

```bash
# En Cloud Shell:
cd ~/Transportes-Ultrarapidos-API
git pull origin master
gcloud app deploy
```

### **PASO 3: Ejecutar comandos de configuración**

Abre en tu navegador **UNO POR UNO** en este orden:

```
1. https://transportes-ultrarapidos-api.uc.r.appspot.com/api/migrate
   → Agrega columnas role y active a users

2. https://transportes-ultrarapidos-api.uc.r.appspot.com/api/passport-install
   → Instala Laravel Passport para tokens

3. https://transportes-ultrarapidos-api.uc.r.appspot.com/api/seed-users
   → Crea los 3 usuarios de prueba
```

---

## 🧪 **PROBAR EL LOGIN:**

### **En Postman:**

```json
POST https://transportes-ultrarapidos-api.uc.r.appspot.com/api/login
Content-Type: application/json

{
  "email": "admin@transportes.com",
  "password": "admin123"
}
```

### **Respuesta Exitosa (200):**

```json
{
  "success": true,
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@transportes.com",
    "role": "admin",
    "active": true
  },
  "token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
}
```

---

## 👤 **USUARIOS DISPONIBLES:**

| Rol | Email | Password |
|-----|-------|----------|
| 👑 **Admin** | `admin@transportes.com` | `admin123` |
| 👷 **Operativo** | `operativo@transportes.com` | `operativo123` |
| 🚛 **Piloto** | `piloto@transportes.com` | `piloto123` |

---

## 📱 **PARA TU COMPAÑERO:**

Dile que use este JSON en su app móvil:

```json
POST /api/login

{
  "email": "admin@transportes.com",
  "password": "admin123"
}
```

**Respuesta:**
- ✅ `success: true` → Login exitoso, guardar `token`
- ❌ `success: false` → Credenciales incorrectas

**Usar el token en headers:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc...
```

---

## ⚠️ **SI SIGUE SIN FUNCIONAR:**

### Ver logs en Cloud Console:
```
https://console.cloud.google.com/logs
```

### Verificar usuarios creados:
```
GET https://transportes-ultrarapidos-api.uc.r.appspot.com/api/test
```

---

## ✅ **DESPUÉS DE ESTOS PASOS:**

1. ✅ Login funcionará correctamente
2. ✅ Tokens JWT funcionarán
3. ✅ Los 3 usuarios estarán disponibles
4. ✅ La app móvil podrá autenticarse

---

**🎉 ¡El login debería funcionar perfectamente después de esto!**

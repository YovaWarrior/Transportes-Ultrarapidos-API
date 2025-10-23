# 🚀 GUÍA DE DESPLIEGUE A GOOGLE CLOUD

## 📋 REQUISITOS PREVIOS

1. **Cuenta de Google Cloud** activa
2. **Git** instalado localmente
3. **gcloud CLI** instalado ([Descargar aquí](https://cloud.google.com/sdk/docs/install))
4. **Proyecto listo** localmente

---

## 1️⃣ PREPARAR PROYECTO PARA PRODUCCIÓN

### A) Crear archivo `.env.production` (copia de `.env`)

```bash
# En tu proyecto local
cp .env .env.production
```

### B) Editar `.env.production` para producción:

```env
APP_NAME="Transportes Ultrarrápidos"
APP_ENV=production
APP_KEY=base64:TU_KEY_AQUI
APP_DEBUG=false
APP_URL=https://tu-proyecto.appspot.com

LOG_CHANNEL=stack
LOG_LEVEL=error

# Base de datos en Cloud SQL (llenar después)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transportes_db
DB_USERNAME=root
DB_PASSWORD=TU_PASSWORD_SEGURO

# Cloud Storage (opcional)
FILESYSTEM_DISK=local

# Timezone
APP_TIMEZONE=America/Guatemala

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

## 2️⃣ CONFIGURAR GIT

### A) Inicializar Git (si no está inicializado)

```bash
cd C:\Users\bumme\Documents\Proyectos\Transportes-Ultrarapidos-API
git init
```

### B) Crear `.gitignore` (si no existe)

```
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.env.production
.phpunit.result.cache
docker-compose.override.yml
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
/.idea
/.vscode
```

### C) Hacer primer commit

```bash
git add .
git commit -m "Initial commit - Sistema de Transportes Ultrarrápidos"
```

### D) Crear repositorio en GitHub/GitLab

1. Ve a [github.com](https://github.com) → New Repository
2. Nombre: `transportes-ultrarapidos-api`
3. Descripción: "Sistema Integral para Control de Flota y Predios"
4. Privado o Público (recomiendo Privado)
5. Click "Create repository"

### E) Conectar y subir a GitHub

```bash
git remote add origin https://github.com/TU_USUARIO/transportes-ultrarapidos-api.git
git branch -M main
git push -u origin main
```

---

## 3️⃣ CONFIGURAR GOOGLE CLOUD

### A) Instalar Google Cloud CLI

1. Descargar: https://cloud.google.com/sdk/docs/install
2. Ejecutar instalador
3. Reiniciar terminal

### B) Autenticarse

```bash
gcloud auth login
```

### C) Crear Proyecto en Google Cloud

```bash
# Crear proyecto
gcloud projects create transportes-ultrarapidos --name="Transportes Ultrarrápidos"

# Establecer como proyecto activo
gcloud config set project transportes-ultrarapidos

# Habilitar App Engine
gcloud app create --region=us-central
```

### D) Habilitar APIs necesarias

```bash
gcloud services enable sqladmin.googleapis.com
gcloud services enable appengine.googleapis.com
gcloud services enable cloudbuild.googleapis.com
```

---

## 4️⃣ CREAR BASE DE DATOS EN CLOUD SQL

### A) Crear instancia MySQL

```bash
gcloud sql instances create transportes-mysql \
    --database-version=MYSQL_8_0 \
    --tier=db-f1-micro \
    --region=us-central1 \
    --root-password=TU_PASSWORD_SEGURO_AQUI
```

**⏱️ Esto toma 5-10 minutos**

### B) Crear base de datos

```bash
gcloud sql databases create transportes_db --instance=transportes-mysql
```

### C) Obtener IP de conexión

```bash
gcloud sql instances describe transportes-mysql --format="value(connectionName)"
```

**Guarda este valor**, lo necesitarás para `app.yaml`

---

## 5️⃣ CREAR ARCHIVO `app.yaml` PARA APP ENGINE

Crear archivo `app.yaml` en la raíz del proyecto:

```yaml
runtime: php82

env_variables:
  APP_KEY: "base64:TU_APP_KEY_DE_ENV"
  APP_ENV: "production"
  APP_DEBUG: "false"
  APP_URL: "https://transportes-ultrarapidos.uc.r.appspot.com"
  
  DB_CONNECTION: "mysql"
  DB_HOST: "/cloudsql/transportes-ultrarapidos:us-central1:transportes-mysql"
  DB_DATABASE: "transportes_db"
  DB_USERNAME: "root"
  DB_PASSWORD: "TU_PASSWORD_SEGURO_AQUI"
  
  SESSION_DRIVER: "file"
  CACHE_DRIVER: "file"
  QUEUE_CONNECTION: "sync"
  
  APP_TIMEZONE: "America/Guatemala"

handlers:
  - url: /.*
    script: auto

automatic_scaling:
  min_instances: 1
  max_instances: 3
```

---

## 6️⃣ MIGRAR BASE DE DATOS

### A) Conectarse a Cloud SQL desde local

```bash
gcloud sql connect transportes-mysql --user=root
```

### B) Restaurar backup local (si lo tienes)

```bash
# Exportar BD local
mysqldump -u root transportes_db > backup_local.sql

# Importar a Cloud SQL
gcloud sql import sql transportes-mysql gs://tu-bucket/backup_local.sql --database=transportes_db
```

### C) O ejecutar migraciones remotamente

Después del primer deploy:

```bash
gcloud app ssh
php artisan migrate --force
```

---

## 7️⃣ DESPLEGAR A GOOGLE CLOUD

### A) Preparar para deploy

```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### B) Deploy inicial

```bash
gcloud app deploy
```

**⏱️ Esto toma 5-15 minutos la primera vez**

### C) Verificar

```bash
gcloud app browse
```

---

## 8️⃣ POST-DEPLOY: CONFIGURACIÓN INICIAL

### A) SSH a la instancia

```bash
gcloud app ssh
```

### B) Ejecutar migraciones

```bash
cd /workspace
php artisan migrate --force
```

### C) Crear usuario admin

```bash
php artisan tinker
```

Dentro de tinker:
```php
$user = new App\Models\User();
$user->name = 'Administrador Sistema';
$user->email = 'admin@transportes.com';
$user->password = bcrypt('password123');
$user->role = 'admin';
$user->active = true;
$user->save();
exit
```

---

## 9️⃣ CONFIGURAR BACKUP AUTOMÁTICO EN CLOUD

### A) Backup de Cloud SQL automático

```bash
gcloud sql instances patch transportes-mysql \
    --backup-start-time=02:00 \
    --enable-bin-log
```

### B) Configurar cron para backups locales (opcional)

En App Engine, editar `app.yaml`:

```yaml
# Agregar al final
cron:
  - description: "Backup diario de base de datos"
    url: /api/cron/backup
    schedule: every day 02:00
    timezone: America/Guatemala
```

---

## 🔟 ACTUALIZAR PROYECTO (DEPLOY CONTINUO)

Cada vez que hagas cambios:

```bash
# 1. Commit cambios
git add .
git commit -m "Descripción de cambios"
git push origin main

# 2. Deploy a Google Cloud
gcloud app deploy

# 3. Verificar
gcloud app browse
```

---

## 📊 MONITOREO Y LOGS

### Ver logs en tiempo real

```bash
gcloud app logs tail -s default
```

### Ver logs en consola

1. Ve a: https://console.cloud.google.com/logs
2. Selecciona tu proyecto
3. Filtra por "App Engine"

---

## 💰 COSTOS ESTIMADOS (Tier Gratuito)

| Servicio | Tier Gratuito | Costo Estimado |
|----------|--------------|----------------|
| App Engine F1 | 28 hrs/día | $0 - $5/mes |
| Cloud SQL (f1-micro) | - | $7 - $10/mes |
| Storage | 5 GB | $0 - $1/mes |
| **TOTAL** | | **$7 - $16/mes** |

---

## ⚡ COMANDOS ÚTILES

```bash
# Ver estado de la app
gcloud app versions list

# Ver instancias activas
gcloud app instances list

# Detener versión
gcloud app versions stop VERSION

# Ver uso de cuota
gcloud app quota

# Limpiar versiones antiguas
gcloud app versions delete VERSION1 VERSION2
```

---

## 🆘 TROUBLESHOOTING

### Error: "Permission Denied"
```bash
gcloud auth login --update-adc
```

### Error: "Cloud SQL connection failed"
Verifica que el `connectionName` en `app.yaml` sea correcto

### Error: "APP_KEY not set"
Genera nueva key:
```bash
php artisan key:generate --show
```
Copia y pega en `app.yaml` → `APP_KEY`

### App muy lenta
Aumenta el tier en `app.yaml`:
```yaml
automatic_scaling:
  min_instances: 1
  max_instances: 5
```

---

## ✅ CHECKLIST FINAL

- [ ] Git inicializado y código en GitHub/GitLab
- [ ] Proyecto creado en Google Cloud
- [ ] Cloud SQL creado y configurado
- [ ] `app.yaml` configurado correctamente
- [ ] Base de datos migrada
- [ ] Primera versión desplegada
- [ ] Usuario admin creado
- [ ] Backup automático configurado
- [ ] Logs funcionando
- [ ] URL funcionando correctamente

---

## 📞 SOPORTE

- Google Cloud Status: https://status.cloud.google.com
- Documentación: https://cloud.google.com/appengine/docs/php
- Precios: https://cloud.google.com/appengine/pricing

---

**¡Proyecto listo para producción! 🚀**

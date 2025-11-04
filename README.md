# 🚛 Transportes Ultrarrápidos - API

# Proyecto realizado por Erick Ortiz, Carlos Martinez y Andy Aquino

## 📋 ¿Qué hace?

La API maneja:
- **Órdenes de trabajo** - Registro de viajes y asignaciones
- **Camiones y pilotos** - Control de flota y personal
- **Vales de combustible** - Seguimiento de gastos de combustible
- **Ingresos y egresos** - Control de entrada/salida de camiones en predios/bodegas
- **Transportistas** - Gestión de propietarios de camiones

## 🛠️ Tecnologías

- **Laravel 11** - Framework PHP
- **MySQL** - Base de datos
- **Google Cloud App Engine** - Hosting en la nube
- **Laravel Passport** - Autenticación para la app web
- **Tokens simples** - Autenticación para la app móvil

## 🚀 Instalación local

Si quieres correr el proyecto en tu máquina:

```bash
# Clonar el repo
git clone https://github.com/YovaWarrior/Transportes-Ultrarapidos-API.git
cd Transportes-Ultrarapidos-API

# Instalar dependencias
composer install
npm install

# Configurar el archivo .env
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=transportes_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Migrar base de datos
php artisan migrate

# Compilar assets
npm run build

# Correr servidor
php artisan serve
```

## 🌐 Deploy en Google Cloud

El proyecto está configurado para deployarse en Google Cloud App Engine:

```bash
# En Cloud Shell
cd ~/Transportes-Ultrarapidos-API
git pull origin master
gcloud app deploy
```

La API está en: `https://transportes-ultrarapidos-api.uc.r.appspot.com`



## 🔑 Autenticación

Hay dos formas de autenticarse:

1. **App Móvil**: Usa tokens simples base64 (login en `/api/login`)
2. **App Web**: Usa Laravel Passport (OAuth 2.0)

## 💾 Base de datos

La base de datos está en **Cloud SQL** con las siguientes tablas:
- users
- transportistas
- camiones
- pilotos
- ordenes_trabajo
- vales_combustible
- predios
- bodegas
- ingresos_camiones
- egresos_camiones

## 📝 Notas

- Los assets de frontend se compilan con Vite (`npm run build`)
- El proyecto usa App Engine serverless (escala automáticamente)
- La base de datos se conecta vía Unix socket en producción
- Las migraciones se ejecutan automáticamente en cada deploy



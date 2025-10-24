# 📱 API Mobile Documentation - Transportes Ultrarrápidos

**Base URL:** `https://transportes-ultrarapidos-api.uc.r.appspot.com/api`

---

## 🔐 Autenticación (Opcional)

```http
POST /api/login
Content-Type: application/json

{
  "email": "piloto@transportes.com",
  "password": "piloto123"
}

Response:
{
  "success": true,
  "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "user": { ... }
}
```

---

## 🚛 CAMIONES

### 📋 Ver todos los camiones
```http
GET /api/camiones

Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "placa": "P-123ABC",
      "marca": "Freightliner",
      "modelo": "FJ2000",
      "año": 2020,
      "tipo": "plataforma",
      "capacidad": 35.00,
      "estado": "activo",
      "transportista_id": 1,
      "transportista": {
        "id": 1,
        "nombre": "Transportes del Norte"
      }
    }
  ]
}
```

### 🔍 Ver un camión
```http
GET /api/camiones/{id}

Response:
{
  "success": true,
  "data": {
    "id": 1,
    "placa": "P-123ABC",
    "marca": "Freightliner",
    ...
  }
}
```

### ➕ Crear camión
```http
POST /api/camiones
Content-Type: application/json

{
  "transportista_id": 1,
  "placa": "P-456DEF",
  "marca": "Volvo",
  "modelo": "FH16",
  "año": 2023,
  "tipo": "plataforma",
  "capacidad": 40.0,
  "estado": "activo"
}

Response:
{
  "success": true,
  "message": "Camión creado exitosamente",
  "data": { ... }
}
```

### ✏️ Actualizar camión
```http
PUT /api/camiones/{id}
Content-Type: application/json

{
  "estado": "mantenimiento",
  "capacidad": 42.0
}

Response:
{
  "success": true,
  "message": "Camión actualizado exitosamente",
  "data": { ... }
}
```

### ❌ Eliminar camión
```http
DELETE /api/camiones/{id}

Response:
{
  "success": true,
  "message": "Camión eliminado exitosamente"
}
```

---

## 👥 TRANSPORTISTAS

### 📋 Ver todos
```http
GET /api/transportistas
```

### ➕ Crear
```http
POST /api/transportistas
Content-Type: application/json

{
  "nombre": "Transportes Express",
  "nit": "12345678-9",
  "direccion": "Zona 10, Ciudad",
  "telefono": "2345-6789",
  "email": "contacto@express.com",
  "active": true
}
```

### ✏️ Actualizar
```http
PUT /api/transportistas/{id}
Content-Type: application/json

{
  "telefono": "2345-9999"
}
```

### ❌ Eliminar
```http
DELETE /api/transportistas/{id}
```

---

## 👨‍✈️ PILOTOS

### 📋 Ver todos
```http
GET /api/pilotos
```

### ➕ Crear
```http
POST /api/pilotos
Content-Type: application/json

{
  "transportista_id": 1,
  "nombre": "Carlos Méndez",
  "licencia": "A123456",
  "telefono": "5555-1234",
  "dpi": "1234567890101",
  "active": true
}
```

### ✏️ Actualizar
```http
PUT /api/pilotos/{id}
```

### ❌ Eliminar
```http
DELETE /api/pilotos/{id}
```

---

## 📦 ÓRDENES DE TRABAJO

### 📋 Ver todas
```http
GET /api/ordenes
```

### 🔍 Ver una orden
```http
GET /api/ordenes/{id}
```

### ➕ Crear orden
```http
POST /api/ordenes
Content-Type: application/json

{
  "camion_id": 1,
  "piloto_id": 2,
  "predio_id": 3,
  "bodega_id": 4,
  "estado": "pendiente"
}

Response:
{
  "success": true,
  "message": "Orden creada exitosamente",
  "data": {
    "id": 10,
    "numero_orden": "OT-20251023-0001",
    ...
  }
}
```

### ✏️ Actualizar orden
```http
PUT /api/ordenes/{id}
Content-Type: application/json

{
  "estado": "completada"
}
```

### ❌ Eliminar orden
```http
DELETE /api/ordenes/{id}
```

### 📥 Registrar Ingreso a una orden
```http
POST /api/ordenes/{id}/ingreso
Content-Type: application/json

{
  "origen": "Predio Las Flores",
  "tipo_carga": "Maíz",
  "fecha_ingreso": "2025-10-23 10:30:00",
  "observaciones": "Carga en buen estado" (opcional)
}

Response:
{
  "success": true,
  "message": "Ingreso registrado exitosamente",
  "data": {
    "id": 1,
    "orden_trabajo_id": 5,
    "origen": "Predio Las Flores",
    "tipo_carga": "Maíz",
    "fecha_ingreso": "2025-10-23 10:30:00",
    "user_id": null,
    "observaciones": "Carga en buen estado",
    "created_at": "2025-10-23T10:30:00.000000Z",
    "updated_at": "2025-10-23T10:30:00.000000Z"
  }
}
```

**⚠️ Nota:** NO incluir `camion_id`, `predio_id`, `bodega_id`, `peso_bruto`, `tara`, `peso_neto` - estos campos no existen.

### 📤 Registrar Egreso a una orden
```http
POST /api/ordenes/{id}/egreso
Content-Type: application/json

{
  "destino": "Bodega Central",
  "tipo_carga": "Maíz",
  "fecha_egreso": "2025-10-23 15:45:00",
  "kilometraje": 150,
  "observaciones": "Entrega completa" (opcional)
}

Response:
{
  "success": true,
  "message": "Egreso registrado exitosamente",
  "data": {
    "id": 1,
    "orden_trabajo_id": 5,
    "destino": "Bodega Central",
    "tipo_carga": "Maíz",
    "fecha_egreso": "2025-10-23 15:45:00",
    "kilometraje": 150,
    "user_id": null,
    "observaciones": "Entrega completa",
    "created_at": "2025-10-23T15:45:00.000000Z",
    "updated_at": "2025-10-23T15:45:00.000000Z"
  }
}
```

**⚠️ Nota:** `kilometraje` es opcional. NO incluir `camion_id`, `predio_id`, `bodega_id`, `peso_bruto`, `tara`, `peso_neto`.

---

## ⛽ VALES DE COMBUSTIBLE

### 📋 Ver todos
```http
GET /api/vales-combustible

Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "orden_trabajo_id": 5,
      "cantidad_galones": 20.00,
      "precio_galon": 6.00,
      "total": 120.00,
      "fecha_vale": "2025-10-23 18:25:00",
      "observaciones": null,
      "user_id": null,
      "orden_trabajo": {
        "id": 5,
        "numero_orden": "ORD-2025-000005",
        "camion": {...},
        "piloto": {...}
      }
    }
  ]
}
```

### 🔍 Ver un vale
```http
GET /api/vales-combustible/{id}

Response:
{
  "success": true,
  "data": {
    "id": 1,
    "orden_trabajo_id": 5,
    "cantidad_galones": 20.00,
    "precio_galon": 6.00,
    "total": 120.00,
    "fecha_vale": "2025-10-23 18:25:00",
    ...
  }
}
```

### ➕ Crear vale (SIN AUTENTICACIÓN)
```http
POST /api/vales-combustible
Content-Type: application/json

{
  "orden_trabajo_id": 5,
  "cantidad_galones": 20.0,
  "precio_galon": 6.00,
  "total": 120.00,
  "fecha_vale": "2025-10-23 18:25:00",
  "observaciones": "Carga completa" (opcional)
}

Response:
{
  "success": true,
  "message": "Vale de combustible creado exitosamente",
  "data": {
    "id": 1,
    "orden_trabajo_id": 5,
    "cantidad_galones": 20.00,
    "precio_galon": 6.00,
    "total": 120.00,
    "fecha_vale": "2025-10-23 18:25:00",
    "user_id": null,
    "observaciones": "Carga completa",
    "created_at": "2025-10-23T18:25:00.000000Z",
    "updated_at": "2025-10-23T18:25:00.000000Z"
  }
}
```

**⚠️ IMPORTANTE:** 
- Usar `"cantidad_galones"` NO `"galones"`
- El campo `total` se calcula automáticamente si no lo envías
- `user_id` es automático (null si no hay login)
- NO incluir `camion_id` ni `numero_factura`

### ✏️ Actualizar vale
```http
PUT /api/vales-combustible/{id}
Content-Type: application/json

{
  "cantidad_galones": 25.0,
  "precio_galon": 6.50,
  "fecha_vale": "2025-10-23 19:00:00",
  "observaciones": "Vale actualizado"
}

Response:
{
  "success": true,
  "message": "Vale de combustible actualizado exitosamente",
  "data": {...}
}
```

### ❌ Eliminar vale
```http
DELETE /api/vales-combustible/{id}

Response:
{
  "success": true,
  "message": "Vale de combustible eliminado exitosamente"
}
```

---

## 🏢 PREDIOS

### 📋 Ver todos
```http
GET /api/predios
```

### ➕ Crear
```http
POST /api/predios
Content-Type: application/json

{
  "nombre": "Predio Los Pinos",
  "ubicacion": "Km 45, Ruta al Pacífico",
  "contacto": "Juan Pérez",
  "telefono": "5555-4321",
  "active": true
}
```

### ✏️ Actualizar
```http
PUT /api/predios/{id}
```

### ❌ Eliminar
```http
DELETE /api/predios/{id}
```

---

## 🏭 BODEGAS

### 📋 Ver todas
```http
GET /api/bodegas
```

### ➕ Crear
```http
POST /api/bodegas
Content-Type: application/json

{
  "predio_id": 1,
  "nombre": "Bodega A",
  "capacidad": 10000.00,
  "ubicacion": "Zona de almacenamiento 1",
  "active": true
}
```

### ✏️ Actualizar
```http
PUT /api/bodegas/{id}
```

### ❌ Eliminar
```http
DELETE /api/bodegas/{id}
```

---

## 📱 Ejemplos para Android (Kotlin + Retrofit)

### Configurar Retrofit
```kotlin
// ApiService.kt
interface ApiService {
    @GET("camiones")
    suspend fun getCamiones(): Response<CamionesResponse>
    
    @POST("camiones")
    suspend fun createCamion(@Body camion: CamionRequest): Response<CamionResponse>
    
    @PUT("camiones/{id}")
    suspend fun updateCamion(@Path("id") id: Int, @Body data: CamionRequest): Response<CamionResponse>
    
    @DELETE("camiones/{id}")
    suspend fun deleteCamion(@Path("id") id: Int): Response<MessageResponse>
}

// Retrofit Instance
object RetrofitClient {
    private const val BASE_URL = "https://transportes-ultrarapidos-api.uc.r.appspot.com/api/"
    
    val apiService: ApiService by lazy {
        Retrofit.Builder()
            .baseUrl(BASE_URL)
            .addConverterFactory(GsonConverterFactory.create())
            .build()
            .create(ApiService::class.java)
    }
}
```

### Crear Camión
```kotlin
val camion = CamionRequest(
    transportista_id = 1,
    placa = "P-789XYZ",
    marca = "Mercedes",
    modelo = "Actros",
    año = 2024,
    tipo = "plataforma",
    capacidad = 45.0,
    estado = "activo"
)

viewModelScope.launch {
    val response = RetrofitClient.apiService.createCamion(camion)
    if (response.isSuccessful) {
        println("Camión creado: ${response.body()?.data}")
    }
}
```

### Actualizar Estado de Camión
```kotlin
val updateData = CamionUpdateRequest(estado = "mantenimiento")

viewModelScope.launch {
    val response = RetrofitClient.apiService.updateCamion(1, updateData)
    if (response.isSuccessful) {
        println("Estado actualizado")
    }
}
```

### Eliminar Camión
```kotlin
viewModelScope.launch {
    val response = RetrofitClient.apiService.deleteCamion(1)
    if (response.isSuccessful) {
        println("Camión eliminado")
    }
}
```

---

## ⚠️ Manejo de Errores

Todas las respuestas de error siguen este formato:

```json
{
  "success": false,
  "message": "Descripción del error",
  "error": "Detalles técnicos"
}
```

**Códigos HTTP:**
- `200` - OK
- `201` - Creado exitosamente
- `404` - No encontrado
- `500` - Error del servidor

---

## 🔑 Tipos de Estado para Camiones

- `activo` - Camión disponible
- `mantenimiento` - En reparación
- `fuera_servicio` - No disponible

## 📋 Tipos de Camión

- `plataforma`
- `furgón`
- `refrigerado`
- `tanque`
- `carga_general`

## 📊 Estados de Orden

- `pendiente`
- `en_proceso`
- `completada`
- `cancelada`

---

## 🧪 Probar la API

**URL de prueba:**
```
GET https://transportes-ultrarapidos-api.uc.r.appspot.com/api/test
```

Respuesta:
```json
{
  "message": "API funcionando correctamente",
  "timestamp": "2025-10-23T17:00:00.000000Z",
  "laravel_version": "11.x"
}
```

---

**📝 Nota:** Esta API está configurada sin autenticación obligatoria. Si necesitas agregar seguridad con JWT, avísame.

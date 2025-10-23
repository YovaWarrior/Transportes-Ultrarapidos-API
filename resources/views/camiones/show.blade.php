@extends('layouts.app')

@section('title', 'Detalle del Camión')

@section('content')
<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('camiones.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a la lista
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Info Card -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Header con gradiente -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-white">{{ $camion->placa }}</h1>
                                <p class="mt-2 text-lg font-medium text-white">{{ $camion->marca }} {{ $camion->modelo }}</p>
                            </div>
                            <div class="text-right">
                                @if($camion->estado === 'activo')
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-500 text-white shadow-lg">
                                        <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                        ACTIVO
                                    </span>
                                @elseif($camion->estado === 'mantenimiento')
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-500 text-gray-900 shadow-lg">
                                        <span class="w-2 h-2 bg-gray-900 rounded-full mr-2"></span>
                                        MANTENIMIENTO
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-500 text-white shadow-lg">
                                        <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                                        FUERA SERVICIO
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Detalles -->
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Información del Vehículo</h2>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Placa</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $camion->placa }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Marca</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $camion->marca }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Modelo</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $camion->modelo }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Año</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $camion->año }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tipo</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        {{ ucfirst($camion->tipo) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Capacidad</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $camion->capacidad }} ton</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Estado</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $camion->estado)) }}</dd>
                            </div>
                        </dl>

                        <!-- Transportista Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Transportista Asignado</h2>
                            @if($camion->transportista)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-base font-medium text-gray-900">{{ $camion->transportista->nombre }}</h3>
                                            <div class="mt-3 space-y-2">
                                                <p class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                    </svg>
                                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ ucfirst($camion->transportista->tipo) }}
                                                    </span>
                                                </p>
                                                @if($camion->transportista->nit)
                                                    <p class="text-sm text-gray-600 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                        NIT: {{ $camion->transportista->nit }}
                                                    </p>
                                                @endif
                                                <p class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                    {{ $camion->transportista->telefono }}
                                                </p>
                                                @if($camion->transportista->email)
                                                    <p class="text-sm text-gray-600 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                        </svg>
                                                        {{ $camion->transportista->email }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No hay transportista asignado</p>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 pt-6 border-t border-gray-200 flex space-x-3">
                            <a href="{{ route('camiones.edit', $camion->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>
                            <form action="{{ route('camiones.destroy', $camion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este camión?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <!-- QR Code Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Código QR</h3>
                    <div class="flex justify-center p-4 bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <div class="w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Escanea para acceso rápido</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Órdenes Recientes</h3>
                    @if($camion->ordenesTrabajos && $camion->ordenesTrabajos->count() > 0)
                        <div class="space-y-3">
                            @foreach($camion->ordenesTrabajos->take(5) as $orden)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $orden->numero_orden }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $orden->created_at->format('d/m/Y') }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($orden->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                        @elseif($orden->estado === 'en_proceso') bg-blue-100 text-blue-800
                                        @elseif($orden->estado === 'finalizada') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($orden->estado) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No hay órdenes registradas</p>
                    @endif
                </div>

                <!-- Metadata -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Sistema</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-xs font-medium text-gray-500">Creado</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $camion->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500">Última actualización</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $camion->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500">ID</dt>
                            <dd class="mt-1 text-sm text-gray-900">#{{ $camion->id }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Flota de Camiones')

@section('content')
<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <!-- Header con gradiente -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-800 to-blue-600 rounded-2xl mb-6 shadow-lg">
            <div class="px-6 py-8 sm:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Flota de Camiones</h1>
                        <p class="mt-2 text-sm text-blue-100">Gestión y control de vehículos</p>
                    </div>
                    <div class="hidden sm:block">
                        <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/>
                        </svg>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-3 gap-4 mt-6">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
                        <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ $totalCamiones }}</div>
                        <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Total</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
                        <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ $activos }}</div>
                        <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Activos</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
                        <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ $mantenimiento }}</div>
                        <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Mantenimiento</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <form method="GET" action="{{ route('camiones.index') }}" class="space-y-4 sm:space-y-0 sm:flex sm:items-end sm:space-x-4">
                    <!-- Búsqueda -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500" 
                                placeholder="Buscar por placa, marca, modelo...">
                        </div>
                    </div>

                    <!-- Filtro Estado -->
                    <div class="w-full sm:w-48">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select name="estado" id="estado" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            <option value="todos" {{ request('estado') === 'todos' ? 'selected' : '' }}>Todos</option>
                            <option value="activo" {{ request('estado') === 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="mantenimiento" {{ request('estado') === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                            <option value="fuera_servicio" {{ request('estado') === 'fuera_servicio' ? 'selected' : '' }}>Fuera de Servicio</option>
                        </select>
                    </div>

                    <!-- Filtro Tipo -->
                    <div class="w-full sm:w-48">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                        <select name="tipo" id="tipo" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            <option value="todos" {{ request('tipo') === 'todos' ? 'selected' : '' }}>Todos</option>
                            <option value="plataforma" {{ request('tipo') === 'plataforma' ? 'selected' : '' }}>Plataforma</option>
                            <option value="furgón" {{ request('tipo') === 'furgón' ? 'selected' : '' }}>Furgón</option>
                            <option value="refrigerado" {{ request('tipo') === 'refrigerado' ? 'selected' : '' }}>Refrigerado</option>
                            <option value="tanque" {{ request('tipo') === 'tanque' ? 'selected' : '' }}>Tanque</option>
                            <option value="carga_general" {{ request('tipo') === 'carga_general' ? 'selected' : '' }}>Carga General</option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex space-x-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filtrar
                        </button>
                        @if(request()->hasAny(['search', 'estado', 'tipo']))
                            <a href="{{ route('camiones.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Botón Agregar (solo Admin y Operativo) -->
        @if(auth()->user()->canCreate())
            <div class="mb-4">
                <a href="{{ route('camiones.create') }}" class="inline-flex items-center px-4 py-2 border border-primary-300 rounded-lg shadow-sm text-sm font-medium text-primary-700 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Agregar Camión
                </a>
            </div>
        @endif

        <!-- Camiones List -->
        <div class="space-y-4">
            @forelse($camiones as $camion)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer" onclick="window.location='{{ route('camiones.show', $camion->id) }}'">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="flex items-start sm:items-center space-x-3 sm:space-x-4 flex-1 min-w-0">
                                <!-- Placa Badge -->
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-10 sm:w-24 sm:h-12 bg-primary-100 border border-primary-300 rounded-lg flex items-center justify-center">
                                        <span class="text-primary-800 font-bold text-xs tracking-wider">{{ $camion->placa }}</span>
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 truncate">
                                        {{ $camion->marca }} {{ $camion->modelo }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                        Año {{ $camion->año }} • Cap. {{ $camion->capacidad }} ton
                                    </p>
                                    <p class="text-xs sm:text-sm text-gray-500 truncate">
                                        {{ $camion->transportista->nombre ?? 'Sin transportista' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Estado Badge -->
                            <div class="flex-shrink-0 flex items-center space-x-2">
                                @if($camion->estado === 'activo')
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-semibold bg-success-100 text-success-700">
                                        <span class="w-2 h-2 bg-success-500 rounded-full mr-1.5 sm:mr-2"></span>
                                        ACTIVO
                                    </span>
                                @elseif($camion->estado === 'mantenimiento')
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-semibold bg-warning-100 text-warning-700">
                                        <span class="w-2 h-2 bg-warning-500 rounded-full mr-1.5 sm:mr-2"></span>
                                        <span class="hidden sm:inline">MANTENIMIENTO</span>
                                        <span class="sm:hidden">MANTEN.</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-semibold bg-error-100 text-error-700">
                                        <span class="w-2 h-2 bg-error-500 rounded-full mr-1.5 sm:mr-2"></span>
                                        <span class="hidden sm:inline">FUERA SERVICIO</span>
                                        <span class="sm:hidden">F. SERVICIO</span>
                                    </span>
                                @endif
                                <!-- Chevron -->
                                <svg class="w-5 h-5 text-gray-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No hay camiones</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(auth()->user()->canCreate())
                            Comienza agregando un nuevo camión a la flota.
                        @else
                            No hay vehículos registrados en el sistema.
                        @endif
                    </p>
                    @if(auth()->user()->canCreate())
                        <div class="mt-6">
                            <a href="{{ route('camiones.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Agregar Camión
                            </a>
                        </div>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($camiones->hasPages())
            <div class="mt-6">
                {{ $camiones->links() }}
            </div>
        @endif

        <!-- Contador -->
        <div class="mt-4 text-sm text-gray-600 text-center">
            Mostrando {{ $camiones->firstItem() ?? 0 }} a {{ $camiones->lastItem() ?? 0 }} de {{ $camiones->total() }} vehículos
        </div>
    </div>
</div>
@endsection

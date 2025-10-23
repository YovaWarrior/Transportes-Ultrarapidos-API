@extends('layouts.app')

@section('title', 'Flota de Camiones')

@section('content')
<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <!-- Header con gradiente -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl sm:rounded-2xl mb-4 sm:mb-6 shadow-xl">
            <div class="px-4 py-6 sm:px-8 sm:py-8">
                <div class="flex items-center justify-between mb-4 sm:mb-0">
                    <div>
                        <h1 class="text-xl sm:text-3xl font-bold text-white">Flota de Camiones</h1>
                        <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-blue-100">Gestión y control de vehículos</p>
                    </div>
                    <div class="hidden sm:block">
                        <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/>
                        </svg>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-3 gap-2 sm:gap-4 mt-4 sm:mt-6">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3 sm:p-4 text-center border border-white/30 hover:bg-white/30 transition">
                        <div class="text-2xl sm:text-4xl font-black text-white leading-none drop-shadow-lg">{{ $totalCamiones }}</div>
                        <div class="text-xs sm:text-sm font-bold tracking-wide uppercase text-white mt-1.5 sm:mt-2 drop-shadow">TOTAL</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3 sm:p-4 text-center border border-white/30 hover:bg-white/30 transition">
                        <div class="text-2xl sm:text-4xl font-black text-white leading-none drop-shadow-lg">{{ $activos }}</div>
                        <div class="text-xs sm:text-sm font-bold tracking-wide uppercase text-white mt-1.5 sm:mt-2 drop-shadow">ACTIVOS</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3 sm:p-4 text-center border border-white/30 hover:bg-white/30 transition">
                        <div class="text-2xl sm:text-4xl font-black text-white leading-none drop-shadow-lg">{{ $mantenimiento }}</div>
                        <div class="text-xs sm:text-sm font-bold tracking-wide uppercase text-white mt-1.5 sm:mt-2 drop-shadow">MANTENIMIENTO</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="mb-4 sm:mb-6">
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
                <form method="GET" action="{{ route('camiones.index') }}" class="space-y-3 sm:space-y-4">
                    <!-- Búsqueda -->
                    <div>
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                class="block w-full pl-10 pr-3 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base" 
                                placeholder="Buscar por placa, marca, modelo...">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Filtro Estado -->
                        <div>
                            <label for="estado" class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                            <select name="estado" id="estado" class="block w-full py-2.5 sm:py-3 px-3 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                                <option value="todos" {{ request('estado') === 'todos' ? 'selected' : '' }}>Todos</option>
                                <option value="activo" {{ request('estado') === 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="mantenimiento" {{ request('estado') === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="fuera_servicio" {{ request('estado') === 'fuera_servicio' ? 'selected' : '' }}>Fuera de Servicio</option>
                            </select>
                        </div>

                        <!-- Filtro Tipo -->
                        <div>
                            <label for="tipo" class="block text-sm font-semibold text-gray-700 mb-2">Tipo</label>
                            <select name="tipo" id="tipo" class="block w-full py-2.5 sm:py-3 px-3 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                                <option value="todos" {{ request('tipo') === 'todos' ? 'selected' : '' }}>Todos</option>
                                <option value="plataforma" {{ request('tipo') === 'plataforma' ? 'selected' : '' }}>Plataforma</option>
                                <option value="furgón" {{ request('tipo') === 'furgón' ? 'selected' : '' }}>Furgón</option>
                                <option value="refrigerado" {{ request('tipo') === 'refrigerado' ? 'selected' : '' }}>Refrigerado</option>
                                <option value="tanque" {{ request('tipo') === 'tanque' ? 'selected' : '' }}>Tanque</option>
                                <option value="carga_general" {{ request('tipo') === 'carga_general' ? 'selected' : '' }}>Carga General</option>
                            </select>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 sm:py-3 border border-transparent rounded-lg shadow-sm text-sm sm:text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filtrar
                        </button>
                        @if(request()->hasAny(['search', 'estado', 'tipo']))
                            <a href="{{ route('camiones.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg shadow-sm text-sm sm:text-base font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Botón Agregar (solo Admin y Operativo) -->
        @if(auth()->user()->canCreate())
            <div class="mb-4 sm:mb-6">
                <a href="{{ route('camiones.create') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-3 border-2 border-blue-600 rounded-lg shadow-sm text-sm sm:text-base font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Agregar Camión
                </a>
            </div>
        @endif

        <!-- Camiones List -->
        <div class="space-y-3 sm:space-y-4">
            @forelse($camiones as $camion)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer border border-gray-100" onclick="window.location='{{ route('camiones.show', $camion->id) }}'">
                    <div class="p-4 sm:p-5">
                        <!-- Header: Placa + Estado -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-sm">
                                <svg class="w-4 h-4 text-white mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-white font-black text-sm tracking-wider">{{ $camion->placa }}</span>
                            </div>

                            @if($camion->estado === 'activo')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                                    ACTIVO
                                </span>
                            @elseif($camion->estado === 'mantenimiento')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>
                                    <span class="hidden xs:inline">MANTEN.</span>
                                    <span class="xs:hidden">MANT.</span>
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                    <span class="hidden xs:inline">F. SERVICIO</span>
                                    <span class="xs:hidden">FUERA</span>
                                </span>
                            @endif
                        </div>

                        <!-- Body: Info del Camión -->
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">
                                {{ $camion->marca }} {{ $camion->modelo }}
                            </h3>
                            <div class="grid grid-cols-2 gap-2 text-xs sm:text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">{{ $camion->año }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <span class="font-medium">{{ $camion->capacidad }} ton</span>
                                </div>
                                <div class="col-span-2 flex items-center truncate">
                                    <svg class="w-4 h-4 text-gray-400 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span class="truncate">{{ $camion->transportista->nombre ?? 'Sin transportista' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer: Ver más -->
                        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-end">
                            <span class="text-xs sm:text-sm font-semibold text-blue-600 flex items-center">
                                Ver detalles
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
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

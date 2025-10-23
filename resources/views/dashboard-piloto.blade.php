@extends('layouts.app')

@section('title', 'Dashboard Piloto')

@section('content')
<div class="py-4 sm:py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        
        <!-- Welcome Header -->
        <div class="mb-6 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-6 sm:p-8 text-white shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold">¡Bienvenido {{ auth()->user()->name }}! 🚛</h1>
                    <p class="mt-2 text-sm sm:text-base text-blue-100">Tu panel de control personal</p>
                    <div class="mt-3 sm:mt-4 inline-flex items-center px-3 py-1.5 bg-white/20 rounded-lg text-xs sm:text-sm backdrop-blur-sm">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        {{ now()->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        @if(!$piloto)
        <!-- Mensaje si no se encuentra el piloto -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        No se encontró tu perfil de piloto. Por favor contacta al administrador.
                    </p>
                </div>
            </div>
        </div>
        @else

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-6 lg:grid-cols-4">
            <!-- Órdenes Completadas -->
            <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-green-100 uppercase">Completadas</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-4xl font-black">{{ $ordenesCompletadas }}</p>
                    </div>
                    <div class="p-2 sm:p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- En Proceso -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-blue-100 uppercase">En Proceso</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-4xl font-black">{{ $ordenesProceso }}</p>
                    </div>
                    <div class="p-2 sm:p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pendientes -->
            <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-amber-100 uppercase">Pendientes</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-4xl font-black">{{ $ordenesPendientes }}</p>
                    </div>
                    <div class="p-2 sm:p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- KM Recorridos -->
            <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-purple-100 uppercase">KM Total</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-4xl font-black">{{ number_format($kmRecorridos, 0) }}</p>
                    </div>
                    <div class="p-2 sm:p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mis Órdenes Recientes -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Mis Órdenes Recientes</h3>
                    <a href="{{ route('ordenes.index') }}" class="text-xs sm:text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Ver todas →
                    </a>
                </div>
            </div>

            <div class="divide-y divide-gray-200">
                @forelse($misOrdenes as $orden)
                    <div class="p-3 sm:p-4 hover:bg-gray-50 transition cursor-pointer" onclick="window.location='{{ route('ordenes.show', $orden->id) }}'">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 sm:space-x-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-blue-100 text-blue-700">
                                        {{ $orden->numero_orden }}
                                    </span>
                                    @if($orden->estado === 'pendiente')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            Pendiente
                                        </span>
                                    @elseif($orden->estado === 'en_proceso')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                            En Proceso
                                        </span>
                                    @elseif($orden->estado === 'completada')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Completada
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                            Cancelada
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-1 text-xs sm:text-sm text-gray-600 truncate">
                                    <span class="font-medium">Camión:</span> {{ $orden->camion->placa ?? 'N/A' }} 
                                    @if($orden->predio)
                                        • <span class="font-medium">Predio:</span> {{ $orden->predio->nombre }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center justify-between sm:justify-end sm:space-x-4">
                                <span class="text-xs text-gray-500">{{ $orden->created_at->format('d/m/Y') }}</span>
                                <svg class="hidden sm:block w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 sm:p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="mt-4 text-sm text-gray-500">No tienes órdenes de trabajo asignadas</p>
                    </div>
                @endforelse
            </div>
        </div>

        @endif
    </div>
</div>
@endsection

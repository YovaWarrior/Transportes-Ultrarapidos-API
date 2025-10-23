@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <!-- Header Espectacular -->
        <div class="relative mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-64 h-64 bg-white rounded-full opacity-5"></div>
            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-48 h-48 bg-white rounded-full opacity-5"></div>
            <div class="relative px-8 py-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-black text-white drop-shadow-lg">¡Bienvenido al Dashboard! 🚛</h1>
                        <p class="mt-3 text-lg text-white/90 drop-shadow">Gestiona tu flota de transportes en tiempo real</p>
                        <div class="flex items-center mt-4 space-x-2">
                            <div class="flex items-center px-3 py-1 text-sm font-semibold text-white bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ now()->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <svg class="w-32 h-32 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Mejorados -->
        <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Camiones -->
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white rounded-full opacity-10"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-blue-100 uppercase tracking-wide">Total Camiones</p>
                            <p class="mt-2 text-5xl font-black text-white drop-shadow-lg">{{ $totalCamiones }}</p>
                            <a href="{{ route('camiones.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-white/90 hover:text-white">
                                Ver todos
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Camiones Activos -->
            <div class="relative overflow-hidden bg-gradient-to-br from-green-500 to-emerald-700 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white rounded-full opacity-10"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-green-100 uppercase tracking-wide">Activos</p>
                            <p class="mt-2 text-5xl font-black text-white drop-shadow-lg">{{ $activos }}</p>
                            <p class="mt-2 text-sm font-medium text-white/80">
                                <span class="inline-flex items-center px-2 py-1 bg-white/20 rounded-full">
                                    {{ $totalCamiones > 0 ? round(($activos / $totalCamiones) * 100, 1) : 0 }}% del total
                                </span>
                            </p>
                        </div>
                        <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mantenimiento -->
            <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white rounded-full opacity-10"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-amber-100 uppercase tracking-wide">Mantenimiento</p>
                            <p class="mt-2 text-5xl font-black text-white drop-shadow-lg">{{ $mantenimiento }}</p>
                            <p class="mt-2 text-sm font-medium text-white/80">En servicio técnico</p>
                        </div>
                        <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fuera de Servicio -->
            <div class="relative overflow-hidden bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white rounded-full opacity-10"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-red-100 uppercase tracking-wide">Fuera Servicio</p>
                            <p class="mt-2 text-5xl font-black text-white drop-shadow-lg">{{ $fueraServicio }}</p>
                            <p class="mt-2 text-sm font-medium text-white/80">No disponibles</p>
                        </div>
                        <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Estado de Camiones Chart -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                    <div class="flex items-center">
                        <div class="p-2 bg-emerald-500 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Distribución por Estado</h3>
                            <p class="text-sm text-gray-600">Estado actual de la flota</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <canvas id="estadoChart" width="400" height="300"></canvas>
                </div>
            </div>

            <!-- Tipo de Camiones Chart -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-500 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Distribución por Tipo</h3>
                            <p class="text-sm text-gray-600">Tipos de vehículos registrados</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <canvas id="tipoChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="mt-8 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="px-6 py-5 bg-gradient-to-r from-sky-50 to-cyan-50 border-b border-sky-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-sky-500 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Últimas Órdenes de Trabajo</h3>
                            <p class="text-sm text-gray-600">Órdenes más recientes del sistema</p>
                        </div>
                    </div>
                    <a href="{{ route('ordenes.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-sky-700 bg-white rounded-lg border border-sky-200 hover:bg-sky-50 transition-colors">
                        Ver todas
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if($ultimasOrdenes->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Número</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Camión</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Estado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($ultimasOrdenes as $orden)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
                                                <span class="text-sm font-bold text-sky-600">#{{ substr($orden->numero_orden, -3) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-semibold text-gray-900">{{ $orden->numero_orden }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $orden->camion->placa ?? 'N/A' }}</p>
                                                <p class="text-xs text-gray-500">{{ $orden->camion->marca ?? '' }} {{ $orden->camion->modelo ?? '' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full
                                            @if($orden->estado === 'pendiente' || $orden->estado === 'abierta') bg-amber-100 text-amber-800 border border-amber-200
                                            @elseif($orden->estado === 'en_proceso') bg-sky-100 text-sky-800 border border-sky-200
                                            @elseif($orden->estado === 'finalizada' || $orden->estado === 'cerrada') bg-emerald-100 text-emerald-800 border border-emerald-200
                                            @else bg-red-100 text-red-800 border border-red-200
                                            @endif">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                                @if($orden->estado === 'pendiente' || $orden->estado === 'abierta') bg-amber-500
                                                @elseif($orden->estado === 'en_proceso') bg-sky-500
                                                @elseif($orden->estado === 'finalizada' || $orden->estado === 'cerrada') bg-emerald-500
                                                @else bg-red-500
                                                @endif">
                                            </span>
                                            {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $orden->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-16 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gray-100 rounded-full">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-900">No hay órdenes registradas</p>
                        <p class="mt-1 text-sm text-gray-500">Crea tu primera orden de trabajo para comenzar</p>
                        <a href="{{ route('ordenes.create') }}" class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-sky-600 rounded-lg hover:bg-sky-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Nueva Orden
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Configuración global de Chart.js
    Chart.defaults.font.family = "'Inter', 'system-ui', 'sans-serif'";
    
    // Estado Chart (Pie mejorado)
    const estadoCtx = document.getElementById('estadoChart').getContext('2d');
    new Chart(estadoCtx, {
        type: 'doughnut',
        data: {
            labels: ['Activos', 'Mantenimiento', 'Fuera de Servicio'],
            datasets: [{
                data: [{{ $activos }}, {{ $mantenimiento }}, {{ $fueraServicio }}],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.9)',   // Verde brillante
                    'rgba(245, 158, 11, 0.9)',   // Ámbar brillante
                    'rgba(239, 68, 68, 0.9)'     // Rojo brillante
                ],
                borderColor: [
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(239, 68, 68, 1)'
                ],
                borderWidth: 3,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 13,
                            weight: '600'
                        },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return ` ${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Tipo Chart (Barras mejorado con gradiente)
    const tipoCtx = document.getElementById('tipoChart').getContext('2d');
    const gradient = tipoCtx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.9)');
    gradient.addColorStop(1, 'rgba(29, 78, 216, 0.9)');
    
    new Chart(tipoCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($tipoLabels) !!},
            datasets: [{
                label: 'Cantidad',
                data: {!! json_encode($tipoData) !!},
                backgroundColor: gradient,
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return ` Cantidad: ${context.parsed.y} camiones`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        color: '#6B7280'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        color: '#6B7280'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection

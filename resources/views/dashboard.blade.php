@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-600">Visión general del sistema de transportes</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Camiones -->
            <div class="overflow-hidden bg-white rounded-lg shadow">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 rounded-md bg-primary-500 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 w-0 ml-5">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Camiones</dt>
                                <dd class="text-3xl font-semibold text-gray-900">{{ $totalCamiones }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-3 bg-gray-50">
                    <div class="text-sm">
                        <a href="{{ route('camiones.index') }}" class="font-medium text-primary-600 hover:text-primary-500">Ver todos</a>
                    </div>
                </div>
            </div>

            <!-- Camiones Activos -->
            <div class="overflow-hidden bg-white rounded-lg shadow">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 rounded-md bg-success-500 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 w-0 ml-5">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Activos</dt>
                                <dd class="text-3xl font-semibold text-gray-900">{{ $activos }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-3 bg-gray-50">
                    <div class="text-sm">
                        <span class="text-sm text-gray-500">{{ $totalCamiones > 0 ? round(($activos / $totalCamiones) * 100, 1) : 0 }}% del total</span>
                    </div>
                </div>
            </div>

            <!-- Mantenimiento -->
            <div class="overflow-hidden bg-white rounded-lg shadow">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 rounded-md bg-warning-500 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 w-0 ml-5">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Mantenimiento</dt>
                                <dd class="text-3xl font-semibold text-gray-900">{{ $mantenimiento }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-3 bg-gray-50">
                    <div class="text-sm">
                        <span class="text-sm text-gray-500">En servicio técnico</span>
                    </div>
                </div>
            </div>

            <!-- Fuera de Servicio -->
            <div class="overflow-hidden bg-white rounded-lg shadow">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 rounded-md bg-error-500 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 w-0 ml-5">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Fuera Servicio</dt>
                                <dd class="text-3xl font-semibold text-gray-900">{{ $fueraServicio }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-3 bg-gray-50">
                    <div class="text-sm">
                        <span class="text-sm text-gray-500">No disponibles</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 gap-5 mt-6 lg:grid-cols-2">
            <!-- Estado de Camiones Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Distribución por Estado</h3>
                </div>
                <div class="p-6">
                    <canvas id="estadoChart" width="400" height="300"></canvas>
                </div>
            </div>

            <!-- Tipo de Camiones Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Distribución por Tipo</h3>
                </div>
                <div class="p-6">
                    <canvas id="tipoChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="mt-6 bg-white rounded-lg shadow">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Últimas Órdenes de Trabajo</h3>
            </div>
            <div class="overflow-hidden">
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
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $orden->numero_orden }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $orden->camion->placa ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full 
                                            @if($orden->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                            @elseif($orden->estado === 'en_proceso') bg-blue-100 text-blue-800
                                            @elseif($orden->estado === 'finalizada') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $orden->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm text-gray-500">No hay órdenes registradas</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Estado Chart
    const estadoCtx = document.getElementById('estadoChart').getContext('2d');
    new Chart(estadoCtx, {
        type: 'pie',
        data: {
            labels: ['Activos', 'Mantenimiento', 'Fuera de Servicio'],
            datasets: [{
                data: [{{ $activos }}, {{ $mantenimiento }}, {{ $fueraServicio }}],
                backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Tipo Chart
    const tipoCtx = document.getElementById('tipoChart').getContext('2d');
    new Chart(tipoCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($tipoLabels) !!},
            datasets: [{
                label: 'Cantidad',
                data: {!! json_encode($tipoData) !!},
                backgroundColor: '#1E40AF',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection

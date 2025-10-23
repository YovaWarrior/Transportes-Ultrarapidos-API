@extends('layouts.app')

@section('title', 'Combustible')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header con gradiente -->
    <div class="relative overflow-hidden bg-gradient-to-r from-orange-600 to-red-600 rounded-2xl mb-6 shadow-lg">
      <div class="px-6 py-8 sm:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Vales de Combustible</h1>
            <p class="mt-2 text-sm text-orange-100">Control de consumo por orden y camión</p>
          </div>
          <div class="hidden sm:block">
            <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/>
            </svg>
          </div>
        </div>

        <!-- Stats Cards dentro del header -->
        <div class="grid grid-cols-2 gap-4 mt-6">
          <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
            <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ number_format($totalGalones, 2) }}</div>
            <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Total Galones</div>
          </div>
          <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
            <div class="text-3xl font-bold text-white leading-none drop-shadow">Q {{ number_format($totalMonto, 2) }}</div>
            <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Total Monto</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón Registrar (Solo Admin y Operativo) -->
    @if(auth()->user()->canCreate())
    <div class="mb-4">
      <a href="{{ route('combustible.create') }}" class="inline-flex items-center px-4 py-2 border border-orange-300 rounded-lg shadow-sm text-sm font-medium text-orange-700 bg-white hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Registrar Vale
      </a>
    </div>
    @endif

    <!-- Filtros -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="space-y-4 sm:space-y-0 sm:flex sm:items-end sm:space-x-4">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Placa, marca, modelo..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
          </div>
        </div>
        <div class="w-full sm:w-48">
          <label class="block text-sm font-medium text-gray-700 mb-1">Desde</label>
          <input type="date" name="desde" value="{{ request('desde') }}" class="block w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
        </div>
        <div class="w-full sm:w-48">
          <label class="block text-sm font-medium text-gray-700 mb-1">Hasta</label>
          <input type="date" name="hasta" value="{{ request('hasta') }}" class="block w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
        </div>
        <div>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Filtrar
          </button>
        </div>
      </form>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Camión</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Galones</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Precio/gal</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($vales as $vale)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">{{ $vale->fecha_vale?->format('d/m/Y') }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">#{{ $vale->ordenTrabajo->numero_orden ?? $vale->orden_trabajo_id }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $vale->ordenTrabajo->camion->placa ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-sm text-gray-900 text-right">{{ number_format($vale->cantidad_galones, 2) }}</td>
                <td class="px-6 py-4 text-sm text-gray-900 text-right">Q {{ number_format($vale->precio_galon, 2) }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-gray-900 text-right">Q {{ number_format($vale->total, 2) }}</td>
                <td class="px-6 py-4 text-right">
                  <a href="{{ route('combustible.show', $vale->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-lg hover:bg-orange-200">
                    Ver
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">No hay vales registrados</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="px-6 py-3">{{ $vales->links() }}</div>
    </div>
  </div>
</div>
@endsection

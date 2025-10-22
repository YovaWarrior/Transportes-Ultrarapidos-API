@extends('layouts.app')

@section('title', 'Combustible')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Vales de Combustible</h1>
        <p class="mt-1 text-sm text-gray-600">Control de consumo por orden y camión</p>
      </div>
      <div>
        <a href="{{ route('combustible.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Registrar Vale
        </a>
      </div>
    </div>

    <!-- Filtros rápidos -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Buscar</label>
          <input type="text" name="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-amber-600 focus:ring-amber-600" placeholder="Placa, marca, modelo...">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Desde</label>
          <input type="date" name="desde" value="{{ request('desde') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-amber-600 focus:ring-amber-600">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Hasta</label>
          <div class="flex space-x-2">
            <input type="date" name="hasta" value="{{ request('hasta') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-amber-600 focus:ring-amber-600">
            <button class="inline-flex items-center px-4 py-2 mt-1 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700">Filtrar</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Totales -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-6">
      <div class="bg-white rounded-lg shadow p-4">
        <p class="text-xs text-gray-500">Total Galones</p>
        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalGalones, 2) }} gal</p>
      </div>
      <div class="bg-white rounded-lg shadow p-4">
        <p class="text-xs text-gray-500">Total Monto</p>
        <p class="text-2xl font-bold text-gray-900">Q {{ number_format($totalMonto, 2) }}</p>
      </div>
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
                  <a href="{{ route('combustible.show', $vale->id) }}" class="text-amber-700 hover:text-amber-900 text-sm font-medium">Ver</a>
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

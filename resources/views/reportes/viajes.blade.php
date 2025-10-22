@extends('layouts.app')

@section('title', 'Reporte de Viajes por Camión')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Viajes por Camión</h1>
        <p class="mt-1 text-sm text-gray-600">Total de viajes y kilómetros recorridos</p>
      </div>
      <a href="{{ route('reportes.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Volver a reportes</a>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div>
          <label class="block text-sm font-medium text-gray-700">Desde</label>
          <input type="date" name="desde" value="{{ request('desde') }}" class="mt-1 block w-full rounded-lg border-gray-300">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Hasta</label>
          <input type="date" name="hasta" value="{{ request('hasta') }}" class="mt-1 block w-full rounded-lg border-gray-300">
        </div>
        <div class="flex items-end">
          <button class="w-full px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">Filtrar</button>
        </div>
      </form>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Placa</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marca/Modelo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Transportista</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total Viajes</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Km Recorridos</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($data as $item)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $item['camion']->placa }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $item['camion']->marca }} {{ $item['camion']->modelo }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $item['camion']->transportista->nombre ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-gray-900 text-right font-semibold">{{ $item['total_viajes'] }}</td>
              <td class="px-6 py-4 text-sm text-gray-900 text-right">{{ number_format($item['km_recorridos'], 2) }} km</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">No hay registros</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

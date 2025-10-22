@extends('layouts.app')

@section('title', 'Reporte de Vales de Combustible')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Vales de Combustible</h1>
        <p class="mt-1 text-sm text-gray-600">Por fecha, camión o piloto</p>
      </div>
      <a href="{{ route('reportes.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Volver a reportes</a>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-5">
        <div>
          <label class="block text-sm font-medium text-gray-700">Camión</label>
          <select name="camion_id" class="mt-1 block w-full rounded-lg border-gray-300">
            <option value="">Todos</option>
            @foreach($camiones as $c)
              <option value="{{ $c->id }}" {{ request('camion_id') == $c->id ? 'selected' : '' }}>{{ $c->placa }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Piloto</label>
          <select name="piloto_id" class="mt-1 block w-full rounded-lg border-gray-300">
            <option value="">Todos</option>
            @foreach($pilotos as $p)
              <option value="{{ $p->id }}" {{ request('piloto_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Desde</label>
          <input type="date" name="desde" value="{{ request('desde') }}" class="mt-1 block w-full rounded-lg border-gray-300">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Hasta</label>
          <input type="date" name="hasta" value="{{ request('hasta') }}" class="mt-1 block w-full rounded-lg border-gray-300">
        </div>
        <div class="flex items-end">
          <button class="w-full px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700">Filtrar</button>
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
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Orden</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Camión</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Piloto</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Galones</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Precio/gal</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($vales as $v)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $v->fecha_vale?->format('d/m/Y H:i') }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">#{{ $v->ordenTrabajo->numero_orden ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $v->ordenTrabajo->camion->placa ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $v->ordenTrabajo->piloto->nombre ?? '—' }}</td>
              <td class="px-6 py-4 text-sm text-gray-900 text-right">{{ number_format($v->cantidad_galones, 2) }}</td>
              <td class="px-6 py-4 text-sm text-gray-900 text-right">Q {{ number_format($v->precio_galon, 2) }}</td>
              <td class="px-6 py-4 text-sm font-semibold text-gray-900 text-right">Q {{ number_format($v->total, 2) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">No hay registros</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <div class="px-6 py-3">{{ $vales->links() }}</div>
    </div>
  </div>
</div>
@endsection

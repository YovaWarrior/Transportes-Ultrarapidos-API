@extends('layouts.app')

@section('title', 'Reporte de Ingresos por Predio')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Ingresos por Predio</h1>
        <p class="mt-1 text-sm text-gray-600">Reporte con filtros de fecha y predio</p>
      </div>
      <a href="{{ route('reportes.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Volver a reportes</a>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Predio</label>
          <select name="predio_id" class="mt-1 block w-full rounded-lg border-gray-300">
            <option value="">Todos</option>
            @foreach($predios as $p)
              <option value="{{ $p->id }}" {{ request('predio_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }}</option>
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
          <button class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">Filtrar</button>
        </div>
      </form>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Orden</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Camión</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Predio</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Origen</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo Carga</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($ingresos as $ing)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $ing->fecha_ingreso?->format('d/m/Y H:i') }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">#{{ $ing->ordenTrabajo->numero_orden ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $ing->ordenTrabajo->camion->placa ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $ing->ordenTrabajo->predio->nombre ?? '—' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $ing->origen }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $ing->tipo_carga }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">No hay registros</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <div class="px-6 py-3">{{ $ingresos->links() }}</div>
    </div>
  </div>
</div>
@endsection

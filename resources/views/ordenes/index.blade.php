@extends('layouts.app')

@section('title', 'Órdenes de Trabajo')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Órdenes de Trabajo</h1>
        <p class="mt-1 text-sm text-gray-600">Gestión de órdenes vinculadas a camiones</p>
      </div>
      <div>
        <a href="{{ route('ordenes.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-sky-600 rounded-lg hover:bg-sky-700">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Nueva Orden
        </a>
      </div>
    </div>

    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Buscar</label>
          <input type="text" name="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-600 focus:ring-sky-600" placeholder="Número de orden, placa, marca, modelo">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Estado</label>
          <select name="estado" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-600 focus:ring-sky-600">
            <option value="todos" {{ request('estado')=='todos' ? 'selected' : '' }}>Todos</option>
            <option value="abierta" {{ request('estado')=='abierta' ? 'selected' : '' }}>Abierta</option>
            <option value="en_proceso" {{ request('estado')=='en_proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="cerrada" {{ request('estado')=='cerrada' ? 'selected' : '' }}>Cerrada</option>
          </select>
        </div>
        <div class="flex items-end">
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-sky-600 rounded-lg hover:bg-sky-700">Filtrar</button>
        </div>
      </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Orden</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Camión</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($ordenes as $o)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">{{ $o->numero_orden }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $o->camion->placa ?? 'N/A' }} · {{ ($o->camion->marca ?? '') . ' ' . ($o->camion->modelo ?? '') }}</td>
                <td class="px-6 py-4 text-sm">
                  @php($estado=$o->estado)
                  @if($estado=='abierta')
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-amber-800 bg-amber-100 rounded-full">Abierta</span>
                  @elseif($estado=='en_proceso')
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-sky-800 bg-sky-100 rounded-full">En proceso</span>
                  @else
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Cerrada</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                  <a href="{{ route('ordenes.show', $o->id) }}" class="text-sky-700 hover:text-sky-900 text-sm font-medium">Ver</a>
                  <a href="{{ route('ordenes.edit', $o->id) }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Editar</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-500">No hay órdenes</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="px-6 py-3">{{ $ordenes->links() }}</div>
    </div>
  </div>
</div>
@endsection

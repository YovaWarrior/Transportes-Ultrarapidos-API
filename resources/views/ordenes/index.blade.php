@extends('layouts.app')

@section('title', 'Órdenes de Trabajo')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header con gradiente -->
    <div class="relative overflow-hidden bg-gradient-to-r from-sky-600 to-cyan-600 rounded-2xl mb-6 shadow-lg">
      <div class="px-6 py-8 sm:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Órdenes de Trabajo</h1>
            <p class="mt-2 text-sm text-sky-100">Gestión de órdenes vinculadas a camiones</p>
          </div>
          <div class="hidden sm:block">
            <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón Nuevo -->
    <div class="mb-4">
      <a href="{{ route('ordenes.create') }}" class="inline-flex items-center px-4 py-2 border border-sky-300 rounded-lg shadow-sm text-sm font-medium text-sky-700 bg-white hover:bg-sky-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nueva Orden
      </a>
    </div>

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
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Número, placa, marca, modelo..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500">
          </div>
        </div>
        <div class="w-full sm:w-48">
          <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
          <select name="estado" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
            <option value="todos" {{ request('estado')=='todos' ? 'selected' : '' }}>Todos</option>
            <option value="abierta" {{ request('estado')=='abierta' ? 'selected' : '' }}>Abierta</option>
            <option value="en_proceso" {{ request('estado')=='en_proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="cerrada" {{ request('estado')=='cerrada' ? 'selected' : '' }}>Cerrada</option>
          </select>
        </div>
        <div>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Filtrar
          </button>
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
                  <a href="{{ route('ordenes.show', $o->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-sky-700 bg-sky-100 rounded-lg hover:bg-sky-200">Ver</a>
                  <a href="{{ route('ordenes.edit', $o->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Editar</a>
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

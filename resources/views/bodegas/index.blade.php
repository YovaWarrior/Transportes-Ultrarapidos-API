@extends('layouts.app')

@section('title', 'Bodegas')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header con gradiente -->
    <div class="relative overflow-hidden bg-gradient-to-r from-amber-600 to-orange-600 rounded-2xl mb-6 shadow-lg">
      <div class="px-6 py-8 sm:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Bodegas</h1>
            <p class="mt-2 text-sm text-amber-100">Almacenes y depósitos por predio</p>
          </div>
          <div class="hidden sm:block">
            <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón Nuevo -->
    <div class="mb-4">
      <a href="{{ route('bodegas.create') }}" class="inline-flex items-center px-4 py-2 border border-amber-300 rounded-lg shadow-sm text-sm font-medium text-amber-700 bg-white hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nueva Bodega
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
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre o predio..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
          </div>
        </div>
        <div>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Buscar
          </button>
        </div>
      </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Predio</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">País</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3"></th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($bodegas as $b)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $b->nombre }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $b->predio->nombre ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $b->predio->pais ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-center">
                @if($b->active)
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activa</span>
                @else
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactiva</span>
                @endif
              </td>
              <td class="px-6 py-4 text-right space-x-2">
                <a href="{{ route('bodegas.show', $b->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-amber-700 bg-amber-100 rounded-lg hover:bg-amber-200">Ver</a>
                <a href="{{ route('bodegas.edit', $b->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Editar</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">No hay bodegas registradas</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      </div>
      <div class="px-6 py-3">{{ $bodegas->links() }}</div>
    </div>
  </div>
</div>
@endsection

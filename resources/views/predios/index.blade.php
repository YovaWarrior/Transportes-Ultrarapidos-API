@extends('layouts.app')

@section('title', 'Predios')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header con gradiente -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 to-green-600 rounded-2xl mb-6 shadow-lg">
      <div class="px-6 py-8 sm:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Predios</h1>
            <p class="mt-2 text-sm text-emerald-100">Ubicaciones en Guatemala y El Salvador</p>
          </div>
          <div class="hidden sm:block">
            <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón Nuevo -->
    <div class="mb-4">
      <a href="{{ route('predios.create') }}" class="inline-flex items-center px-4 py-2 border border-emerald-300 rounded-lg shadow-sm text-sm font-medium text-emerald-700 bg-white hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nuevo Predio
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
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre o país..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
          </div>
        </div>
        <div>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Buscar
          </button>
        </div>
      </form>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($predios as $p)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
          <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-emerald-600 to-green-600">
            <h3 class="text-lg font-semibold text-white">{{ $p->nombre }}</h3>
            <p class="text-sm text-white/90 mt-1">{{ $p->pais }}</p>
          </div>
          <div class="px-6 py-4 space-y-2">
            <p class="text-sm text-gray-600"><strong>Dirección:</strong> {{ $p->direccion ?: '—' }}</p>
            <p class="text-sm text-gray-600"><strong>Teléfono:</strong> {{ $p->telefono ?: '—' }}</p>
            <p class="text-sm text-gray-600"><strong>Bodegas:</strong> {{ $p->bodegas_count }}</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
              @if($p->active)
                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
              @else
                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactivo</span>
              @endif
              <div class="flex space-x-2">
                <a href="{{ route('predios.show', $p->id) }}" class="inline-flex items-center px-2 py-1 text-xs font-medium text-emerald-700 bg-emerald-100 rounded-lg hover:bg-emerald-200">Ver</a>
                <a href="{{ route('predios.edit', $p->id) }}" class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Editar</a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-3 bg-white rounded-lg shadow p-12 text-center">
          <p class="text-sm text-gray-500">No hay predios registrados</p>
        </div>
      @endforelse
    </div>

    <div class="mt-6">{{ $predios->links() }}</div>
  </div>
</div>
@endsection

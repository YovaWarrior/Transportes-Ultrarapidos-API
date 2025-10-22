@extends('layouts.app')

@section('title', 'Predios')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Predios</h1>
        <p class="mt-1 text-sm text-gray-600">Guatemala y El Salvador</p>
      </div>
      <div>
        <a href="{{ route('predios.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Nuevo Predio
        </a>
      </div>
    </div>

    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="flex items-center space-x-4">
        <div class="flex-1">
          <input type="text" name="search" value="{{ request('search') }}" class="block w-full rounded-lg border-gray-300 focus:border-purple-600 focus:ring-purple-600" placeholder="Buscar por nombre o país...">
        </div>
        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">Buscar</button>
      </form>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($predios as $p)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
          <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-purple-600 to-indigo-600">
            <h3 class="text-lg font-semibold text-white">{{ $p->nombre }}</h3>
            <p class="text-sm text-white/80 mt-1">{{ $p->pais }}</p>
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
              <div class="space-x-2">
                <a href="{{ route('predios.show', $p->id) }}" class="text-purple-700 hover:text-purple-900 text-sm font-medium">Ver</a>
                <a href="{{ route('predios.edit', $p->id) }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Editar</a>
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

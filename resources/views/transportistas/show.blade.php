@extends('layouts.app')

@section('title', 'Detalle de Transportista')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-6xl sm:px-6 md:px-8">
    <div class="mb-4">
      <a href="{{ route('transportistas.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Volver a transportistas
      </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-600">
        <h1 class="text-2xl font-bold text-white">{{ $transportista->nombre }}</h1>
        <p class="text-white/80 text-sm mt-1">{{ ucfirst($transportista->tipo) }} · {{ $transportista->email ?: 'Sin email' }}</p>
      </div>

      <div class="p-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Info -->
        <div class="lg:col-span-1 space-y-4">
          <div class="bg-gray-50 rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Información</h2>
            <dl class="text-sm text-gray-900 space-y-2">
              <div class="flex justify-between"><dt class="text-gray-600">Tipo</dt><dd>{{ ucfirst($transportista->tipo) }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">NIT</dt><dd>{{ $transportista->nit ?: '—' }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">Teléfono</dt><dd>{{ $transportista->telefono ?: '—' }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">Dirección</dt><dd class="text-right">{{ $transportista->direccion ?: '—' }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">Estado</dt>
                <dd>
                  @if($transportista->active)
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
                  @else
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactivo</span>
                  @endif
                </dd>
              </div>
            </dl>
          </div>

          <div class="flex items-center justify-between">
            <a href="{{ route('transportistas.edit', $transportista->id) }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Editar</a>
            <form action="{{ route('transportistas.destroy', $transportista->id) }}" method="POST" onsubmit="return confirm('¿Eliminar transportista?');">
              @csrf
              @method('DELETE')
              <button class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Eliminar</button>
            </form>
          </div>
        </div>

        <!-- Camiones asociados -->
        <div class="lg:col-span-2">
          <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
              <h2 class="text-lg font-semibold text-gray-900">Camiones Asociados</h2>
              <span class="text-sm text-gray-500">{{ $transportista->camiones->count() }} en total</span>
            </div>

            <div class="divide-y divide-gray-200">
              @forelse($transportista->camiones as $c)
                <a href="{{ route('camiones.show', $c->id) }}" class="block hover:bg-gray-50">
                  <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                      <span class="inline-flex items-center px-2 py-1 rounded border border-primary-300 bg-primary-50 text-primary-800 text-xs font-semibold">{{ $c->placa }}</span>
                      <div>
                        <p class="text-sm font-medium text-gray-900">{{ $c->marca }} {{ $c->modelo }}</p>
                        <p class="text-xs text-gray-500">Año {{ $c->año }} · {{ ucfirst($c->tipo) }}</p>
                      </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                  </div>
                </a>
              @empty
                <div class="px-6 py-10 text-center text-sm text-gray-500">Sin camiones asociados</div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

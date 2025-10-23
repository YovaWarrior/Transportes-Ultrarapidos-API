@extends('layouts.app')

@section('title', 'Detalle de Predio')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $predio->nombre }}</h1>
        <p class="mt-1 text-sm text-gray-600">Detalle del predio</p>
      </div>
      <div class="flex items-center space-x-3">
        <a href="{{ route('predios.edit', $predio->id) }}" class="inline-flex items-center px-4 py-2 border border-emerald-300 rounded-lg shadow-sm text-sm font-medium text-emerald-700 bg-white hover:bg-emerald-50">
          Editar
        </a>
        <a href="{{ route('predios.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Volver</a>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
      <!-- Información Principal -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Card de Información -->
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Información del Predio</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-500">País</label>
              <p class="mt-1 text-sm text-gray-900">{{ $predio->pais }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500">Estado</label>
              <p class="mt-1">
                @if($predio->active)
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
                @else
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactivo</span>
                @endif
              </p>
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-500">Dirección</label>
              <p class="mt-1 text-sm text-gray-900">{{ $predio->direccion ?: '—' }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500">Teléfono</label>
              <p class="mt-1 text-sm text-gray-900">{{ $predio->telefono ?: '—' }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500">Total Bodegas</label>
              <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $predio->bodegas->count() }}</p>
            </div>
          </div>
        </div>

        <!-- Bodegas Asociadas -->
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Bodegas del Predio</h2>
            <a href="{{ route('bodegas.create') }}?predio_id={{ $predio->id }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">+ Agregar Bodega</a>
          </div>
          @if($predio->bodegas->count() > 0)
            <div class="space-y-3">
              @foreach($predio->bodegas as $bodega)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                  <div>
                    <p class="text-sm font-medium text-gray-900">{{ $bodega->nombre }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                      <span class="inline-flex items-center">
                        @if($bodega->active)
                          <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>
                          <span>Activa</span>
                        @else
                          <span class="w-2 h-2 bg-gray-400 rounded-full mr-1.5"></span>
                          <span>Inactiva</span>
                        @endif
                      </span>
                    </p>
                  </div>
                  <a href="{{ route('bodegas.show', $bodega->id) }}" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium">Ver →</a>
                </div>
              @endforeach
            </div>
          @else
            <p class="text-sm text-gray-500 text-center py-8">No hay bodegas registradas en este predio</p>
          @endif
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Card de Fechas -->
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-sm font-semibold text-gray-900 mb-3">Información del Sistema</h3>
          <div class="space-y-3">
            <div>
              <label class="block text-xs font-medium text-gray-500">Fecha de Creación</label>
              <p class="mt-1 text-sm text-gray-900">{{ $predio->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-500">Última Actualización</label>
              <p class="mt-1 text-sm text-gray-900">{{ $predio->updated_at->format('d/m/Y H:i') }}</p>
            </div>
          </div>
        </div>

        <!-- Acciones -->
        @if(auth()->user()->canDelete())
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-sm font-semibold text-gray-900 mb-3">Acciones</h3>
          <form method="POST" action="{{ route('predios.destroy', $predio->id) }}" onsubmit="return confirm('¿Estás seguro de eliminar este predio? Se eliminarán también todas las bodegas asociadas.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
              Eliminar Predio
            </button>
          </form>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

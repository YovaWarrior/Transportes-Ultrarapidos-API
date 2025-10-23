@extends('layouts.app')

@section('title', 'Detalle de Bodega')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-5xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $bodega->nombre }}</h1>
        <p class="mt-1 text-sm text-gray-600">Detalle de la bodega</p>
      </div>
      <div class="flex items-center space-x-3">
        <a href="{{ route('bodegas.edit', $bodega->id) }}" class="inline-flex items-center px-4 py-2 border border-green-300 rounded-lg shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50">
          Editar
        </a>
        <a href="{{ route('bodegas.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Volver</a>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
      <!-- Información Principal -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Card de Información -->
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Información de la Bodega</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-500">Nombre</label>
              <p class="mt-1 text-sm text-gray-900 font-medium">{{ $bodega->nombre }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500">Estado</label>
              <p class="mt-1">
                @if($bodega->active)
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activa</span>
                @else
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactiva</span>
                @endif
              </p>
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-500">Predio</label>
              <div class="mt-1 flex items-center space-x-2">
                <a href="{{ route('predios.show', $bodega->predio->id) }}" class="text-sm text-green-600 hover:text-green-700 font-medium">
                  {{ $bodega->predio->nombre }}
                </a>
                <span class="text-xs text-gray-500">• {{ $bodega->predio->pais }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Órdenes de Trabajo Asociadas -->
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Órdenes de Trabajo</h2>
          @php
            $ordenes = \App\Models\OrdenTrabajo::where('bodega_id', $bodega->id)->with('camion')->latest()->take(5)->get();
          @endphp
          @if($ordenes->count() > 0)
            <div class="space-y-3">
              @foreach($ordenes as $orden)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                  <div>
                    <p class="text-sm font-medium text-gray-900">{{ $orden->numero_orden }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                      {{ $orden->camion->placa ?? 'N/A' }} • 
                      @if($orden->estado == 'pendiente')
                        <span class="text-amber-600">Pendiente</span>
                      @elseif($orden->estado == 'en_proceso')
                        <span class="text-blue-600">En Proceso</span>
                      @elseif($orden->estado == 'completada')
                        <span class="text-green-600">Completada</span>
                      @else
                        <span class="text-gray-600">Cancelada</span>
                      @endif
                    </p>
                  </div>
                  <a href="{{ route('ordenes.show', $orden->id) }}" class="text-xs text-green-600 hover:text-green-700 font-medium">Ver →</a>
                </div>
              @endforeach
            </div>
            @if($ordenes->count() >= 5)
              <div class="mt-4 text-center">
                <a href="{{ route('ordenes.index') }}?bodega_id={{ $bodega->id }}" class="text-sm text-green-600 hover:text-green-700 font-medium">Ver todas las órdenes →</a>
              </div>
            @endif
          @else
            <p class="text-sm text-gray-500 text-center py-8">No hay órdenes de trabajo registradas para esta bodega</p>
          @endif
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Card de Ubicación -->
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-sm font-semibold text-gray-900 mb-3">Ubicación</h3>
          <div class="space-y-3">
            <div>
              <label class="block text-xs font-medium text-gray-500">Predio</label>
              <p class="mt-1 text-sm text-gray-900">{{ $bodega->predio->nombre }}</p>
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-500">País</label>
              <p class="mt-1 text-sm text-gray-900">{{ $bodega->predio->pais }}</p>
            </div>
            @if($bodega->predio->direccion)
            <div>
              <label class="block text-xs font-medium text-gray-500">Dirección</label>
              <p class="mt-1 text-sm text-gray-900">{{ $bodega->predio->direccion }}</p>
            </div>
            @endif
          </div>
        </div>

        <!-- Card de Fechas -->
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-sm font-semibold text-gray-900 mb-3">Información del Sistema</h3>
          <div class="space-y-3">
            <div>
              <label class="block text-xs font-medium text-gray-500">Fecha de Creación</label>
              <p class="mt-1 text-sm text-gray-900">{{ $bodega->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-500">Última Actualización</label>
              <p class="mt-1 text-sm text-gray-900">{{ $bodega->updated_at->format('d/m/Y H:i') }}</p>
            </div>
          </div>
        </div>

        <!-- Acciones -->
        @if(auth()->user()->canDelete())
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-sm font-semibold text-gray-900 mb-3">Acciones</h3>
          <form method="POST" action="{{ route('bodegas.destroy', $bodega->id) }}" onsubmit="return confirm('¿Estás seguro de eliminar esta bodega?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
              Eliminar Bodega
            </button>
          </form>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

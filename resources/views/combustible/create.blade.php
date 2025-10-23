@extends('layouts.app')

@section('title', 'Registrar Vale de Combustible')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 bg-gradient-to-r from-orange-600 to-red-600 rounded-2xl shadow-lg px-6 py-6">
      <h1 class="text-2xl font-bold text-white">Registrar Vale de Combustible</h1>
      <p class="mt-1 text-sm text-orange-100">Asocia el vale a una Orden de Trabajo y un camión</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <form action="{{ route('combustible.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <!-- Orden de Trabajo -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Orden de Trabajo</h2>
          <div>
            <label class="block text-sm font-medium text-gray-700">Orden de Trabajo <span class="text-red-500">*</span></label>
            <select name="orden_trabajo_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-orange-600 focus:ring-orange-600 @error('orden_trabajo_id') border-red-500 @enderror" required>
              <option value="">Seleccione una orden</option>
              @foreach($ordenes as $o)
                <option value="{{ $o->id }}" {{ (old('orden_trabajo_id', request('orden_trabajo_id')) == $o->id) ? 'selected' : '' }}>
                  #{{ $o->numero_orden ?? $o->id }} · {{ $o->camion->placa ?? 'N/A' }}
                </option>
              @endforeach
            </select>
            @error('orden_trabajo_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <!-- Detalles del Vale -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Detalles del Vale</h2>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div>
              <label class="block text-sm font-medium text-gray-700">Galones <span class="text-red-500">*</span></label>
              <input type="number" step="0.01" min="0.01" name="cantidad_galones" value="{{ old('cantidad_galones') }}" placeholder="0.00" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-orange-600 focus:ring-orange-600 @error('cantidad_galones') border-red-500 @enderror" required>
              @error('cantidad_galones')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Precio/galón (Q) <span class="text-red-500">*</span></label>
              <input type="number" step="0.01" min="0" name="precio_galon" value="{{ old('precio_galon') }}" placeholder="0.00" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-orange-600 focus:ring-orange-600 @error('precio_galon') border-red-500 @enderror" required>
              @error('precio_galon')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Fecha del vale <span class="text-red-500">*</span></label>
              <input type="datetime-local" name="fecha_vale" value="{{ old('fecha_vale', now()->format('Y-m-d\\TH:i')) }}" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-orange-600 focus:ring-orange-600 @error('fecha_vale') border-red-500 @enderror" required>
              @error('fecha_vale')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        <!-- Observaciones -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Observaciones</label>
          <textarea name="observaciones" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-orange-600 focus:ring-orange-600 @error('observaciones') border-red-500 @enderror" placeholder="Detalles adicionales">{{ old('observaciones') }}</textarea>
          @error('observaciones')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
          <a href="{{ route('combustible.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            Cancelar
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Guardar Vale
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

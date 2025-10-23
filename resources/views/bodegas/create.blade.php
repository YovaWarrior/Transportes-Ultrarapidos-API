@extends('layouts.app')

@section('title', 'Nueva Bodega')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 bg-gradient-to-r from-amber-600 to-orange-600 rounded-2xl shadow-lg px-6 py-6">
      <h1 class="text-2xl font-bold text-white">Nueva Bodega</h1>
      <p class="mt-1 text-sm text-amber-100">Registra un nuevo almacén o depósito en un predio</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <form method="POST" action="{{ route('bodegas.store') }}" class="p-6 space-y-6">
        @csrf

        <!-- Información Básica -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Información Básica</h2>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-gray-700">Nombre de la Bodega <span class="text-red-500">*</span></label>
              <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Bodega Principal, Almacén A, etc." class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-amber-600 focus:ring-amber-600 @error('nombre') border-red-500 @enderror" required>
              @error('nombre')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Predio <span class="text-red-500">*</span></label>
              <select name="predio_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-amber-600 focus:ring-amber-600 @error('predio_id') border-red-500 @enderror" required>
                <option value="">Seleccione un predio</option>
                @foreach($predios as $p)
                  <option value="{{ $p->id }}" {{ old('predio_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }} - {{ $p->pais }}</option>
                @endforeach
              </select>
              @error('predio_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Capacidad (opcional)</label>
              <input type="text" name="capacidad" value="{{ old('capacidad') }}" placeholder="Ej: 500 m², 1000 pallets" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-amber-600 focus:ring-amber-600 @error('capacidad') border-red-500 @enderror">
              @error('capacidad')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        <!-- Descripción -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Descripción (opcional)</label>
          <textarea name="descripcion" rows="3" placeholder="Detalles adicionales sobre la bodega..." class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-amber-600 focus:ring-amber-600 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
          @error('descripcion')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <!-- Estado -->
        <div>
          <label class="flex items-center">
            <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
            <span class="ml-2 text-sm font-medium text-gray-700">Activa</span>
          </label>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
          <a href="{{ route('bodegas.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
            Cancelar
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Guardar Bodega
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Editar Predio')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Editar Predio</h1>
      <p class="mt-1 text-sm text-gray-600">Modifica la información del predio</p>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow p-6">
      <form method="POST" action="{{ route('predios.update', $predio->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Nombre -->
          <div class="md:col-span-2">
            <label for="nombre" class="block text-sm font-medium text-gray-700">
              Nombre del Predio <span class="text-red-500">*</span>
            </label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $predio->nombre) }}" required
              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            @error('nombre')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- País -->
          <div>
            <label for="pais" class="block text-sm font-medium text-gray-700">
              País <span class="text-red-500">*</span>
            </label>
            <input type="text" name="pais" id="pais" value="{{ old('pais', $predio->pais) }}" required
              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
              placeholder="Ej: Guatemala">
            @error('pais')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Teléfono -->
          <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $predio->telefono) }}"
              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
              placeholder="Ej: +502 1234-5678">
            @error('telefono')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Dirección -->
          <div class="md:col-span-2">
            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
            <textarea name="direccion" id="direccion" rows="3"
              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
              placeholder="Dirección completa del predio">{{ old('direccion', $predio->direccion) }}</textarea>
            @error('direccion')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Estado Activo -->
          <div class="md:col-span-2">
            <div class="flex items-center">
              <input type="checkbox" name="active" id="active" value="1" {{ old('active', $predio->active) ? 'checked' : '' }}
                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
              <label for="active" class="ml-2 block text-sm text-gray-900">
                Predio activo
              </label>
            </div>
            <p class="mt-1 text-xs text-gray-500">Si está inactivo, no se podrá usar en nuevas órdenes de trabajo</p>
          </div>
        </div>

        <!-- Botones -->
        <div class="mt-6 flex items-center justify-end space-x-3">
          <a href="{{ route('predios.show', $predio->id) }}" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Cancelar
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
            Guardar Cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

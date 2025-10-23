@extends('layouts.app')

@section('title', 'Editar Bodega')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Editar Bodega</h1>
      <p class="mt-1 text-sm text-gray-600">Modifica la información de la bodega</p>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow p-6">
      <form method="POST" action="{{ route('bodegas.update', $bodega->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Nombre -->
          <div class="md:col-span-2">
            <label for="nombre" class="block text-sm font-medium text-gray-700">
              Nombre de la Bodega <span class="text-red-500">*</span>
            </label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $bodega->nombre) }}" required
              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('nombre')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Predio -->
          <div class="md:col-span-2">
            <label for="predio_id" class="block text-sm font-medium text-gray-700">
              Predio <span class="text-red-500">*</span>
            </label>
            <select name="predio_id" id="predio_id" required
              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
              <option value="">Seleccionar predio...</option>
              @foreach($predios as $predio)
                <option value="{{ $predio->id }}" {{ old('predio_id', $bodega->predio_id) == $predio->id ? 'selected' : '' }}>
                  {{ $predio->nombre }} ({{ $predio->pais }})
                </option>
              @endforeach
            </select>
            @error('predio_id')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Descripción -->
          <div class="md:col-span-2">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3"
              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
              placeholder="Descripción opcional de la bodega">{{ old('descripcion', $bodega->descripcion) }}</textarea>
            @error('descripcion')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Estado Activo -->
          <div class="md:col-span-2">
            <div class="flex items-center">
              <input type="checkbox" name="active" id="active" value="1" {{ old('active', $bodega->active) ? 'checked' : '' }}
                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
              <label for="active" class="ml-2 block text-sm text-gray-900">
                Bodega activa
              </label>
            </div>
            <p class="mt-1 text-xs text-gray-500">Si está inactiva, no se podrá usar en nuevas órdenes de trabajo</p>
          </div>
        </div>

        <!-- Botones -->
        <div class="mt-6 flex items-center justify-end space-x-3">
          <a href="{{ route('bodegas.show', $bodega->id) }}" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Cancelar
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Guardar Cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

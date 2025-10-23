@extends('layouts.app')

@section('title', 'Nuevo Piloto')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-2xl shadow-lg px-6 py-6">
      <h1 class="text-2xl font-bold text-white">Nuevo Piloto</h1>
      <p class="mt-1 text-sm text-teal-100">Registra un nuevo conductor asociado a un transportista</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <form method="POST" action="{{ route('pilotos.store') }}" class="p-6 space-y-6">
        @csrf

        <!-- Información Básica -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Información Básica</h2>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-gray-700">Nombre Completo <span class="text-red-500">*</span></label>
              <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Juan Pérez López" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600 @error('nombre') border-red-500 @enderror" required>
              @error('nombre')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Licencia</label>
              <input type="text" name="licencia" value="{{ old('licencia') }}" placeholder="Ej: A-1234567" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600 @error('licencia') border-red-500 @enderror">
              @error('licencia')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">DPI</label>
              <input type="text" name="dpi" value="{{ old('dpi') }}" placeholder="Ej: 1234567890101" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600 @error('dpi') border-red-500 @enderror">
              @error('dpi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Teléfono</label>
              <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: +502 1234-5678" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600 @error('telefono') border-red-500 @enderror">
              @error('telefono')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        <!-- Asociación -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Asociación</h2>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-gray-700">Transportista <span class="text-red-500">*</span></label>
              <select name="transportista_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600 @error('transportista_id') border-red-500 @enderror" required>
                <option value="">Seleccione un transportista</option>
                @foreach($transportistas as $t)
                  <option value="{{ $t->id }}" {{ old('transportista_id') == $t->id ? 'selected' : '' }}>{{ $t->nombre }}</option>
                @endforeach
              </select>
              @error('transportista_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" placeholder="piloto@ejemplo.com" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600 @error('email') border-red-500 @enderror">
              @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        <!-- Dirección -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Dirección</label>
          <textarea name="direccion" rows="3" placeholder="Zona, ciudad, departamento..." class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-teal-600 focus:ring-teal-600 @error('direccion') border-red-500 @enderror">{{ old('direccion') }}</textarea>
          @error('direccion')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <!-- Estado -->
        <div>
          <label class="flex items-center">
            <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
            <span class="ml-2 text-sm font-medium text-gray-700">Activo</span>
          </label>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
          <a href="{{ route('pilotos.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Cancelar
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Guardar Piloto
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

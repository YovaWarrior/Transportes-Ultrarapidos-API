@extends('layouts.app')

@section('title', 'Nuevo Transportista')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl shadow-lg px-6 py-6">
      <h1 class="text-2xl font-bold text-white">Nuevo Transportista</h1>
      <p class="mt-1 text-sm text-purple-100">Registra una empresa o un independiente</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <form action="{{ route('transportistas.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <!-- Información Básica -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Información Básica</h2>
          <div class="space-y-6">
            <div>
              <label class="block text-sm font-medium text-gray-700">Nombre <span class="text-red-500">*</span></label>
              <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Transportes Rápidos S.A." class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-purple-600 @error('nombre') border-red-500 @enderror" required>
              @error('nombre')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
              <div>
                <label class="block text-sm font-medium text-gray-700">Tipo <span class="text-red-500">*</span></label>
                <select name="tipo" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-purple-600 @error('tipo') border-red-500 @enderror" required>
                  <option value="empresa" {{ old('tipo') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                  <option value="independiente" {{ old('tipo') == 'independiente' ? 'selected' : '' }}>Independiente</option>
                </select>
                @error('tipo')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">NIT</label>
                <input type="text" name="nit" value="{{ old('nit') }}" placeholder="Ej: 12345678-9" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-purple-600 @error('nit') border-red-500 @enderror">
                @error('nit')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
              </div>
            </div>
          </div>
        </div>

        <!-- Datos de Contacto -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Datos de Contacto</h2>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-gray-700">Teléfono</label>
              <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="+502 1234-5678" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-purple-600 @error('telefono') border-red-500 @enderror">
              @error('telefono')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" placeholder="contacto@empresa.com" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-purple-600 @error('email') border-red-500 @enderror">
              @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        <!-- Dirección -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Dirección</label>
          <textarea name="direccion" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-purple-600 @error('direccion') border-red-500 @enderror" placeholder="Zona, ciudad, etc.">{{ old('direccion') }}</textarea>
          @error('direccion')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <!-- Estado -->
        <div>
          <label class="flex items-center">
            <input type="checkbox" name="active" value="1" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500" {{ old('active', true) ? 'checked' : '' }}>
            <span class="ml-2 text-sm font-medium text-gray-700">Activo</span>
          </label>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
          <a href="{{ route('transportistas.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
            Cancelar
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Nuevo Transportista')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-3xl sm:px-6 md:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-600">
        <h1 class="text-2xl font-bold text-white">Nuevo Transportista</h1>
        <p class="text-white/80 text-sm mt-1">Registra una empresa o un independiente</p>
      </div>

      <form action="{{ route('transportistas.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <div>
          <label class="block text-sm font-medium text-gray-700">Nombre <span class="text-red-500">*</span></label>
          <input type="text" name="nombre" value="{{ old('nombre') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 @error('nombre') border-red-500 @enderror" required>
          @error('nombre')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Tipo <span class="text-red-500">*</span></label>
            <select name="tipo" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 @error('tipo') border-red-500 @enderror" required>
              <option value="empresa" {{ old('tipo') == 'empresa' ? 'selected' : '' }}>Empresa</option>
              <option value="independiente" {{ old('tipo') == 'independiente' ? 'selected' : '' }}>Independiente</option>
            </select>
            @error('tipo')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">NIT</label>
            <input type="text" name="nit" value="{{ old('nit') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 @error('nit') border-red-500 @enderror">
            @error('nit')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 @error('telefono') border-red-500 @enderror">
            @error('telefono')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 @error('email') border-red-500 @enderror">
            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Dirección</label>
          <textarea name="direccion" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600 @error('direccion') border-red-500 @enderror" placeholder="Zona, ciudad, etc.">{{ old('direccion') }}</textarea>
          @error('direccion')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center">
          <input type="checkbox" name="active" id="active" value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('active', true) ? 'checked' : '' }}>
          <label for="active" class="ml-2 block text-sm text-gray-700">Activo</label>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
          <a href="{{ route('transportistas.index') }}" class="px-4 py-2 text-sm font-medium border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-50">Cancelar</a>
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

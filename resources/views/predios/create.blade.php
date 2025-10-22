@extends('layouts.app')

@section('title', 'Nuevo Predio')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-3xl sm:px-6 md:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-purple-600 to-indigo-600">
        <h1 class="text-2xl font-bold text-white">Nuevo Predio</h1>
      </div>

      <form action="{{ route('predios.store') }}" method="POST" class="p-6 space-y-6">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nombre <span class="text-red-500">*</span></label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-purple-600 focus:ring-purple-600 @error('nombre') border-red-500 @enderror" required>
            @error('nombre')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">País <span class="text-red-500">*</span></label>
            <select name="pais" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-purple-600 focus:ring-purple-600" required>
              <option value="Guatemala" {{ old('pais')=='Guatemala' ? 'selected' : '' }}>Guatemala</option>
              <option value="El Salvador" {{ old('pais')=='El Salvador' ? 'selected' : '' }}>El Salvador</option>
            </select>
            @error('pais')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Dirección</label>
          <input type="text" name="direccion" value="{{ old('direccion') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-purple-600 focus:ring-purple-600">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Teléfono</label>
          <input type="text" name="telefono" value="{{ old('telefono') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-purple-600 focus:ring-purple-600">
        </div>
        <div class="flex items-center">
          <input type="checkbox" name="active" id="active" value="1" class="h-4 w-4 text-purple-600 border-gray-300 rounded" {{ old('active', true) ? 'checked' : '' }}>
          <label for="active" class="ml-2 block text-sm text-gray-700">Activo</label>
        </div>
        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
          <a href="{{ route('predios.index') }}" class="px-4 py-2 text-sm font-medium border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-50">Cancelar</a>
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

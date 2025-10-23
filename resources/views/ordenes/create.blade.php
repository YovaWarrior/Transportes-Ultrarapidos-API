@extends('layouts.app')

@section('title', 'Nueva Orden de Trabajo')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 bg-gradient-to-r from-sky-600 to-cyan-600 rounded-2xl shadow-lg px-6 py-6">
      <h1 class="text-2xl font-bold text-white">Nueva Orden de Trabajo</h1>
      <p class="mt-1 text-sm text-sky-100">Asocia la orden a un camión y define el estado</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <form action="{{ route('ordenes.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <!-- Info -->
        <div class="bg-sky-50 border-l-4 border-sky-400 p-4 rounded-lg">
          <div class="flex">
            <svg class="h-5 w-5 text-sky-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm text-sky-700">El número de orden se generará automáticamente al guardar.</p>
          </div>
        </div>

        <!-- Asignación -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Asignación</h2>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-gray-700">Camión <span class="text-red-500">*</span></label>
              <select name="camion_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-sky-600 focus:ring-sky-600 @error('camion_id') border-red-500 @enderror" required>
                <option value="">Seleccione camión</option>
                @foreach($camiones as $c)
                  <option value="{{ $c->id }}" {{ old('camion_id') == $c->id ? 'selected' : '' }}>{{ $c->placa }} · {{ $c->marca }} {{ $c->modelo }}</option>
                @endforeach
              </select>
              @error('camion_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Piloto</label>
              <select name="piloto_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-sky-600 focus:ring-sky-600 @error('piloto_id') border-red-500 @enderror">
                <option value="">Seleccione piloto</option>
                @foreach($pilotos as $p)
                  <option value="{{ $p->id }}" {{ old('piloto_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }}</option>
                @endforeach
              </select>
              @error('piloto_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        <!-- Ubicación -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Ubicación</h2>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-medium text-gray-700">Predio</label>
              <select name="predio_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-sky-600 focus:ring-sky-600 @error('predio_id') border-red-500 @enderror">
                <option value="">Seleccione predio</option>
                @foreach($predios as $pr)
                  <option value="{{ $pr->id }}" {{ old('predio_id') == $pr->id ? 'selected' : '' }}>{{ $pr->nombre }} ({{ $pr->pais }})</option>
                @endforeach
              </select>
              @error('predio_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Bodega</label>
              <select name="bodega_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-sky-600 focus:ring-sky-600 @error('bodega_id') border-red-500 @enderror">
                <option value="">Seleccione bodega</option>
                @foreach($bodegas as $b)
                  <option value="{{ $b->id }}" {{ old('bodega_id') == $b->id ? 'selected' : '' }}>{{ $b->nombre }} ({{ $b->predio->nombre ?? 'N/A' }})</option>
                @endforeach
              </select>
              @error('bodega_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
          </div>
        </div>

        <!-- Estado -->
        <div>
          <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Estado</h2>
          <div>
            <label class="block text-sm font-medium text-gray-700">Estado <span class="text-red-500">*</span></label>
            <select name="estado" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-sky-600 focus:ring-sky-600 @error('estado') border-red-500 @enderror" required>
              @foreach($estados as $e)
                <option value="{{ $e }}" {{ old('estado','abierta')==$e ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ', $e)) }}</option>
              @endforeach
            </select>
            @error('estado')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
          <a href="{{ route('ordenes.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
            Cancelar
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
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

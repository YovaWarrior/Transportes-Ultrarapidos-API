@extends('layouts.app')

@section('title', 'Nueva Orden de Trabajo')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-3xl sm:px-6 md:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-sky-600 to-blue-600">
        <h1 class="text-2xl font-bold text-white">Nueva Orden</h1>
        <p class="text-white/80 text-sm mt-1">Asocia la orden a un camión y define el estado</p>
      </div>

      <form action="{{ route('ordenes.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded mb-6">
          <p class="text-sm text-blue-700">El número de orden se generará automáticamente al guardar.</p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Camión <span class="text-red-500">*</span></label>
            <select name="camion_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-600 focus:ring-sky-600 @error('camion_id') border-red-500 @enderror" required>
              <option value="">Seleccione camión</option>
              @foreach($camiones as $c)
                <option value="{{ $c->id }}" {{ old('camion_id') == $c->id ? 'selected' : '' }}>{{ $c->placa }} · {{ $c->marca }} {{ $c->modelo }}</option>
              @endforeach
            </select>
            @error('camion_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Piloto</label>
            <select name="piloto_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-600 focus:ring-sky-600">
              <option value="">Seleccione piloto</option>
              @foreach($pilotos as $p)
                <option value="{{ $p->id }}" {{ old('piloto_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }}</option>
              @endforeach
            </select>
            @error('piloto_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Predio</label>
            <select name="predio_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-600 focus:ring-sky-600">
              <option value="">Seleccione predio</option>
              @foreach($predios as $pr)
                <option value="{{ $pr->id }}" {{ old('predio_id') == $pr->id ? 'selected' : '' }}>{{ $pr->nombre }} ({{ $pr->pais }})</option>
              @endforeach
            </select>
            @error('predio_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Bodega</label>
            <select name="bodega_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-600 focus:ring-sky-600">
              <option value="">Seleccione bodega</option>
              @foreach($bodegas as $b)
                <option value="{{ $b->id }}" {{ old('bodega_id') == $b->id ? 'selected' : '' }}>{{ $b->nombre }} ({{ $b->predio->nombre ?? 'N/A' }})</option>
              @endforeach
            </select>
            @error('bodega_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Estado <span class="text-red-500">*</span></label>
          <select name="estado" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-600 focus:ring-sky-600 @error('estado') border-red-500 @enderror" required>
            @foreach($estados as $e)
              <option value="{{ $e }}" {{ old('estado','abierta')==$e ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ', $e)) }}</option>
            @endforeach
          </select>
          @error('estado')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
          <a href="{{ route('ordenes.index') }}" class="px-4 py-2 text-sm font-medium border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-50">Cancelar</a>
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-sky-600 rounded-lg hover:bg-sky-700">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

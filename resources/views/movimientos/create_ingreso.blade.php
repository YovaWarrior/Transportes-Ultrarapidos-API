@extends('layouts.app')

@section('title', 'Registrar Ingreso')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-3xl sm:px-6 md:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-green-600 to-emerald-600">
        <h1 class="text-2xl font-bold text-white">Registrar Ingreso</h1>
        <p class="text-white/80 text-sm mt-1">Registra el ingreso de un camión asociado a una Orden de Trabajo</p>
      </div>

      <form action="{{ route('movimientos.ingresos.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <div>
          <label class="block text-sm font-medium text-gray-700">Orden de Trabajo <span class="text-red-500">*</span></label>
          <select name="orden_trabajo_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600 @error('orden_trabajo_id') border-red-500 @enderror" required>
            <option value="">Seleccione una orden</option>
            @foreach($ordenes as $o)
              <option value="{{ $o->id }}" {{ (old('orden_trabajo_id', request('orden_trabajo_id')) == $o->id) ? 'selected' : '' }}>
                #{{ $o->numero_orden ?? $o->id }} · {{ $o->camion->placa ?? 'N/A' }}
              </option>
            @endforeach
          </select>
          @error('orden_trabajo_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Origen <span class="text-red-500">*</span></label>
            <input type="text" name="origen" value="{{ old('origen') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600 @error('origen') border-red-500 @enderror" required>
            @error('origen')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Tipo de Carga <span class="text-red-500">*</span></label>
            <input type="text" name="tipo_carga" value="{{ old('tipo_carga') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600 @error('tipo_carga') border-red-500 @enderror" required>
            @error('tipo_carga')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Fecha y hora de ingreso <span class="text-red-500">*</span></label>
            <input type="datetime-local" name="fecha_ingreso" value="{{ old('fecha_ingreso', now()->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600 @error('fecha_ingreso') border-red-500 @enderror" required>
            @error('fecha_ingreso')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Observaciones</label>
          <textarea name="observaciones" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600 @error('observaciones') border-red-500 @enderror" placeholder="Detalles adicionales">{{ old('observaciones') }}</textarea>
          @error('observaciones')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
          <a href="{{ route('movimientos.index') }}" class="px-4 py-2 text-sm font-medium border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-50">Cancelar</a>
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">Guardar Ingreso</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

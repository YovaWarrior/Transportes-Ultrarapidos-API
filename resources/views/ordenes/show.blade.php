@extends('layouts.app')

@section('title', 'Detalle de Orden de Trabajo')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-6xl sm:px-6 md:px-8">
    <div class="mb-4">
      <a href="{{ route('ordenes.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Volver a órdenes
      </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-sky-600 to-blue-600">
        <h1 class="text-2xl font-bold text-white">Orden #{{ $orden->numero_orden }}</h1>
        <p class="text-white/80 text-sm mt-1">Camión {{ $orden->camion->placa ?? 'N/A' }} · {{ ucfirst(str_replace('_',' ', $orden->estado)) }}</p>
      </div>

      <div class="p-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Resumen -->
        <div class="lg:col-span-1 space-y-4">
          <div class="bg-gray-50 rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Información</h2>
            <dl class="text-sm text-gray-900 space-y-2">
              <div class="flex justify-between"><dt class="text-gray-600">Número</dt><dd>{{ $orden->numero_orden }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">Camión</dt><dd>{{ $orden->camion->placa ?? 'N/A' }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">Estado</dt><dd>{{ ucfirst(str_replace('_',' ', $orden->estado)) }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">Creada</dt><dd>{{ $orden->created_at?->format('d/m/Y H:i') }}</dd></div>
              <div class="flex justify-between"><dt class="text-gray-600">Actualizada</dt><dd>{{ $orden->updated_at?->format('d/m/Y H:i') }}</dd></div>
            </dl>
          </div>

          <div class="flex items-center justify-between">
            <a href="{{ route('ordenes.edit', $orden->id) }}" class="px-4 py-2 text-sm font-medium text-white bg-sky-600 rounded-lg hover:bg-sky-700">Editar</a>
            <form action="{{ route('ordenes.destroy', $orden->id) }}" method="POST" onsubmit="return confirm('¿Eliminar orden?');">
              @csrf
              @method('DELETE')
              <button class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Eliminar</button>
            </form>
          </div>
        </div>

        <!-- Actividad -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Movimientos -->
          <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
              <h2 class="text-lg font-semibold text-gray-900">Movimientos</h2>
              <div class="space-x-2">
                <a href="{{ route('movimientos.ingresos.create', ['orden_trabajo_id' => $orden->id]) }}" class="text-green-700 hover:text-green-900 text-sm font-medium">Registrar Ingreso</a>
                <a href="{{ route('movimientos.egresos.create', ['orden_trabajo_id' => $orden->id]) }}" class="text-blue-700 hover:text-blue-900 text-sm font-medium">Registrar Egreso</a>
              </div>
            </div>
            <div class="divide-y divide-gray-200">
              @if($orden->ingresoCamion)
                <div class="px-6 py-4 flex items-center justify-between">
                  <div>
                    <p class="text-sm font-medium text-gray-900">Ingreso · {{ $orden->ingresoCamion->origen }}</p>
                    <p class="text-xs text-gray-500">{{ $orden->ingresoCamion->tipo_carga }} · {{ $orden->ingresoCamion->fecha_ingreso?->format('d/m/Y H:i') }}</p>
                  </div>
                  <a href="{{ route('movimientos.show', ['tipo'=>'ingreso','id'=>$orden->ingresoCamion->id]) }}" class="text-sm text-sky-700 hover:text-sky-900 font-medium">Ver</a>
                </div>
              @endif
              @if($orden->egresoCamion)
                <div class="px-6 py-4 flex items-center justify-between">
                  <div>
                    <p class="text-sm font-medium text-gray-900">Egreso · {{ $orden->egresoCamion->destino }}</p>
                    <p class="text-xs text-gray-500">{{ $orden->egresoCamion->tipo_carga }} · {{ $orden->egresoCamion->fecha_egreso?->format('d/m/Y H:i') }}</p>
                  </div>
                  <a href="{{ route('movimientos.show', ['tipo'=>'egreso','id'=>$orden->egresoCamion->id]) }}" class="text-sm text-sky-700 hover:text-sky-900 font-medium">Ver</a>
                </div>
              @endif
              @if(!$orden->ingresoCamion && !$orden->egresoCamion)
                <div class="px-6 py-8 text-center text-sm text-gray-500">Sin movimientos registrados</div>
              @endif
            </div>
          </div>

          <!-- Vales de combustible -->
          <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
              <h2 class="text-lg font-semibold text-gray-900">Vales de Combustible</h2>
              <a href="{{ route('combustible.create', ['orden_trabajo_id' => $orden->id]) }}" class="text-amber-700 hover:text-amber-900 text-sm font-medium">Registrar Vale</a>
            </div>
            <div class="divide-y divide-gray-200">
              @forelse($orden->valesCombustible as $v)
                <a href="{{ route('combustible.show', $v->id) }}" class="block hover:bg-gray-50">
                  <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                      <p class="text-sm font-medium text-gray-900">{{ $v->fecha_vale?->format('d/m/Y H:i') }} · {{ number_format($v->cantidad_galones,2) }} gal</p>
                      <p class="text-xs text-gray-500">Q {{ number_format($v->precio_galon,2) }} / gal · Total Q {{ number_format($v->total,2) }}</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                  </div>
                </a>
              @empty
                <div class="px-6 py-8 text-center text-sm text-gray-500">Sin vales registrados</div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

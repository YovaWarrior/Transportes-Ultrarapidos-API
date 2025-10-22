@extends('layouts.app')

@section('title', 'Detalle de Movimiento')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-5xl sm:px-6 md:px-8">
    <!-- Back -->
    <div class="mb-4">
      <a href="{{ route('movimientos.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Volver a movimientos
      </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 {{ $tipo === 'ingreso' ? 'bg-green-600' : 'bg-blue-600' }}">
        <h1 class="text-2xl font-bold text-white">{{ ucfirst($tipo) }} de Camión</h1>
        <p class="text-white/80 text-sm mt-1">Detalle del movimiento asociado a la orden #{{ $movimiento->ordenTrabajo->numero_orden ?? $movimiento->orden_trabajo_id }}</p>
      </div>

      <div class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
          <h2 class="text-sm font-semibold text-gray-700 mb-3">Información del Camión</h2>
          <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-900"><span class="font-medium">Placa:</span> {{ $movimiento->ordenTrabajo->camion->placa ?? 'N/A' }}</p>
            <p class="text-sm text-gray-900 mt-1"><span class="font-medium">Modelo:</span> {{ ($movimiento->ordenTrabajo->camion->marca ?? '') . ' ' . ($movimiento->ordenTrabajo->camion->modelo ?? '') }}</p>
          </div>
        </div>
        <div>
          <h2 class="text-sm font-semibold text-gray-700 mb-3">Información del Movimiento</h2>
          <div class="bg-gray-50 rounded-lg p-4 space-y-2">
            @if($tipo === 'ingreso')
              <p class="text-sm text-gray-900"><span class="font-medium">Origen:</span> {{ $movimiento->origen }}</p>
              <p class="text-sm text-gray-900"><span class="font-medium">Tipo de Carga:</span> {{ $movimiento->tipo_carga }}</p>
              <p class="text-sm text-gray-900"><span class="font-medium">Fecha ingreso:</span> {{ $movimiento->fecha_ingreso?->format('d/m/Y H:i') }}</p>
            @else
              <p class="text-sm text-gray-900"><span class="font-medium">Destino:</span> {{ $movimiento->destino }}</p>
              <p class="text-sm text-gray-900"><span class="font-medium">Tipo de Carga:</span> {{ $movimiento->tipo_carga }}</p>
              <p class="text-sm text-gray-900"><span class="font-medium">Fecha egreso:</span> {{ $movimiento->fecha_egreso?->format('d/m/Y H:i') }}</p>
              @if(!is_null($movimiento->kilometraje))
                <p class="text-sm text-gray-900"><span class="font-medium">Kilometraje:</span> {{ $movimiento->kilometraje }} km</p>
              @endif
            @endif
            @if($movimiento->observaciones)
              <p class="text-sm text-gray-900"><span class="font-medium">Observaciones:</span> {{ $movimiento->observaciones }}</p>
            @endif
          </div>
        </div>
      </div>

      <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-sm text-gray-500">
        <span>Registrado: {{ $movimiento->created_at?->format('d/m/Y H:i') }}</span>
      </div>
    </div>
  </div>
</div>
@endsection

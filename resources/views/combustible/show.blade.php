@extends('layouts.app')

@section('title', 'Detalle de Vale de Combustible')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-3xl sm:px-6 md:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-amber-600 to-yellow-500">
        <h1 class="text-2xl font-bold text-white">Detalle de Vale</h1>
        <p class="text-white/80 text-sm mt-1">Orden #{{ $vale->ordenTrabajo->numero_orden ?? $vale->orden_trabajo_id }} · Camión {{ $vale->ordenTrabajo->camion->placa ?? 'N/A' }}</p>
      </div>

      <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Información del Vale</h2>
            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
              <p class="text-sm text-gray-900"><span class="font-medium">Fecha:</span> {{ $vale->fecha_vale?->format('d/m/Y H:i') }}</p>
              <p class="text-sm text-gray-900"><span class="font-medium">Galones:</span> {{ number_format($vale->cantidad_galones, 2) }}</p>
              <p class="text-sm text-gray-900"><span class="font-medium">Precio/galón:</span> Q {{ number_format($vale->precio_galon, 2) }}</p>
              <p class="text-sm text-gray-900"><span class="font-medium">Total:</span> Q {{ number_format($vale->total, 2) }}</p>
            </div>
          </div>
          <div>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Observaciones</h2>
            <div class="bg-gray-50 rounded-lg p-4 min-h-[100px]">
              <p class="text-sm text-gray-900">{{ $vale->observaciones ?: '—' }}</p>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-between">
          <a href="{{ route('combustible.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Volver
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Movimientos')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">Movimientos</h1>
          <p class="mt-1 text-sm text-gray-600">Ingresos y egresos de camiones</p>
        </div>
        @if(auth()->user()->canCreate())
        <div class="space-x-2">
          <a href="{{ route('movimientos.ingresos.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Registrar Ingreso
          </a>
          <a href="{{ route('movimientos.egresos.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Registrar Egreso
          </a>
        </div>
        @endif
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
      <!-- Ingresos -->
      <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-semibold text-gray-900">Ingresos Recientes</h2>
        </div>
        <div class="divide-y divide-gray-200">
          @forelse($ingresos as $ing)
            <a href="{{ route('movimientos.show', ['tipo' => 'ingreso', 'id' => $ing->id]) }}" class="block hover:bg-gray-50">
              <div class="px-6 py-4 flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-900">{{ $ing->ordenTrabajo->camion->placa ?? 'N/A' }} · {{ $ing->origen }}</p>
                  <p class="text-xs text-gray-500 mt-1">{{ $ing->tipo_carga }} · {{ $ing->fecha_ingreso?->format('d/m/Y H:i') }}</p>
                </div>
                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Ingreso</span>
              </div>
            </a>
          @empty
            <div class="px-6 py-10 text-center text-sm text-gray-500">Sin ingresos registrados</div>
          @endforelse
        </div>
        <div class="px-6 py-3">{{ $ingresos->links() }}</div>
      </div>

      <!-- Egresos -->
      <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-semibold text-gray-900">Egresos Recientes</h2>
        </div>
        <div class="divide-y divide-gray-200">
          @forelse($egresos as $egr)
            <a href="{{ route('movimientos.show', ['tipo' => 'egreso', 'id' => $egr->id]) }}" class="block hover:bg-gray-50">
              <div class="px-6 py-4 flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-900">{{ $egr->ordenTrabajo->camion->placa ?? 'N/A' }} · {{ $egr->destino }}</p>
                  <p class="text-xs text-gray-500 mt-1">{{ $egr->tipo_carga }} · {{ $egr->fecha_egreso?->format('d/m/Y H:i') }}</p>
                </div>
                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">Egreso</span>
              </div>
            </a>
          @empty
            <div class="px-6 py-10 text-center text-sm text-gray-500">Sin egresos registrados</div>
          @endforelse
        </div>
        <div class="px-6 py-3">{{ $egresos->links() }}</div>
      </div>
    </div>
  </div>
</div>
@endsection

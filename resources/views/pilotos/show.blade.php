@extends('layouts.app')

@section('title', 'Detalle del Piloto')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-4xl sm:px-6 md:px-8">
    <!-- Header -->
    <div class="mb-6 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-2xl shadow-lg px-6 py-6">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-white">{{ $piloto->nombre }}</h1>
          <p class="mt-1 text-sm text-teal-100">Información detallada del piloto</p>
        </div>
        <div class="flex items-center space-x-3">
          @if(auth()->user()->canEdit())
            <a href="{{ route('pilotos.edit', $piloto) }}" class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg text-sm font-medium text-white hover:bg-white/30 transition">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
              </svg>
              Editar
            </a>
          @endif
          <a href="{{ route('pilotos.index') }}" class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg text-sm font-medium text-white hover:bg-white/30 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver
          </a>
        </div>
      </div>
    </div>

    <!-- Información Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Columna Izquierda - Info Básica -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Datos Personales -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
          <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-4">
            <h2 class="text-lg font-semibold text-white flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
              Datos Personales
            </h2>
          </div>
          <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nombre Completo</label>
                <p class="text-base font-semibold text-gray-900">{{ $piloto->nombre }}</p>
              </div>
              <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Licencia</label>
                <p class="text-base text-gray-900">{{ $piloto->licencia ?? 'No registrada' }}</p>
              </div>
              <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">DPI</label>
                <p class="text-base text-gray-900">{{ $piloto->dpi ?? 'No registrado' }}</p>
              </div>
              <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Teléfono</label>
                <p class="text-base text-gray-900">{{ $piloto->telefono ?? 'No registrado' }}</p>
              </div>
              <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email</label>
                <p class="text-base text-gray-900">{{ $piloto->email ?? 'No registrado' }}</p>
              </div>
              <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Transportista</label>
                <p class="text-base text-gray-900">
                  @if($piloto->transportista)
                    <a href="{{ route('transportistas.show', $piloto->transportista) }}" class="text-teal-600 hover:text-teal-800 font-semibold">
                      {{ $piloto->transportista->nombre }}
                    </a>
                  @else
                    <span class="text-gray-500">Sin asignar</span>
                  @endif
                </p>
              </div>
            </div>
            
            @if($piloto->direccion)
              <div class="pt-4 border-t border-gray-200">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Dirección</label>
                <p class="text-base text-gray-900">{{ $piloto->direccion }}</p>
              </div>
            @endif
          </div>
        </div>

        <!-- Historial de Vales (si existe relación) -->
        @if(method_exists($piloto, 'valesCombustible'))
          <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
              <h2 class="text-lg font-semibold text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Vales de Combustible
              </h2>
            </div>
            <div class="p-6">
              @php
                $vales = $piloto->valesCombustible()->latest()->take(5)->get();
              @endphp
              
              @if($vales->count() > 0)
                <div class="space-y-3">
                  @foreach($vales as $vale)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                      <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $vale->camion->placa ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500">{{ $vale->fecha_vale?->format('d/m/Y') }}</p>
                      </div>
                      <div class="text-right">
                        <p class="text-sm font-bold text-orange-600">{{ number_format($vale->cantidad_galones, 2) }} gal</p>
                        <p class="text-xs text-gray-500">Q{{ number_format($vale->total, 2) }}</p>
                      </div>
                    </div>
                  @endforeach
                  <a href="{{ route('combustible.index', ['piloto_id' => $piloto->id]) }}" class="block text-center text-sm text-teal-600 hover:text-teal-800 font-semibold mt-4">
                    Ver todos los vales →
                  </a>
                </div>
              @else
                <p class="text-sm text-gray-500 text-center py-8">No hay vales registrados</p>
              @endif
            </div>
          </div>
        @endif
      </div>

      <!-- Columna Derecha - Estado y Acciones -->
      <div class="space-y-6">
        <!-- Estado -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
          <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Estado</h3>
          </div>
          <div class="p-6">
            @if($piloto->active)
              <div class="flex items-center justify-center py-4">
                <div class="text-center">
                  <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                  </div>
                  <p class="text-lg font-bold text-green-700">ACTIVO</p>
                  <p class="text-xs text-gray-500 mt-1">Disponible para asignaciones</p>
                </div>
              </div>
            @else
              <div class="flex items-center justify-center py-4">
                <div class="text-center">
                  <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-3">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                  </div>
                  <p class="text-lg font-bold text-gray-700">INACTIVO</p>
                  <p class="text-xs text-gray-500 mt-1">No disponible</p>
                </div>
              </div>
            @endif
          </div>
        </div>

        <!-- Fechas de Registro -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
          <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Información del Sistema</h3>
          </div>
          <div class="p-6 space-y-4">
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Registrado</label>
              <p class="text-sm text-gray-900">{{ $piloto->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Última Actualización</label>
              <p class="text-sm text-gray-900">{{ $piloto->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
            </div>
          </div>
        </div>

        <!-- Acciones -->
        @if(auth()->user()->canDelete())
          <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-red-200">
            <div class="bg-red-50 px-6 py-4 border-b border-red-200">
              <h3 class="text-sm font-semibold text-red-700 uppercase tracking-wider">Zona de Peligro</h3>
            </div>
            <div class="p-6">
              <form action="{{ route('pilotos.destroy', $piloto) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este piloto? Esta acción no se puede deshacer.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                  Eliminar Piloto
                </button>
              </form>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

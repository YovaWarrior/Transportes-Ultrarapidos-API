@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header con gradiente -->
    <div class="relative overflow-hidden bg-gradient-to-r from-violet-600 to-purple-600 rounded-2xl mb-6 shadow-lg">
      <div class="px-6 py-8 sm:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Reportes y Exportaciones</h1>
            <p class="mt-2 text-sm text-violet-100">Análisis y descarga de datos en formato CSV</p>
          </div>
          <div class="hidden sm:block">
            <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
          </div>
        </div>

        <!-- Stats Cards dentro del header -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
          <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
            <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ $totalCamiones }}</div>
            <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Camiones</div>
          </div>
          <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
            <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ $totalIngresos }}</div>
            <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Ingresos</div>
          </div>
          <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
            <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ $totalEgresos }}</div>
            <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Egresos</div>
          </div>
          <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center border border-white/30">
            <div class="text-3xl font-bold text-white leading-none drop-shadow">{{ $totalVales }}</div>
            <div class="text-xs font-semibold tracking-wide uppercase text-white/90 mt-2 drop-shadow">Vales</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reportes Avanzados -->
    <div class="mb-8">
      <h2 class="text-xl font-bold text-gray-900 mb-4">Reportes Operativos</h2>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <a href="{{ route('reportes.ingresos') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition border-t-4 border-green-500">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-900">Ingresos por Predio</h3>
              <p class="text-sm text-gray-600 mt-2">Filtros por fecha y predio</p>
            </div>
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
          </div>
        </a>
        <a href="{{ route('reportes.egresos') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition border-t-4 border-blue-500">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-900">Egresos por Predio</h3>
              <p class="text-sm text-gray-600 mt-2">Filtros por fecha y predio</p>
            </div>
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
            </svg>
          </div>
        </a>
        <a href="{{ route('reportes.vales') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition border-t-4 border-amber-500">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-900">Vales de Combustible</h3>
              <p class="text-sm text-gray-600 mt-2">Por fecha, camión o piloto</p>
            </div>
            <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
            </svg>
          </div>
        </a>
        <a href="{{ route('reportes.viajes') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition border-t-4 border-purple-500">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-900">Viajes por Camión</h3>
              <p class="text-sm text-gray-600 mt-2">Total de viajes y km recorridos</p>
            </div>
            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
            </svg>
          </div>
        </a>
        <a href="{{ route('reportes.actividad') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-xl transition border-t-4 border-indigo-500">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-900">Actividad por Usuario</h3>
              <p class="text-sm text-gray-600 mt-2">Registros por usuario del sistema</p>
            </div>
            <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
          </div>
        </a>
      </div>
    </div>

    <!-- Exports -->
    <h2 class="text-xl font-bold text-gray-900 mb-4">Exportaciones CSV</h2>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <!-- Camiones -->
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Camiones</h3>
          <p class="mt-1 text-sm text-gray-500">Exportar todos los camiones con transportista</p>
        </div>
        <div class="px-6 py-4">
          <a href="{{ route('reportes.export.camiones') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 w-full justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Descargar CSV
          </a>
        </div>
      </div>

      <!-- Movimientos -->
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Movimientos</h3>
          <p class="mt-1 text-sm text-gray-500">Ingresos y egresos de camiones</p>
        </div>
        <div class="px-6 py-4">
          <a href="{{ route('reportes.export.movimientos') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 w-full justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Descargar CSV
          </a>
        </div>
      </div>

      <!-- Combustible -->
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Combustible</h3>
          <p class="mt-1 text-sm text-gray-500">Vales de combustible registrados</p>
        </div>
        <div class="px-6 py-4">
          <a href="{{ route('reportes.export.combustible') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700 w-full justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Descargar CSV
          </a>
        </div>
      </div>
    </div>

    <!-- Info -->
    <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
      <div class="flex">
        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
        <p class="ml-3 text-sm text-blue-700">Los archivos se descargarán en formato CSV. Puedes abrirlos en Excel, Google Sheets u otra aplicación de hojas de cálculo.</p>
      </div>
    </div>
  </div>
</div>
@endsection

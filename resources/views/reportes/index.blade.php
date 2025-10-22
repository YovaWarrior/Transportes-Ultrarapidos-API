@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Reportes y Exportaciones</h1>
      <p class="mt-1 text-sm text-gray-600">Descarga datos en formato CSV</p>
    </div>

    <!-- Resumen -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 mb-8">
      <div class="bg-white rounded-lg shadow p-6">
        <p class="text-xs text-gray-500 uppercase">Camiones</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalCamiones }}</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6">
        <p class="text-xs text-gray-500 uppercase">Ingresos</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalIngresos }}</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6">
        <p class="text-xs text-gray-500 uppercase">Egresos</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalEgresos }}</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6">
        <p class="text-xs text-gray-500 uppercase">Vales Combustible</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalVales }}</p>
      </div>
    </div>

    <!-- Reportes Avanzados -->
    <div class="mb-8">
      <h2 class="text-xl font-bold text-gray-900 mb-4">Reportes Operativos</h2>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <a href="{{ route('reportes.ingresos') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold text-green-700">Ingresos por Predio</h3>
          <p class="text-sm text-gray-600 mt-2">Filtros por fecha y predio</p>
        </a>
        <a href="{{ route('reportes.egresos') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold text-blue-700">Egresos por Predio</h3>
          <p class="text-sm text-gray-600 mt-2">Filtros por fecha y predio</p>
        </a>
        <a href="{{ route('reportes.vales') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold text-amber-700">Vales de Combustible</h3>
          <p class="text-sm text-gray-600 mt-2">Por fecha, camión o piloto</p>
        </a>
        <a href="{{ route('reportes.viajes') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold text-purple-700">Viajes por Camión</h3>
          <p class="text-sm text-gray-600 mt-2">Total de viajes y km recorridos</p>
        </a>
        <a href="{{ route('reportes.actividad') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
          <h3 class="text-lg font-semibold text-indigo-700">Actividad por Usuario</h3>
          <p class="text-sm text-gray-600 mt-2">Registros por usuario del sistema</p>
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

@extends('layouts.app')

@section('title', 'Reporte de Actividad por Usuario')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Actividad por Usuario</h1>
        <p class="mt-1 text-sm text-gray-600">Registros creados por usuario del sistema</p>
      </div>
      <a href="{{ route('reportes.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Volver a reportes</a>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Vales Registrados</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Estado</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($usuarios as $u)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $u->name }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $u->email }}</td>
              <td class="px-6 py-4 text-sm">
                @if($u->role == 'admin')
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full">Admin</span>
                @elseif($u->role == 'operativo')
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">Operativo</span>
                @else
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Piloto</span>
                @endif
              </td>
              <td class="px-6 py-4 text-sm text-gray-900 text-right font-semibold">{{ $u->vales_count ?? 0 }}</td>
              <td class="px-6 py-4 text-center">
                @if($u->active)
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
                @else
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactivo</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">No hay usuarios</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
      <p class="text-sm text-blue-700">
        <strong>Nota:</strong> En producción, este reporte usará la tabla `activity_logs` para mostrar toda la actividad del usuario (crear, editar, eliminar). Actualmente muestra solo vales registrados como ejemplo.
      </p>
    </div>
  </div>
</div>
@endsection

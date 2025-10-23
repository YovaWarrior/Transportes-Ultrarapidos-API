@extends('layouts.app')

@section('title', 'Logs de Actividad')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <!-- Header con gradiente -->
    <div class="relative overflow-hidden bg-gradient-to-r from-slate-700 to-gray-800 rounded-2xl mb-6 shadow-lg">
      <div class="px-6 py-8 sm:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Logs de Actividad del Sistema</h1>
            <p class="mt-2 text-sm text-slate-200">Auditoría completa de acciones realizadas</p>
          </div>
          <div class="hidden sm:block">
            <svg class="w-16 h-16 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-5 sm:gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
          <select name="user_id" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg focus:ring-slate-500 focus:border-slate-500">
            <option value="">Todos</option>
            @foreach($usuarios as $u)
              <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Acción</label>
          <select name="action" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg focus:ring-slate-500 focus:border-slate-500">
            <option value="">Todas</option>
            @foreach($acciones as $a)
              <option value="{{ $a }}" {{ request('action') == $a ? 'selected' : '' }}>{{ ucfirst($a) }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Desde</label>
          <input type="date" name="desde" value="{{ request('desde') }}" class="block w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Hasta</label>
          <input type="date" name="hasta" value="{{ request('hasta') }}" class="block w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-slate-500 focus:border-slate-500">
        </div>
        <div class="flex items-end">
          <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-slate-700 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Filtrar
          </button>
        </div>
      </form>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha/Hora</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acción</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modelo</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">IP</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($logs as $log)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $log->user->name ?? 'Sistema' }}</td>
                <td class="px-6 py-4 text-sm">
                  @if($log->action == 'login')
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Login</span>
                  @elseif($log->action == 'logout')
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Logout</span>
                  @elseif($log->action == 'created')
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">Creado</span>
                  @elseif($log->action == 'updated')
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Actualizado</span>
                  @elseif($log->action == 'deleted')
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Eliminado</span>
                  @else
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">{{ ucfirst($log->action) }}</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $log->description }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                  @if($log->model_type)
                    {{ class_basename($log->model_type) }} #{{ $log->model_id }}
                  @else
                    —
                  @endif
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $log->ip_address }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">No hay registros de actividad</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="px-6 py-3">{{ $logs->links() }}</div>
    </div>

    <!-- Info -->
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
      <p class="text-sm text-blue-700">
        <strong>Nota:</strong> Los logs se registran automáticamente para login/logout. Para registrar automáticamente acciones de crear/editar/eliminar en modelos, puedes agregar observers o eventos.
      </p>
    </div>
  </div>
</div>
@endsection

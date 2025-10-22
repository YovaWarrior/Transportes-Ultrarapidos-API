@extends('layouts.app')

@section('title', 'Logs de Actividad')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Logs de Actividad del Sistema</h1>
      <p class="mt-1 text-sm text-gray-600">Auditoría completa de acciones realizadas</p>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-5">
        <div>
          <label class="block text-sm font-medium text-gray-700">Usuario</label>
          <select name="user_id" class="mt-1 block w-full rounded-lg border-gray-300">
            <option value="">Todos</option>
            @foreach($usuarios as $u)
              <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Acción</label>
          <select name="action" class="mt-1 block w-full rounded-lg border-gray-300">
            <option value="">Todas</option>
            @foreach($acciones as $a)
              <option value="{{ $a }}" {{ request('action') == $a ? 'selected' : '' }}>{{ ucfirst($a) }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Desde</label>
          <input type="date" name="desde" value="{{ request('desde') }}" class="mt-1 block w-full rounded-lg border-gray-300">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Hasta</label>
          <input type="date" name="hasta" value="{{ request('hasta') }}" class="mt-1 block w-full rounded-lg border-gray-300">
        </div>
        <div class="flex items-end">
          <button class="w-full px-4 py-2 text-sm font-medium text-white bg-gray-700 rounded-lg hover:bg-gray-800">Filtrar</button>
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

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
    <div class="bg-white rounded-lg shadow overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-violet-600 to-purple-600">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Usuario</th>
            <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Email</th>
            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Rol</th>
            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Total</th>
            <th class="px-3 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Login</th>
            <th class="px-3 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Logout</th>
            <th class="px-3 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Crear</th>
            <th class="px-3 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Editar</th>
            <th class="px-3 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Eliminar</th>
            <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Última Actividad</th>
            <th class="px-4 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Estado</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($usuarios as $item)
            <tr class="hover:bg-violet-50 transition-colors">
              <td class="px-4 py-4 text-sm font-semibold text-gray-900">{{ $item['usuario']->name }}</td>
              <td class="px-4 py-4 text-sm text-gray-700">{{ $item['usuario']->email }}</td>
              <td class="px-4 py-4 text-sm text-center">
                @if($item['usuario']->role == 'admin')
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold text-purple-800 bg-purple-100 rounded-full">👑 Admin</span>
                @elseif($item['usuario']->role == 'operativo')
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">🏢 Operativo</span>
                @else
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold text-teal-800 bg-teal-100 rounded-full">👨‍✈️ Piloto</span>
                @endif
              </td>
              <td class="px-4 py-4 text-center">
                <span class="inline-flex items-center px-3 py-1.5 text-sm font-bold text-violet-700 bg-violet-100 rounded-lg">
                  {{ $item['total_acciones'] }}
                </span>
              </td>
              <td class="px-3 py-4 text-center text-sm font-medium text-blue-600">{{ $item['login'] }}</td>
              <td class="px-3 py-4 text-center text-sm font-medium text-gray-600">{{ $item['logout'] }}</td>
              <td class="px-3 py-4 text-center text-sm font-medium text-green-600">{{ $item['create'] }}</td>
              <td class="px-3 py-4 text-center text-sm font-medium text-amber-600">{{ $item['update'] }}</td>
              <td class="px-3 py-4 text-center text-sm font-medium text-red-600">{{ $item['delete'] }}</td>
              <td class="px-4 py-4 text-sm text-gray-700">
                @if($item['ultima_actividad'])
                  <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $item['ultima_actividad']->format('d/m/Y H:i') }}</span>
                  </div>
                @else
                  <span class="text-gray-400 italic">Sin actividad</span>
                @endif
              </td>
              <td class="px-4 py-4 text-center">
                @if($item['usuario']->active)
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>
                    Activo
                  </span>
                @else
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                    <span class="w-2 h-2 bg-gray-400 rounded-full mr-1.5"></span>
                    Inactivo
                  </span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="11" class="px-6 py-12 text-center">
                <div class="flex flex-col items-center">
                  <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                  </svg>
                  <p class="text-sm text-gray-500">No hay usuarios registrados</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Leyenda de acciones -->
    <div class="mt-6 bg-gradient-to-r from-violet-50 to-purple-50 border-2 border-violet-200 p-6 rounded-xl">
      <h3 class="text-sm font-bold text-violet-900 mb-3 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Tipos de Acciones Registradas
      </h3>
      <div class="grid grid-cols-2 md:grid-cols-6 gap-3 text-xs">
        <div class="flex items-center space-x-2">
          <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
          <span class="text-gray-700"><strong>Login:</strong> Inicio de sesión</span>
        </div>
        <div class="flex items-center space-x-2">
          <span class="w-3 h-3 bg-gray-500 rounded-full"></span>
          <span class="text-gray-700"><strong>Logout:</strong> Cerrar sesión</span>
        </div>
        <div class="flex items-center space-x-2">
          <span class="w-3 h-3 bg-green-500 rounded-full"></span>
          <span class="text-gray-700"><strong>Crear:</strong> Registros nuevos</span>
        </div>
        <div class="flex items-center space-x-2">
          <span class="w-3 h-3 bg-amber-500 rounded-full"></span>
          <span class="text-gray-700"><strong>Editar:</strong> Modificaciones</span>
        </div>
        <div class="flex items-center space-x-2">
          <span class="w-3 h-3 bg-red-500 rounded-full"></span>
          <span class="text-gray-700"><strong>Eliminar:</strong> Solo Admin</span>
        </div>
        <div class="flex items-center space-x-2">
          <span class="w-3 h-3 bg-violet-500 rounded-full"></span>
          <span class="text-gray-700"><strong>Total:</strong> Todas las acciones</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Transportistas')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Transportistas</h1>
        <p class="mt-1 text-sm text-gray-600">Empresas e independientes</p>
      </div>
      <div>
        <a href="{{ route('transportistas.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Nuevo Transportista
        </a>
      </div>
    </div>

    <!-- Filtros -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Buscar</label>
          <input type="text" name="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600" placeholder="Nombre, NIT, teléfono, email">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Tipo</label>
          <select name="tipo" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
            <option value="todos" {{ request('tipo') == 'todos' ? 'selected' : '' }}>Todos</option>
            <option value="empresa" {{ request('tipo') == 'empresa' ? 'selected' : '' }}>Empresa</option>
            <option value="independiente" {{ request('tipo') == 'independiente' ? 'selected' : '' }}>Independiente</option>
          </select>
        </div>
        <div class="flex items-end space-x-2">
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Filtrar</button>
          @if(request()->hasAny(['search','tipo']))
          <a href="{{ route('transportistas.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Limpiar</a>
          @endif
        </div>
      </form>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($transportistas as $t)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">{{ $t->nombre }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($t->tipo) }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $t->telefono ?: '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $t->email ?: '—' }}</td>
                <td class="px-6 py-4 text-center">
                  @if($t->active)
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
                  @else
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactivo</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                  <a href="{{ route('transportistas.show', $t->id) }}" class="text-indigo-700 hover:text-indigo-900 text-sm font-medium">Ver</a>
                  <a href="{{ route('transportistas.edit', $t->id) }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Editar</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">No hay transportistas</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="px-6 py-3">{{ $transportistas->links() }}</div>
    </div>
  </div>
</div>
@endsection

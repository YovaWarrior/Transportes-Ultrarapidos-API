@extends('layouts.app')

@section('title', 'Pilotos')

@section('content')
<div class="py-6">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Pilotos</h1>
        <p class="mt-1 text-sm text-gray-600">Asociados a transportistas</p>
      </div>
      <div>
        <a href="{{ route('pilotos.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Nuevo Piloto
        </a>
      </div>
    </div>

    <div class="mb-6 bg-white rounded-lg shadow p-4">
      <form method="GET" class="flex items-center space-x-4">
        <div class="flex-1">
          <input type="text" name="search" value="{{ request('search') }}" class="block w-full rounded-lg border-gray-300 focus:border-teal-600 focus:ring-teal-600" placeholder="Buscar por nombre, licencia, DPI o transportista...">
        </div>
        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700">Buscar</button>
      </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Licencia</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transportista</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3"></th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($pilotos as $p)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $p->nombre }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $p->licencia ?: '—' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $p->transportista->nombre ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $p->telefono ?: '—' }}</td>
              <td class="px-6 py-4 text-center">
                @if($p->active)
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
                @else
                  <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">Inactivo</span>
                @endif
              </td>
              <td class="px-6 py-4 text-right space-x-2">
                <a href="{{ route('pilotos.show', $p->id) }}" class="text-teal-700 hover:text-teal-900 text-sm font-medium">Ver</a>
                <a href="{{ route('pilotos.edit', $p->id) }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Editar</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">No hay pilotos registrados</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <div class="px-6 py-3">{{ $pilotos->links() }}</div>
    </div>
  </div>
</div>
@endsection

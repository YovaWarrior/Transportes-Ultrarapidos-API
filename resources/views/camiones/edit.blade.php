@extends('layouts.app')

@section('title', 'Editar Camión')

@section('content')
<div class="py-6">
    <div class="px-4 mx-auto max-w-3xl sm:px-6 md:px-8">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('camiones.show', $camion->id) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al detalle
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-6">
                <h1 class="text-2xl font-bold text-white">Editar Camión</h1>
                <p class="mt-1 text-sm text-blue-100">Modificar datos del vehículo {{ $camion->placa }}</p>
            </div>

            <!-- Form -->
            <form action="{{ route('camiones.update', $camion->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Información Básica -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Placa -->
                        <div class="sm:col-span-2">
                            <label for="placa" class="block text-sm font-medium text-gray-700">
                                Placa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="placa" id="placa" value="{{ old('placa', $camion->placa) }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('placa') border-red-500 @enderror" 
                                placeholder="P-001AAA" required>
                            @error('placa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Formato: P-###XXX, C-###XXX, TC-###XXX, etc.</p>
                        </div>

                        <!-- Marca -->
                        <div>
                            <label for="marca" class="block text-sm font-medium text-gray-700">
                                Marca <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="marca" id="marca" value="{{ old('marca', $camion->marca) }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('marca') border-red-500 @enderror" 
                                placeholder="Volvo" required>
                            @error('marca')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Modelo -->
                        <div>
                            <label for="modelo" class="block text-sm font-medium text-gray-700">
                                Modelo <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $camion->modelo) }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('modelo') border-red-500 @enderror" 
                                placeholder="FH16" required>
                            @error('modelo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Año -->
                        <div>
                            <label for="año" class="block text-sm font-medium text-gray-700">
                                Año <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="año" id="año" value="{{ old('año', $camion->año) }}" 
                                min="1990" max="{{ date('Y') + 1 }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('año') border-red-500 @enderror" 
                                required>
                            @error('año')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacidad -->
                        <div>
                            <label for="capacidad" class="block text-sm font-medium text-gray-700">
                                Capacidad (toneladas) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="capacidad" id="capacidad" value="{{ old('capacidad', $camion->capacidad) }}" 
                                step="0.01" min="0"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('capacidad') border-red-500 @enderror" 
                                placeholder="40" required>
                            @error('capacidad')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tipo y Estado -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Tipo y Estado</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Tipo -->
                        <div>
                            <label for="tipo" class="block text-sm font-medium text-gray-700">
                                Tipo de Camión <span class="text-red-500">*</span>
                            </label>
                            <select name="tipo" id="tipo" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('tipo') border-red-500 @enderror">
                                <option value="">Seleccione un tipo</option>
                                <option value="plataforma" {{ old('tipo', $camion->tipo) === 'plataforma' ? 'selected' : '' }}>Plataforma</option>
                                <option value="furgón" {{ old('tipo', $camion->tipo) === 'furgón' ? 'selected' : '' }}>Furgón</option>
                                <option value="refrigerado" {{ old('tipo', $camion->tipo) === 'refrigerado' ? 'selected' : '' }}>Refrigerado</option>
                                <option value="tanque" {{ old('tipo', $camion->tipo) === 'tanque' ? 'selected' : '' }}>Tanque</option>
                                <option value="carga_general" {{ old('tipo', $camion->tipo) === 'carga_general' ? 'selected' : '' }}>Carga General</option>
                            </select>
                            @error('tipo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700">
                                Estado <span class="text-red-500">*</span>
                            </label>
                            <select name="estado" id="estado" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('estado') border-red-500 @enderror">
                                <option value="activo" {{ old('estado', $camion->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="mantenimiento" {{ old('estado', $camion->estado) === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="fuera_servicio" {{ old('estado', $camion->estado) === 'fuera_servicio' ? 'selected' : '' }}>Fuera de Servicio</option>
                            </select>
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Transportista -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Asignación</h2>
                    <div>
                        <label for="transportista_id" class="block text-sm font-medium text-gray-700">
                            Transportista <span class="text-red-500">*</span>
                        </label>
                        <select name="transportista_id" id="transportista_id" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('transportista_id') border-red-500 @enderror">
                            <option value="">Seleccione un transportista</option>
                            @foreach($transportistas as $transportista)
                                <option value="{{ $transportista->id }}" {{ old('transportista_id', $camion->transportista_id) == $transportista->id ? 'selected' : '' }}>
                                    {{ $transportista->nombre }} ({{ ucfirst($transportista->tipo) }})
                                </option>
                            @endforeach
                        </select>
                        @error('transportista_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('camiones.show', $camion->id) }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Actualizar Camión
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Validación de placa en tiempo real
    document.getElementById('placa').addEventListener('input', function(e) {
        const value = e.target.value.toUpperCase();
        e.target.value = value;
        
        const regex = /^(P|C|TC|M|A|O|CD|CC)-\d{0,3}[A-Z]{0,3}$/;
        if (value && !regex.test(value)) {
            e.target.classList.add('border-red-500');
        } else {
            e.target.classList.remove('border-red-500');
        }
    });
</script>
@endpush
@endsection

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Transportes Ultrarrápidos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-600 rounded-full mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white">Transportes Ultrarrápidos</h1>
            <p class="text-gray-400 mt-2">Sistema de Control de Flota</p>
        </div>

        <!-- Card de Login -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Iniciar Sesión</h2>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition @error('email') border-red-500 @enderror" 
                        placeholder="usuario@ejemplo.com"
                        required
                        autofocus
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition @error('password') border-red-500 @enderror" 
                        placeholder="••••••••"
                        required
                    >
                </div>

                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember" 
                        class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Recordarme
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-[1.02]"
                >
                    Iniciar Sesión
                </button>
            </form>

            <!-- Info de usuarios de prueba -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    <strong>Usuarios de prueba:</strong><br>
                    Admin: admin@transportes.com / admin123<br>
                    Operativo: operativo@transportes.com / operativo123<br>
                    Piloto: piloto@transportes.com / piloto123
                </p>
            </div>
        </div>

        <p class="text-center text-gray-500 text-sm mt-6">
            © 2025 Transportes Ultrarrápidos S.A.
        </p>
    </div>
</body>
</html>

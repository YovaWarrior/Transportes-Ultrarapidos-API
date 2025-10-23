<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermissions
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = auth()->user();

        // Verificar permisos según el tipo
        switch ($permission) {
            case 'create':
                if (!$user->canCreate()) {
                    return redirect()->back()->with('error', 'No tienes permisos para crear este recurso.');
                }
                break;

            case 'edit':
                if (!$user->canEdit()) {
                    return redirect()->back()->with('error', 'No tienes permisos para editar este recurso.');
                }
                break;

            case 'delete':
                if (!$user->canDelete()) {
                    return redirect()->back()->with('error', 'No tienes permisos para eliminar este recurso.');
                }
                break;

            case 'admin':
                if (!$user->isAdmin()) {
                    return redirect()->route('dashboard')->with('error', 'Solo los administradores pueden acceder a esta sección.');
                }
                break;
        }

        return $next($request);
    }
}

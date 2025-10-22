<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Solo administradores pueden ver logs
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permisos para ver los logs del sistema.');
        }

        $query = ActivityLog::with('user')->latest();

        // Filtros
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $logs = $query->paginate(50)->withQueryString();
        $usuarios = User::orderBy('name')->get();
        $acciones = ['login', 'logout', 'created', 'updated', 'deleted'];

        return view('logs.index', compact('logs', 'usuarios', 'acciones'));
    }
}

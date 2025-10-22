<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            
            if (!$user->active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Tu cuenta está desactivada.'])->withInput();
            }

            $request->session()->regenerate();
            
            // Log login activity
            ActivityLog::log('login', null, 'Usuario inició sesión: ' . $user->name);
            
            return redirect()->intended(route('dashboard'))->with('success', 'Bienvenido, ' . $user->name);
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        $userName = Auth::user()->name ?? 'Usuario';
        
        // Log logout activity before logging out
        ActivityLog::log('logout', null, 'Usuario cerró sesión: ' . $userName);
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}

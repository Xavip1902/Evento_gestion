<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        // Si ya está autenticado, redirigir a principal
        if (Auth::check()) {
            return redirect()->route('principal');
        }
        
        return view('auth.login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            if (Auth::check()) {
                return redirect()->route('principal')->with('success', '¡Bienvenido!');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'name' => 'Error inesperado en la autenticación.',
                ]);
            }
        }

        return back()->withErrors([
            'name' => 'Credenciales incorrectas.',
        ])->onlyInput('name');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Has cerrado sesión exitosamente.');
    }

    // Ejemplo de acción protegida
    public function algunaAccionProtegida(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta función.');
        }
        
        // Resto del código para usuarios autenticados
        return view('accion_protegida')->with('message', 'Acceso concedido a la acción protegida');
    }
}
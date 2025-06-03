<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login'); // crea esta vista con tu formulario
    }

    // Procesar el login
    public function login(Request $request)
    {
        // Validar datos
        $credentials = $request->validate([
            'name' => ['required', 'string'],       // si usas 'name' como username
            'password' => ['required', 'string'],
        ]);

        // Intentar autenticar
        if (Auth::attempt($credentials)) {
            // Regenerar sesión para evitar fijación de sesión
            $request->session()->regenerate();

            // Redirigir a la página que intentaba acceder o /home
            return redirect()->intended('principal');
        }

        // Si falla, regresar con error
        return back()->withErrors([
            'name' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('name');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

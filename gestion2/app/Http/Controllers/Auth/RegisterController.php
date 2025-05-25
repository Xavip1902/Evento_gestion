<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirección después del registro
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Constructor - aplica middleware de invitado
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validador de datos de registro
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'], // Solo letras y espacios
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'], // Validación estricta de email
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(), // Verifica contra contraseñas comprometidas
            ],
        ]);
    }

    /**
     * Crea un nuevo usuario después de validación exitosa
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Crear usuario con contraseña hasheada
        $user = User::create([
            'name' => htmlspecialchars($data['name']), // Prevención XSS
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Hash seguro con bcrypt
        ]);

        // Asignación segura de rol con fallback
        $defaultRole = Role::where('name', 'user')->firstOr(function () {
            // Crear rol user si no existe (fallback)
            return Role::create([
                'name' => 'user',
                'description' => 'Usuario regular'
            ]);
        });

        $user->role()->associate($defaultRole);
        $user->save();

        return $user;
    }

    /**
     * El usuario ha sido registrado
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered($request, $user)
    {
        // Opcional: Enviar email de verificación
        // $user->sendEmailVerificationNotification();
        
        return redirect($this->redirectPath())
            ->with('success', '¡Registro exitoso! Bienvenido/a ' . $user->name);
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Obtener el usuario autenticado
            $user = Auth::user();

            if ($user->rol === 'admin') {
                return redirect()->intended('/dashboard');
            }

            if (!$user->is_approved) {
                Auth::logout();

                //crea esa ruta de approval.wait en web y descomentalo, despues crea ese archivo
                //return redirect()->route('login')->with('message', 'Tu cuenta está en espera de aprobación.');
                return redirect()->route('approval.wait')->with('message', 'Tu cuenta está en espera de aprobación.');

            }

            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Las credenciales no son correctas.']);
    }
}

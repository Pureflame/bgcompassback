<?php

namespace App\Http\Middleware\Register;

use Closure;
use Illuminate\Http\Request;

class RegisterUsuarioValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'nombre_usuario' => ['required','string','min:2','max:20','regex:/^[a-zA-Z ]+$/'],
            'contrasenha_usuario' => ['required','string','min:10','max:255','regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#¿?¡!*_\-$%^&+=]).*$/'],
            'correo_usuario' => ['required','string','email:rfc,dns'],
            'tipo_usuario' => ['required','string'],
        ]);
        
        return $next($request);
    }
}

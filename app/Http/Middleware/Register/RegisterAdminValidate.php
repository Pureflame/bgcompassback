<?php

namespace App\Http\Middleware\Register;

use Closure;
use Illuminate\Http\Request;

class RegisterAdminValidate
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
            'dni_admin' => ['required','string','regex:/(^[0-9]{8}[A-Z]{1}$)/'],
            'nombre_admin' => ['required','string','min:2','max:20','regex:/^[a-zA-Z ]+$/'],
            'apellidos_admin' => ['required','string','min:2','max:40','regex:/^[a-zA-Z ]+$/'],
            'contrasenha_admin' => ['required','string','min:10','max:255','regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#¿?¡!*_\-$%^&+=]).*$/'],
            'correo_admin' => ['required','string','email:rfc,dns'],
            'telefono_admin' => ['nullable','string','regex:/^[0-9+]{9,12}$/'],
            'tipo_usuario' => ['required','string'],
        ]);
        
        return $next($request);
    }
}

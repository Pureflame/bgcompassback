<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class partidaGeneralGloomhavenValidate
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
            'nombre_partida' => ['required','string','min:4', 'max:255','regex:/^(?=.*[0-9a-zA-Z ]).*$/'],
            'prosperidad_ciudad_partida_gh' => ['required','string','min:0','max:6','regex:/^(?=.*[0-9]).*$/'],
            'nombre_mision_gh' => ['required','string','max:255','regex:/^(?=.*[0-9a-zA-Z ]).*$/'],
            'logros_globales.*' => ['required','string','max:255','regex:/^(?=.*[0-9a-zA-Z ]).*$/'],
        ]);
        return $next($request);
    }
}

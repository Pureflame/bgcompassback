<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class partidaHeroeDescentValidate
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
            'habilidades_clase' => ['present','array','regex:/^(?=.*[ ])(?=.*[a-z])(?=.*[A-Z]).*$/'],
            'equipo_heroe' => ['present','array','regex:/^(?=.*[ ])(?=.*[a-z])(?=.*[A-Z]).*$/'],
            'id_heroe_dc' => ['required','string','regex:/^(?=.*[0-9]).*$/'],
        ]);

        return $next($request);
    }
}

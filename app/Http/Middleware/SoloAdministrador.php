<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class SoloAdministrador
{
    /**
     * Solo permite acceso a usuarios con rol 'administrador'.
     * El resto es redirigido al dashboard con un mensaje de error.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */
        // Usar el usuario obtenido desde la request para evitar advertencias de analizadores
        $user = $request->user();

        // Evitar llamada a auth()->check() que algunos analizadores consideran indefinida;
        // basta con comprobar si $user es null y su rol.
        if (!$user || $user->rol !== 'administrador') {
            return redirect()->route('dashboard')
                ->with('error', 'Acceso restringido: esta sección es solo para administradores.');
        }

        return $next($request);
    }
}

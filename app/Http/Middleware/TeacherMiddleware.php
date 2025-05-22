<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isTeacher()) {
            abort(403, 'Acesso negado. Somente professores podem acessar esta área.');
        }

        return $next($request);
    }
}

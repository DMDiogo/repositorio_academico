<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserApproval
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Se o usuário for admin, não precisa de aprovação
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Se o usuário não estiver aprovado e não for admin, redireciona para uma página de espera
        if (!$user->approved) {
            return redirect()->route('approval.pending');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LotAccess
{

    /**
     * Проверка есть ли доступ к страницам
     */
    public function handle($request, Closure $next)
    {
        $user = $user = Auth::user();
        if (isset($user) && $user->flag_is_admin
        ) {
            return $next($request);
        }
        return redirect('/');
    }
}

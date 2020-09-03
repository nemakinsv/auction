<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuctionAccess
{

    /**
     * Проверка есть ли доступ к страницам
     */
    public function handle($request, Closure $next)
    {
        $user = $user = Auth::user();
        if (isset($user)) {
            return $next($request);
        }
        return redirect('/');
    }
}

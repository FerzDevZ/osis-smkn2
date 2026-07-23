<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\ExperienceManager;
use Illuminate\Support\Facades\Cache;

class GiveLoginXP
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cacheKey = 'last_login_xp_' . $user->id;
            
            if (!Cache::has($cacheKey)) {
                ExperienceManager::addXp($user, 10); // Give 10 XP for first login of the day
                Cache::put($cacheKey, true, now()->endOfDay());
            }
        }

        return $next($request);
    }
}

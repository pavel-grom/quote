<?php

namespace App\Http\Middleware;

use App\Events\ApiRequestHit;
use App\Models\User;
use Closure;

class ApiRequestStat
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        event(new ApiRequestHit($user, now()));

        return $next($request);
    }
}

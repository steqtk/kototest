<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class KeyTokenAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->header('key');
        $user = User::where(['key' => $key])->first();
        if ($user) {
            \Auth::login($user);
            return $next($request);
        }
        throw new AuthenticationException();
    }
}

<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                if ($user->role === 'admin' || $user->role === 'perusahaan') {
                    switch ($user->role) {
                        case 'admin':
                            return redirect()->route('admin.dashboard');
                        case 'perusahaan':
                            return redirect()->route('perusahaan.dashboard');
                        default:
                            return redirect(RouteServiceProvider::HOME);
                    }
                }

                if (! $user->hasVerifiedEmail()) {
                    return redirect()->route('verification.notice');
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}

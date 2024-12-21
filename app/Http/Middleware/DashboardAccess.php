<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         // to prevent user enter dashboard

        $user = $request->user();

         // if not login
        if (!$user) {
            return redirect()->route('login');
        }

        // if user error not progress
        if ($user->role == 'user') {
            abort(403);
        }

        if($user->role == 'admin' || $user->role == 'super_admin'){
            return $next($request);
        }
    }
}

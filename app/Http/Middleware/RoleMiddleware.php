<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->level == $this->mapRoleToLevel($role)) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You do not have access to this page.');
    }

    /**
     * Map the role string to the user level.
     *
     * @param  string  $role
     * @return int
     */
    private function mapRoleToLevel($role)
    {
        switch ($role) {
            case 'supervisor':
                return 3; // Supervisor level mapping
            case 'superadmin':
                return 2;
            case 'admin':
                return 1;
            case 'user':
                return 0;
            default:
                return -1; // Invalid role
        }
    }
}

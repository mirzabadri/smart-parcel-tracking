<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoles = [User::ROLE_SUPERVISOR, User::ROLE_DRIVER, User::ROLE_SORTER];
        
        if ($request->user() && !in_array($request->user()->role, $allowedRoles)) {
            return redirect('/staff/unauthorized');
        }
        
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $userRole = Auth::user()->role->name;
        if ($userRole && !in_array($userRole, $roles)) {
            abort(403, 'Sizda ushbu sahifaga kirish huquqi yo\'q.'); 
        }

        return $next($request);
    }
}


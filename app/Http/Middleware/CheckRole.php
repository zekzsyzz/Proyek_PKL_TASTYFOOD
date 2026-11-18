<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{

    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('login')->withErrors(['email' => 'anda tidak memiliki akses ke halaman index admin.']);
        }
        return $next($request);
    }
}

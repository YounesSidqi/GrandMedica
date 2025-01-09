<?php

namespace App\Http\Middleware;

use App\Models\Products;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProducts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Products::check()) {
            return redirect('/'); // Pastikan URL ini benar dan bisa diakses
        }

        return $next($request);
    }
}

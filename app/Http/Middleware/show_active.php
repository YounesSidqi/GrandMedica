<?php

namespace App\Http\Middleware;

use App\Models\Products;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class show_active
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $status = Products::where('id', $request->id)->first();

    if($status && $status->show_products == true) {
        return $next($request);
    }

    return redirect()->back()->with('error', 'Product is not accessible.');
}

}

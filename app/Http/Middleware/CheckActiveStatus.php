<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActiveStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $context = null)
    {
        if(Auth::user()->status == ($context == 'customer' ? CUSTOMER_INACTIVE : DRIVER_INACTIVE)){
            return response()->json([
                'success' => 0,
                'message' => 'Account Suspended'
            ]);
        }

        return $next($request);
    }
}

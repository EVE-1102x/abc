<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check())
        {
            if (Auth::user()->role_as == '1') //1 = Employee & 0 = user
            {
                return $next($request);
            }
            else
            {
                return redirect('/home')->with('status','Access Denied!');
            }
        }
        else
        {
            return redirect('/login')->with('status','Please login first!');
        }
    }
}

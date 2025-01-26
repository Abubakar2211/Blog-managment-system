<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Checking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user(); 

        if ($user && in_array($user->role->name ,['Admin','Author'])) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}

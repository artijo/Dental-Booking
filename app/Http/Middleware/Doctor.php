<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Doctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->session()->has('doctor_id') && !$request->session()->has('idcard')){
            return $next($request);
        }elseif($request->session()->has('idcard')){
            return redirect('/');
        }
        return redirect('/admin/login');
    }
}

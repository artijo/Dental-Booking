<?php

namespace App\Http\Middleware;

use App\Models\Doctor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Support
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('supportid') && !$request->session()->has('idcard')){
            return $next($request);
        }elseif($request->session()->has('idcard')){
        return redirect('/');
    }else{
        return redirect()->route('supports.login');
    }
    
    }
}

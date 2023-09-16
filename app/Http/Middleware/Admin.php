<?php

namespace App\Http\Middleware;

use App\Models\Support;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $support = Support::where('support_id',session('supportid'))->get()->first();
        $level = $support->level;
        if (!$request->session()->has('supportid') || $level == 1) {
            return abort('403');
        }elseif($request->session()->has('idcard')){
            session()->pull('support_id');
            return redirect('/user');
        }
        return $next($request);
    }
}

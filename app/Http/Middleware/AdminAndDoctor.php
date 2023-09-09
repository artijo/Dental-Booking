<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Support;

class AdminAndDoctor
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
        if (!$request->session()->has('doctor_id') || $level == 1) {
            return redirect('/admin/login');
        }
        return $next($request);
    }
}

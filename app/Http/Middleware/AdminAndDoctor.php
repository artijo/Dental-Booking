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
        if ($support == null) {
            $level = 1;
        }else{
            $level = $support->level;
        }

        if ($request->session()->has('doctor_id')) {
            return $next($request);
        }elseif ($request->session()->has('supportid') && $level == 0) {
            return $next($request);
        }
        return redirect('/admin/login');
    }
}

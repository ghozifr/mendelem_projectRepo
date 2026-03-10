<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }
        if (!Auth::user()->is_active) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Akun tidak aktif.');
        }
        return $next($request);
    }
}
// namespace App\Http\Middleware;
// use Closure; use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth;
// class AdminMiddleware
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (!Auth::check()) {
//             return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
//         }
//         if (!Auth::user()->is_active) {
//             Auth::logout();
//             return redirect()->route('admin.login')->with('error', 'Akun tidak aktif.');
//         }
//         if (!in_array(Auth::user()->role, ['superadmin', 'admin', 'editor'])) {
//             abort(403, 'Akses ditolak.');
//         }
//         return $next($request);
//     }
// }

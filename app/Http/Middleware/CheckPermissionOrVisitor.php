<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckPermissionOrVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Jika pengguna adalah tamu atau memiliki izin yang diperlukan, lanjutkan permintaan
        if (Auth::guest() || (Auth::check() && Auth::user()->can($permission))) {
            return $next($request);
        }

        // Jika pengguna terautentikasi tetapi tidak memiliki izin yang diperlukan, kembalikan ke halaman yang diinginkan
        if (Auth::check()) {
            // Ganti 'home' dengan route yang diinginkan jika pengguna tidak memiliki izin yang diperlukan
            return $next($request);
        }

        // Jika tidak ada yang cocok, batalkan akses
        return abort(403, 'Unauthorized action.');
    }
}

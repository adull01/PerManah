<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            // Redirect ke halaman login berdasarkan role yang diminta
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.login');
                case 'petugas':
                    return redirect()->route('petugas.login');
                case 'anggota':
                    return redirect()->route('anggota.login');
                default:
                    return redirect()->route('landing');
            }
        }

        // Cek apakah user memiliki role yang sesuai
        if (Auth::user()->role !== $role) {
            // Redirect ke dashboard mereka sendiri
            $userRole = Auth::user()->role;
            switch ($userRole) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                case 'petugas':
                    return redirect()->route('petugas.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                case 'anggota':
                    return redirect()->route('anggota.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                default:
                    Auth::logout();
                    return redirect()->route('landing');
            }
        }

        return $next($request);
    }
}

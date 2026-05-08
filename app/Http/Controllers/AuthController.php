<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectUserByRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Status Check for Anggota
            if ($user->role === 'anggota' && $user->status !== 'active') {
                $statusMessage = $user->status === 'pending' 
                    ? 'Akun Anda masih dalam proses peninjauan. Silakan tunggu konfirmasi dari petugas.'
                    : 'Akun Anda telah ditolak. Alasan: ' . ($user->rejection_reason ?? 'Tidak disebutkan.');
                
                Auth::logout();
                return back()->withErrors(['email' => $statusMessage])->withInput($request->only('email'));
            }

            $request->session()->regenerate();
            return $this->redirectUserByRole($user);
        }

        return back()->withErrors(['email' => 'Email atau password yang Anda masukkan salah.'])->withInput($request->only('email'));
    }

    public function showAdminLogin()
    {
        return redirect()->route('login');
    }

    public function showPetugasLogin()
    {
        return redirect()->route('login');
    }

    public function showAnggotaLogin()
    {
        return redirect()->route('login');
    }

    public function showAnggotaRegister()
    {
        return view('auth.anggota-register');
    }

    public function loginAdmin(Request $request)
    {
        return $this->login($request);
    }

    public function loginPetugas(Request $request)
    {
        return $this->login($request);
    }

    public function loginAnggota(Request $request)
    {
        return $this->login($request);
    }

public function registerAnggota(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'nisn' => 'required|string|max:20|unique:users,nisn',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'ktm_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        'name.required' => 'Nama lengkap wajib diisi.',
        'name.max' => 'Nama karakter maksimal 255 karakter.',
        'nisn.required' => 'NISN wajib diisi.',
        'nisn.max' => 'NISN maksimal 20 karakter.',
        'nisn.unique' => 'NISN sudah terdaftar.',
        'email.required' => 'Alamat email wajib diisi.',
        'email.email' => 'Format email tidak valid (contoh: user@example.com).',
        'email.max' => 'Email maksimal 255 karakter.',
        'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.',
        'password.required' => 'Kata sandi wajib diisi.',
        'password.min' => 'Kata sandi minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        'ktm_photo.required' => 'Foto KTM/Kartu Pelajar wajib diunggah.',
        'ktm_photo.image' => 'File harus berupa gambar.',
        'ktm_photo.mimes' => 'Format file harus JPG, JPEG, atau PNG.',
        'ktm_photo.max' => 'Ukuran file maksimal 2MB.',
    ]);

    // Handle KTM photo upload
    $ktmPath = null;
    if ($request->hasFile('ktm_photo')) {
        $ktmPath = $request->file('ktm_photo')->store('ktm_photos', 'public');
    }

    $user = User::create([
        'name' => $validated['name'],
        'nisn' => $validated['nisn'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'plain_password' => $validated['password'],
        'phone' => $validated['phone'] ?? null,
        'address' => $validated['address'] ?? null,
        'role' => 'anggota',
        'status' => 'pending',
        'membership_date' => now(),
        'ktm_photo' => $ktmPath,
    ]);

    // Return response dengan flag untuk menampilkan modal di frontend
    return redirect()->route('login')
        ->with('success', 'Pendaftaran berhasil! Akun Anda sedang ditinjau oleh petugas.')
        ->with('show_pending_modal', true)
        ->with('pending_email', $user->email);
}

    private function redirectUserByRole($user)
    {
        $routeName = match ($user->role) {
            'admin' => 'admin.dashboard',
            'petugas' => 'petugas.dashboard',
            'anggota' => 'anggota.dashboard',
            default => null,
        };

        if ($routeName && \Illuminate\Support\Facades\Route::has($routeName)) {
            return redirect()->route($routeName);
        }

        Auth::logout();
        return redirect()->route('login')->withErrors(['email' => 'Peran pengguna tidak dikenali atau akses dasbor tidak tersedia.']);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $role = $user ? $user->role : null;
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect berdasarkan role
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
            case 'petugas':
                return redirect()->route('petugas.login')->with('success', 'Anda telah logout.');
            case 'anggota':
                return redirect()->route('anggota.login')->with('success', 'Anda telah logout.');
            default:
                return redirect('/')->with('success', 'Anda telah logout.');
        }
    }
}

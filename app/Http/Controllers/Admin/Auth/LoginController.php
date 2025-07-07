<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login admin
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Memproses usaha login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba untuk melakukan otentikasi
        if (Auth::attempt($credentials)) {
            // Jika berhasil, cek rolenya
            if (auth()->user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika berhasil login tapi bukan admin, logout lagi dan beri pesan error
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun ini tidak memiliki hak akses sebagai admin.',
            ])->onlyInput('email');
        }

        // Jika email/password salah
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    // Proses logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login admin
        return redirect()->route('admin.login');
    }
}
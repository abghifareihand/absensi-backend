<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // ✅ cek role langsung saat login
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            // kalau bukan admin, logout dan kasih pesan error
            Auth::logout();
            return back()->with('error', 'Hanya admin yang bisa login.');
        }

        return back()->with('error', 'Username atau password salah.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

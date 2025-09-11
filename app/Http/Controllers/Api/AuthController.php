<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        // ✅ Cek username ada atau tidak
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Username tidak ditemukan'
            ], 404);
        }

        // ✅ Cek password cocok atau tidak
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password salah'
            ], 401);
        }

        // ✅ Cegah login kalau role = admin
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Akun admin hanya bisa login melalui dashboard web'
            ], 403);
        }

        // ✅ Buat token login
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        // ✅ Hapus token yang sedang dipakai
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function profile(Request $request)
    {
        // ✅ Ambil data user berdasarkan token
        return response()->json([
            'status' => true,
            'message' => 'Data profil berhasil diambil',
            'user' => $request->user()
        ]);
    }

    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        // ✅ Simpan fcm token dari mobile app ke db
        $user = $request->user();
        $user->update([
            'fcm_token' => $request->fcm_token,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'FCM token updated successfully',
        ], 200);
    }

}

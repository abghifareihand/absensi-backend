<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // Register
    public function register(Request $request)
    {
        // Validasi data masukan
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6',
            'phone' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respons JSON dengan pesan kesalahan dan kode status 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Buat pengguna baru jika validasi berhasil
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'roles' => 'USER',
        ]);

        // Buat token otentikasi untuk pengguna baru
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Register success',
            'data' => [
                'access_token' => $token,
                'user' => $user
            ]
        ]);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // pengecekan email
        if (!$user) {
            return response()->json([
                'code' => 401,
                'success' => false,
                'message' => 'Invalid email',
            ], 401);
        }

        // pengecekan password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 401,
                'success' => false,
                'message' => 'Invalid password',
            ], 401);
        }

        // token autentikasi
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Login success',
            'data' => [
                'access_token' => $token,
                'user' => new UserResource($user)
            ]
        ]);
    }

    // Get User
    public function get(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Get user success',
            'data' => new UserResource($user)
        ]);
    }

    // Update User
    public function update(Request $request)
    {
        // Validasi data masukan
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $request->user()->id,
            'phone' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respons JSON dengan pesan kesalahan dan kode status 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Dapatkan pengguna yang sedang terotentikasi
        $user = $request->user();

        // Update informasi profil pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Kembalikan respons JSON dengan kode status 200 (OK) dan data pengguna yang telah diperbarui
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Update profile success',
            'data' => new UserResource($user)
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        // Revoke semua token akses pengguna saat ini
        $request->user()->tokens()->delete();
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Logout success',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'face_embedding' => 'required',
        ]);

        $user = $request->user();
        $image = $request->file('image');
        $face_embedding = $request->face_embedding;

        //save image
        $image->storeAs('public/images', $image->hashName());
        $user->image_url = $image->hashName();
        $user->face_embedding = $face_embedding;
        $user->save();

        return response([
            'code' => 200,
            'success' => true,
            'message' => 'Profile updated',
            'user' => $user,
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // Tentukan jenis login
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        } elseif (preg_match('/^[0-9]{10,15}$/', $login)) {
            $fieldType = 'phone';
        } else {
            $fieldType = 'user'; // GANTI SESUAI KOLOM YANG ADA
        }

        // Coba cari user
        $user = User::where($fieldType, $login)
            ->where('type', 2)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Akun tidak ditemukan'], 404);
        }

        // Autentikasi
        if (!Auth::attempt([$fieldType => $login, 'password' => $password])) {
            return response()->json(['message' => 'Login gagal, periksa kembali kredensial'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
            'role' => $user->rawtype ?? 'user',
        ]);
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->verify_token = Str::random(40);
        $user->token_created_at = now();
        $user->save();

        Mail::send('base.resource.mail-user-forgot-temp', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Password for ' . $user->name);
            $message->from('admin@internal-dev.id', 'SIAKAD PT by Internal-Dev');
        });

        return response()->json(['message' => 'Email reset password telah dikirim.']);
    }

    public function resetPage($token)
    {
        $user = User::where('verify_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token tidak valid'], 404);
        }

        return response()->json([
            'message' => 'Token valid',
            'token' => $token,
            'user_id' => $user->id,
            'email' => $user->email,
        ]);
    }

    public function reset(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('verify_token', $token)->first();

        if (!$user || now()->diffInHours($user->token_created_at) >= 1) {
            return response()->json(['message' => 'Token tidak valid atau kedaluwarsa'], 400);
        }

        $user->verify_token = Str::random(40); // reset token agar tidak bisa digunakan ulang
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password berhasil direset']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil']);
    }
}

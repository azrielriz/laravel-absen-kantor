<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
{
    return view('auth.login'); // arahkan ke file resources/views/auth/login.blade.php
}
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

     if (Auth::attempt($credentials)) {
            // Login berhasil
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // langsung ke dashboard
        }


    return response()->json([
        'message' => 'Email atau password salah!'
    ], 401);
 }
}

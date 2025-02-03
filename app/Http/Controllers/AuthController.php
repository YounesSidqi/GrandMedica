<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function index() {
        return view('auth.sign-in.index');
    }
    public function login(Request $request) {
    // Validasi input
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ], [
        'email.required' => 'Email harus diisi',
        'password.required' => 'Password harus diisi'
    ]);

    // Ambil kredensial
    $credentials = $request->only('email', 'password');

    // Coba login dengan kredensial
    if (Auth::attempt($credentials)) {
        // Login berhasil
        return redirect('/admin_dashboard/screen_opname');
    } else {
        // Login gagal
        return redirect('/sign-in')->withErrors('Email dan password yang dimasukkan tidak sesuai')->withInput();
    }
}

public function logout() {
    Auth::logout(); // This will clear the authenticated user's session

    return redirect('/'); // Redirect to the homepage or any desired page after logout
}

}

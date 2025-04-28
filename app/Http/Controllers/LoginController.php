<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('user');
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
{
    // Validasi form login
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password tidak boleh kosong',
    ]);

    $credentials = $request->only('email', 'password');

    // Cek kredensial login
    if (Auth::attempt($credentials)) {
        // Ambil user yang sudah login
        $user = Auth::user();

        // Pastikan pengguna memiliki role admin
        if ($user->role === 'admin') {
            // Jika peran adalah admin, redirect ke halaman visualisasidata
            return redirect('visualisasidata');
        } else {
            // Jika bukan admin, logout dan berikan pesan error
            Auth::logout();
            Session::flash('error', 'Anda tidak memiliki akses ke halaman ini');
            return redirect('/');
        }
    } else {
        // Jika gagal login, tampilkan pesan error
        Session::flash('error', 'Email atau Password Salah');
        return redirect('/');
    }
}


    public function user() //fungsi halaman guest dan menampilkan form pengaduan : guest
                {
                    return view('user'); 
                }

    public function tanggapan() //fungsi halaman tanggapan : guest
                {
                    return view('tanggapan');
                }

    public function actionlogout()
    {
        Auth::logout(); // Logout user
        return redirect('/'); // Redirect ke halaman login
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = strtolower(Auth::user()->role ?? ''); // amanin case dan null

            // Admin
            if ($role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Selamat datang, Admin!');
            }

            // User biasa (user / guest)
            if ($role === 'guest') {
                return redirect()->route('home')->with('success', 'Login berhasil!');
            }

            // Role tidak valid → logout
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun tidak memiliki akses yang valid.');
        }

        return back()->with('error', 'Email atau password salah.');
    }



    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        try {
            //code...
            // Validasi input
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:8', 'confirmed'],
            ]);

            // Buat user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'guest', // default user
            ]);

            // Login otomatis
            Auth::login($user);

            // Redirect ke home/dashboard dengan session flash
            return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registrasi Gagal ! ' . $e->getMessage());
        }
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}

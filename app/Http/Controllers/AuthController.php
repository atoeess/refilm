<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // 🔹 Tampilkan halaman login
    public function showLogin()
    {
        return view('Auth.login');
    }

    // 🔹 Proses login
    public function login(Request $request)
    {
        try {
            // Validasi input
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Pastikan email & password adalah string, bukan array
            $email = is_array($credentials['email']) ? $credentials['email'][0] : $credentials['email'];
            $password = is_array($credentials['password']) ? $credentials['password'][0] : $credentials['password'];

            // Cek apakah akun ada di database
            $isExists = User::where('email', $email)->exists();
            if (!$isExists) {
                return back()->with('error', 'Akun anda belum terdaftar.');
            }

            // Coba login
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect('/admin/dashboard');
                // return redirect()->route('wel');
            }

            // Jika password salah
            return back()->with('error', 'Email atau password salah.');

        } catch (\Exception $e) {
            // Tangani error agar bisa dilihat di browser
            return back()->with('error', $e->getMessage());
        }
    }

    // 🔹 Tampilkan halaman register
    // public function showRegister()
    // {
    //     return view('auth.register');
    // }

    // 🔹 (Opsional) Proses register
    // public function register(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'email', 'unique:users,email'],
    //         'password' => ['required', 'min:6', 'confirmed'],
    //     ]);

    //     $user = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => bcrypt($validated['password']),
    //     ]);

    //     Auth::login($user);

    //     return redirect()->route('dashboard');
    // }


    public function logout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');

    }
}

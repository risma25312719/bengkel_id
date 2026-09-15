<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- 1. TAMPILKAN FORM LOGIN ---
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan nama file view sesuai (resources/views/auth/login.blade.php)
    }

    // --- 2. PROSES LOGIN ---
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'pemilik_bengkel') {
                return redirect()->intended('/dashboard');
            }

            if ($user->role === 'teknisi') {
                return redirect()->intended('/transaksi');
            }

            return redirect()->intended('/status-servis');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // --- 3. TAMPILKAN FORM REGISTER ---
    public function showRegisterForm()
    {
        return view('auth.register'); // Pastikan nama file view sesuai (resources/views/auth/register.blade.php)
    }

    // --- 4. PROSES REGISTER ---
    public function register(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'nama_bengkel' => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'no_hp'        => 'required|string',
            'alamat'       => 'required|string|max:255',
            'password'     => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'         => $request->name,
            'nama_bengkel' => $request->nama_bengkel,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'password'     => Hash::make($request->password),
            'role'         => 'pemilik_bengkel',
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Bengkel berhasil didaftarkan!');
    }

    // --- 5. PROSES LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil keluar.');
    }
}
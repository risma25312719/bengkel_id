<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm() { return view('auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->role === 'teknisi' && $user->status_bengkel !== 'approved') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors(['email' => $user->status_bengkel === 'rejected' ? 'Pendaftaran bengkel ditolak. Silakan hubungi admin.' : 'Pendaftaran bengkel masih menunggu verifikasi admin.']);
        }

        return redirect()->intended($this->dashboardPath($user));
    }

    public function showRegisterForm() { return view('auth.register'); }
    public function showCustomerRegisterForm() { return view('auth.register-customer'); }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nama_bengkel' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_hp' => 'required|string|max:30',
            'alamat' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'teknisi';
        $data['status_bengkel'] = 'pending';
        User::create($data);
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil dikirim. Silakan login setelah admin menyetujui bengkel Anda.');
    }

    public function registerCustomer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_hp' => 'required|string|max:30',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'pelanggan';
        $data['status_bengkel'] = 'approved';
        $user = User::create($data);
        Auth::login($user);
        return redirect()->intended(route('pelanggan.status'))->with('success', 'Akun pelanggan berhasil dibuat.');
    }

    private function dashboardPath($user)
    {
        if ($user->role === 'admin') return '/admin/bengkel';
        if ($user->role === 'teknisi') return '/dashboard';
        return '/status-servis';
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil keluar.');
    }
}

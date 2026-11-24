<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminBengkelController extends Controller
{
    // Menampilkan daftar pendaftaran bengkel
    public function index()
    {
        $bengkelList = User::where('role', 'teknisi')
            ->whereIn('status_bengkel', ['pending', 'approved', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bengkel.index', compact('bengkelList'));
    }

    // Menampilkan detail bengkel
    public function show($id)
    {
        $bengkel = User::where('role', 'teknisi')
            ->findOrFail($id);

        return view('admin.bengkel.detail', compact('bengkel'));
    }

    // Menyetujui atau menolak pendaftaran
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_bengkel' => 'required|in:approved,rejected'
        ]);

        $bengkel = User::where('role', 'teknisi')
            ->findOrFail($id);

        $bengkel->status_bengkel = $request->status_bengkel;
        $bengkel->save();

        return redirect()
            ->route('admin.bengkel.index')
            ->with('success', 'Status bengkel berhasil diperbarui.');
    }
}

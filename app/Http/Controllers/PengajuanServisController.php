<?php

namespace App\Http\Controllers;

use App\Models\PengajuanServis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PengajuanServisController extends Controller
{
    public function store(Request $request, User $bengkel)
    {
        abort_unless(
            $bengkel->role === 'teknisi' && $bengkel->status_bengkel === 'approved',
            404
        );

        $data = $request->validate([
            'jenis_perangkat' => ['required', Rule::in(PengajuanServis::JENIS_PERANGKAT)],
            'nama_perangkat' => 'required|string|max:255',
            'keluhan_kerusakan' => 'required|string|max:5000',
            'lokasi_jemput_latitude' => 'required|numeric|between:-90,90',
            'lokasi_jemput_longitude' => 'required|numeric|between:-180,180',
        ]);

        PengajuanServis::create([
            'pelanggan_id' => $request->user()->id,
            'bengkel_id' => $bengkel->id,
            'jenis_perangkat' => $data['jenis_perangkat'],
            'nama_perangkat' => $data['nama_perangkat'],
            'keluhan_kerusakan' => $data['keluhan_kerusakan'],
            'lokasi_jemput_latitude' => $data['lokasi_jemput_latitude'],
            'lokasi_jemput_longitude' => $data['lokasi_jemput_longitude'],
            'status' => 'menunggu',
        ]);

        return redirect()->route('bengkel.dashboard', $bengkel)->with('success', 'Pengajuan servis berhasil dikirim ke bengkel.');
    }

    public function index(Request $request)
    {
        $pengajuan = PengajuanServis::with('pelanggan')
            ->where('bengkel_id', $request->user()->id)
            ->latest()
            ->get();

        return view('pengajuan-servis.index', compact('pengajuan'));
    }

    public function customerIndex(Request $request)
    {
        $pengajuan = PengajuanServis::with('bengkel')
            ->where('pelanggan_id', $request->user()->id)
            ->latest()
            ->get();

        return view('pelanggan.status-akun', compact('pengajuan'));
    }

    public function updateStatus(Request $request, PengajuanServis $pengajuanServis)
    {
        abort_unless($pengajuanServis->bengkel_id === $request->user()->id, 404);

        $data = $request->validate([
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        $pengajuanServis->update($data);

        return redirect()->route('pengajuan-servis.index')->with('success', 'Status pengajuan diperbarui.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PengajuanServis;
use App\Models\User;
use Illuminate\Http\Request;

class BengkelController extends Controller
{
    public function customerDashboard(Request $request, User $bengkel)
    {
        $this->ensureApprovedWorkshop($bengkel);

        $pengajuanTerakhir = PengajuanServis::where('pelanggan_id', $request->user()->id)
            ->where('bengkel_id', $bengkel->id)
            ->latest()
            ->first();

        return view('bengkel.dashboard-pelanggan', compact('bengkel', 'pengajuanTerakhir'));
    }

    private function ensureApprovedWorkshop(User $bengkel)
    {
        abort_unless(
            $bengkel->role === 'teknisi' && $bengkel->status_bengkel === 'approved',
            404
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan', 'user', 'layanan', 'barang'])->latest()->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $layanan   = Layanan::all();
        $barang    = Barang::where('stok', '>', 0)->get();
        return view('transaksi.create', compact('pelanggan', 'layanan', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id'     => 'required|exists:pelanggan,id',
            'nama_perangkat'   => 'required|string|max:255',
            'keluhan_kerusakan'=> 'required|string',
        ]);

        // Hitung total biaya (Jasa + Sparepart)
        $biayaJasa = 0;
        $biayaBarang = 0;

        if ($request->layanan_id) {
            $layanan = Layanan::find($request->layanan_id);
            $biayaJasa = $layanan ? $layanan->biaya_jasa : 0;
        }

        if ($request->barang_id) {
            $barang = Barang::find($request->barang_id);
            $jumlah = $request->jumlah_barang ?? 1;
            $biayaBarang = $barang ? ($barang->harga_jual * $jumlah) : 0;

            // Potong stok barang
            if ($barang && $barang->stok >= $jumlah) {
                $barang->decrement('stok', $jumlah);
            }
        }

        $totalBiaya = $biayaJasa + $biayaBarang;

        Transaksi::create([
            'kode_transaksi'    => 'TRX-' . strtoupper(Str::random(6)),
            'pelanggan_id'      => $request->pelanggan_id,
            'user_id'           => auth()->id(), // Kasir/Teknisi yang login
            'layanan_id'        => $request->layanan_id,
            'barang_id'         => $request->barang_id,
            'nama_perangkat'    => $request->nama_perangkat,
            'keluhan_kerusakan' => $request->keluhan_kerusakan,
            'jumlah_barang'     => $request->jumlah_barang ?? 1,
            'total_biaya'       => $totalBiaya,
            'status_servis'     => 'proses',
            'status_bayar'      => 'belum_bayar',
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi baru berhasil dibuat.');
    }

    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status_servis' => 'required|in:proses,menunggu_sparepart,selesai,batal',
            'status_bayar'  => 'required|in:belum_bayar,lunas',
        ]);

        $data = [
            'status_servis' => $request->status_servis,
            'status_bayar'  => $request->status_bayar,
        ];

        if ($request->status_servis === 'selesai' && !$transaksi->tgl_selesai) {
            $data['tgl_selesai'] = now();
        }

        $transaksi->update($data);

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi diperbarui.');
    }
}
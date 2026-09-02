<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        // 1. Ambil ID terbesar / transaksi terakhir
        $lastBarang = Barang::latest('id')->first();

        // 2. Ambil nomor urut berikutnya (jika belum ada barang, mulai dari 1)
        $nextNumber = $lastBarang ? $lastBarang->id + 1 : 1;

        // 3. Format nomor menjadi 4 digit angka (misal: 1 -> 0001)
        $kodeBarang = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return view('barang.create', compact('kodeBarang'));
    }

    public function store(Request $request)
    {
        // Generate ulang kode barang di backend untuk memastikan tidak ada duplikasi jika dibuka berbarengan
        $lastBarang = Barang::latest('id')->first();
        $nextNumber = $lastBarang ? $lastBarang->id + 1 : 1;
        $kodeBarang = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|integer',
        ]);

        // Merge/gabungkan kode_barang otomatis ke dalam request
        $data = $request->all();
        $data['kode_barang'] = $kodeBarang;

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan dengan kode ' . $kodeBarang);
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|integer',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
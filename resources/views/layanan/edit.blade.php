@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="m-0">Edit Layanan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('layanan.update', $layanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control" value="{{ $layanan->nama_layanan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biaya Jasa (Rp)</label>
                        <input type="number" name="biaya_jasa" class="form-control" value="{{ $layanan->biaya_jasa }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $layanan->deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Perbarui Data</button>
                    <a href="{{ route('layanan.index') }}" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
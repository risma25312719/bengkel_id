@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark">Data Pelanggan</h3>
        <p class="text-muted small mb-0 mt-1">
            Daftar pelanggan yang pernah mengajukan servis ke bengkel Anda.
        </p>
    </div>
</div>

<div class="card card-seamless overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-seamless align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pelanggan as $item)
                    <tr>
                        <td class="text-center fw-semibold">
                            {{ $loop->iteration }}
                        </td>

                        <td class="fw-bold text-dark">
                            {{ $item->name }}
                        </td>

                        <td>{{ $item->email }}</td>

                        <td>{{ $item->no_hp ?? '-' }}</td>

                        <td>
                            <span class="badge bg-success">
                                Pernah Mengajukan Servis
                            </span>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-2"></i>
                            <h6 class="fw-semibold">Belum Ada Pelanggan</h6>
                            <small>
                                Pelanggan yang mengajukan servis akan otomatis muncul di sini.
                            </small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

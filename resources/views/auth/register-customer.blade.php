<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Daftar Pelanggan - BengkelKu</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><style>body{background:#fff7ed;min-height:100vh;display:grid;place-items:center}.card{width:min(460px,94vw);border:0;border-radius:18px;box-shadow:0 12px 35px #0001}.btn-orange{background:#f97316;color:white}</style></head><body>
<div class="card p-4 p-md-5"><div class="text-center mb-4"><h3 class="fw-bold">Bengkel<span class="text-warning">Ku</span></h3><p class="text-muted">Buat akun pelanggan</p></div>
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('register.customer.post') }}">@csrf
<div class="mb-3"><label class="form-label">Nama lengkap</label><input class="form-control" name="name" value="{{ old('name') }}" required></div>
<div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="{{ old('email') }}" required></div>
<div class="mb-3"><label class="form-label">Nomor WhatsApp</label><input class="form-control" name="no_hp" value="{{ old('no_hp') }}" required></div>
<div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
<div class="mb-3"><label class="form-label">Konfirmasi password</label><input type="password" class="form-control" name="password_confirmation" required></div>
<button class="btn btn-orange w-100 fw-semibold">Daftar sebagai Pelanggan</button></form>
<p class="text-center mt-3 mb-0 small">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p><p class="text-center mt-2 mb-0 small"><a href="/">Kembali ke beranda</a></p></div></body></html>
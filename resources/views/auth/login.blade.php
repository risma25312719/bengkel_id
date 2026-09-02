<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System - Bengkel Elektronik</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body class="d-flex align-items-center vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card login-card p-3">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-primary">Bengkel Elektronik</h4>
                        <p class="text-muted small">Silakan masuk ke akun Anda</p>
                    </div>

                    {{-- Flash Alert Success --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-semibold">Alamat Email</label>
                            <input type="email" name="email" id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label small fw-semibold">Kata Sandi</label>
                            <input type="password" name="password" id="password" 
                                   class="form-control" required placeholder="••••••••">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Masuk</button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="small text-muted">Belum punya akun? </span>
                        <a href="{{ route('register') }}" class="small text-decoration-none fw-semibold">Daftar Akun</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
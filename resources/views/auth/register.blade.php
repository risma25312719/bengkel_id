<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bengkel - BengkelKu</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #fff7ed 0%, #ffffff 50%, #fed7aa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            position: relative;
            overflow-x: hidden;
        }
        .register-card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.12);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .register-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, #ea580c, #f97316, #ea580c);
        }
        .brand-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #ea580c, #c2410c);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: white; margin: 0 auto 16px;
            box-shadow: 0 8px 24px rgba(234, 88, 12, 0.3);
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #f3f4f6;
            transition: all 0.3s ease;
            font-size: 14px;
            background: #fafafa;
        }
        .form-control:focus {
            border-color: #ea580c;
            box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.1);
            background: white;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            border: none; border-radius: 12px; padding: 12px;
            font-weight: 700; font-size: 15px; color: white;
            box-shadow: 0 4px 16px rgba(234, 88, 12, 0.3);
        }
        .btn-primary-custom:hover { color: white; transform: translateY(-2px); }
        .link-custom { color: #ea580c; text-decoration: none; font-weight: 600; }
        .divider { display: flex; align-items: center; text-align: center; margin: 20px 0; }
        .divider::before, .divider::after { content: ''; flex: 1; border-bottom: 2px solid #f3f4f6; }
        .divider::before { margin-right: 16px; } .divider::after { margin-left: 16px; }
        .divider-text { color: #9ca3af; font-size: 12px; font-weight: 500; }
        .password-toggle {
            position: absolute; right: 16px; top: 50%;
            transform: translateY(-50%); background: none; border: none;
            color: #9ca3af; cursor: pointer; padding: 0; font-size: 14px;
        }
        .floating-label-group { position: relative; margin-bottom: 18px; }
        .floating-label-group .form-control { padding-top: 16px; padding-bottom: 6px; }
        .floating-label-group .form-label {
            position: absolute; top: 12px; left: 16px;
            font-size: 13px; color: #9ca3af; transition: all 0.2s ease;
            pointer-events: none; margin: 0; padding: 0 4px;
        }
        .floating-label-group .form-control:focus ~ .form-label,
        .floating-label-group .form-control:not(:placeholder-shown) ~ .form-label {
            top: -8px; left: 12px; font-size: 11px; color: #ea580c;
            background: white; font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="register-card p-4 p-md-5">

                    <div class="text-center">
                        <div class="brand-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <h4 class="fw-bold text-gray-800 mb-1">Bengkel<span style="color: #ea580c;">Ku</span></h4>
                        <p class="text-muted small mb-0">Pendaftaran Mitra Bengkel Baru</p>
                        <div class="divider mt-3">
                            <span class="divider-text">ISI DATA BENGKEL</span>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="border-radius: 12px; border: none; font-size: 13px;">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST" class="mt-3">
                        @csrf

                        <!-- Nama Pemilik -->
                        <div class="floating-label-group">
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required autofocus placeholder=" ">
                            <label for="name" class="form-label">Nama Pemilik</label>
                        </div>

                        <!-- Nama Bengkel (Ditambahkan) -->
                        <div class="floating-label-group">
                            <input type="text" name="nama_bengkel" id="nama_bengkel"
                                   class="form-control @error('nama_bengkel') is-invalid @enderror"
                                   value="{{ old('nama_bengkel') }}" required placeholder=" ">
                            <label for="nama_bengkel" class="form-label">Nama Bengkel</label>
                        </div>

                        <!-- Email -->
                        <div class="floating-label-group">
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required placeholder=" ">
                            <label for="email" class="form-label">Alamat Email</label>
                        </div>

                        <!-- WhatsApp -->
                        <div class="floating-label-group">
                            <input type="text" name="no_hp" id="no_hp"
                                   class="form-control @error('no_hp') is-invalid @enderror"
                                   value="{{ old('no_hp') }}" required placeholder=" ">
                            <label for="no_hp" class="form-label">Nomor WhatsApp Bengkel</label>
                        </div>

                        <!-- Alamat Bengkel -->
                        <div class="floating-label-group">
                            <input type="text" name="alamat" id="alamat"
                                   class="form-control @error('alamat') is-invalid @enderror"
                                   value="{{ old('alamat') }}" required placeholder=" ">
                            <label for="alamat" class="form-label">Alamat Lengkap Bengkel</label>
                        </div>

                        <!-- Password -->
                        <div class="floating-label-group position-relative">
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required placeholder=" ">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        <!-- Confirm Password -->
                        <div class="floating-label-group position-relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control" required placeholder=" ">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 mt-2">
                            <i class="fas fa-store me-2"></i> Daftar Bengkel Sekarang
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="small text-muted">Sudah punya akun? </span>
                        <a href="{{ route('login') }}" class="small link-custom">Masuk Akun</a>
                    </div>

                    <div class="text-center mt-2">
                        <a href="/" class="small text-muted text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>
</html>
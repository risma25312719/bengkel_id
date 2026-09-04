<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BengkelKu</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #fff7ed 0%, #ffffff 50%, #fed7aa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative background elements */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(234, 88, 12, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(234, 88, 12, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ea580c, #f97316, #ea580c);
            background-size: 200% 100%;
            animation: shimmer-bar 3s ease-in-out infinite;
        }

        @keyframes shimmer-bar {
            0%, 100% { background-position: 0% 0%; }
            50% { background-position: 100% 0%; }
        }

        .login-card:hover {
            box-shadow: 0 30px 70px -15px rgba(234, 88, 12, 0.2);
            transform: translateY(-2px);
        }

        .brand-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #ea580c, #c2410c);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            margin: 0 auto 16px;
            box-shadow: 0 8px 24px rgba(234, 88, 12, 0.3);
            transition: all 0.4s ease;
        }

        .brand-icon:hover {
            transform: rotate(-10deg) scale(1.05);
            box-shadow: 0 12px 32px rgba(234, 88, 12, 0.4);
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

        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            margin-bottom: 6px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            font-size: 15px;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(234, 88, 12, 0.3);
        }

        .btn-primary-custom::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.4s ease;
            transform: scale(0.5);
        }

        .btn-primary-custom:hover::after {
            opacity: 1;
            transform: scale(1);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(234, 88, 12, 0.4);
            color: white;
        }

        .btn-primary-custom:active {
            transform: scale(0.96);
        }

        .input-group-text-custom {
            background: #fafafa;
            border: 2px solid #f3f4f6;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #9ca3af;
        }

        .form-control-with-icon {
            border-radius: 0 12px 12px 0;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group .form-control:focus {
            border-left: none;
        }

        .input-group .input-group-text {
            background: #fafafa;
            border: 2px solid #f3f4f6;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #9ca3af;
            transition: all 0.3s ease;
        }

        .input-group:focus-within .input-group-text {
            border-color: #ea580c;
            background: white;
            color: #ea580c;
        }

        .form-check-input:checked {
            background-color: #ea580c;
            border-color: #ea580c;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2);
            border-color: #ea580c;
        }

        .link-custom {
            color: #ea580c;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }

        .link-custom::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ea580c;
            transition: width 0.3s ease;
        }

        .link-custom:hover {
            color: #c2410c;
        }

        .link-custom:hover::after {
            width: 100%;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px solid #f3f4f6;
        }

        .divider::before {
            margin-right: 16px;
        }

        .divider::after {
            margin-left: 16px;
        }

        .divider-text {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .alert-custom {
            border-radius: 12px;
            border: none;
            background: #f0fdf4;
            color: #166534;
            padding: 12px 16px;
            font-size: 13px;
        }

        .alert-custom .btn-close {
            font-size: 10px;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #ea580c;
        }

        .position-relative .form-control {
            padding-right: 44px;
        }

        /* Floating label animation */
        .floating-label-group {
            position: relative;
            margin-bottom: 20px;
        }

        .floating-label-group .form-control {
            padding-top: 16px;
            padding-bottom: 6px;
        }

        .floating-label-group .form-label {
            position: absolute;
            top: 12px;
            left: 16px;
            font-size: 13px;
            color: #9ca3af;
            font-weight: 400;
            transition: all 0.2s ease;
            pointer-events: none;
            margin: 0;
            background: transparent;
            padding: 0 4px;
        }

        .floating-label-group .form-control:focus ~ .form-label,
        .floating-label-group .form-control:not(:placeholder-shown) ~ .form-label {
            top: -8px;
            left: 12px;
            font-size: 11px;
            color: #ea580c;
            background: white;
            padding: 0 4px;
            font-weight: 600;
        }

        .floating-label-group .form-control:focus {
            border-color: #ea580c;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                padding: 0;
                margin: 0 10px;
            }

            body {
                padding: 10px;
            }

            .brand-icon {
                width: 56px;
                height: 56px;
                font-size: 24px;
            }
        }

        /* Decorative dots */
        .deco-dot {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.3;
        }

        .deco-dot-1 {
            width: 12px;
            height: 12px;
            background: #ea580c;
            top: 10%;
            right: 8%;
            animation: float-dot 6s ease-in-out infinite;
        }

        .deco-dot-2 {
            width: 8px;
            height: 8px;
            background: #f97316;
            bottom: 15%;
            left: 10%;
            animation: float-dot 8s ease-in-out infinite reverse;
        }

        .deco-dot-3 {
            width: 16px;
            height: 16px;
            background: #fed7aa;
            top: 50%;
            right: 5%;
            animation: float-dot 7s ease-in-out infinite 1s;
        }

        @keyframes float-dot {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.2); }
        }
    </style>
</head>
<body>

    <!-- Decorative dots -->
    <div class="deco-dot deco-dot-1"></div>
    <div class="deco-dot deco-dot-2"></div>
    <div class="deco-dot deco-dot-3"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="login-card p-4 p-md-5">

                    <!-- Brand -->
                    <div class="text-center">
                        <div class="brand-icon">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <h4 class="fw-bold text-gray-800 mb-1">Bengkel<span style="color: #ea580c;">Ku</span></h4>
                        <p class="text-muted small mb-0">Sistem Manajemen Bengkel</p>
                        <div class="divider mt-3">
                            <span class="divider-text">MASUK KE AKUN</span>
                        </div>
                    </div>

                    {{-- Flash Alert Success --}}
                    @if(session('success'))
                        <div class="alert alert-custom alert-dismissible fade show mt-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Flash Alert Error --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="border-radius: 12px; border: none; padding: 12px 16px; font-size: 13px;">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST" class="mt-3">
                        @csrf

                        <!-- Email -->
                        <div class="floating-label-group">
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus
                                   placeholder=" ">
                            <label for="email" class="form-label">Alamat Email</label>
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="floating-label-group position-relative">
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required placeholder=" ">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                            </div>
                            <a href="#" class="small link-custom">Lupa Password?</a>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk
                        </button>
                    </form>

                    <!-- Register link -->
                    <div class="text-center mt-4">
                        <span class="small text-muted">Belum punya akun? </span>
                        <a href="{{ route('register') }}" class="small link-custom">Daftar Akun</a>
                    </div>

                    <!-- Back to home -->
                    <div class="text-center mt-2">
                        <a href="/" class="small text-muted text-decoration-none hover-text-orange" style="transition: color 0.3s ease;">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Auto dismiss alerts after 5 seconds
        document.querySelectorAll('.alert-dismissible').forEach(alert => {
            setTimeout(() => {
                const closeBtn = alert.querySelector('.btn-close');
                if (closeBtn) closeBtn.click();
            }, 5000);
        });
    </script>
</body>
</html>
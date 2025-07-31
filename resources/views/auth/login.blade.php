<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SDA Papua</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e9f2fc, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }

        .container-login {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            display: flex;
            width: 850px;
            max-width: 95%;
        }

        .login-left {
            flex: 1;
        }

        .login-right {
            flex: 1;
            padding: 40px 30px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-header h3 {
            color: #0d6efd;
            font-weight: bold;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .text-small {
            font-size: 0.9rem;
        }

        .input-group-text {
            cursor: pointer;
            background: #e9f2fc;
            border: 1px solid #ced4da;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel,
        .carousel-inner,
        .carousel-item {
            height: 100%;
        }
    </style>
</head>
<body>

    <div class="container-login">
        <div class="login-box">

            <!-- Gambar Kiri (Carousel) -->
            <div class="login-left d-none d-md-block">
                <div id="loginCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner h-100">
                        <div class="carousel-item active h-100">
                            <img src="https://mmc.tirto.id/image/otf/640x0/2023/02/24/piaynemo-raja-ampat-istock-865002310_ratio-16x9.jpg" class="d-block w-100" alt="1">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="https://kompaspedia.kompas.id/wp-content/uploads/2021/02/20180619FLO02-scaled.jpg" class="d-block w-100" alt="2">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="https://cdn.betahita.id/6/8/0/6/6806.jpeg" class="d-block w-100" alt="3">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="https://cdn.antaranews.com/cache/1200x800/2024/05/27/1000358775.jpg" class="d-block w-100" alt="4">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="https://i0.wp.com/www.rukita.co/stories/wp-content/uploads/2022/11/Kiprah-Kementerian-PUPR.jpg?fit=720%2C405&ssl=1" class="d-block w-100" alt="5">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Login Kanan -->
            <div class="login-right">
                <div class="login-header">
                    <h3>Login SDA Papua</h3>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

             <form method="POST" action="/login">

                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                        @error('email')
                            <div class="text-danger text-small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   required>
                            <span class="input-group-text" onclick="togglePassword()">
  <i class="fas fa-tint" id="toggleIcon" style="color: #00bfff;"></i>
</span>

                        </div>
                        @error('password')
                            <div class="text-danger text-small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Ingat saya</label>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="text-small text-decoration-none" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-tint');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-tint');
            }
        }
    </script>

</body>
</html>

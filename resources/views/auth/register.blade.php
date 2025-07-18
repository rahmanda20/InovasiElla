<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sumber Daya Air Papua</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            background-color: #e9f2fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .container-register {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-wrapper {
            width: 95%;
            max-width: 1200px;
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
        }

        .register-carousel {
            flex: 1;
            position: relative;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .register-form {
            flex: 1;
            padding: 50px 40px;
        }

        .register-form h3 {
            color: #0d6efd;
            font-weight: bold;
            margin-bottom: 25px;
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

        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
            }

            .register-carousel {
                height: 200px;
            }

            .register-form {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="container-register">
    <div class="register-wrapper card">

        <!-- LEFT: Carousel Gambar -->
        <div class="register-carousel">
            <div id="carouselRegister" class="carousel slide h-100" data-bs-ride="carousel">
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100">
                        <img src="https://cdn.antaranews.com/cache/1200x800/2024/05/27/1000358775.jpg" class="d-block w-100" alt="Papua">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="https://i0.wp.com/www.rukita.co/stories/wp-content/uploads/2022/11/Kiprah-Kementerian-PUPR.jpg?fit=720%2C405&ssl=1" class="d-block w-100" alt="SDA">
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Form Register -->
        <div class="register-form">
            <h3 class="text-center">Daftar Akun SDA Papua</h3>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required autofocus>
                    @error('name')
                        <div class="text-danger text-small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <div class="text-danger text-small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           required>
                    @error('password')
                        <div class="text-danger text-small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           id="password_confirmation"
                           name="password_confirmation"
                           required>
                    @error('password_confirmation')
                        <div class="text-danger text-small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Aksi -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="text-small text-decoration-none" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

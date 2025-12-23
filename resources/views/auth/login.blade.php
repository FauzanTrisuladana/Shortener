<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Shortener') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width: 450px;">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">
                        <h2 class="fw-bold">🔗 URL Shortener</h2>
                    </a>
                </div>

                <div class="card-auth">
                    <h4 class="text-white mb-4 text-center">Login</h4>

                    <form action="{{ route('dashboard') }}" method="GET">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control form-control-dark"
                                id="email"
                                name="email"
                                placeholder="nama@email.com"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control form-control-dark"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-danger w-100 mb-3" style="padding: 12px;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Login
                        </button>
                    </form>

                    <div class="text-center mb-3">
                        <div style="color: #6a6a6a; position: relative; margin: 20px 0;">
                            <span style="background: #2a2a2a; padding: 0 10px; position: relative; z-index: 1;">atau</span>
                            <hr style="border-color: #3a3a3a; position: absolute; top: 50%; left: 0; right: 0; margin: 0; z-index: 0;">
                        </div>
                    </div>

                    <a href="{{ route('auth.google') }}" class="btn btn-light w-100 mb-3" style="padding: 12px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.874 2.684-6.615z" fill="#4285F4"/>
                            <path d="M9.003 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.96v2.332C2.44 15.983 5.485 18 9.003 18z" fill="#34A853"/>
                            <path d="M3.964 10.71c-.18-.54-.282-1.117-.282-1.71s.102-1.17.282-1.71V4.958H.957C.347 6.173 0 7.548 0 9s.348 2.827.957 4.042l3.007-2.332z" fill="#FBBC05"/>
                            <path d="M9.003 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.464.891 11.426 0 9.003 0 5.485 0 2.44 2.017.96 4.958L3.967 7.29c.708-2.127 2.692-3.71 5.036-3.71z" fill="#EA4335"/>
                        </svg>
                        <span>Login with Google</span>
                    </a>

                    <div class="text-center">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="text-decoration-none text-danger">
                            Daftar di sini
                        </a>
                    </div>

                        <hr class="my-4" style="border-color: #3a3a3a;">

                        <div class="text-center">
                            <a href="{{ route('home') }}" class="text-decoration-none text-muted">
                                <i class="bi bi-arrow-left me-2"></i>
                                Kembali ke Home
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

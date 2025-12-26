<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>URL Shortener - {{ config('app.name', 'Shortener') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/js/app.js', 'resources/js/home.js'])
</head>
<body class="home-page">
    <button class="dark-mode-toggle" id="darkModeToggleHome" onclick="toggleDarkModeHome()">
        <i class="bi bi-brightness-high" id="darkModeIconHome"></i>
    </button>

    <div class="container-home">
        <div class="text-center mb-5">
            <h1 class="text-white fw-bold mb-2" style="font-size: 48px;">URL Shortener</h1>
        </div>

        <div class="card-home">
            @if(session('success'))
            <div class="alert-success">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <strong><i class="bi bi-check-circle me-2"></i>URL berhasil diperpendek!</strong>
                </div>
                <div class="short-url-result">
                    <a href="{{ session('short_url') }}" target="_blank">{{ session('short_url') }}</a>
                    <button class="btn-copy" onclick="copyToClipboard('{{ session('short_url') }}')">
                        <i class="bi bi-clipboard"></i> Copy
                    </button>
                </div>
            </div>
            @endif

            <h4 class="text-white mb-2">Buat short URL</h4>
            <p class="info-text mb-4">Masukin url panjang, nanti dapat url pendek, bisa custom slug juga</p>

            <form action="{{ route('shorten') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="target_url" class="form-label">Target URL</label>
                    <input
                        type="url"
                        class="form-control form-control-dark"
                        id="target_url"
                        name="target_url"
                        placeholder="https://trisuladana.com/url-yang-panjang-atau-apalah"
                        required
                        value="{{ old('target_url') }}"
                    >
                    @error('target_url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="custom_slug" class="form-label">Custom Slug (opsional)</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: #1a1a1a; border: 1px solid #3a3a3a; color: #6a6a6a; border-radius: 8px 0 0 8px;">
                            link.trisuladana.com/
                        </span>
                        <input
                            type="text"
                            class="form-control form-control-dark"
                            id="custom_slug"
                            name="custom_slug"
                            placeholder="url-custom"
                            value="{{ old('custom_slug') }}"
                            style="border-radius: 0 8px 8px 0; border-left: none;"
                        >
                    </div>
                    <small class="info-text">Bisa dikosongkan, nanti dibikinin</small>
                    @error('custom_slug')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-shorten">
                    Shorten URL
                </button>
            </form>
        </div>

        <div class="text-center mt-4">
            <div class="card-home py-3">
                <p class="text-white mb-2">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Dengan login,</strong> Anda dapat melihat performa link Anda
                </p>
                <p class="info-text mb-0">
                    Link Anda akan tersimpan dan dapat Anda edit lagi kapan saja
                </p>
                <div class="mt-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-danger">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </a>
                    <!-- Tombol sementara ke dashboard -->
                    <a href="{{ route('dashboard') }}" class="btn btn-primary ms-2">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard (sementara)
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

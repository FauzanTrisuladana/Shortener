<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shortener') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js'])
</head>
<body class="dashboard-layout">
    <!-- Sidebar Component -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-grow-1 dashboard-main">
            <!-- Navbar / Header -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid px-4">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <button class="btn btn-light">
                            <i class="bi bi-bell"></i>
                        </button>
                        <button class="btn btn-light" style="border-radius: 8px;" id="darkModeToggle" onclick="toggleDarkMode()">
                            <i class="bi bi-brightness-high" id="darkModeIcon"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <span class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    FT
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid px-4 py-4">
                @yield('content')
            </div>
        </main>

    <script>
        // Dark mode functionality
        function toggleDarkMode() {
            const body = document.body;
            const icon = document.getElementById('darkModeIcon');

            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                icon.classList.remove('bi-brightness-high');
                icon.classList.add('bi-moon-fill');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                icon.classList.remove('bi-moon-fill');
                icon.classList.add('bi-brightness-high');
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        // Check for saved dark mode preference
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode');
            const icon = document.getElementById('darkModeIcon');

            if (darkMode === 'enabled') {
                document.body.classList.add('dark-mode');
                icon.classList.remove('bi-brightness-high');
                icon.classList.add('bi-moon-fill');
            }
        });
    </script>
</body>
</html>

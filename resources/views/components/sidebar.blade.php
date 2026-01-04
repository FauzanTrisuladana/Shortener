<aside class="d-flex flex-column p-3 text-white" id="sidebarMenu">
    <!-- Close Button (Mobile Only) -->
    <button id="sidebarCloseBtn" type="button" class="btn btn-sm d-lg-none align-self-end mb-2" aria-label="Close Sidebar">
        <span aria-hidden="true">&times;</span>
    </button>
    <!-- Logo / Brand -->
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none">
        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <span style="font-size: 20px;">🔗</span>
        </div>
        <span class="sidebar-brand">Link Shortener</span>
    </a>

    <hr>

    <!-- Navigation Menu -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page">
                <i class="bi bi-grid-fill me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('analytics') }}" class="nav-link text-white {{ request()->routeIs('analytics') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill me-2"></i>
                Analytics
            </a>
        </li>
        <li>
            <a href="{{ route('links') }}" class="nav-link text-white {{ request()->routeIs('links*') ? 'active' : '' }}">
                <i class="bi bi-link-45deg me-2"></i>
                Links
            </a>
        </li>
        <li class="mt-3">
            <hr>
        </li>
        <li>
            <a href="{{ route('profile') }}" class="nav-link text-white {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-2"></i>
                Profile
            </a>
        </li>
    </ul>

    <!-- User Profile at Bottom -->
    <hr>
    <div class="dropdown">
        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            @if(auth()->user()->profile_image ?? false)
                @if(Str::startsWith(auth()->user()->profile_image, ['http://', 'https://']))
                    <img src="{{ auth()->user()->profile_image }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                @else
                    <img src="{{ asset(auth()->user()->profile_image) }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                @endif
            @else
                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-2 sidebar-user-avatar">
                    {{ strtoupper(collect(explode(' ', auth()->user()->name))->map(fn($n) => substr($n,0,1))->join('')) }}
                </div>
            @endif
            <div>
                <strong class="sidebar-user-name">{{ auth()->user()->name }}</strong>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark w-100">
            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>

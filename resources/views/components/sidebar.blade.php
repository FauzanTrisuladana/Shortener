<aside class="d-flex flex-column p-3 text-white" style="width: 250px; background-color: #161615; min-height: 100vh;" id="sidebarMenu">
    <!-- Logo / Brand -->
    <a href="/" class="d-flex align-items-center mb-4 text-white text-decoration-none">
        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <span style="font-size: 20px;">🔗</span>
        </div>
        <span class="fs-5 fw-bold">s.id</span>
    </a>

    <hr style="border-color: #3E3E3A;">

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
            <a href="{{ route('links') }}" class="nav-link text-white {{ request()->routeIs('links') ? 'active' : '' }}">
                <i class="bi bi-link-45deg me-2"></i>
                Links
            </a>
        </li>
        <li class="mt-3">
            <hr style="border-color: #3E3E3A;">
        </li>
        <li>
            <a href="{{ route('profile') }}" class="nav-link text-white {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-2"></i>
                Profile
            </a>
        </li>
    </ul>

    <!-- User Profile at Bottom -->
    <hr style="border-color: #3E3E3A;">
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 12px;">
                FT
            </div>
            <div>
                <strong style="font-size: 14px;">Fauzan Trisuladana</strong>
                <p class="mb-0" style="font-size: 12px; color: #A1A09A;">Free User</p>
            </div>
        </a>
    </div>
</aside>

<style>
    #sidebarMenu .nav-link {
        color: #A1A09A;
        border-radius: 8px;
        margin-bottom: 4px;
        padding: 12px 16px;
        transition: all 0.2s ease;
    }

    #sidebarMenu .nav-link:hover {
        background-color: #3E3E3A;
        color: #EDEDEC;
    }

    #sidebarMenu .nav-link.active {
        background-color: #FF4433;
        color: white;
    }

    #sidebarMenu .nav-link i {
        font-size: 18px;
    }

    @media (max-width: 768px) {
        #sidebarMenu {
            position: fixed;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1050;
        }

        #sidebarMenu.show {
            transform: translateX(0);
        }
    }
</style>

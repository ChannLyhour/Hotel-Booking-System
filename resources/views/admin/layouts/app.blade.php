<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'HotelPro') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-indigo: #4f46e5;
            --bg-sidebar: #0f172a;
            --text-sidebar: #94a3b8;
            --hover-sidebar: #1e293b;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--bg-sidebar);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: white;
            text-decoration: none;
        }

        .sidebar-nav {
            flex-grow: 1;
            padding: 1rem;
            overflow-y: auto;
        }

        .nav-category {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #475569;
            margin-bottom: 0.75rem;
            margin-top: 1.5rem;
            letter-spacing: 0.05em;
        }

        .nav-item { margin-bottom: 4px; }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.75rem 1rem;
            color: var(--text-sidebar);
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-link-custom:hover {
            background-color: var(--hover-sidebar);
            color: white;
        }

        .nav-link-custom.active {
            background-color: var(--primary-indigo);
            color: white;
        }

        .nav-link-custom i {
            width: 20px;
            font-size: 1.1rem;
            text-align: center;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .page-content {
            padding: 2rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Auth Pages Styling */
        .auth-wrapper {
            min-height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @guest
        .auth-wrapper { min-height: 100vh; }
        .page-content { padding: 0 !important; }
        @endguest

        .auth-image-side {
            background: linear-gradient(135deg, var(--primary-indigo), #6366f1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .auth-content {
            max-width: 450px;
            width: 100%;
            padding: 2rem;
            margin: auto;
        }

        /* Top Navbar Enhancements */
        .top-navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(10px);
        }
    </style>
    @stack('styles')
</head>
<body>
    @auth
    <!-- Sidebar -->
    <div class="sidebar shadow-lg">
        <div class="sidebar-header">
            <div class="bg-primary rounded-3 p-2 text-white shadow-sm">
                <i class="fa-solid fa-hotel"></i>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">HotelPro <span class="text-primary small ms-1">Admin</span></a>
        </div>

        <div class="sidebar-nav">
            @foreach(\App\Helpers\HelperSidebar::getMenuItems() as $category)
                <div class="nav-category">{{ $category['category'] }}</div>
                @foreach($category['items'] as $item)
                    <div class="nav-item">
                        <a href="{{ route($item['route']) }}" class="nav-link-custom {{ \App\Helpers\HelperSidebar::isActive($item['active']) ? 'active' : '' }}">
                            <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>

        <div class="p-3 border-top border-white-5">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link-custom text-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </div>
    @endauth

    <!-- Main Content -->
    <div class="main-content" @guest style="margin-left: 0;" @endguest>
        @auth
        <div class="top-navbar px-4">
            <div class="d-flex align-items-center gap-3">
                <h5 class="mb-0 fw-bold">Welcome back, {{ Auth::user()->name }}!</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-dark" data-bs-toggle="dropdown">
                        <img src="https://i.pravatar.cc/150?u={{ Auth::user()->email }}" class="rounded-circle shadow-sm border border-2 border-white" style="width: 38px; height: 38px;">
                        <div class="d-none d-sm-block">
                            <div class="fw-bold small" style="line-height: 1">{{ Auth::user()->name }}</div>
                            <div class="text-muted extra-small" style="font-size: 10px">Super Admin</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 mt-2">
                        <li><a class="dropdown-item py-2" href="#"><i class="fa-solid fa-user me-2 small text-muted"></i> Profile</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fa-solid fa-bell me-2 small text-muted"></i> Notifications</a></li>
                        <li><hr class="dropdown-divider mx-2"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-power-off me-2 small"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endauth

        <div class="page-content">
            @yield('content')
        </div>
    </div>


    @stack('scripts')
</body>
</html>


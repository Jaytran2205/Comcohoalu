<!DOCTYPE html>
<html lang="vi" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">

    <title>@yield('title', 'Quản Trị Viên') - Cơm Cổ Hoa Lư</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Tailwind & Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg-secondary text-text-primary h-full flex overflow-hidden">
    <!-- CSRF logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Sidebar Navigation -->
    @include('admin.partials.sidebar')

    <!-- Right Content Area -->
    <div class="flex-grow flex flex-col min-w-0 overflow-hidden bg-bg-secondary">
        
        <!-- Top header bar -->
        <header class="h-16 bg-white border-b border-border-custom/30 flex items-center justify-between px-6 flex-shrink-0">
            <!-- Left Header Title -->
            <div class="flex items-center space-x-3">
                <h1 class="text-sm font-bold text-text-primary uppercase tracking-wider font-sans">
                    @yield('page_title', 'Bảng điều khiển')
                </h1>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center space-x-4 text-xs">
                <div class="flex items-center space-x-2 border-r border-border-custom/30 pr-4">
                    <span class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                        {{ substr(Auth::user()->name ?? 'Q', 0, 1) }}
                    </span>
                    <span class="font-semibold text-text-primary hidden sm:inline">{{ Auth::user()->name ?? 'Quản trị viên' }}</span>
                    <span class="px-2 py-0.5 rounded-full text-[9px] bg-primary text-white font-bold uppercase">{{ Auth::user()->role ?? 'admin' }}</span>
                </div>
                
                <a href="{{ route('home') }}" target="_blank" class="text-text-secondary hover:text-primary transition-colors py-1 px-2 rounded hover:bg-bg-secondary">
                    <i class="fas fa-external-link-alt mr-1"></i>Xem trang chủ
                </a>
                
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-error hover:text-error/85 transition-colors py-1 px-2 rounded hover:bg-error/5 font-semibold">
                    <i class="fas fa-sign-out-alt mr-1"></i>Đăng xuất
                </button>
            </div>
        </header>

        <!-- Main Content (Scrollable) -->
        <main class="flex-grow overflow-y-auto p-6 md:p-8">
            <!-- Breadcrumbs in admin (optional but very nice) -->
            <div class="mb-6 flex justify-between items-center">
                <div class="text-xs text-text-secondary">
                    <span class="hover:text-primary">Hệ quản trị</span>
                    <span class="mx-1.5"><i class="fas fa-chevron-right text-[8px]"></i></span>
                    <span class="text-text-primary font-medium">@yield('page_title', 'Dashboard')</span>
                </div>
                <div>
                    @yield('admin_actions')
                </div>
            </div>

            <!-- Toast Messages for Admin (rendered inside layouts but using layout flow) -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-success/15 border-l-4 border-success text-success text-xs rounded-r-lg flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-2 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-error/15 border-l-4 border-error text-error text-xs rounded-r-lg flex items-center shadow-sm">
                    <i class="fas fa-exclamation-circle mr-2 text-sm"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any() && Request::is('admin*'))
                <div class="mb-6 p-4 bg-error/15 border-l-4 border-error text-error text-xs rounded-r-lg shadow-sm">
                    <div class="font-bold mb-1 flex items-center"><i class="fas fa-exclamation-triangle mr-2 text-sm"></i> Lỗi nhập liệu:</div>
                    <ul class="list-disc list-inside space-y-0.5 pl-2">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Main Render Area -->
            @yield('content')
        </main>
        
    </div>

    @yield('scripts')
</body>
</html>

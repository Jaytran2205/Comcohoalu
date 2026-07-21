<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', $siteSettings['site_name'] ?? 'Cơm Cổ Hoa Lư') - {{ $siteSettings['site_slogan'] ?? 'Hương vị cổ truyền Hoa Lư' }}</title>
    <meta name="description" content="@yield('meta_description', 'Nhà hàng Cơm Cổ Hoa Lư mang đến trải nghiệm ẩm thực đặc sắc Ninh Bình với cơm niêu than hồng, dê núi và các món ăn đặc sản đậm đà hương vị truyền thống.')">
    <meta name="keywords" content="cơm cổ hoa lư, cơm niêu ninh bình, đặc sản ninh bình, dê núi ninh bình, nhà hàng hoa lư">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', $siteSettings['site_name'] ?? 'Cơm Cổ Hoa Lư')">
    <meta property="og:description" content="@yield('meta_description', 'Trải nghiệm ẩm thực cổ truyền Ninh Bình tại Cơm Cổ Hoa Lư.')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- jQuery CDN (Loaded before Vite JS so it is available globally) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Tailwind & Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Analytics -->
    @if(!empty($siteSettings['google_analytics_code']))
        {!! $siteSettings['google_analytics_code'] !!}
    @endif
</head>
<body class="bg-bg-primary text-text-primary min-h-screen flex flex-col antialiased">
    <!-- Facebook SDK for Social Plugins -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0"></script>

    <!-- Header/Navbar -->
    @include('partials.header')

    <!-- Toast Notifications -->
    @include('partials.toast')

    <!-- Main Content Area -->
    <main class="flex-grow {{ request()->routeIs('home') ? '' : 'pt-16' }}">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Floating Contact Buttons -->
    @include('partials.floating-buttons')

    <!-- Extra Scripts -->
    @yield('scripts')
<!-- impeccable-live-start -->
<script src="http://localhost:8400/live.js"></script>
<!-- impeccable-live-end -->
</body>
</html>

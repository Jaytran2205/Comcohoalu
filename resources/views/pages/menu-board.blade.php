@extends('layouts.app')

@section('title', 'Menu - Cơm Cổ Hoa Lư')
@section('meta_description', 'Menu nhà hàng Cơm Cổ Hoa Lư đang trong quá trình cập nhật. Quý khách vui lòng tham khảo các Combo mâm cơm đặc sắc.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Menu',
    'items' => [
        ['label' => 'Menu', 'url' => null]
    ]
])

<section class="py-20 bg-bg-primary min-h-[50vh] flex items-center justify-center">
    <div class="max-w-xl mx-auto px-4 text-center">
        <div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fas fa-book-open"></i>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold font-serif text-primary mb-3">
            Menu Đang Được Cập Nhật
        </h1>
        <div class="w-12 h-1 bg-secondary mx-auto mb-4"></div>
        <p class="text-text-secondary text-sm leading-relaxed mb-8">
            Dữ liệu Menu món đang được ban quản trị hoàn thiện. Quý khách vui lòng khám phá các <strong>Combo Mâm Cơm Đặc Sắc</strong> của nhà hàng hoặc liên hệ hotline để được phục vụ chu đáo nhất.
        </p>
        <div class="flex flex-wrap justify-center items-center gap-4">
            <a href="{{ route('menu') }}" class="px-7 py-3 bg-primary hover:bg-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-wider rounded-lg shadow-md transition-all">
                <i class="fas fa-layer-group mr-1.5"></i>Xem Combo Mâm Cơm
            </a>
            <a href="{{ route('booking.create') }}" class="px-7 py-3 bg-white hover:bg-bg-secondary text-primary border border-border-custom font-bold text-xs uppercase tracking-wider rounded-lg shadow-xs transition-all">
                <i class="fas fa-calendar-alt mr-1.5 text-secondary"></i>Đặt Bàn Ngay
            </a>
        </div>
    </div>
</section>
@endsection

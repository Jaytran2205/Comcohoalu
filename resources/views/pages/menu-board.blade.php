@extends('layouts.app')

@section('title', 'Menu Chính - Cơm Cổ Hoa Lư')
@section('meta_description', 'Khám phá Menu Chính nhà hàng Cơm Cổ Hoa Lư với các món đặc sản dê núi Ninh Bình, thịt lợn quê, gà ta, cá kho tộ niêu đất, canh rau đồng quê và đồ uống truyền thống.')

@section('content')
<div class="bg-bg-primary min-h-screen pb-20">
    <!-- Breadcrumb Header -->
    <div class="bg-white border-b border-border-custom/30 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-xs text-text-secondary">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center">
                    <i class="fas fa-home mr-1.5 text-xs"></i>
                </a>
                <span class="text-border-custom">/</span>
                <span class="text-text-primary font-bold">Menu</span>
            </nav>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <!-- Page Title & Section Header -->
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold font-sans text-primary tracking-tight uppercase">
                MENU
            </h1>
            <h2 class="text-xl sm:text-2xl font-bold font-sans text-primary mt-2 uppercase tracking-wide flex items-center">
                <span class="w-2.5 h-6 bg-secondary mr-2.5 rounded-xs inline-block"></span>
                MENU CHÍNH
            </h2>
        </div>

        <!-- 2-Page Vintage Menu Board Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 max-w-6xl mx-auto">
            
            <!-- ================= PAGE 1 (LEFT) ================= -->
            <div class="relative bg-[#f6eedb] border-[3px] border-[#3d2410] rounded-xl p-5 sm:p-7 shadow-2xl overflow-hidden transition-all duration-300 hover:shadow-primary/20">
                <!-- Inner Border Frame -->
                <div class="absolute inset-2.5 sm:inset-3 border border-[#8a5d3b]/40 rounded-lg pointer-events-none"></div>

                <!-- Vintage L-shaped Corner Brackets -->
                <div class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3 w-5 h-5 border-t-[3px] border-l-[3px] border-[#3d2410] pointer-events-none"></div>
                <div class="absolute top-2.5 right-2.5 sm:top-3 sm:right-3 w-5 h-5 border-t-[3px] border-r-[3px] border-[#3d2410] pointer-events-none"></div>
                <div class="absolute bottom-2.5 left-2.5 sm:bottom-3 sm:left-3 w-5 h-5 border-b-[3px] border-l-[3px] border-[#3d2410] pointer-events-none"></div>
                <div class="absolute bottom-2.5 right-2.5 sm:bottom-3 sm:right-3 w-5 h-5 border-b-[3px] border-r-[3px] border-[#3d2410] pointer-events-none"></div>

                <!-- Header Calligraphy "menu" with Leaves -->
                <div class="text-center mb-6 relative">
                    <span class="font-['Dancing_Script',cursive] text-4xl sm:text-5xl text-[#2c1d11] font-bold tracking-wider inline-block transform -rotate-3 select-none">
                        menu
                    </span>
                    <span class="absolute top-1 right-1/4 text-emerald-600/70 text-sm transform rotate-45 select-none pointer-events-none">🍃</span>
                    <span class="absolute top-0 left-1/4 text-emerald-600/70 text-sm transform -rotate-12 select-none pointer-events-none">🍃</span>
                </div>

                <div class="space-y-6 relative z-10">
                    <!-- 1. THỊT DÊ -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-grow min-w-0">
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Thịt dê</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Dê xào xả ớt</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">260k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Dê xào lăn</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">260k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Dê chao tỏi</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">260k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Dê tái chanh</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">280k</span>
                                </div>
                            </div>
                        </div>
                        <!-- Dish Image Plate -->
                        <div class="w-24 h-24 sm:w-28 sm:h-28 flex-shrink-0 relative group">
                            <div class="w-full h-full rounded-full overflow-hidden border-[2.5px] border-[#1e40af] p-0.5 bg-white shadow-md transform group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/dishes/de-xao.jpg') }}" alt="Thịt dê xào đặc sản" class="w-full h-full object-cover rounded-full" loading="lazy">
                            </div>
                        </div>
                    </div>

                    <!-- 2. THỊT LỢN -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-grow min-w-0">
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Thịt lợn</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Thịt rang cháy cạnh</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">100k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Thịt kho tàu</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">100k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Sườn xào chua ngọt</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">120k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Chân giò luộc chấm mắm nêm</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">120k</span>
                                </div>
                            </div>
                        </div>
                        <!-- Dish Image Plate -->
                        <div class="w-24 h-24 sm:w-28 sm:h-28 flex-shrink-0 relative group">
                            <div class="w-full h-full rounded-full overflow-hidden border-[2.5px] border-[#1e40af] p-0.5 bg-white shadow-md transform group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/dishes/thit-luoc.jpg') }}" alt="Thịt chân giò luộc" class="w-full h-full object-cover rounded-full" loading="lazy">
                            </div>
                        </div>
                    </div>

                    <!-- 3. THỊT GÀ -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-grow min-w-0">
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Thịt gà</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Gà chiên mắm</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">130k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Gà rang xả ớt</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">130k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Gà rang gừng</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">130k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Gà thảo mộc Cố Đô</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">250k</span>
                                </div>
                            </div>
                        </div>
                        <!-- Dish Image Plate -->
                        <div class="w-24 h-24 sm:w-28 sm:h-28 flex-shrink-0 relative group">
                            <div class="w-full h-full rounded-full overflow-hidden border-[2.5px] border-[#1e40af] p-0.5 bg-white shadow-md transform group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/dishes/tom-xao.jpg') }}" alt="Món hải sản gà tôm thơm ngon" class="w-full h-full object-cover rounded-full" loading="lazy">
                            </div>
                        </div>
                    </div>

                    <!-- 4. CÁ & TÔM - MỰC - BÒ (Bottom Row) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        <div>
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Cá</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Cá kho tộ</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">100k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Cá suối chiên giòn</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">120k</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Tôm - Mực - Bò</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Bò xào ngồng tỏi</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">200k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Mực chiên bơ</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">200k</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= PAGE 2 (RIGHT) ================= -->
            <div class="relative bg-[#f6eedb] border-[3px] border-[#3d2410] rounded-xl p-5 sm:p-7 shadow-2xl overflow-hidden transition-all duration-300 hover:shadow-primary/20">
                <!-- Inner Border Frame -->
                <div class="absolute inset-2.5 sm:inset-3 border border-[#8a5d3b]/40 rounded-lg pointer-events-none"></div>

                <!-- Vintage L-shaped Corner Brackets -->
                <div class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3 w-5 h-5 border-t-[3px] border-l-[3px] border-[#3d2410] pointer-events-none"></div>
                <div class="absolute top-2.5 right-2.5 sm:top-3 sm:right-3 w-5 h-5 border-t-[3px] border-r-[3px] border-[#3d2410] pointer-events-none"></div>
                <div class="absolute bottom-2.5 left-2.5 sm:bottom-3 sm:left-3 w-5 h-5 border-b-[3px] border-l-[3px] border-[#3d2410] pointer-events-none"></div>
                <div class="absolute bottom-2.5 right-2.5 sm:bottom-3 sm:right-3 w-5 h-5 border-b-[3px] border-r-[3px] border-[#3d2410] pointer-events-none"></div>

                <!-- Header Calligraphy "menu" with Leaves -->
                <div class="text-center mb-6 relative">
                    <span class="font-['Dancing_Script',cursive] text-4xl sm:text-5xl text-[#2c1d11] font-bold tracking-wider inline-block transform -rotate-3 select-none">
                        menu
                    </span>
                    <span class="absolute top-1 right-1/4 text-emerald-600/70 text-sm transform rotate-45 select-none pointer-events-none">🍃</span>
                    <span class="absolute top-0 left-1/4 text-emerald-600/70 text-sm transform -rotate-12 select-none pointer-events-none">🍃</span>
                </div>

                <div class="space-y-5 relative z-10">
                    <!-- 1. ĐẬU - TRỨNG -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-grow min-w-0">
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Đậu - Trứng</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Đậu sốt cà chua</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">55k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Đậu tẩm hành</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">50k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Đậu rán</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">45k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Trứng rán</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">45k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Trứng đúc thịt</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">80k</span>
                                </div>
                            </div>
                        </div>
                        <!-- Dish Image Plate -->
                        <div class="w-24 h-24 sm:w-28 sm:h-28 flex-shrink-0 relative group">
                            <div class="w-full h-full rounded-full overflow-hidden border-[2.5px] border-[#1e40af] p-0.5 bg-white shadow-md transform group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/dishes/dau-sot.jpg') }}" alt="Đậu sốt cà chua" class="w-full h-full object-cover rounded-full" loading="lazy">
                            </div>
                        </div>
                    </div>

                    <!-- 2. CANH - RAU -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-grow min-w-0">
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Canh - Rau</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Canh cua + Cà</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">70k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Canh chua thịt băm</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">70k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Rau củ luộc kho quẹt</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">65k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Rau luộc</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">40k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Rau xào tỏi</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">55k</span>
                                </div>
                            </div>
                        </div>
                        <!-- 2 Stacked Dish Images -->
                        <div class="flex flex-col space-y-2 flex-shrink-0">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-[2.5px] border-[#1e40af] p-0.5 bg-white shadow-md transform hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/dishes/rau-muong.jpg') }}" alt="Rau muống xào tỏi" class="w-full h-full object-cover rounded-full" loading="lazy">
                            </div>
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-[2.5px] border-[#1e40af] p-0.5 bg-white shadow-md transform hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/dishes/rau-cu-kho-quet.jpg') }}" alt="Rau củ luộc chấm kho quẹt" class="w-full h-full object-cover rounded-full" loading="lazy">
                            </div>
                        </div>
                    </div>

                    <!-- 3. MÓN THÊM & CƠM -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        <div>
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Món thêm</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Dưa chua / Cà pháo</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">15k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Lạc rim muối</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">15k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Ngô chiên</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">50k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Khoai tây chiên</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">50k</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Cơm</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Cơm niêu</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">25k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Cơm điện</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">25k</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. RƯỢU - BIA & TRÀ / NƯỚC NGỌT -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        <div>
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Rượu - Bia</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Bia Sài Gòn</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">20k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Bia Tiger</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">25k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Rượu táo / nếp</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">50k</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="inline-block bg-[#e8dbbe] px-3.5 py-1 rounded-md border border-[#c4b18c] shadow-xs mb-2">
                                <h3 class="text-xs sm:text-sm font-extrabold text-[#3d2410] uppercase tracking-wider font-serif">Trà / Nước ngọt</h3>
                            </div>
                            <div class="space-y-1.5 text-xs sm:text-[13px] font-serif text-[#2c1d11]">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Trà chanh / quất</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">25k</span>
                                </div>
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold whitespace-nowrap">Nước ngọt lon</span>
                                    <span class="flex-grow border-b border-dotted border-[#6b4e33]/60 mx-1.5"></span>
                                    <span class="font-bold font-sans text-[#7a1c14] whitespace-nowrap">15k</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Action CTAs -->
        <div class="mt-12 text-center flex flex-wrap justify-center items-center gap-4">
            <a href="{{ route('booking.create') }}" class="px-8 py-3.5 bg-primary hover:bg-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-wider rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-calendar-check mr-2"></i>Đặt Bàn Ngay
            </a>
            <a href="{{ route('menu') }}" class="px-8 py-3.5 bg-white hover:bg-bg-secondary text-primary border border-border-custom font-bold text-xs uppercase tracking-wider rounded-lg shadow-sm hover:shadow transition-all duration-300">
                <i class="fas fa-utensils mr-2"></i>Xem Thực Đơn Từng Món & Mâm Cơm
            </a>
        </div>
    </div>
</div>
@endsection

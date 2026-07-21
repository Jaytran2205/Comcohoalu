@extends('layouts.app')

@section('title', 'Về Chúng Tôi - Câu Chuyện Cơm Cổ Hoa Lư')
@section('meta_description', 'Tìm hiểu về lịch sử, sứ mệnh gìn giữ bản sắc ẩm thực và không gian mộc mạc đậm chất cố đô Ninh Bình của nhà hàng Cơm Cổ Hoa Lư.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Giới Thiệu Về Cơm Cổ Hoa Lư',
    'items' => [
        ['label' => 'Giới thiệu', 'url' => null]
    ]
])

<!-- Story Section -->
<section class="py-20 bg-bg-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left Side: Image collage -->
            <div class="relative">
                <div class="absolute -inset-4 bg-secondary/15 rounded-3xl -z-10 transform rotate-1"></div>
                <div class="rounded-xl overflow-hidden shadow-lg border border-border-custom/30 aspect-[4/3] bg-bg-secondary">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=800&auto=format&fit=crop" alt="Không gian Cơm Cổ Hoa Lư" class="w-full h-full object-cover">
                </div>
                <!-- Mini overlay image -->
                <div class="absolute -bottom-10 -right-6 w-1/2 rounded-xl overflow-hidden shadow-2xl border-4 border-white hidden sm:block aspect-[4/3] bg-bg-secondary">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=600&auto=format&fit=crop" alt="Ẩm thực niêu đất" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="space-y-6">
                <div class="space-y-3">
                    <h2 class="text-3xl lg:text-4xl font-bold text-primary font-serif leading-tight">Khơi Dậy Bản Sắc Ẩm Thực Cố Đô</h2>
                    <div class="w-12 h-1 bg-secondary rounded-full"></div>
                </div>
                
                <p class="text-text-secondary text-sm sm:text-base leading-relaxed">
                    Kinh đô Hoa Lư xưa không chỉ ghi dấu những trang sử oai hùng của triều đại Đinh - Lê, mà còn là cái nôi sản sinh ra những món ăn tiến vua giản dị nhưng đậm đà bản sắc núi rừng Tràng An. Trải qua ngàn năm thăng trầm, những ngọn lửa than hồng nung niêu cơm đất đã nhạt phai dần trong nhịp sống hiện đại.
                </p>

                <p class="text-text-secondary text-sm sm:text-base leading-relaxed">
                    Với tình yêu sâu sắc dành cho di sản văn hóa cố hương Ninh Bình, nhà sáng lập <strong>Cơm Cổ Hoa Lư</strong> đã dành nhiều năm kiếm tìm, khôi phục những công thức cổ truyền và những chiếc niêu đất nung tay mộc mạc từ đất sét tự nhiên. Mỗi niêu cơm đưa ra phục vụ là kết quả của sự tỉ mỉ từ khâu chọn gạo tám xoan dẻo thơm, đến kỹ thuật canh lửa than củi đều tay để tạo nên lớp cơm cháy vàng giòn tan rụm.
                </p>

                <p class="text-text-secondary text-sm sm:text-base leading-relaxed">
                    Đến với Cơm Cổ Hoa Lư, quý khách không chỉ dùng bữa, mà là đang cùng chúng tôi ngược dòng thời gian, chạm vào một phần ký ức xưa của đất Việt xưa mộc mạc, yên bình và đong đầy tình cảm.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-bg-secondary relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section title -->
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <h2 class="text-3xl md:text-4xl font-bold text-primary font-serif heading-decorator">Giá Trị Cốt Lõi Tại Nhà Hàng</h2>
            <p class="text-text-secondary text-sm md:text-base leading-relaxed max-w-xl mx-auto">Những nguyên tắc bất biến tạo nên uy tín và sự tin mến của thực khách dành cho Cơm Cổ Hoa Lư.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12 pt-4">
            <!-- Value 1 -->
            <div class="space-y-4 text-left border-t border-border-custom/30 pt-8 group">
                <div class="w-12 h-12 rounded-lg bg-primary/5 text-primary flex items-center justify-center text-xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="font-serif font-bold text-lg text-primary">Nguyên Bản</h3>
                <p class="text-text-secondary text-xs leading-relaxed">Giữ trọn vẹn phương pháp nấu cơm niêu đất than hồng và công thức tẩm ướp gia truyền ngàn năm.</p>
            </div>

            <!-- Value 2 -->
            <div class="space-y-4 text-left border-t border-border-custom/30 pt-8 group">
                <div class="w-12 h-12 rounded-lg bg-primary/5 text-primary flex items-center justify-center text-xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3 class="font-serif font-bold text-lg text-primary">Tươi Sạch</h3>
                <p class="text-text-secondary text-xs leading-relaxed">100% dê núi chăn thả tự nhiên và rau củ canh tác hữu cơ từ thung lũng Tràng An xinh đẹp.</p>
            </div>

            <!-- Value 3 -->
            <div class="space-y-4 text-left border-t border-border-custom/30 pt-8 group">
                <div class="w-12 h-12 rounded-lg bg-primary/5 text-primary flex items-center justify-center text-xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="font-serif font-bold text-lg text-primary">Tận Tâm</h3>
                <p class="text-text-secondary text-xs leading-relaxed">Đón tiếp nồng hậu, chu đáo mang hơi ấm gia đình vào trong mỗi khâu phục vụ quý khách hàng.</p>
            </div>

            <!-- Value 4 -->
            <div class="space-y-4 text-left border-t border-border-custom/30 pt-8 group">
                <div class="w-12 h-12 rounded-lg bg-primary/5 text-primary flex items-center justify-center text-xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="font-serif font-bold text-lg text-primary">Trọn Vẹn</h3>
                <p class="text-text-secondary text-xs leading-relaxed">Sự hài lòng tuyệt đối của thực khách trong bữa ăn là hạnh phúc lớn nhất của toàn thể nhân viên.</p>
            </div>
        </div>

    </div>
</section>

<!-- Chef Section -->
<section class="py-20 bg-bg-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left Side: Content -->
            <div class="space-y-6 order-2 lg:order-1">
                <div class="space-y-3">
                    <h2 class="text-3xl lg:text-4xl font-bold text-primary font-serif leading-tight">Đầu Bếp Lưu Giữ Hồn Quê Việt</h2>
                    <div class="w-12 h-1 bg-secondary rounded-full"></div>
                </div>
                
                <p class="text-text-secondary text-sm sm:text-base leading-relaxed">
                    Tại Cơm Cổ Hoa Lư, người đứng sau mỗi niêu cơm nóng hổi, mỗi đĩa dê tái chanh thơm phức là <strong>Bếp trưởng Lê Văn Hoa</strong> - người con đất Ninh Bình với hơn 20 năm tâm huyết gìn giữ ẩm thực cổ truyền. 
                </p>

                <p class="text-text-secondary text-sm sm:text-base leading-relaxed">
                    Bếp trưởng luôn khắt khe từ khâu chọn lựa nguyên liệu đầu vào đến cách giữ nhiệt lò nung. Với anh, nấu ăn không chỉ là sự phối hợp của các loại gia vị, mà là cả một nghệ thuật đối thoại giữa lịch sử cố đô và khẩu vị hiện đại của thực khách.
                </p>

                <blockquote class="p-4 bg-bg-secondary rounded-lg border-l-4 border-primary text-text-primary italic font-serif text-sm leading-relaxed">
                    "Niêu cơm mộc mạc làm từ đất sét, khi nung trên than hồng sẽ tỏa ra mùi thơm của đồng ruộng quê hương mà không chiếc nồi hiện đại nào có được. Đó chính là hồn cốt của bữa cơm gia đình Việt."
                </blockquote>
            </div>

            <!-- Right Side: Chef Image -->
            <div class="relative order-1 lg:order-2">
                <div class="absolute -inset-4 bg-secondary/15 rounded-3xl -z-10 transform -rotate-1"></div>
                <div class="rounded-xl overflow-hidden shadow-lg border border-border-custom/30 aspect-[4/5] bg-bg-secondary max-w-sm mx-auto">
                    <!-- Chef Image -->
                    <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?q=80&w=800&auto=format&fit=crop" alt="Bếp trưởng Lê Văn Hoa" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-20 bg-bg-secondary relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <h2 class="text-3xl md:text-4xl font-bold text-primary font-serif mt-2 heading-decorator-double">Khoảnh Khắc Hoa Lư</h2>
            <p class="text-text-secondary text-sm md:text-base leading-relaxed max-w-xl mx-auto">Chiêm ngưỡng những hình ảnh chân thực về các món ăn đặc sắc và kiến trúc mang đậm dấu ấn cung đình cổ xưa.</p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="rounded-xl overflow-hidden aspect-[4/3] bg-bg-primary shadow-sm hover:scale-[1.02] transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1560624052-449f5ddf0c31?q=80&w=600&auto=format&fit=crop" alt="Không gian gỗ" class="w-full h-full object-cover">
            </div>
            <div class="rounded-xl overflow-hidden aspect-[4/3] bg-bg-primary shadow-sm hover:scale-[1.02] transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=600&auto=format&fit=crop" alt="Dê tái chanh" class="w-full h-full object-cover">
            </div>
            <div class="rounded-xl overflow-hidden aspect-[4/3] bg-bg-primary shadow-sm hover:scale-[1.02] transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1589301760014-d929f3979dbc?q=80&w=600&auto=format&fit=crop" alt="Cơm niêu giòn tan" class="w-full h-full object-cover">
            </div>
            <div class="rounded-xl overflow-hidden aspect-[4/3] bg-bg-primary shadow-sm hover:scale-[1.02] transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?q=80&w=600&auto=format&fit=crop" alt="Phục vụ chu đáo" class="w-full h-full object-cover">
            </div>
            <div class="rounded-xl overflow-hidden aspect-[4/3] bg-bg-primary shadow-sm hover:scale-[1.02] transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=600&auto=format&fit=crop" alt="Góc ấm cúng" class="w-full h-full object-cover">
            </div>
            <div class="rounded-xl overflow-hidden aspect-[4/3] bg-bg-primary shadow-sm hover:scale-[1.02] transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1543007630-9710e4a00a20?q=80&w=600&auto=format&fit=crop" alt="Bình rượu cổ" class="w-full h-full object-cover">
            </div>
        </div>

    </div>
</section>
@endsection

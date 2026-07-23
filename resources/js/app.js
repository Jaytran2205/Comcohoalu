// Make sure jQuery is available (should be loaded via CDN prior to app.js, or imported)
$(document).ready(function () {
    // ── CSRF Token for AJAX ──
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ── Public Mobile Menu Toggle ──
    const $mobileMenuBtn = $('#mobile-menu-btn');
    const $mobileMenu = $('#mobile-menu');
    const $mobileMenuClose = $('#mobile-menu-close');
    const $mobileBackdrop = $('#mobile-menu-backdrop');

    function openMobileMenu() {
        if (!$mobileMenu.length) return;
        $mobileBackdrop.removeClass('hidden');
        $mobileMenu.removeClass('hidden');
        setTimeout(function () {
            $mobileMenu.removeClass('translate-x-full');
        }, 10);
        $('body').css('overflow', 'hidden');
    }

    function closeMobileMenu() {
        if (!$mobileMenu.length) return;
        $mobileMenu.addClass('translate-x-full');
        $mobileBackdrop.addClass('hidden');
        setTimeout(function () {
            $mobileMenu.addClass('hidden');
        }, 300);
        $('body').css('overflow', '');
    }

    if ($mobileMenuBtn.length && $mobileMenu.length) {
        $mobileMenuBtn.on('click', function (e) {
            e.stopPropagation();
            if ($mobileMenu.hasClass('hidden') || $mobileMenu.hasClass('translate-x-full')) {
                openMobileMenu();
            } else {
                closeMobileMenu();
            }
        });

        $mobileMenuClose.on('click', closeMobileMenu);
        $mobileBackdrop.on('click', closeMobileMenu);

        $(document).on('keyup', function (e) {
            if (e.key === 'Escape') closeMobileMenu();
        });
    }

    // ── Admin Mobile Sidebar Toggle ──
    const $adminSidebarToggle = $('#admin-mobile-sidebar-toggle');
    const $adminSidebarMobile = $('#admin-sidebar-mobile');
    const $adminSidebarClose = $('#admin-sidebar-close');
    const $adminSidebarBackdrop = $('#admin-sidebar-backdrop');

    function openAdminSidebar() {
        if (!$adminSidebarMobile.length) return;
        $adminSidebarBackdrop.removeClass('hidden');
        $adminSidebarMobile.removeClass('hidden');
        setTimeout(function () {
            $adminSidebarMobile.removeClass('-translate-x-full');
        }, 10);
    }

    function closeAdminSidebar() {
        if (!$adminSidebarMobile.length) return;
        $adminSidebarMobile.addClass('-translate-x-full');
        $adminSidebarBackdrop.addClass('hidden');
        setTimeout(function () {
            $adminSidebarMobile.addClass('hidden');
        }, 300);
    }

    if ($adminSidebarToggle.length && $adminSidebarMobile.length) {
        $adminSidebarToggle.on('click', function (e) {
            e.stopPropagation();
            openAdminSidebar();
        });

        if ($adminSidebarClose.length) $adminSidebarClose.on('click', closeAdminSidebar);
        if ($adminSidebarBackdrop.length) $adminSidebarBackdrop.on('click', closeAdminSidebar);
    }

    // ── Fullscreen Video Intro & Hero Card Scroll Reveal ──
    const $siteHeader = $('#site-header');
    const $heroGlassCard = $('#hero-glass-card');
    const $scrollCue = $('#scroll-cue');

    function handleScrollEffects() {
        const scrollTop = $(window).scrollTop();

        // 1. Dynamic Header Transition
        if ($siteHeader.length) {
            if ($('#hero-section').length) {
                if (scrollTop > 25) {
                    $siteHeader.addClass('header-scrolled').removeClass('header-transparent');
                } else {
                    $siteHeader.addClass('header-transparent').removeClass('header-scrolled');
                }
            } else {
                $siteHeader.addClass('header-scrolled').removeClass('header-transparent');
            }
        }

        // 2. Hero Content Card Reveal (Hidden at top video intro, reveals when scrolling down)
        if ($heroGlassCard.length) {
            if (scrollTop < 15) {
                // Completely hidden at the top of the video intro
                $heroGlassCard
                    .addClass('opacity-0 pointer-events-none translate-y-10 scale-95')
                    .removeClass('opacity-100 pointer-events-auto translate-y-0 scale-100');

                if ($scrollCue.length) {
                    $scrollCue.removeClass('opacity-0 pointer-events-none');
                }
            } else {
                // Smoothly slide up & fade in centered over the video background
                $heroGlassCard
                    .removeClass('opacity-0 pointer-events-none translate-y-10 scale-95')
                    .addClass('opacity-100 pointer-events-auto translate-y-0 scale-100');

                if ($scrollCue.length) {
                    $scrollCue.addClass('opacity-0 pointer-events-none');
                }
            }
        }
    }

    // Smooth scroll down slightly inside video intro bounds to center hero card
    if ($scrollCue.length) {
        $scrollCue.on('click', function () {
            $('html, body').animate({
                scrollTop: 40
            }, 500);
        });
    }

    $(window).on('scroll resize', handleScrollEffects);
    handleScrollEffects();

    // ── Toast Notification Dismissal ──
    const $toasts = $('.toast-notification');
    if ($toasts.length) {
        $toasts.each(function () {
            const $toast = $(this);
            // Auto hide after 4 seconds
            setTimeout(function () {
                $toast.fadeOut(500, function () {
                    $toast.remove();
                });
            }, 4000);

            // Close button click
            $toast.find('.toast-close').on('click', function () {
                $toast.fadeOut(300, function () {
                    $toast.remove();
                });
            });
        });
    }

    // ── Active Navigation Links ──
    const currentUrl = window.location.pathname;
    $('.nav-link').each(function () {
        const href = $(this).attr('href');
        if (href) {
            const path = new URL(href, window.location.origin).pathname;
            if (currentUrl === path || (path !== '/' && currentUrl.startsWith(path))) {
                $(this).addClass('active text-primary font-bold');
            }
        }
    });

    // ── Menu Filter & Search (AJAX) ──
    const $menuGrid = $('#menu-items-grid');
    const $categoryFilters = $('.category-filter-btn');
    const $menuSearchInput = $('#menu-search-input');
    const $loadMoreBtn = $('#load-more-btn');
    const $loadMoreContainer = $('#load-more-container');
    const $loadMoreSpinner = $('#load-more-spinner');
    const $loadMoreText = $('#load-more-text');
    let searchTimeout;

    if ($menuGrid.length) {
        let activeCategoryId = '';
        let searchQuery = '';

        // Category filter click
        $categoryFilters.on('click', function () {
            $categoryFilters.removeClass('bg-primary text-white border-primary').addClass('bg-white text-text-secondary border-border-custom');
            $(this).addClass('bg-primary text-white border-primary').removeClass('bg-white text-text-secondary border-border-custom');

            activeCategoryId = $(this).data('category-id') || '';
            fetchFilteredMenu();
        });

        // Search typing (Debounced to avoid flooding DB)
        $menuSearchInput.on('input', function () {
            clearTimeout(searchTimeout);
            searchQuery = $(this).val();
            searchTimeout = setTimeout(function () {
                fetchFilteredMenu();
            }, 400); // 400ms debounce
        });

        // Click Load More
        $loadMoreBtn.on('click', function () {
            const nextPage = $(this).attr('data-next-page');
            if (!nextPage) return;

            // Show loading state in button
            $loadMoreBtn.prop('disabled', true);
            $loadMoreSpinner.removeClass('hidden');
            $loadMoreText.text('Đang tải...');

            $.ajax({
                url: '/menu/filter',
                type: 'GET',
                data: {
                    category_id: activeCategoryId,
                    search: searchQuery,
                    page: nextPage
                },
                success: function (response) {
                    if (response && response.html) {
                        $menuGrid.append(response.html);
                        
                        // Update next page
                        $loadMoreBtn.attr('data-next-page', response.nextPage);
                        
                        // Show/hide Load More container
                        if (response.hasMore) {
                            $loadMoreContainer.removeClass('hidden');
                        } else {
                            $loadMoreContainer.addClass('hidden');
                        }
                    }
                },
                error: function () {
                    alert('Đã có lỗi xảy ra khi tải thêm món ăn. Vui lòng thử lại.');
                },
                complete: function () {
                    // Reset button state
                    $loadMoreBtn.prop('disabled', false);
                    $loadMoreSpinner.addClass('hidden');
                    $loadMoreText.text('Xem thêm món ngon');
                }
            });
        });

        function fetchFilteredMenu() {
            // Show loading state
            $menuGrid.html(`
                <div class="col-span-full py-16 text-center">
                    <i class="fas fa-spinner fa-spin text-4xl text-primary mb-4"></i>
                    <p class="text-text-secondary font-serif">Đang tìm kiếm món ngon Hoa Lư...</p>
                </div>
            `);
            $loadMoreContainer.addClass('hidden');

            $.ajax({
                url: '/menu/filter',
                type: 'GET',
                data: {
                    category_id: activeCategoryId,
                    search: searchQuery,
                    page: 1
                },
                success: function (response) {
                    if (response && response.html) {
                        $menuGrid.html(response.html);
                        
                        // Reset Load More button to page 2
                        $loadMoreBtn.attr('data-next-page', response.nextPage || 2);
                        
                        // Show/hide Load More container
                        if (response.hasMore) {
                            $loadMoreContainer.removeClass('hidden');
                        } else {
                            $loadMoreContainer.addClass('hidden');
                        }
                    } else {
                        // Fallback in case of raw HTML response
                        $menuGrid.html(response);
                        $loadMoreContainer.addClass('hidden');
                    }
                },
                error: function () {
                    $menuGrid.html(`
                        <div class="col-span-full py-16 text-center text-error">
                            <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                            <p class="font-serif">Đã có lỗi xảy ra khi tải thực đơn. Vui lòng thử lại sau.</p>
                        </div>
                    `);
                    $loadMoreContainer.addClass('hidden');
                }
            });
        }
    }

    // ── Quick View Modal (Optional & Premium) ──
    $(document).on('click', '.quick-view-btn', function (e) {
        e.preventDefault();
        const itemId = $(this).data('item-id');

        // Show loading modal or dialog
        if (itemId) {
            $.get(`/api/menu/${itemId}`, function (data) {
                // Resolve image path correctly
                let dishImage = '/images/default-dish.jpg';
                if (data.image) {
                    dishImage = data.image.startsWith('http') ? data.image : '/storage/' + data.image;
                }

                const modalHtml = `
                    <div id="quick-view-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60">
                        <div class="relative w-full max-w-2xl bg-bg-primary rounded-xl overflow-hidden shadow-2xl border border-border-custom max-h-[90vh] overflow-y-auto">
                            <button id="close-modal" class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-black/40 text-white hover:bg-primary transition-all">
                                <i class="fas fa-times"></i>
                            </button>
                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <div class="relative h-64 md:h-full min-h-[250px]">
                                    <img src="${dishImage}" alt="${data.name}" class="absolute inset-0 w-full h-full object-cover">
                                    ${data.badge ? `<span class="absolute top-4 left-4 px-3 py-1 text-xs font-bold uppercase rounded bg-secondary text-bg-dark">${data.badge}</span>` : ''}
                                </div>
                                <div class="p-6 md:p-8 flex flex-col justify-between">
                                    <div>
                                        <span class="text-xs font-semibold uppercase tracking-wider text-secondary">${data.category}</span>
                                        <h3 class="text-2xl font-bold text-primary mt-1 mb-2">${data.name}</h3>
                                        <p class="text-xl font-bold text-primary-light font-serif mb-4">${data.formatted_price}</p>
                                        <p class="text-text-secondary text-sm leading-relaxed mb-6">${data.description || 'Món ăn truyền thống hấp dẫn được chuẩn bị bởi đầu bếp Cơm Cổ Hoa Lư.'}</p>
                                    </div>
                                    <div class="border-t border-border-custom pt-4">
                                        <a href="/dat-ban" class="inline-block w-full py-3 text-center font-bold text-bg-dark bg-secondary hover:bg-secondary-dark rounded-lg transition-all">
                                            <i class="fas fa-calendar-alt mr-2"></i>Đặt bàn ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('body').append(modalHtml);
            });
        }
    });

    $(document).on('click', '#close-modal, #quick-view-modal', function (e) {
        if (e.target.id === 'quick-view-modal' || $(e.target).closest('#close-modal').length) {
            $('#quick-view-modal').fadeOut(300, function () {
                $(this).remove();
            });
        }
    });

    // ── Booking Form Validation & Constraints ──
    const $bookingForm = $('#booking-form');
    if ($bookingForm.length) {
        // Validate date is not in the past
        const today = new Date().toISOString().split('T')[0];
        $('#booking_date').attr('min', today);

        $bookingForm.on('submit', function (e) {
            let isValid = true;
            const $name = $('#customer_name');
            const $phone = $('#customer_phone');
            const $guests = $('#adults');
            const $time = $('#booking_time');
            const $date = $('#booking_date');

            // Name check
            if ($.trim($name.val()) === '') {
                showFieldError($name, 'Vui lòng nhập tên của quý khách.');
                isValid = false;
            } else {
                clearFieldError($name);
            }

            // Phone check (Vietnam format)
            const phoneRegex = /^(03|05|07|08|09|01[2|6|8|9])+\d{8}$/;
            if (!phoneRegex.test($phone.val())) {
                showFieldError($phone, 'Số điện thoại không hợp lệ (nhập 10 số bắt đầu bằng 0).');
                isValid = false;
            } else {
                clearFieldError($phone);
            }

            // Guests check
            if (parseInt($guests.val()) < 1 || isNaN(parseInt($guests.val()))) {
                showFieldError($guests, 'Số lượng người lớn phải tối thiểu là 1 người.');
                isValid = false;
            } else {
                clearFieldError($guests);
            }

            // Date check
            if ($date.val() === '') {
                showFieldError($date, 'Vui lòng chọn ngày dùng bữa.');
                isValid = false;
            } else {
                clearFieldError($date);
            }

            // Time check
            if ($time.val() === '') {
                showFieldError($time, 'Vui lòng chọn giờ dùng bữa.');
                isValid = false;
            } else {
                const timeVal = $time.val();
                const [hours, minutes] = timeVal.split(':').map(Number);
                const totalMinutes = hours * 60 + minutes;

                // Lunch: 10:00 - 14:00 (600 - 840 mins)
                // Dinner: 17:00 - 22:00 (1020 - 1320 mins)
                const isLunch = totalMinutes >= 600 && totalMinutes <= 840;
                const isDinner = totalMinutes >= 1020 && totalMinutes <= 1320;

                if (!isLunch && !isDinner) {
                    showFieldError($time, 'Giờ hoạt động: Trưa (10:00 - 14:00) hoặc Tối (17:00 - 22:00).');
                    isValid = false;
                } else {
                    clearFieldError($time);
                }
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        function showFieldError($input, msg) {
            $input.addClass('border-error ring-1 ring-error/50');
            let $errorLabel = $input.next('.field-error-msg');
            if (!$errorLabel.length) {
                $errorLabel = $('<span class="field-error-msg text-error text-xs mt-1 block"></span>');
                $input.after($errorLabel);
            }
            $errorLabel.text(msg);
        }

        function clearFieldError($input) {
            $input.removeClass('border-error ring-1 ring-error/50');
            $input.next('.field-error-msg').remove();
        }
    }
});

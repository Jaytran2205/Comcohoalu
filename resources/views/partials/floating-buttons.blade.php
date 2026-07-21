@php
    $hotline = $siteSettings['site_hotline'] ?? '0866.000.000';
    $cleanPhone = str_replace(['.', ' ', '-'], '', $hotline);
    
    // Zalo fallback: link to zalo.me/phone if Zalo URL setting is empty
    $zaloUrl = $siteSettings['site_zalo'] ?? '';
    if (empty($zaloUrl)) {
        $zaloUrl = 'https://zalo.me/' . $cleanPhone;
    }
    
    // Messenger fallback: convert Facebook page to m.me link, or fallback to #
    $facebookUrl = $siteSettings['site_facebook'] ?? '';
    $messengerUrl = '#';
    if (!empty($facebookUrl)) {
        if (preg_match('/facebook\.com\/([a-zA-Z0-9\.]+)/', $facebookUrl, $matches)) {
            $messengerUrl = 'https://m.me/' . $matches[1];
        } else {
            $messengerUrl = $facebookUrl;
        }
    }
@endphp

<!-- Floating Contact Buttons -->
<div class="floating-contact-container">
    
    <!-- Messenger Button -->
    <a href="{{ $messengerUrl }}" target="_blank" rel="noopener noreferrer" 
       class="floating-contact-btn bg-messenger"
       title="Chat Messenger">
        <i class="fab fa-facebook-messenger text-lg md:text-xl"></i>
        <!-- Tooltip -->
        <span class="floating-tooltip">
            Chat Messenger
        </span>
    </a>

    <!-- Zalo Button -->
    <a href="{{ $zaloUrl }}" target="_blank" rel="noopener noreferrer" 
       class="floating-contact-btn bg-zalo"
       title="Chat Zalo">
        <!-- Zalo Speech Bubble SVG -->
        <svg class="zalo-svg fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.003 2C6.478 2 2 6.03 2 11c0 2.535 1.187 4.815 3.1 6.345-.24.845-.85 2.445-.85 2.445s1.65-.29 3.22-1.105c1.49.435 3.09.695 4.83.695 5.525 0 10.003-4.03 10.003-9 0-4.97-4.478-9-10.003-9zm3.565 11.395h-3.23l-.57 1.38h-1.43l2.31-5.34h1.25l2.31 5.34h-1.41l-.57-1.38zm-2.68-1.12h2.14l-1.07-2.57-1.07 2.57zm4.94 2.5H16.29V9.435h1.22v4.185h2.22v1.155zm3.43-2.7c0 1.61-1.15 2.825-2.73 2.825s-2.73-1.215-2.73-2.825 1.15-2.825 2.73-2.825 2.73 1.215 2.73 2.825zm-4.08 0c0 .97.55 1.67 1.35 1.67.8 0 1.35-.7 1.35-1.67s-.55-1.67-1.35-1.67c-.8 0-1.35.7-1.35 1.67z"/>
        </svg>
        <!-- Tooltip -->
        <span class="floating-tooltip">
            Chat Zalo
        </span>
    </a>

    <!-- Directions/Map Button -->
    <a href="{{ route('contact') }}" 
       class="floating-contact-btn bg-directions"
       title="Chỉ đường bản đồ">
        <i class="fas fa-map-marker-alt text-lg md:text-xl"></i>
        <!-- Tooltip -->
        <span class="floating-tooltip">
            Chỉ đường bản đồ
        </span>
    </a>

    <!-- Hotline Button with custom pulse styling -->
    <a href="tel:{{ $cleanPhone }}" 
       class="floating-contact-btn bg-hotline phone-pulse-btn"
       title="Gọi Hotline">
        <i class="fas fa-phone-alt text-lg md:text-xl rotate-12 transition-transform duration-300"></i>
        <!-- Tooltip -->
        <span class="floating-tooltip">
            Hotline: {{ $hotline }}
        </span>
    </a>
</div>

<style>
/* Base Floating Contact Container styling */
.floating-contact-container {
    position: fixed !important;
    right: 16px !important;
    bottom: 32px !important;
    z-index: 99999 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
    visibility: visible !important;
    opacity: 1 !important;
}

@media (min-width: 768px) {
    .floating-contact-container {
        right: 24px !important;
        bottom: 40px !important;
    }
}

/* Individual Floating Button styling */
.floating-contact-btn {
    width: 48px !important;
    height: 48px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    box-shadow: 0 4px 16px rgba(44, 24, 16, 0.2) !important;
    position: relative !important;
    text-decoration: none !important;
    visibility: visible !important;
    opacity: 1 !important;
}

@media (min-width: 768px) {
    .floating-contact-btn {
        width: 56px !important;
        height: 56px !important;
    }
}

.floating-contact-btn:hover {
    transform: scale(1.1) translateY(-4px);
    box-shadow: 0 8px 24px rgba(44, 24, 16, 0.35);
}

/* Specific heritage colors */
.bg-messenger {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45);
}
.bg-messenger i {
    color: var(--color-secondary) !important;
}
.bg-messenger:hover {
    background-color: var(--color-secondary) !important;
}
.bg-messenger:hover i {
    color: var(--color-bg-dark) !important;
}

.bg-zalo {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45);
}
.bg-zalo .zalo-svg {
    color: var(--color-secondary) !important;
}
.bg-zalo:hover {
    background-color: var(--color-secondary) !important;
}
.bg-zalo:hover .zalo-svg {
    color: var(--color-bg-dark) !important;
}

.bg-directions {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45);
}
.bg-directions i {
    color: var(--color-secondary) !important;
}
.bg-directions:hover {
    background-color: var(--color-secondary) !important;
}
.bg-directions:hover i {
    color: var(--color-bg-dark) !important;
}

.bg-hotline {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45);
}
.bg-hotline i {
    color: var(--color-secondary) !important;
}
.bg-hotline:hover {
    background-color: var(--color-secondary) !important;
}
.bg-hotline:hover i {
    color: var(--color-bg-dark) !important;
}

/* Tooltip styles */
.floating-tooltip {
    position: absolute;
    right: 58px;
    background-color: rgba(44, 24, 16, 0.95);
    color: #FFF9F0;
    font-size: 12px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 8px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    opacity: 0;
    visibility: hidden;
    transform: translateX(10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    border: 1px solid rgba(212, 197, 178, 0.2);
    pointer-events: none;
    font-family: 'Open Sans', 'Segoe UI', system-ui, sans-serif;
}

@media (min-width: 768px) {
    .floating-tooltip {
        right: 68px;
    }
}

.floating-contact-btn:hover .floating-tooltip {
    opacity: 1;
    visibility: visible;
    transform: translateX(0);
}

/* Zalo SVG sizing */
.zalo-svg {
    width: 24px;
    height: 24px;
}
@media (min-width: 768px) {
    .zalo-svg {
        width: 28px;
        height: 28px;
    }
}

/* Pulse animation for Hotline button */
@keyframes ping-slow {
    0% {
        transform: scale(1);
        opacity: 0.7;
    }
    50% {
        opacity: 0.4;
    }
    100% {
        transform: scale(1.45);
        opacity: 0;
    }
}

.phone-pulse-btn::before {
    content: '';
    position: absolute;
    top: -4px;
    left: -4px;
    right: -4px;
    bottom: -4px;
    border: 2px solid var(--color-secondary);
    border-radius: 50%;
    opacity: 0.5;
    animation: ping-slow 2s infinite ease-out;
    pointer-events: none;
}

.phone-pulse-btn::after {
    content: '';
    position: absolute;
    top: -8px;
    left: -8px;
    right: -8px;
    bottom: -8px;
    border: 2px solid var(--color-secondary);
    border-radius: 50%;
    opacity: 0.3;
    animation: ping-slow 2s infinite ease-out;
    animation-delay: 0.8s;
    pointer-events: none;
}
</style>

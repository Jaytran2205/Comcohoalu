@php
    $hotline = $siteSettings['site_hotline'] ?? '0866.000.000';
    $cleanPhone = str_replace(['.', ' ', '-'], '', $hotline);
    
    // Zalo fallback
    $zaloUrl = $siteSettings['site_zalo'] ?? '';
    if (empty($zaloUrl)) {
        $zaloUrl = 'https://zalo.me/' . $cleanPhone;
    }
    
    // Messenger fallback
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

<!-- Generic class names (c-bar, c-item) to prevent mobile ad-blockers / content-blockers from hiding them -->
<div class="c-bar">
    
    <!-- Messenger -->
    <a href="{{ $messengerUrl }}" target="_blank" rel="noopener noreferrer" 
       class="c-item c-m"
       title="Chat Messenger">
        <i class="fab fa-facebook-messenger text-lg md:text-xl"></i>
        <span class="c-tt">
            Chat Messenger
        </span>
    </a>

    <!-- Zalo -->
    <a href="{{ $zaloUrl }}" target="_blank" rel="noopener noreferrer" 
       class="c-item c-z"
       title="Chat Zalo">
        <svg class="c-z-svg fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.003 2C6.478 2 2 6.03 2 11c0 2.535 1.187 4.815 3.1 6.345-.24.845-.85 2.445-.85 2.445s1.65-.29 3.22-1.105c1.49.435 3.09.695 4.83.695 5.525 0 10.003-4.03 10.003-9 0-4.97-4.478-9-10.003-9zm3.565 11.395h-3.23l-.57 1.38h-1.43l2.31-5.34h1.25l2.31 5.34h-1.41l-.57-1.38zm-2.68-1.12h2.14l-1.07-2.57-1.07 2.57zm4.94 2.5H16.29V9.435h1.22v4.185h2.22v1.155zm3.43-2.7c0 1.61-1.15 2.825-2.73 2.825s-2.73-1.215-2.73-2.825 1.15-2.825 2.73-2.825 2.73 1.215 2.73 2.825zm-4.08 0c0 .97.55 1.67 1.35 1.67.8 0 1.35-.7 1.35-1.67s-.55-1.67-1.35-1.67c-.8 0-1.35.7-1.35 1.67z"/>
        </svg>
        <span class="c-tt">
            Chat Zalo
        </span>
    </a>

    <!-- Directions/Map -->
    <a href="{{ route('contact') }}" 
       class="c-item c-d"
       title="Chỉ đường bản đồ">
        <i class="fas fa-map-marker-alt text-lg md:text-xl"></i>
        <span class="c-tt">
            Chỉ đường bản đồ
        </span>
    </a>

    <!-- Hotline -->
    <a href="tel:{{ $cleanPhone }}" 
       class="c-item c-h c-p"
       title="Gọi Hotline">
        <i class="fas fa-phone-alt text-lg md:text-xl rotate-12 transition-transform duration-300"></i>
        <span class="c-tt">
            Hotline: {{ $hotline }}
        </span>
    </a>
</div>

<style>
.c-bar {
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
    .c-bar {
        right: 24px !important;
        bottom: 40px !important;
    }
}

.c-item {
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
    .c-item {
        width: 56px !important;
        height: 56px !important;
    }
}

.c-item:hover {
    transform: scale(1.1) translateY(-4px) !important;
    box-shadow: 0 8px 24px rgba(44, 24, 16, 0.35) !important;
}

.c-m {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45) !important;
}
.c-m i {
    color: var(--color-secondary) !important;
}
.c-m:hover {
    background-color: var(--color-secondary) !important;
}
.c-m:hover i {
    color: var(--color-bg-dark) !important;
}

.c-z {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45) !important;
}
.c-z .c-z-svg {
    color: var(--color-secondary) !important;
}
.c-z:hover {
    background-color: var(--color-secondary) !important;
}
.c-z:hover .c-z-svg {
    color: var(--color-bg-dark) !important;
}

.c-d {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45) !important;
}
.c-d i {
    color: var(--color-secondary) !important;
}
.c-d:hover {
    background-color: var(--color-secondary) !important;
}
.c-d:hover i {
    color: var(--color-bg-dark) !important;
}

.c-h {
    background-color: var(--color-bg-dark) !important;
    border: 1px solid rgba(212, 168, 85, 0.45) !important;
}
.c-h i {
    color: var(--color-secondary) !important;
}
.c-h:hover {
    background-color: var(--color-secondary) !important;
}
.c-h:hover i {
    color: var(--color-bg-dark) !important;
}

.c-tt {
    position: absolute !important;
    right: 58px !important;
    background-color: rgba(44, 24, 16, 0.95) !important;
    color: #FFF9F0 !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    padding: 6px 12px !important;
    border-radius: 8px !important;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25) !important;
    opacity: 0 !important;
    visibility: hidden !important;
    transform: translateX(10px) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    white-space: nowrap !important;
    border: 1px solid rgba(212, 197, 178, 0.2) !important;
    pointer-events: none !important;
    font-family: 'Open Sans', 'Segoe UI', system-ui, sans-serif !important;
}

@media (min-width: 768px) {
    .c-tt {
        right: 68px !important;
    }
}

.c-item:hover .c-tt {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateX(0) !important;
}

.c-z-svg {
    width: 24px !important;
    height: 24px !important;
}
@media (min-width: 768px) {
    .c-z-svg {
        width: 28px !important;
        height: 28px !important;
    }
}

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

.c-p::before {
    content: '' !important;
    position: absolute !important;
    top: -4px !important;
    left: -4px !important;
    right: -4px !important;
    bottom: -4px !important;
    border: 2px solid var(--color-secondary) !important;
    border-radius: 50% !important;
    opacity: 0.5 !important;
    animation: ping-slow 2s infinite ease-out !important;
    pointer-events: none !important;
}

.c-p::after {
    content: '' !important;
    position: absolute !important;
    top: -8px !important;
    left: -8px !important;
    right: -8px !important;
    bottom: -8px !important;
    border: 2px solid var(--color-secondary) !important;
    border-radius: 50% !important;
    opacity: 0.3 !important;
    animation: ping-slow 2s infinite ease-out !important;
    animation-delay: 0.8s !important;
    pointer-events: none !important;
}
</style>

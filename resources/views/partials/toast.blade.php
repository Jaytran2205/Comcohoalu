<div class="fixed top-24 right-4 z-50 flex flex-col gap-3 pointer-events-none max-w-sm w-full">
    @if(session('success'))
        <div class="toast-notification pointer-events-auto flex items-center p-4 bg-white rounded-lg shadow-lg border-l-4 border-success text-text-primary transition-all duration-300" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-success bg-success/10 rounded-lg">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="ml-3 text-sm font-semibold pr-2">{{ session('success') }}</div>
            <button type="button" class="toast-close ml-auto -mx-1.5 -my-1.5 bg-white text-text-secondary hover:text-text-primary rounded-lg p-1.5 hover:bg-bg-secondary inline-flex items-center justify-center h-8 w-8 transition-all">
                <span class="sr-only">Đóng</span>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-notification pointer-events-auto flex items-center p-4 bg-white rounded-lg shadow-lg border-l-4 border-error text-text-primary transition-all duration-300" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-error bg-error/10 rounded-lg">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="ml-3 text-sm font-semibold pr-2">{{ session('error') }}</div>
            <button type="button" class="toast-close ml-auto -mx-1.5 -my-1.5 bg-white text-text-secondary hover:text-text-primary rounded-lg p-1.5 hover:bg-bg-secondary inline-flex items-center justify-center h-8 w-8 transition-all">
                <span class="sr-only">Đóng</span>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if($errors->any() && !Request::is('login'))
        <div class="toast-notification pointer-events-auto flex items-center p-4 bg-white rounded-lg shadow-lg border-l-4 border-error text-text-primary transition-all duration-300" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-error bg-error/10 rounded-lg">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="ml-3 text-sm font-semibold pr-2">Thông tin nhập vào chưa hợp lệ. Vui lòng kiểm tra lại.</div>
            <button type="button" class="toast-close ml-auto -mx-1.5 -my-1.5 bg-white text-text-secondary hover:text-text-primary rounded-lg p-1.5 hover:bg-bg-secondary inline-flex items-center justify-center h-8 w-8 transition-all">
                <span class="sr-only">Đóng</span>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('warning'))
        <div class="toast-notification pointer-events-auto flex items-center p-4 bg-white rounded-lg shadow-lg border-l-4 border-warning text-text-primary transition-all duration-300" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-warning bg-warning/10 rounded-lg">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="ml-3 text-sm font-semibold pr-2">{{ session('warning') }}</div>
            <button type="button" class="toast-close ml-auto -mx-1.5 -my-1.5 bg-white text-text-secondary hover:text-text-primary rounded-lg p-1.5 hover:bg-bg-secondary inline-flex items-center justify-center h-8 w-8 transition-all">
                <span class="sr-only">Đóng</span>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('info'))
        <div class="toast-notification pointer-events-auto flex items-center p-4 bg-white rounded-lg shadow-lg border-l-4 border-info text-text-primary transition-all duration-300" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-info bg-info/10 rounded-lg">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="ml-3 text-sm font-semibold pr-2">{{ session('info') }}</div>
            <button type="button" class="toast-close ml-auto -mx-1.5 -my-1.5 bg-white text-text-secondary hover:text-text-primary rounded-lg p-1.5 hover:bg-bg-secondary inline-flex items-center justify-center h-8 w-8 transition-all">
                <span class="sr-only">Đóng</span>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
</div>

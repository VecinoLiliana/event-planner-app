<div class="block">
    <!-- Logo de LoopEvents -->
    @php($builtLogoPng = public_path('build/assets/images/LogoLoopEvents.png'))
    @php($logoSvg = public_path('images/LogoLoopEvents.svg'))
    @php($logoPng = public_path('images/LogoLoopEvents.png'))
    @if (file_exists($builtLogoPng))
        <div class="mx-auto inline-flex items-center justify-center w-32 h-24 sm:w-44 sm:h-28 p-1 sm:p-2 overflow-hidden">
            <img src="{{ asset('build/assets/images/LogoLoopEvents.png') }}" alt="Logo LoopEvents" class="h-28 sm:h-32 w-auto object-contain" loading="lazy" />
        </div>
    @elseif (file_exists($logoSvg))
        <div class="mx-auto inline-flex items-center justify-center w-32 h-24 sm:w-44 sm:h-28 p-1 sm:p-2 overflow-hidden">
            <img src="{{ asset('images/LogoLoopEvents.svg') }}" alt="Logo LoopEvents" class="h-28 sm:h-32 w-auto object-contain" loading="lazy" />
        </div>
    @elseif (file_exists($logoPng))
        <div class="mx-auto inline-flex items-center justify-center w-32 h-24 sm:w-44 sm:h-28 p-1 sm:p-2 overflow-hidden">
            <img src="{{ asset('images/LogoLoopEvents.png') }}" alt="Logo LoopEvents" class="h-28 sm:h-32 w-auto object-contain" loading="lazy" />
        </div>
    @else
        <!-- SVG del logo de LoopEvents -->
        <div class="mx-auto inline-flex items-center gap-3 w-32 h-24 sm:w-44 sm:h-28 p-1 sm:p-2 overflow-hidden">
            <svg class="h-20 w-20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#5A73FF"/>
                <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#1F2937"/>
            </svg>
            <span class="text-gray-900 text-xl font-semibold tracking-wide">LoopEvents</span>
        </div>
    @endif
</div>

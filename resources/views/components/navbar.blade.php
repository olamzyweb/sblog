{{-- Navbar Component --}}
<nav
    class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-border shadow-sm transition-all duration-300"
>
    <div class="section-container">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo-mark.png') }}" alt="NEWS BLOG" class="w-10 h-10 object-contain">
                    <div>
                        <span class="font-bold text-lg tracking-tight text-dark-green">TECH</span>
                        <span class="font-semibold text-lg ml-0.5 text-primary">THREAD</span>
                    </div>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['route' => 'home', 'label' => 'Home'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="px-4 py-2 rounded-lg text-base font-medium transition-all duration-200 relative group text-charcoal hover:text-primary hover:bg-primary/5"
                    >
                        {{ $link['label'] }}
                        @if(request()->routeIs($link['route']))
                            <span class="absolute bottom-0 left-4 right-4 h-0.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- Mobile Hamburger --}}
            <button
                @click="toggleMobile()"
                class="lg:hidden relative w-10 h-10 flex items-center justify-center rounded-lg transition-colors text-dark-green hover:bg-gray-100"
                aria-label="Toggle menu"
            >
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.away="closeMobile()"
        x-cloak
        class="lg:hidden absolute top-full left-0 right-0 bg-white shadow-xl border-t border-border"
    >
        <div class="section-container py-4 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   @click="closeMobile()"
                   class="block px-4 py-3 rounded-lg text-base font-medium transition-colors text-charcoal hover:text-primary hover:bg-primary/5"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

{{-- Spacer for fixed navbar --}}
<div class="h-20"></div>



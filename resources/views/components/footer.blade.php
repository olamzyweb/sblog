{{-- Footer Component --}}
<footer class="bg-dark-green text-white">
    {{-- Main Footer --}}
    <div class="section-container py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-12">
            {{-- Company Info --}}
            <div>
                <div class="flex items-center gap-2 mb-5">
                    <img src="{{ asset('images/logo-mark.png') }}" alt="NEWS BLOG" class="w-10 h-10 object-contain">
                    <div>
                        <span class="font-bold text-lg tracking-tight text-white">TECH</span>
                        <span class="font-semibold text-sm ml-0.5 text-primary-300">THREAD</span>
                    </div>
                </div>
                <p class="text-white/70 text-sm leading-relaxed mb-5">
                    Stay updated with the latest insights, trending stories, and updates.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Quick Links</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['route' => 'home', 'label' => 'Home'],
                    ] as $link)
                        <li>
                            <a href="{{ route($link['route']) }}"
                               class="text-white/70 hover:text-primary-300 text-sm transition-colors inline-flex items-center gap-1.5 group">
                                <svg class="w-3 h-3 text-primary/50 group-hover:text-primary-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
        <div class="section-container py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-white/50 text-xs">
                &copy; {{ date('Y') }} TECH THREAD. All rights reserved.
            </p>
        </div>
    </div>
</footer>



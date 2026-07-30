{{-- News Card Component --}}
@props(['post'])

<article class="card-hover group news-card">
    {{-- Cover Image --}}
    <div class="relative overflow-hidden aspect-[16/10]">
        <img src="{{ $post->cover_image_url }}"
             alt="{{ $post->title }}"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
             loading="lazy">

        {{-- Category Badge --}}
        <div class="absolute top-3 left-3">
            <x-badge :text="$post->category" color="green" />
        </div>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-dark-green/30 to-transparent"></div>
    </div>

    {{-- Content --}}
    <div class="p-5">
        {{-- Meta --}}
        <div class="flex items-center gap-3 text-xs text-muted mb-3">
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $post->formatted_date }}
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $post->read_time_minutes }} min read
            </span>
        </div>

        {{-- Title --}}
        <h3 class="font-bold text-dark-green text-base mb-2 line-clamp-2 group-hover:text-primary transition-colors">
            <a href="{{ route('news.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h3>

        {{-- Excerpt --}}
        <p class="text-muted text-sm line-clamp-3 mb-4">
            {{ $post->excerpt }}
        </p>

        {{-- Read More --}}
        <a href="{{ route('news.show', $post->slug) }}"
           class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-pharma-green transition-colors group/link">
            Read More
            <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</article>

@extends('layouts.app')

@section('title', 'News & Blog — Latest Insights & Stories')
@section('meta_description', 'Stay updated with the latest news, blog posts, and insightful articles.')

@section('content')

<section class="section-padding bg-white">
    <div class="section-container">
        {{-- Page Header --}}
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-dark-green tracking-tight mb-2">Tech Articles & Insights</h1>
            <p class="text-muted text-lg">Explore technical deep dives, software design patterns, and coding guides.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2">

                {{-- Active Filters Banner --}}
                @if($category || $tag)
                    <div class="flex items-center gap-3 mb-6 p-3 bg-light-teal rounded-xl text-sm">
                        <span class="text-muted">Filtering by:</span>
                        @if($category)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary/10 text-primary rounded-full font-medium">
                                Category: {{ $category }}
                                <a href="{{ route('news.index', $tag ? ['tag' => $tag] : []) }}" class="hover:text-primary/70">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </a>
                            </span>
                        @endif
                        @if($tag)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-pharma-green/10 text-pharma-green rounded-full font-medium">
                                Tag: {{ $tag }}
                                <a href="{{ route('news.index', $category ? ['category' => $category] : []) }}" class="hover:text-pharma-green/70">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </a>
                            </span>
                        @endif
                        <a href="{{ route('news.index') }}" class="ml-auto text-muted hover:text-charcoal text-xs">Clear all</a>
                    </div>
                @endif

                @if($posts->count() > 0)
                    <div class="grid sm:grid-cols-2 gap-6">
                        @foreach($posts as $post)
                            <x-news-card :post="$post" />
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-10">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="w-16 h-16 text-border mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-dark-green mb-2">No articles found</h3>
                        <p class="text-muted mb-4">No articles match your current filter.</p>
                        <a href="{{ route('news.index') }}" class="btn-primary !text-sm">View all articles</a>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-1">
                <div class="sticky top-28 space-y-8">
                    {{-- Categories --}}
                    <div class="card p-6">
                        <h3 class="font-bold text-dark-green mb-4">Categories</h3>
                        <div class="space-y-2">
                            @foreach($categories as $cat)
                                <a href="{{ route('news.index', ['category' => Str::slug($cat)]) }}"
                                   class="flex items-center justify-between px-3 py-2 rounded-lg text-sm hover:bg-light-teal transition-colors
                                          {{ Str::slug($cat) === $category ? 'bg-primary/10 text-primary font-medium' : 'text-charcoal hover:text-primary' }}">
                                    {{ $cat }}
                                    <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tags Cloud --}}
                    @if($allTags->count() > 0)
                        <div class="card p-6">
                            <h3 class="font-bold text-dark-green mb-4">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($allTags as $t)
                                    <a href="{{ route('news.index', ['tag' => $t]) }}"
                                       class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border transition-all duration-200
                                              {{ $t === $tag
                                                  ? 'bg-primary text-white border-primary'
                                                  : 'bg-white text-charcoal border-border hover:border-primary hover:text-primary' }}">
                                        # {{ $t }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Recent Posts --}}
                    <div class="card p-6">
                        <h3 class="font-bold text-dark-green mb-4">Recent Posts</h3>
                        <div class="space-y-4">
                            @foreach($recentPosts as $recent)
                                <a href="{{ route('news.show', $recent->slug) }}" class="flex gap-3 group">
                                    <img src="{{ $recent->cover_image_url }}"
                                         alt="{{ $recent->title }}"
                                         class="w-16 h-16 rounded-lg object-cover shrink-0"
                                         loading="lazy">
                                    <div>
                                        <h4 class="text-sm font-medium text-dark-green line-clamp-2 group-hover:text-primary transition-colors">
                                            {{ $recent->title }}
                                        </h4>
                                        <p class="text-xs text-muted mt-1">{{ $recent->formatted_date }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Newsletter Signup --}}
                    <div class="bg-gradient-to-br from-primary to-pharma-green rounded-2xl p-6 text-center text-white">
                        <h3 class="font-bold mb-2">Subscribe</h3>
                        <p class="text-sm text-white/70 mb-4">Get the latest technical insights sent straight to your inbox.</p>
                        <div class="space-y-2">
                            <input type="email" placeholder="you@example.com" class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-white/50 border border-white/20 focus:outline-none focus:border-white text-sm" />
                            <button class="btn-white !text-sm w-full">Subscribe</button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection

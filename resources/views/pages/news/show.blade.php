@extends('layouts.app')

@section('title', $post->seo_title . ' — News Blog')
@section('meta_description', $post->seo_description)
@section('og_image', $post->cover_image_url)
@section('og_type', 'article')

@section('content')

<section class="section-padding bg-white">
    <div class="section-container">
        <div class="max-w-3xl mx-auto">
            {{-- Breadcrumbs --}}
            <nav class="flex text-sm text-muted mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center hover:text-primary">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-muted mx-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-charcoal font-medium truncate max-w-[200px] md:max-w-xs" aria-current="page">
                                {{ $post->title }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- Title --}}
            <h1 class="text-3xl md:text-4xl font-extrabold text-dark-green tracking-tight mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            {{-- Cover Image --}}
            <div class="rounded-2xl overflow-hidden mb-10 animate-on-scroll">
                <img src="{{ $post->cover_image_url }}"
                     alt="{{ $post->title }}"
                     class="w-full h-auto aspect-[16/9] object-cover">
            </div>

            {{-- Meta Bar --}}
            <div class="flex flex-wrap items-center gap-4 mb-8 pb-8 border-b border-border animate-on-scroll">
                <x-badge :text="$post->category" color="green" />
                <span class="flex items-center gap-1.5 text-sm text-muted">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $post->formatted_date }}
                </span>
                <span class="flex items-center gap-1.5 text-sm text-muted">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $post->read_time_minutes }} min read
                </span>
            </div>

            {{-- Article Body --}}
            <div class="article-content prose prose-lg max-w-none
                        prose-headings:text-dark-green prose-headings:font-bold
                        prose-p:text-charcoal prose-p:leading-relaxed
                        prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-dark-green
                        prose-li:text-charcoal
                        prose-ul:space-y-1">
                {!! $post->body !!}
            </div>

            {{-- Tags --}}
            @if(count($post->tags_list) > 0)
                <div class="mt-8 pt-6 border-t border-border animate-on-scroll">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm font-medium text-muted mr-1">Tags:</span>
                        @foreach($post->tags_list as $tag)
                            <a href="{{ route('news.index', ['tag' => $tag]) }}"
                               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-light-teal text-primary border border-primary/20 hover:bg-primary hover:text-white transition-all duration-200">
                                # {{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Share Links --}}
            <div class="mt-12 pt-8 border-t border-border animate-on-scroll">
                <h3 class="font-semibold text-dark-green mb-4">Share this article</h3>
                <div class="flex gap-3">
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' — ' . url()->current()) }}"
                       target="_blank"
                       class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                       target="_blank"
                       class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                       target="_blank"
                       class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Posts --}}
@if($relatedPosts->count() > 0)
<section class="section-padding bg-section-light">
    <div class="section-container">
        <x-section-heading
            title="Related Articles"
            subtitle="More articles you might find interesting"
        />

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($relatedPosts as $related)
                <x-news-card :post="$related" />
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Article",
  "headline": "{{ $post->seo_title }}",
  "image": [
    "{{ $post->cover_image_url }}"
   ],
  "datePublished": "{{ $post->published_at ? $post->published_at->toIso8601String() : '' }}",
  "dateModified": "{{ $post->updated_at ? $post->updated_at->toIso8601String() : '' }}",
  "author": [{
      "@@type": "Organization",
      "name": "News Blog",
      "url": "{{ url('/') }}"
    }]
}
</script>
@endpush

{{-- Section Heading Component --}}
@props(['title', 'subtitle' => '', 'centered' => true, 'light' => false])

<div class="{{ $centered ? 'text-center' : '' }} mb-12 md:mb-16">
    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold {{ $light ? 'text-white' : 'text-dark-green' }} mb-4 animate-on-scroll">
        {{ $title }}
    </h2>
    @if($subtitle)
        <p class="text-base md:text-lg {{ $light ? 'text-white/70' : 'text-muted' }} max-w-2xl {{ $centered ? 'mx-auto' : '' }} animate-on-scroll">
            {{ $subtitle }}
        </p>
    @endif
    <div class="mt-4 flex {{ $centered ? 'justify-center' : '' }} animate-on-scroll">
        <div class="divider"></div>
    </div>
</div>

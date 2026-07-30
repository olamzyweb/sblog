<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- SEO Meta --}}
    <title>@yield('title', 'NEWS BLOG — Latest Insights & Trending Stories')</title>
    <meta name="description" content="@yield('meta_description', 'Stay updated with the latest news, blog posts, and insightful articles across various topics.')">
    <meta name="keywords" content="news, blog, articles, opinions, stories, updates">
    <meta name="author" content="NEWS BLOG">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', 'NEWS BLOG')">
    <meta property="og:description" content="@yield('meta_description', 'Stay updated with the latest news, blog posts, and insightful articles.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:title" content="@yield('title', 'NEWS BLOG')">
    <meta name="twitter:description" content="@yield('meta_description', 'Stay updated with the latest news, blog posts, and insightful articles.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-image.jpg'))">


    {{-- Google Search Console Verification --}}
    @if(config('services.google.site_verification'))
        <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}" />
    @endif

    {{-- Google Analytics 4 --}}
    @if(config('services.google.analytics_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('services.google.analytics_id') }}');
        </script>
    @endif

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-specific head --}}
    @stack('head')
</head>
<body class="font-sans text-charcoal antialiased overflow-x-hidden">

    {{-- Navbar --}}
    <x-navbar />

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />


    {{-- GSAP + ScrollTrigger via CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

    {{-- GSAP Animations --}}
    <script src="{{ asset('js/animations.js') }}" defer></script>

    {{-- Page-specific scripts --}}
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    @php
        $metaTitle = trim($__env->yieldContent('title'));
        if ($metaTitle === '') {
            $metaTitle = $title ?? config('app.name');
        }
        
        // Ensure site name is always appended for SEO
        $siteName = 'HIMA-SIKC Event Center';
        if (!str_contains($metaTitle, $siteName) && $metaTitle !== $siteName) {
            $metaTitle = $metaTitle . ' | ' . $siteName;
        }

        $metaDescription = trim($__env->yieldContent('description'));
        if ($metaDescription === '') {
            $metaDescription = $description ?? 'Platform digital terintegrasi untuk mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.';
        }

        $metaKeywords = trim($__env->yieldContent('keywords'));
        if ($metaKeywords === '') {
            $metaKeywords = $keywords ?? 'HIMA SIKC, event center, mahasiswa, politeknik indramayu, sistem informasi kota cerdas, polindra';
        }

        $metaCanonical = trim($__env->yieldContent('canonical'));
        if ($metaCanonical === '') {
            $metaCanonical = $canonical ?? url()->current();
        }

        $metaOgType = trim($__env->yieldContent('og_type'));
        if ($metaOgType === '') {
            $metaOgType = 'website';
        }

	        $metaOgImage = trim($__env->yieldContent('og_image'));
	        if ($metaOgImage === '') {
	            $metaOgImage = $og_image ?? $ogImage ?? asset('images/featured-event.png');
	        }

	        $metaOgImageAlt = trim($__env->yieldContent('og_image_alt'));
	        if ($metaOgImageAlt === '') {
	            $metaOgImageAlt = $og_image_alt ?? $ogImageAlt ?? $metaTitle;
	        }
	    @endphp

    <!-- SEO Meta Tags -->
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="author" content="HIMA SIKC">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="{{ $metaCanonical }}">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="application-name" content="HIMA-SIKC Event Center">
    <meta name="apple-mobile-web-app-title" content="HIMA-SIKC Event Center">
    <meta name="google-site-verification" content="">
    <meta name="msvalidate.01" content="">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $metaOgType }}">
    <meta property="og:url" content="{{ $metaCanonical }}">
    <meta property="og:title" content="{{ $metaTitle }}">
	    <meta property="og:description" content="{{ $metaDescription }}">
	    <meta property="og:image" content="{{ $metaOgImage }}">
	    <meta property="og:image:alt" content="{{ $metaOgImageAlt }}">
	    <meta property="og:image:width" content="1200">
	    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="HIMA-SIKC Event Center">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $metaCanonical }}">
	    <meta name="twitter:title" content="{{ $metaTitle }}">
	    <meta name="twitter:description" content="{{ $metaDescription }}">
	    <meta name="twitter:image" content="{{ $metaOgImage }}">
	    <meta name="twitter:image:alt" content="{{ $metaOgImageAlt }}">
	    <meta name="twitter:site" content="@himasikc_polindra">
	    <meta name="twitter:creator" content="@himasikc_polindra">

    <!-- PWA & Favicon -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#E6AD2B">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('logo.png') }}">
    <meta name="msapplication-TileColor" content="#E6AD2B">

    <!-- Performance: Preconnect & DNS Prefetch -->
    <link rel="preconnect" href="{{ asset('') }}" crossorigin>
    <link rel="dns-prefetch" href="{{ asset('') }}">
    <link rel="preconnect" href="https://ui-avatars.com" crossorigin>
    <link rel="dns-prefetch" href="https://ui-avatars.com">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Structured Data -->
    @php
        $structuredDataSection = trim($__env->yieldContent('structured-data'));
        
        // Global Schema.org - Organization
        $globalOrganizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => url('/') . '#organization',
            'name' => 'HIMA-SIKC Event Center',
            'alternateName' => ['HIMA SIKC', 'Himpunan Mahasiswa Sistem Informasi Kota Cerdas'],
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('logo.png'),
                'width' => 512,
                'height' => 512
            ],
            'image' => asset('logo.png'),
            'description' => 'Pusat informasi event, kompetisi, dan kegiatan mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.',
            'foundingDate' => '2020',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Raya Lohbener Lama No. 8',
                'addressLocality' => 'Indramayu',
                'addressRegion' => 'Jawa Barat',
                'postalCode' => '45252',
                'addressCountry' => 'ID'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'email' => 'himasikc@polindra.ac.id',
                'contactType' => 'customer service'
            ],
            'sameAs' => [
                'https://www.instagram.com/himasikc_polindra/'
            ]
        ];
        
        // Global Schema.org - WebSite with SearchAction
        $globalWebsiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'name' => 'HIMA-SIKC Event Center',
            'alternateName' => 'HIMA SIKC',
            'url' => url('/'),
            'description' => 'Platform digital terintegrasi untuk mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.',
            'publisher' => [
                '@id' => url('/') . '#organization'
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => url('/events') . '?q={search_term_string}'
                ],
                'query-input' => 'required name=search_term_string'
            ],
            'inLanguage' => 'id-ID'
        ];
        
        // Navigation Items Configuration
        $navItems = [
            ['route' => 'home', 'label' => 'Beranda'],
            ['route' => 'events.index', 'label' => 'Event', 'wildcard' => 'events.*'],
            ['route' => 'blog.index', 'label' => 'Blog', 'wildcard' => 'blog.*'],
            ['route' => 'about', 'label' => 'Tentang Kami']
        ];

        $mobileNavItems = [
            ['route' => 'home', 'label' => 'Beranda', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['route' => 'events.index', 'label' => 'Event', 'wildcard' => 'events.*', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ['route' => 'blog.index', 'label' => 'Blog', 'wildcard' => 'blog.*', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
            ['route' => 'about', 'label' => 'Tentang Kami', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z']
        ];
    @endphp

    <!-- Global Schema.org Structured Data -->
    <script type="application/ld+json">
        {!! json_encode($globalOrganizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    <script type="application/ld+json">
        {!! json_encode($globalWebsiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    
    <!-- Page-specific Structured Data -->
    @if($structuredDataSection !== '')
        @yield('structured-data')
    @elseif(!empty($structuredData))
        {!! $structuredData !!}
    @endif

    <style>
        [x-cloak] { display: none !important; }
        /* Hard-disable any auto darkening heuristics on mobile browsers */
        html { color-scheme: light; background: #fff; }
        body { background: #fff; color: #09090B; }
    </style>
    @stack('styles')
</head>

<body class="font-sans antialiased text-text-main bg-background flex flex-col min-h-screen selection:bg-primary-100 selection:text-primary-900 overflow-x-hidden">
    <!-- Background Pattern -->
    <div class="fixed inset-0 pointer-events-none z-[-1] opacity-40" style="background-image: radial-gradient(#E6AD2B 0.5px, transparent 0.5px); background-size: 24px 24px;"></div>
    <div class="fixed inset-0 pointer-events-none z-[-1] bg-gradient-to-b from-background via-transparent to-background"></div>

    <!-- Toast Notifications -->
    <x-toast />
    <livewire:components.search-palette />

    <!-- Premium Navbar -->
	    <nav class="fixed w-full z-50 top-0 isolate" x-data="{
	        scrolled: false,
	        mobileOpen: false,
	        activeDropdown: null
	    }" @scroll.window="scrolled = (window.pageYOffset > 20)">

        <!-- Backdrop blur with gradient edge -->
	        <div class="absolute inset-0 z-0 transition-all duration-500 pointer-events-none"
	             :class="scrolled ? 'bg-surface/70 backdrop-blur-2xl backdrop-saturate-150 shadow-lg shadow-black/5' : 'bg-transparent'">
	            <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-border to-transparent pointer-events-none"
	                 :class="scrolled ? 'opacity-100' : 'opacity-0'"></div>
	        </div>

	        <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 sm:h-20">

                <!-- LOGO PREMIUM with animation -->
                <a href="/" class="flex items-center gap-3 group relative">
                    <!-- Glow effect -->
                    <div class="absolute -inset-2 bg-primary-400/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>

                    <!-- Logo container with ring -->
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl blur opacity-50 group-hover:opacity-75 transition-opacity"></div>
                        <img src="{{ asset('logo.png') }}" alt="HIMA SIKC"
                             class="relative h-10 w-10 sm:h-11 sm:w-11 rounded-xl shadow-lg ring-1 ring-white/20 group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <!-- Text logo -->
                    <div class="flex flex-col relative">
                        <span class="font-heading font-extrabold text-text-main text-lg sm:text-xl tracking-tight group-hover:text-primary-600 transition-colors">
                            HIMA-SIKC
                        </span>
                        <span class="text-[9px] sm:text-[10px] font-bold text-text-muted tracking-[0.25em] uppercase -mt-0.5">
                            Event Center
                        </span>
                    </div>
                </a>

                <!-- DESKTOP MENU - Pill Navigation with Indicator -->
	                <div class="hidden lg:flex items-center">
	                    <div class="flex items-center bg-surface-secondary/50 backdrop-blur-sm rounded-2xl p-1.5 border border-border/50">
	                        @foreach($navItems as $item)
	                            @php
	                                $isActive = request()->routeIs($item['route']) || (isset($item['wildcard']) && request()->routeIs($item['wildcard']));
	                            @endphp
	                            <a href="{{ route($item['route']) }}"
                                   @if($item['route'] !== 'home') wire:navigate @endif
	                               class="relative px-5 py-2.5 text-sm font-semibold rounded-xl transition-all duration-300
	                                      {{ $isActive ? 'text-primary-700 bg-surface shadow-sm' : 'text-text-muted hover:text-text-main hover:bg-surface/50' }}">
	                                {{ $item['label'] }}
	                                @if($isActive)
	                                    <!-- Active indicator dot -->
	                                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-primary-500 rounded-full"></span>
	                                @endif
	                            </a>
	                        @endforeach
	                    </div>
                </div>

	                <!-- MOBILE MENU BUTTON - Animated hamburger -->
		                <div class="lg:hidden relative z-20 flex items-center gap-3">
	                    <button id="mobile-menu-toggle"
	                            type="button"
	                            aria-controls="mobile-menu-panel"
	                            aria-expanded="false"
	                            @click="mobileOpen = !mobileOpen"
		                            class="relative z-20 p-2 rounded-xl hover:bg-surface-secondary transition-colors">
	                        <!-- Animated hamburger to X -->
	                        <div class="w-6 h-5 flex flex-col justify-between">
                            <span class="w-full h-0.5 bg-text-main rounded-full transition-all duration-300 origin-left"
                                  :class="mobileOpen ? 'rotate-45 translate-x-px' : ''"></span>
                            <span class="w-full h-0.5 bg-text-main rounded-full transition-all duration-300"
                                  :class="mobileOpen ? 'opacity-0 translate-x-4' : ''"></span>
                            <span class="w-full h-0.5 bg-text-main rounded-full transition-all duration-300 origin-left"
                                  :class="mobileOpen ? '-rotate-45 translate-x-px' : ''"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

	        <!-- MOBILE MENU - Full screen overlay with stagger animation -->
	        <div id="mobile-menu-panel"
	             x-show="mobileOpen"
	             x-cloak
	             x-transition:enter="transition ease-out duration-300"
	             x-transition:enter-start="opacity-0 translate-y-4"
	             x-transition:enter-end="opacity-100 translate-y-0"
	             class="lg:hidden fixed inset-0 top-16 sm:top-20 bg-surface/95 backdrop-blur-3xl z-50 flex flex-col"
	             style="display: none;">
	            
                <div class="flex-1 overflow-y-auto overscroll-contain px-6 py-8">
                    {{-- Mobile Search --}}
                    <div class="mb-8">
                        <div class="relative">
                            <input type="text" placeholder="Cari event atau artikel..." 
                                   class="w-full pl-10 pr-4 py-3 bg-surface-secondary border-border rounded-xl text-sm focus:ring-primary-500 focus:border-primary-500 transition-all">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

	                <div class="space-y-2">
	                    @foreach($mobileNavItems as $index => $item)
                        @php
                            $isActive = request()->routeIs($item['route']) || (isset($item['wildcard']) && request()->routeIs($item['wildcard']));
                        @endphp
	                        <a href="{{ route($item['route']) }}"
                               @if($item['route'] !== 'home') wire:navigate @endif
	                           @click="mobileOpen = false"
	                           class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-200 group
	                                  {{ $isActive ? 'bg-primary-50 border border-primary-100' : 'hover:bg-surface-secondary border border-transparent' }}"
	                           style="animation-delay: {{ $index * 50 }}ms">
                            <span class="p-3 rounded-xl transition-colors {{ $isActive ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/30' : 'bg-surface-secondary text-text-muted group-hover:bg-white group-hover:text-primary-500' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                                </svg>
                            </span>
                            <div>
                                <span class="block font-bold text-lg {{ $isActive ? 'text-primary-700' : 'text-text-main' }}">{{ $item['label'] }}</span>
                                <span class="text-xs text-text-muted font-medium">Akses halaman {{ strtolower($item['label']) }}</span>
                            </div>
                            @if($isActive)
                                <span class="ml-auto w-2 h-2 bg-primary-500 rounded-full animate-pulse"></span>
                            @else
                                <svg class="ml-auto w-5 h-5 text-text-muted/30 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            @endif
                        </a>
	                    @endforeach
	                </div>
	            </div>

                {{-- Mobile Footer --}}
                <div class="p-6 border-t border-border bg-surface-secondary/30">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-text-muted">Ikuti Kami</span>
                        <div class="flex gap-3">
                            <a href="https://www.instagram.com/himasikc_polindra/" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-surface border border-border flex items-center justify-center text-text-muted hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 hover:text-white hover:border-transparent transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <a href="https://www.tiktok.com/@himasikc.polindra" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-surface border border-border flex items-center justify-center text-text-muted hover:bg-black hover:text-white hover:border-transparent transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
	        </div>
        
	        <!-- Mobile Menu Backdrop -->
	        <div id="mobile-menu-backdrop"
	             x-show="mobileOpen" 
	             x-cloak
	             x-transition:enter="transition-opacity duration-300"
	             x-transition:enter-start="opacity-0"
	             x-transition:enter-end="opacity-100"
	             x-transition:leave="transition-opacity duration-300"
	             x-transition:leave-start="opacity-100"
	             x-transition:leave-end="opacity-0"
	             @click="mobileOpen = false"
	             class="lg:hidden fixed inset-0 top-20 bg-black/40 backdrop-blur-sm z-30"
	             style="display: none;"></div>
	    </nav>

    <!-- Main Content with Smooth Page Transitions -->
    <main class="flex-grow pt-20">
        <div class="animate-fade-in min-h-[calc(100vh-5rem)]">
            {{ $slot }}
        </div>
    </main>

    <!-- Modern Footer -->
    <footer class="bg-surface-secondary border-t border-border py-16 mt-auto relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-primary-500/20 to-transparent"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-secondary/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="w-full px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12">
                <!-- Brand Section -->
                <div class="space-y-6 lg:col-span-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('logo.png') }}" alt="HIMA SIKC Logo" class="h-12 w-12 rounded-xl shadow-sm">
                        <div class="flex flex-col">
                            <span class="text-xl font-bold text-text-main font-heading tracking-tight">HIMA-SIKC</span>
                            <span class="text-xs text-text-muted font-bold uppercase tracking-widest">Politeknik Negeri Indramayu</span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-text-muted max-w-sm">
                        Platform digital terintegrasi untuk mahasiswa Sistem Informasi Kota Cerdas. Wadah kreativitas, aspirasi, dan kolaborasi mahasiswa untuk masa depan yang lebih cerdas.
                    </p>
                    
                    <!-- Social Media -->
                    <div class="flex space-x-3">
                        <a href="https://www.instagram.com/himasikc_polindra/" target="_blank" rel="noopener noreferrer" 
                           class="w-10 h-10 rounded-xl bg-surface border border-border flex items-center justify-center text-text-muted hover:text-white hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 hover:border-transparent transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1" 
                           aria-label="Instagram">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@himasikc.polindra" target="_blank" rel="noopener noreferrer" 
                           class="w-10 h-10 rounded-xl bg-surface border border-border flex items-center justify-center text-text-muted hover:text-white hover:bg-black hover:border-transparent transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1" 
                           aria-label="TikTok">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="lg:col-span-3">
                    <h3 class="text-text-main font-bold mb-6 text-sm uppercase tracking-wider font-heading flex items-center gap-2">
                        <span class="w-8 h-0.5 bg-primary-500 rounded-full"></span>
                        Navigasi
                    </h3>
                    <ul class="space-y-3">
                        @foreach([
                            ['route' => 'home', 'label' => 'Beranda'],
                            ['route' => 'events.index', 'label' => 'Event'],
                            ['route' => 'blog.index', 'label' => 'Blog'],
                            ['route' => 'about', 'label' => 'Tentang Kami']
                        ] as $item)
                            <li>
                                <a href="{{ route($item['route']) }}" class="text-sm text-text-muted hover:text-primary-600 transition-colors duration-200 flex items-center gap-2 group">
                                    <span class="w-1.5 h-1.5 rounded-full bg-border group-hover:bg-primary-500 transition-colors"></span>
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Support Links -->
                <div class="lg:col-span-3">
                    <h3 class="text-text-main font-bold mb-6 text-sm uppercase tracking-wider font-heading flex items-center gap-2">
                        <span class="w-8 h-0.5 bg-primary-500 rounded-full"></span>
                        Dukungan
                    </h3>
                    <ul class="space-y-3">
                        @foreach([
                            ['route' => 'help', 'label' => 'Bantuan'],
                            ['route' => 'privacy-policy', 'label' => 'Kebijakan Privasi'],
                            ['route' => 'terms-of-service', 'label' => 'Syarat & Ketentuan']
                        ] as $item)
                            <li>
                                <a href="{{ route($item['route']) }}" class="text-sm text-text-muted hover:text-primary-600 transition-colors duration-200 flex items-center gap-2 group">
                                    <span class="w-1.5 h-1.5 rounded-full bg-border group-hover:bg-primary-500 transition-colors"></span>
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="lg:col-span-2">
                    <h3 class="text-text-main font-bold mb-6 text-sm uppercase tracking-wider font-heading flex items-center gap-2">
                        <span class="w-8 h-0.5 bg-primary-500 rounded-full"></span>
                        Kontak
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 group">
                            <div class="p-2 bg-surface rounded-lg text-text-muted group-hover:text-primary-600 group-hover:bg-primary-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <a href="mailto:himasikc@polindra.ac.id" class="text-sm text-text-muted hover:text-primary-600 transition-colors duration-200 mt-1.5">
                                himasikc@polindra.ac.id
                            </a>
                        </li>
                        <li class="flex items-start gap-3 group">
                            <div class="p-2 bg-surface rounded-lg text-text-muted group-hover:text-primary-600 group-hover:bg-primary-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-text-muted leading-snug mt-1.5">
                                Jl. Raya Lohbener Lama No. 8, Indramayu 45252
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="border-t border-border mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
	                <p class="text-sm text-text-muted text-center md:text-left">
	                    &copy; {{ date('Y') }} <span class="text-text-main font-bold">HIMA-SIKC</span>. All rights reserved.
	                </p>
	                <div class="flex items-center gap-4">
	                <p class="text-sm text-text-muted flex items-center gap-2">
	                    Made by <span class="text-text-main font-bold">Litbang Division</span>
	                </p>
	                </div>
	            </div>
        </div>
    </footer>

	    @livewireScripts
        @stack('scripts')

	    <script>
	        document.addEventListener('DOMContentLoaded', function () {
	            const toggle = document.getElementById('mobile-menu-toggle');
	            const panel = document.getElementById('mobile-menu-panel');
	            const backdrop = document.getElementById('mobile-menu-backdrop');
	            const alpineRoot = document.querySelector('nav[x-data]');

	            if (!toggle || !panel || !backdrop) return;

	            function setOpen(isOpen) {
	                // If Alpine isn't running, x-cloak will keep the panel hidden via `display:none !important`.
	                // Remove it so the fallback toggler can control visibility.
	                panel.removeAttribute('x-cloak');
	                backdrop.removeAttribute('x-cloak');

	                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
	                panel.style.display = isOpen ? 'block' : 'none';
	                backdrop.style.display = isOpen ? 'block' : 'none';
	            }

	            function enableFallbackIfNeeded() {
	                const alpineReady = !!(window.Alpine && alpineRoot && alpineRoot.__x);
	                if (alpineReady) return;

	                setOpen(false);

	                toggle.addEventListener('click', function (e) {
	                    e.preventDefault();
	                    e.stopPropagation();
	                    const isOpen = toggle.getAttribute('aria-expanded') === 'true';
	                    setOpen(!isOpen);
	                });

	                backdrop.addEventListener('click', function () {
	                    setOpen(false);
	                });

	                panel.querySelectorAll('a').forEach(function (link) {
	                    link.addEventListener('click', function () {
	                        setOpen(false);
	                    });
	                });
	            }

	            // Give Alpine a tick to initialize, then fallback if it didn't.
	            setTimeout(enableFallbackIfNeeded, 0);
	        });
	    </script>
</body>
</html>

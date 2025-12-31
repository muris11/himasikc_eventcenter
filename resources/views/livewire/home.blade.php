<div>
    {{-- Hero Section with Abstract Geometric Background --}}
    <section class="relative bg-background py-24 sm:py-32 overflow-hidden">
        {{-- Abstract Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-br from-primary-500/5 to-transparent rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gradient-to-tr from-slate-800/5 to-transparent rounded-full blur-3xl translate-y-1/3 -translate-x-1/4"></div>
            <svg class="absolute top-0 left-0 w-full h-full opacity-[0.03]" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="4" height="4" patternUnits="userSpaceOnUse">
                        <path d="M 4 0 L 0 0 0 4" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                
                {{-- Text Content --}}
                <div class="lg:col-span-7 text-center lg:text-left mb-16 lg:mb-0">
                    <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-surface-secondary border border-border text-primary-600 text-sm font-semibold mb-8 animate-fade-in-up">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                        </span>
                        Pusat Informasi Lomba & Event
                    </div>
                    
                    <h1 class="text-6xl sm:text-7xl lg:text-8xl font-bold text-text-main leading-none mb-8 font-display tracking-tighter animate-fade-in-up" style="animation-delay: 0.1s">
                        Tingkatkan Potensi,<br>
                        <span class="text-gradient-gold">Raih Prestasi.</span>
                    </h1>
                    
                    <p class="text-xl text-text-muted mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0 animate-fade-in-up" style="animation-delay: 0.2s">
                        Pusat informasi terlengkap seputar lomba, kompetisi, dan event mahasiswa dari berbagai sumber terpercaya. Temukan peluang prestasimu di sini.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up" style="animation-delay: 0.3s">
                        <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari Lomba
                        </a>
                        <a href="{{ route('about') }}" class="btn btn-secondary btn-lg">
                            Tentang Kami
                        </a>
                    </div>
                </div>

                {{-- Hero Visual --}}
                <div class="lg:col-span-5 relative animate-float hidden lg:block">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-border bg-surface p-2">
                        <div class="aspect-[4/5] bg-surface-secondary rounded-xl overflow-hidden relative group">
                            @if($heroSection && $heroSection->image_path)
                                {{-- Hero Image --}}
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                     style="background-image: url('{{ asset('storage/' . $heroSection->image_path) }}')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                </div>
                                
                                {{-- Content Overlay --}}
                                @if($heroSection->link)
                                    <a href="{{ $heroSection->link }}" class="absolute bottom-0 left-0 right-0 p-8 text-white block">
                                        <p class="text-sm font-medium text-primary-400 mb-2">{{ $heroSection->subtitle ?? 'Featured Event' }}</p>
                                        <h3 class="text-3xl font-bold leading-tight group-hover:text-primary-400 transition-colors">{{ $heroSection->title ?? 'Tech Summit 2024' }}</h3>
                                    </a>
                                @else
                                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                                        <p class="text-sm font-medium text-primary-400 mb-2">{{ $heroSection->subtitle ?? 'Featured Event' }}</p>
                                        <h3 class="text-3xl font-bold leading-tight">{{ $heroSection->title ?? 'Tech Summit 2024' }}</h3>
                                    </div>
                                @endif
                            @else
                                {{-- Fallback / Placeholder --}}
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                     style="background-image: url('{{ asset('images/featured-event.png') }}')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                </div>
                                
                                <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                                    <p class="text-sm font-medium text-primary-400 mb-2">Featured Event</p>
                                    <h3 class="text-3xl font-bold leading-tight">Tech Summit 2024</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Floating Stats --}}
                    <div class="absolute -bottom-10 -left-10 bg-surface p-6 rounded-xl shadow-xl border border-border animate-bounce-slow">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary-500/10 p-3 rounded-lg text-primary-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-text-muted font-medium">Info Aktif</p>
                                <p class="text-2xl font-bold text-text-main">{{ $totalEvents }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Counter Section --}}
    <section class="py-16 bg-surface border-y border-border scroll-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8" x-data="{
                stats: [
                    { value: 0, target: {{ $totalEvents }}, label: 'Info Lomba' },
                    { value: 0, target: {{ $totalPosts }}, label: 'Artikel Blog' },
                    { value: 0, target: 500, label: 'Mahasiswa Aktif' },
                    { value: 0, target: 50, label: 'Sumber Info' }
                ],
                started: false
            }" x-intersect="if (!started) { started = true; stats.forEach((stat, i) => { let start = 0; const end = stat.target; const duration = 2000; const increment = end / (duration / 16); const timer = setInterval(() => { start += increment; if (start >= end) { start = end; clearInterval(timer); } stats[i].value = Math.floor(start); }, 16); }); }">
                <template x-for="(stat, index) in stats" :key="index">
                    <div class="text-center">
                        <div class="text-4xl sm:text-5xl font-bold text-text-main font-heading mb-2" x-text="stat.value + '+'"></div>
                        <p class="text-sm font-medium text-text-muted uppercase tracking-wider" x-text="stat.label"></p>
                    </div>
                </template>
            </div>
        </div>
    </section>

    {{-- Latest Events Section --}}
    <section class="py-24 bg-background scroll-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-text-main mb-4 font-heading">Info Lomba & Event Terbaru</h2>
                <p class="text-lg text-text-muted max-w-xl mx-auto">Temukan berbagai kompetisi dan kegiatan menarik dari berbagai penyelenggara. Daftar sekarang sebelum terlambat.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 auto-rows-[180px] sm:auto-rows-[300px] gap-3 sm:gap-6">
                @forelse($featuredEvents as $index => $event)
                    <article class="group relative overflow-hidden rounded-2xl sm:rounded-3xl border border-border bg-surface shadow-sm hover:shadow-md transition-all duration-300 {{ $index === 0 ? 'col-span-2 row-span-2 sm:col-span-2 sm:row-span-2 md:col-span-2 md:row-span-2' : 'col-span-1 row-span-1' }}">
                        
                        {{-- Image Background --}}
                        <div class="absolute inset-0 bg-surface-secondary">
                            @if ($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" 
                                     alt="{{ $event->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-surface-secondary">
                                    <svg class="w-12 h-12 text-text-muted/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        </div>

                        {{-- Status Badge --}}
                        <div class="absolute top-2 right-2 sm:top-4 sm:right-4 z-10">
                            <span class="inline-flex items-center px-2 py-0.5 sm:px-3 sm:py-1 rounded-full text-[10px] sm:text-xs font-bold shadow-sm backdrop-blur-md {{ $event->is_active ? 'bg-status-success text-white' : 'bg-surface-tertiary text-text-muted' }}">
                                {{ $event->is_active ? 'Open' : 'Closed' }}
                            </span>
                        </div>

                        {{-- Content Overlay --}}
                        <div class="absolute bottom-0 left-0 right-0 p-3 sm:p-6 md:p-8 text-white flex flex-col h-full justify-end">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <div class="flex items-center gap-1.5 sm:gap-3 mb-1.5 sm:mb-3 text-[10px] sm:text-sm text-white/80">
                                    @if($event->category)
                                        <span class="font-semibold text-primary-400">
                                            {{ $event->category->name }}
                                        </span>
                                    @endif
                                    <span class="hidden sm:inline">•</span>
                                    <span class="hidden sm:inline">{{ $event->date->format('d M Y') }}</span>
                                </div>

                                <h3 class="font-bold text-white mb-1 sm:mb-2 font-heading leading-tight {{ $index === 0 ? 'text-base sm:text-2xl md:text-3xl' : 'text-xs sm:text-xl' }} line-clamp-2">
                                    <a href="{{ route('events.show', $event->slug) }}">
                                        {{ $event->title }}
                                    </a>
                                </h3>

                                @if($index === 0)
                                    <p class="text-white/70 text-xs sm:text-sm leading-relaxed line-clamp-2 mb-2 sm:mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100 hidden sm:block">
                                        {{ Str::limit(strip_tags($event->description), 150) }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center justify-between mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @if($event->location)
                                        <div class="flex items-center text-xs text-white/70">
                                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span class="truncate max-w-[150px]">{{ $event->location }}</span>
                                        </div>
                                    @endif
                                    
                                    <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm hover:bg-primary-500 hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full">
                        <x-empty-state 
                            title="Belum Ada Info Lomba"
                            message="Nantikan info lomba dan event terbaru segera."
                            icon="calendar"
                        />
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 text-center">
                <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-primary-600 border border-transparent rounded-full shadow-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 hover:shadow-primary-500/30 hover:-translate-y-1">
                    Lihat Semua Event
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Latest Blog Posts Section --}}
    <section class="py-24 bg-surface scroll-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-text-main mb-4 font-heading">Blog & Artikel</h2>
                <p class="text-lg text-text-muted max-w-2xl mx-auto">
                    Wawasan, tips, dan trik seputar dunia perkuliahan dan teknologi.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-8">
                @forelse($latestPosts as $post)
                    <article class="card group flex flex-col h-full overflow-hidden bg-background rounded-2xl sm:rounded-3xl">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block relative h-32 sm:h-56 overflow-hidden bg-surface-secondary">
                            @if ($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-surface-secondary">
                                    <svg class="w-12 h-12 text-text-muted/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Category Badge --}}
                            @if($post->category)
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-white/90 backdrop-blur-md text-primary-700 shadow-sm uppercase tracking-wider">
                                        {{ $post->category->name }}
                                    </span>
                                </div>
                            @endif
                        </a>

                        <div class="p-3 sm:p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-1.5 sm:gap-3 mb-2 sm:mb-4 text-[10px] sm:text-sm">
                                <span class="text-text-muted">{{ $post->created_at->format('d M Y') }}</span>
                            </div>

                            <h3 class="text-sm sm:text-xl font-bold text-text-main mb-2 sm:mb-3 leading-tight group-hover:text-primary-600 transition-colors line-clamp-2 font-heading">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            <p class="text-text-muted text-xs sm:text-sm line-clamp-2 sm:line-clamp-3 mb-3 sm:mb-6 leading-relaxed flex-1">
                                {{ Str::limit(strip_tags($post->content), 140) }}
                            </p>

                            <div class="flex items-center justify-between pt-2 sm:pt-5 border-t border-border mt-auto">
                                <div class="flex items-center gap-1.5 sm:gap-2">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-surface-secondary flex items-center justify-center text-[10px] sm:text-xs font-bold text-text-main border border-border">
                                        {{ substr($post->user->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="text-[10px] sm:text-xs font-semibold text-text-muted">{{ $post->user->name ?? 'Admin' }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-text-muted">Belum ada artikel terbaru.</p>
                    </div>
                @endforelse
            </div>
            
            @if($latestPosts->count() > 0)
                <div class="mt-16 text-center">
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-text-main transition-all duration-200 bg-white border border-border rounded-full shadow-sm hover:bg-surface-secondary hover:text-primary-600 hover:border-primary-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 hover:shadow-md hover:-translate-y-1">
                        Lihat Semua Artikel
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-24 bg-background relative overflow-hidden border-t border-border scroll-fade-in">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="currentColor" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-text-main mb-4 font-heading">Apa Kata Mereka?</h2>
                <p class="text-lg text-text-muted max-w-2xl mx-auto">
                    Cerita inspiratif dari mahasiswa yang telah mendapatkan manfaat dari informasi di sini.
                </p>
            </div>

            @if($testimonials->count() > 0)
                <div class="relative w-full overflow-hidden space-y-6 pause-on-hover">
                    {{-- Row 1: Right to Left --}}
                    <div class="flex w-max animate-marquee gap-6">
                        @foreach($testimonials->merge($testimonials)->merge($testimonials) as $testimonial)
                            <div class="w-[300px] sm:w-[400px] bg-surface rounded-2xl border border-border p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                                <div class="mb-4 text-primary-500/30">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.017 21L14.017 18C14.017 16.0547 15.3738 15.122 15.632 14.9733C15.9338 14.7774 16.5 14.3059 16.5 13C16.5 12.1217 16.07 11.5 15.5 11.5C14.427 11.5 13.5 12.3736 13.5 13.5V14.5H9.5V13.5C9.5 10.5522 11.5 9 13.5 9C15.5 9 16.5 10.5 16.5 10.5C18.5 10.5 19.5 12.5 19.5 13.5V21H14.017ZM8 21V18C8 16.0547 9.35683 15.122 9.61504 14.9733C9.91685 14.7774 10.5 14.3059 10.5 13C10.5 12.1217 10.07 11.5 9.5 11.5C8.42703 11.5 7.5 12.3736 7.5 13.5V14.5H3.5V13.5C3.5 10.5522 5.5 9 7.5 9C9.5 9 10.5 10.5 10.5 10.5C12.5 10.5 13.5 12.5 13.5 13.5V21H8Z" />
                                    </svg>
                                </div>
                                <p class="text-base sm:text-lg text-text-main mb-6 leading-relaxed italic line-clamp-3">
                                    "{{ $testimonial->content }}"
                                </p>
                                <div class="flex items-center gap-3">
                                    @if ($testimonial->avatar)
                                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full border border-primary-500 object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=E6AD2B&color=fff" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full border border-primary-500">
                                    @endif
                                    <div>
                                        <div class="font-bold text-text-main text-sm">{{ $testimonial->name }}</div>
                                        <div class="text-xs text-text-muted">{{ $testimonial->role }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Row 2: Left to Right --}}
                    <div class="flex w-max animate-marquee-reverse gap-6">
                        @foreach($testimonials->merge($testimonials)->merge($testimonials) as $testimonial)
                            <div class="w-[300px] sm:w-[400px] bg-surface rounded-2xl border border-border p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                                <div class="mb-4 text-primary-500/30">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.017 21L14.017 18C14.017 16.0547 15.3738 15.122 15.632 14.9733C15.9338 14.7774 16.5 14.3059 16.5 13C16.5 12.1217 16.07 11.5 15.5 11.5C14.427 11.5 13.5 12.3736 13.5 13.5V14.5H9.5V13.5C9.5 10.5522 11.5 9 13.5 9C15.5 9 16.5 10.5 16.5 10.5C18.5 10.5 19.5 12.5 19.5 13.5V21H14.017ZM8 21V18C8 16.0547 9.35683 15.122 9.61504 14.9733C9.91685 14.7774 10.5 14.3059 10.5 13C10.5 12.1217 10.07 11.5 9.5 11.5C8.42703 11.5 7.5 12.3736 7.5 13.5V14.5H3.5V13.5C3.5 10.5522 5.5 9 7.5 9C9.5 9 10.5 10.5 10.5 10.5C12.5 10.5 13.5 12.5 13.5 13.5V21H8Z" />
                                    </svg>
                                </div>
                                <p class="text-base sm:text-lg text-text-main mb-6 leading-relaxed italic line-clamp-3">
                                    "{{ $testimonial->content }}"
                                </p>
                                <div class="flex items-center gap-3">
                                    @if ($testimonial->avatar)
                                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full border border-primary-500 object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=E6AD2B&color=fff" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full border border-primary-500">
                                    @endif
                                    <div>
                                        <div class="font-bold text-text-main text-sm">{{ $testimonial->name }}</div>
                                        <div class="text-xs text-text-muted">{{ $testimonial->role }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-text-muted">Belum ada testimoni yang ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 relative overflow-hidden scroll-fade-in">
        <div class="absolute inset-0 bg-mustard-gradient opacity-10"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6AD2B 1px, transparent 1px); background-size: 24px 24px;"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl sm:text-5xl font-bold text-text-main mb-6 font-heading tracking-tight">
                Jangan Ketinggalan Info!
            </h2>
            <p class="text-xl text-text-muted mb-10 max-w-2xl mx-auto leading-relaxed">
                Temukan lomba yang sesuai dengan minatmu dan raih prestasi gemilang.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg">
                    Cari Lomba Sekarang
                </a>
            </div>
        </div>
    </section>
</div>

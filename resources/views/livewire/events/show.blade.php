<div class="py-12 bg-background min-h-screen pb-24 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-text-muted hover:text-primary-600 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-text-muted mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ route('events.index') }}" class="ml-1 text-text-muted hover:text-primary-600 transition-colors">Event</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-text-muted mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="ml-1 text-text-main font-medium truncate max-w-[200px] sm:max-w-xs">{{ $event->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                <div class="bg-surface rounded-[2.5rem] border border-border overflow-hidden shadow-sm">
                    {{-- Hero Image with Parallax Effect --}}
                    <div x-data="{ lightbox: false, scroll: 0 }" 
                         @scroll.window="scroll = window.pageYOffset"
                         class="relative group h-[300px] sm:h-[400px] overflow-hidden">
                        @if ($event->image_path)
                            <div @click="lightbox = true" class="cursor-pointer w-full h-full relative">
                                <img src="{{ asset('storage/' . $event->image_path) }}" 
                                     alt="{{ $event->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-100 ease-linear"
                                     :style="`transform: translateY(${scroll * 0.2}px) scale(1.1)`">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                
                                {{-- Zoom Icon --}}
                                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="bg-black/50 backdrop-blur-md rounded-full p-2 text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Lightbox Modal --}}
                            <div x-show="lightbox" 
                                 @click.self="lightbox = false"
                                 @keydown.escape.window="lightbox = false"
                                 class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-xl flex items-center justify-center p-4"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 style="display: none;">
                                <img src="{{ asset('storage/' . $event->image_path) }}" 
                                     alt="{{ $event->title }}" 
                                     class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl">
                                <button @click="lightbox = false" 
                                        class="absolute top-6 right-6 p-2 bg-white/10 hover:bg-white/20 rounded-full transition-colors text-white">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div class="w-full h-full bg-surface-secondary flex items-center justify-center">
                                <svg class="w-20 h-20 text-text-muted/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-8 sm:p-10 bg-surface relative">
                        {{-- Header --}}
                        <div class="mb-10 pb-10 border-b border-border">
                            <div class="flex flex-wrap items-center gap-3 mb-5">
                                @if($event->category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-primary-50 text-primary-700 border border-primary-100">
                                        {{ $event->category->name }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $event->is_active ? 'bg-green-50 text-status-success border border-green-200' : 'bg-surface-secondary text-text-muted border border-border' }}">
                                    <span class="w-2 h-2 rounded-full mr-2 {{ $event->is_active ? 'bg-status-success animate-pulse' : 'bg-text-muted' }}"></span>
                                    {{ $event->is_active ? 'Registrasi Dibuka' : 'Registrasi Ditutup' }}
                                </span>
                            </div>

                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-text-main leading-tight mb-6 font-heading tracking-tight">
                                {{ $event->title }}
                            </h1>
                            
                            {{-- Share Buttons (Desktop) --}}
                            <div class="hidden lg:flex flex-wrap items-center gap-4">
                                <span class="text-sm font-semibold text-text-muted uppercase tracking-wider">Bagikan</span>
                                <div class="flex gap-2">
                                    <button onclick="shareToWhatsApp()" class="p-2.5 text-text-muted hover:text-white hover:bg-[#25D366] rounded-xl transition-all duration-300 hover:-translate-y-1" title="WhatsApp">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/></svg>
                                    </button>
                                    <button onclick="shareToFacebook()" class="p-2.5 text-text-muted hover:text-white hover:bg-[#1877F2] rounded-xl transition-all duration-300 hover:-translate-y-1" title="Facebook">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </button>
                                    <button onclick="copyLink()" class="p-2.5 text-text-muted hover:text-white hover:bg-primary-500 rounded-xl transition-all duration-300 hover:-translate-y-1" title="Copy Link">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Event Details Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                            <div class="flex items-start gap-5 p-6 rounded-3xl bg-surface-secondary border border-border hover:border-primary-200 transition-colors group">
                                <div class="p-3.5 bg-surface rounded-xl shadow-sm group-hover:shadow-md transition-shadow">
                                    <svg class="w-7 h-7 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-text-main mb-1 font-heading uppercase tracking-wide">Tanggal & Waktu</h3>
                                    <p class="text-text-muted font-medium">{{ $event->date->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                                    <p class="text-sm text-text-muted mt-0.5">Pukul {{ $event->date->format('H:i') }} WIB</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 p-6 rounded-3xl bg-surface-secondary border border-border hover:border-primary-200 transition-colors group">
                                <div class="p-3.5 bg-surface rounded-xl shadow-sm group-hover:shadow-md transition-shadow">
                                    <svg class="w-7 h-7 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-text-main mb-1 font-heading uppercase tracking-wide">Lokasi</h3>
                                    <p class="text-text-muted font-medium">{{ $event->location ?? 'Online / Daring' }}</p>
                                    <a href="https://maps.google.com/?q={{ urlencode($event->location) }}" target="_blank" class="text-sm text-primary-600 hover:text-primary-700 mt-0.5 inline-flex items-center">
                                        Lihat di Peta
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="event-content mb-12">
                            <h3 class="text-2xl font-bold text-text-main mb-6 font-heading">Deskripsi Event</h3>
                            <div class="leading-relaxed space-y-4">
                                {!! auto_format_text($event->description) !!}
                            </div>
                        </div>

                        {{-- CTA Button (Desktop) --}}
                        @if ($event->registration_link)
                            <div class="hidden lg:block pt-10 border-t border-border">
                                @if ($event->is_active)
                                    <div class="flex flex-col sm:flex-row items-center gap-6 bg-primary-50 p-8 rounded-3xl border border-primary-100">
                                        <div class="flex-1 text-center sm:text-left">
                                            <h4 class="text-lg font-bold text-text-main mb-1">Tertarik mengikuti event ini?</h4>
                                            <p class="text-text-muted text-sm">Segera daftarkan diri Anda sebelum kuota penuh.</p>
                                        </div>
                                        <a href="{{ $event->registration_link }}" 
                                           target="_blank"
                                           class="btn btn-primary btn-lg shadow-mustard hover:shadow-mustard-lg transform hover:-translate-y-1 transition-all duration-300 w-full sm:w-auto px-8">
                                            Daftar Sekarang
                                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                @else
                                    <div class="bg-surface-secondary p-8 rounded-3xl text-center border border-border">
                                        <span class="inline-block p-3 bg-surface rounded-full mb-3 text-text-muted">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                        </span>
                                        <h4 class="text-lg font-bold text-text-main mb-1">Pendaftaran Ditutup</h4>
                                        <p class="text-text-muted text-sm">Event ini sudah berakhir atau kuota pendaftaran sudah penuh.</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sticky Sidebar --}}
            <aside class="lg:col-span-1 space-y-8">
                {{-- Event Info Card --}}
                <div class="lg:sticky lg:top-24 space-y-8">
                    <div class="bg-surface rounded-3xl border border-border shadow-sm p-8">
                        <h3 class="font-bold text-text-main font-heading text-lg mb-6 pb-4 border-b border-border">Info Tambahan</h3>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="p-2 bg-surface-secondary rounded-lg text-text-muted mt-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-1">Tipe Partisipan</p>
                                    <p class="font-medium text-text-main capitalize">{{ str_replace('_', ' ', $event->participant_type) }}</p>
                                </div>
                            </div>

                            @if($event->organizer)
                                <div class="flex items-start gap-4">
                                    <div class="p-2 bg-surface-secondary rounded-lg text-text-muted mt-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-1">Penyelenggara</p>
                                        <p class="font-medium text-text-main">{{ $event->organizer }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Location Map --}}
                    <div class="bg-surface rounded-3xl border border-border shadow-sm p-8">
                        <h3 class="font-bold text-text-main font-heading text-lg mb-6 pb-4 border-b border-border">Peta Lokasi</h3>
                        <div id="map" class="w-full h-64 rounded-xl z-0"></div>
                    </div>

                    {{-- Related Events (Desktop) --}}
                    @if (isset($relatedEvents) && $relatedEvents->count() > 0)
                        <div class="hidden lg:block bg-surface rounded-3xl border border-border shadow-sm p-8">
                            <h3 class="font-bold text-text-main font-heading text-lg mb-6 pb-4 border-b border-border">Event Terkait</h3>

                            <div class="space-y-5">
                                @foreach($relatedEvents as $relEvent)
                                    <a href="{{ route('events.show', $relEvent) }}" class="flex gap-4 group">
                                        <div class="w-20 h-20 bg-surface-secondary rounded-xl overflow-hidden flex-shrink-0 relative">
                                            @if ($relEvent->image_path)
                                                <img src="{{ asset('storage/' . $relEvent->image_path) }}" 
                                                     alt="{{ $relEvent->title }}" 
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100">
                                                    <svg class="w-8 h-8 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0 py-1">
                                            <h4 class="text-sm font-bold text-text-main line-clamp-2 group-hover:text-primary-600 transition-colors mb-1.5 leading-snug">
                                                {{ $relEvent->title }}
                                            </h4>
                                            <p class="text-xs text-text-muted flex items-center gap-1.5 font-medium">
                                                <svg class="w-3.5 h-3.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $relEvent->date->format('d M Y') }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
        
        {{-- Related Events (Mobile Horizontal Scroll) --}}
        @if (isset($relatedEvents) && $relatedEvents->count() > 0)
            <div class="lg:hidden mt-12">
                <h3 class="font-bold text-text-main font-heading text-lg mb-4 px-1">Event Terkait</h3>
                <div class="flex gap-4 overflow-x-auto pb-6 -mx-4 px-4 scrollbar-hide snap-x">
                    @foreach($relatedEvents as $relEvent)
                        <a href="{{ route('events.show', $relEvent) }}" class="min-w-[280px] bg-surface rounded-2xl border border-border overflow-hidden shadow-sm snap-center">
                            <div class="h-40 relative overflow-hidden bg-surface-secondary">
                                @if ($relEvent->image_path)
                                    <img src="{{ asset('storage/' . $relEvent->image_path) }}" 
                                         alt="{{ $relEvent->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100">
                                        <svg class="w-10 h-10 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="text-sm font-bold text-text-main line-clamp-2 mb-2">{{ $relEvent->title }}</h4>
                                <p class="text-xs text-text-muted flex items-center gap-1.5 font-medium">
                                    <svg class="w-3.5 h-3.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $relEvent->date->format('d M Y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Fixed Bottom Share Bar (Mobile) --}}
    <div class="fixed bottom-0 left-0 right-0 bg-surface/90 backdrop-blur-md border-t border-border p-4 z-40 lg:hidden flex justify-between items-center shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="flex-1 mr-4">
            @if($event->is_active && $event->registration_link)
                <a href="{{ $event->registration_link }}" target="_blank" class="block w-full text-center py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-mustard">
                    Daftar Sekarang
                </a>
            @else
                <div class="text-xs font-bold text-text-muted uppercase tracking-wider text-center">Pendaftaran Ditutup</div>
            @endif
        </div>
        <div class="flex gap-2">
            <button onclick="shareToWhatsApp()" class="p-2.5 bg-surface-secondary text-text-muted rounded-xl hover:bg-[#25D366] hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/></svg>
            </button>
            <button onclick="shareToFacebook()" class="p-2.5 bg-surface-secondary text-text-muted rounded-xl hover:bg-[#1877F2] hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </button>
            <button onclick="copyLink()" class="p-2.5 bg-surface-secondary text-text-muted rounded-xl hover:bg-primary-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </button>
        </div>
    </div>

    {{-- Share Functions --}}
    <script>
        function shareToWhatsApp() {
            const url = window.location.href;
            const title = "{{ $event->title }}";
            const text = `*${title}*\n\nLihat event ini: ${url}`;
            window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(text)}`, '_blank');
        }

        function shareToFacebook() {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank');
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: { message: 'Link berhasil disalin!', type: 'success' }
                }));
            });
        }
    </script>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('livewire:navigated', function () {
            initMap();
        });

        document.addEventListener('DOMContentLoaded', function () {
            initMap();
        });

        function initMap() {
            var mapElement = document.getElementById('map');
            if (mapElement && !mapElement._leaflet_id) {
                var lat = {{ $event->latitude ?? -6.327583 }};
                var lng = {{ $event->longitude ?? 108.324936 }};
                var map = L.map('map').setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup('{{ $event->location }}')
                    .openPopup();
            }
        }
    </script>
    @endpush
</div>

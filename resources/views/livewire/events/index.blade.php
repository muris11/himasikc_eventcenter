<div class="py-12 bg-background min-h-screen relative overflow-hidden" x-data="{ showFilters: false }">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-gradient-to-br from-primary-500/5 to-transparent rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-gradient-to-tr from-slate-800/5 to-transparent rounded-full blur-3xl translate-y-1/3 -translate-x-1/4"></div>
        <svg class="absolute top-0 left-0 w-full h-full opacity-[0.02]" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="grid" width="4" height="4" patternUnits="userSpaceOnUse">
                    <path d="M 4 0 L 0 0 0 4" fill="none" stroke="currentColor" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#grid)" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="mb-12 text-center md:text-left">
            <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-surface-secondary border border-border text-primary-600 text-sm font-semibold mb-6 animate-fade-in-up">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                Event & Kompetisi
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-text-main mb-4 font-heading tracking-tight animate-fade-in-up" style="animation-delay: 0.1s">
                Temukan <span class="text-gradient-gold">Peluangmu</span>
            </h1>
            <p class="text-lg text-text-muted max-w-2xl animate-fade-in-up" style="animation-delay: 0.2s">
                Jelajahi berbagai kegiatan menarik untuk mengembangkan potensi dan kreativitasmu bersama HIMA SIKC.
            </p>
        </div>

        {{-- Mobile Filter Toggle --}}
        <div class="lg:hidden mb-6">
            <button @click="showFilters = !showFilters" class="w-full flex items-center justify-between p-4 bg-surface border border-border rounded-xl shadow-sm transition-all duration-200 active:scale-[0.99]">
                <span class="font-semibold text-text-main flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter & Pencarian
                </span>
                <svg class="w-5 h-5 text-text-muted transition-transform duration-200" :class="{'rotate-180': showFilters}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-10">
            {{-- Sidebar Filter --}}
            <aside class="lg:col-span-3 mb-8 lg:mb-0 hidden lg:block" :class="{'hidden': !showFilters, 'block': showFilters, 'lg:block': true}">
                <div class="bg-surface rounded-2xl border border-border p-6 sticky top-24 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-text-main font-heading text-lg">Filter</h3>
                        @if($search || $selectedCategory || $selectedStatus !== 'all')
                            <button 
                                wire:click="clearFilters"
                                class="text-xs font-medium text-status-error hover:text-red-700 transition-colors flex items-center gap-1"
                            >
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset
                            </button>
                        @endif
                    </div>
                    
                    <div class="space-y-6">
                        {{-- Search --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-main mb-2">Cari Event</label>
                            <div class="relative group">
                                <input 
                                    type="text" 
                                    wire:model.live.debounce.300ms="search"
                                    placeholder="Ketik judul event..."
                                    class="w-full pl-10 pr-4 py-2.5 text-sm bg-background border border-border rounded-xl focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all duration-200 group-hover:border-primary-300 text-text-main placeholder:text-text-muted/50"
                                />
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-text-muted group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-main mb-2">Kategori</label>
                            <div class="relative">
                                <select 
                                    wire:model.live="selectedCategory"
                                    class="w-full px-3 py-2.5 text-sm bg-background border border-border rounded-xl focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all duration-200 appearance-none text-text-main cursor-pointer"
                                >
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-main mb-3">Status</label>
                            <div class="space-y-3">
                                @foreach([
                                    ['value' => 'all', 'label' => 'Semua'],
                                    ['value' => 'active', 'label' => 'Aktif'],
                                    ['value' => 'inactive', 'label' => 'Selesai']
                                ] as $status)
                                    <label class="flex items-center cursor-pointer group p-2 rounded-lg hover:bg-surface-secondary transition-colors -mx-2">
                                        <div class="relative flex items-center">
                                            <input type="radio" wire:model.live="selectedStatus" value="{{ $status['value'] }}" class="peer sr-only"/>
                                            <div class="w-5 h-5 border-2 border-border rounded-full peer-checked:border-primary-500 peer-checked:bg-primary-500 transition-all duration-200"></div>
                                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                                                <div class="w-2 h-2 bg-white rounded-full"></div>
                                            </div>
                                        </div>
                                        <span class="ml-3 text-sm text-text-muted group-hover:text-text-main transition-colors font-medium">{{ $status['label'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="lg:col-span-9">
                {{-- Results Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                    <p class="text-sm text-text-muted">
                        Menampilkan <span class="font-bold text-text-main">{{ $events->count() }}</span> 
                        dari <span class="font-bold text-text-main">{{ $events->total() }}</span> event
                    </p>

                    {{-- View Toggle --}}
                    <div class="flex gap-1 bg-surface border border-border rounded-lg p-1 self-start sm:self-auto shadow-sm">
                        <button 
                            wire:click="$set('viewMode', 'grid')"
                            class="p-2 rounded-md transition-all duration-200 {{ $viewMode === 'grid' ? 'bg-primary-50 text-primary-600 shadow-sm' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main' }}"
                            aria-label="Grid View"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        </button>
                        <button 
                            wire:click="$set('viewMode', 'list')"
                            class="p-2 rounded-md transition-all duration-200 {{ $viewMode === 'list' ? 'bg-primary-50 text-primary-600 shadow-sm' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main' }}"
                            aria-label="List View"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Loading State (Skeleton) --}}
                <div wire:loading.class.remove="hidden" class="hidden w-full">
                    <div class="grid gap-3 sm:gap-6 {{ $viewMode === 'grid' ? 'grid-cols-2 sm:grid-cols-2 xl:grid-cols-3' : 'grid-cols-1' }}">
                        @for($i=0; $i<6; $i++)
                            <div class="bg-surface rounded-xl sm:rounded-2xl border border-border overflow-hidden shadow-sm animate-pulse">
                                <div class="h-32 sm:h-48 bg-surface-secondary w-full"></div>
                                <div class="p-6 space-y-4">
                                    <div class="flex gap-2">
                                        <div class="h-5 bg-surface-secondary rounded-full w-20"></div>
                                        <div class="h-5 bg-surface-secondary rounded-full w-24"></div>
                                    </div>
                                    <div class="h-7 bg-surface-secondary rounded w-3/4"></div>
                                    <div class="space-y-2">
                                        <div class="h-4 bg-surface-secondary rounded w-full"></div>
                                        <div class="h-4 bg-surface-secondary rounded w-2/3"></div>
                                    </div>
                                    <div class="pt-4 border-t border-border flex justify-between items-center">
                                        <div class="h-4 bg-surface-secondary rounded w-24"></div>
                                        <div class="h-4 bg-surface-secondary rounded w-16"></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                {{-- Events Grid --}}
                <div wire:loading.class="hidden" class="w-full">
                    @if($events->count() > 0)
                        <div class="grid gap-3 sm:gap-6 {{ $viewMode === 'grid' ? 'grid-cols-2 sm:grid-cols-2 xl:grid-cols-3' : 'grid-cols-1' }}">
                            @foreach($events as $event)
                                <article class="card group flex flex-col h-full hover:shadow-xl hover:-translate-y-1 hover:border-primary-200 transition-all duration-300 bg-surface rounded-xl sm:rounded-2xl border border-border overflow-hidden">
                                    {{-- Image --}}
                                    <a href="{{ route('events.show', $event->slug) }}" class="block relative {{ $viewMode === 'grid' ? 'h-32 sm:h-52' : 'h-48 sm:h-56 md:h-auto md:w-1/3 md:float-left' }} overflow-hidden bg-surface-secondary">
                                        @if ($event->image_path)
                                            <img 
                                                src="{{ asset('storage/' . $event->image_path) }}" 
                                                alt="{{ $event->title }}" 
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                                loading="lazy"
                                                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($event->title) }}&background=random&color=fff&size=500';"
                                            >
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-secondary to-surface-tertiary group-hover:scale-105 transition-transform duration-700">
                                                <svg class="w-12 h-12 text-text-muted/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        {{-- Status Badge --}}
                                        <div class="absolute top-2 right-2 sm:top-3 sm:right-3 z-10">
                                            <span class="inline-flex items-center px-2 py-0.5 sm:px-3 sm:py-1 rounded-full text-[10px] sm:text-xs font-bold shadow-sm backdrop-blur-md {{ $event->is_active ? 'bg-status-success text-white' : 'bg-surface-tertiary text-text-muted' }}">
                                                <span class="w-1 h-1 sm:w-1.5 sm:h-1.5 rounded-full mr-1 sm:mr-1.5 bg-white animate-pulse"></span>
                                                {{ $event->is_active ? 'Aktif' : 'Selesai' }}
                                            </span>
                                        </div>

                                        {{-- Overlay Gradient --}}
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </a>

                                    {{-- Content --}}
                                    <div class="p-3 sm:p-6 flex flex-col flex-grow {{ $viewMode === 'list' ? 'md:w-2/3 md:float-left' : '' }}">
                                        {{-- Meta --}}
                                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-3 mb-2 sm:mb-3 text-sm">
                                            @if($event->category)
                                                <span class="inline-flex items-center px-1.5 py-0.5 sm:px-2.5 rounded-full text-[10px] sm:text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100">
                                                    {{ $event->category->name }}
                                                </span>
                                            @endif
                                            <span class="text-text-muted flex items-center gap-1 sm:gap-1.5 text-[10px] sm:text-xs font-medium">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $event->date->format('d M Y') }}
                                            </span>
                                        </div>

                                        {{-- Title --}}
                                        <h3 class="text-sm sm:text-xl font-bold text-text-main mb-2 sm:mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors font-heading leading-tight">
                                            <a href="{{ route('events.show', $event->slug) }}">
                                                {{ $event->title }}
                                            </a>
                                        </h3>

                                        {{-- Description --}}
                                        <p class="text-text-muted text-xs sm:text-sm line-clamp-2 mb-3 sm:mb-5 leading-relaxed flex-grow hidden sm:block">
                                            {{ Str::limit(strip_tags($event->description), 120) }}
                                        </p>

                                        {{-- Footer --}}
                                        <div class="flex items-center justify-between pt-2 sm:pt-4 border-t border-border mt-auto">
                                            @if($event->location)
                                                <div class="flex items-center text-[10px] sm:text-sm text-text-muted max-w-[65%] group/loc hidden sm:flex">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 flex-shrink-0 text-text-muted/60 group-hover/loc:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span class="truncate font-medium">{{ $event->location }}</span>
                                                </div>
                                            @else
                                                <div></div>
                                            @endif
                                            
                                            <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center text-xs sm:text-sm font-bold text-primary-600 hover:text-primary-700 transition-colors group/link">
                                                Detail
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-10">
                            {{ $events->links() }}
                        </div>
                    @else
                        {{-- Empty State --}}
                        <x-empty-state 
                            title="Tidak Ada Event Ditemukan"
                            message="Kami tidak dapat menemukan event yang sesuai dengan kriteria pencarian Anda. Coba ubah filter atau kata kunci."
                            icon="search"
                            :action-label="$search || $selectedCategory || $selectedStatus !== 'all' ? 'Reset Filter' : null"
                            action-wire-click="clearFilters"
                        />
                    @endif
                </div>
            </main>
        </div>
    </div>
</div>

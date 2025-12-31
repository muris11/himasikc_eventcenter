<div class="py-12 bg-background min-h-screen relative overflow-hidden">
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16 relative">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <h1 class="text-4xl sm:text-5xl font-bold text-text-main mb-6 font-heading tracking-tight relative z-10">
                Blog & <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-400">Artikel</span>
            </h1>
            <p class="text-lg text-text-muted max-w-2xl mx-auto leading-relaxed relative z-10">
                Temukan wawasan terbaru, berita kegiatan, dan artikel inspiratif seputar teknologi dan kegiatan mahasiswa HIMA SIKC.
            </p>
        </div>

        {{-- Blog Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-8">
            @forelse($posts as $post)
                <article class="group flex flex-col h-full bg-surface rounded-2xl sm:rounded-[2rem] border border-border overflow-hidden hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-2 transition-all duration-500">
                     {{-- Image --}}
                    <a href="{{ route('blog.show', $post->slug) }}" class="block relative h-32 sm:h-60 overflow-hidden">
                        <div class="absolute inset-0 bg-primary-900/10 group-hover:bg-transparent transition-colors z-10"></div>
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 loading="lazy" />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 group-hover:from-primary-100 group-hover:to-primary-200 transition-colors">
                                <svg class="w-16 h-16 text-primary-300 transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                    {{-- Content --}}
                    <div class="p-4 sm:p-8 flex flex-col flex-1">
                        <div class="flex items-center gap-2 sm:gap-3 mb-2 sm:mb-4 text-[10px] sm:text-xs font-medium text-text-muted uppercase tracking-wider">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <h3 class="text-sm sm:text-xl font-bold text-text-main mb-2 sm:mb-4 leading-tight group-hover:text-primary-600 transition-colors line-clamp-2 font-heading">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        <p class="text-text-muted text-xs sm:text-sm line-clamp-2 sm:line-clamp-3 mb-3 sm:mb-6 leading-relaxed flex-1">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>

                        {{-- Author --}}
                        <div class="flex items-center justify-between pt-3 sm:pt-6 border-t border-border mt-auto">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-[10px] sm:text-xs font-bold text-white shadow-sm ring-2 ring-white">
                                    {{ substr($post->user->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="text-[10px] sm:text-xs font-bold text-text-main uppercase tracking-wide">{{ $post->user->name ?? 'Admin' }}</span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-surface-secondary flex items-center justify-center text-text-muted group-hover:bg-primary-500 group-hover:text-white transition-all duration-300 transform group-hover:rotate-45">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full">
                    <x-empty-state 
                        title="Belum Ada Artikel"
                        message="Nantikan artikel menarik dari kami segera."
                        icon="document"
                    />
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</div>

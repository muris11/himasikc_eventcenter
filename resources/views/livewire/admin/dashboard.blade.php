<div>
    {{-- Welcome Section --}}
    <div class="mb-10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-text-main font-heading tracking-tight">
                    Selamat Datang, <span class="text-primary-600">{{ auth()->user()->name }}</span>!
                </h1>
                <p class="text-text-muted mt-2 text-lg">Pantau aktivitas dan kelola konten dengan mudah hari ini.</p>
            </div>
            <div class="flex items-center gap-3 bg-surface px-4 py-2 rounded-xl border border-border shadow-sm">
                <div class="p-2 bg-primary-50 rounded-lg text-primary-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="text-sm text-text-muted">
                    <span class="font-bold text-text-main block">{{ now()->format('l') }}</span>
                    <span>{{ now()->format('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Stats Cards with Animation --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10" 
         x-data="{ 
             stats: [
                 { value: 0, target: {{ $totalEvents }}, color: 'primary', label: 'Total Event' },
                 { value: 0, target: {{ $activeEvents }}, color: 'green', label: 'Event Aktif' },
                 { value: 0, target: {{ $totalPosts }}, color: 'purple', label: 'Total Posts' },
                 { value: 0, target: {{ $todayVisitors }}, color: 'orange', label: 'Pengunjung Hari Ini' }
             ],
             started: false
         }"
         x-intersect="if (!started) { 
             started = true; 
             stats.forEach((stat, i) => { 
                 let start = 0; 
                 const end = stat.target; 
                 const duration = 1500; 
                 const increment = end / (duration / 16); 
                 const timer = setInterval(() => { 
                     start += increment; 
                     if (start >= end) { 
                         start = end; 
                         clearInterval(timer); 
                     } 
                     stats[i].value = Math.floor(start); 
                 }, 16); 
             }); 
         }"
    >
        {{-- Total Events --}}
        <div class="bg-surface rounded-3xl p-6 border border-border shadow-sm hover:shadow-xl hover:shadow-primary-500/10 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-primary-50 rounded-2xl text-primary-600 group-hover:bg-primary-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100">Total</span>
                </div>
                <h3 class="text-sm font-bold text-text-muted mb-1 uppercase tracking-wider">Total Event</h3>
                <p class="text-4xl font-bold text-text-main font-heading" x-text="stats[0]?.value || 0"></p>
                <p class="text-sm text-text-muted mt-2 font-medium">Event yang dibuat</p>
            </div>
        </div>

        {{-- Active Events --}}
        <div class="bg-surface rounded-3xl p-6 border border-border shadow-sm hover:shadow-xl hover:shadow-green-500/10 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-2xl text-green-600 group-hover:bg-green-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Aktif
                    </span>
                </div>
                <h3 class="text-sm font-bold text-text-muted mb-1 uppercase tracking-wider">Event Aktif</h3>
                <p class="text-4xl font-bold text-text-main font-heading" x-text="stats[1]?.value || 0"></p>
                <p class="text-sm text-green-600 mt-2 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                    </svg>
                    Sedang berjalan
                </p>
            </div>
        </div>

        {{-- Total Posts --}}
        <div class="bg-surface rounded-3xl p-6 border border-border shadow-sm hover:shadow-xl hover:shadow-purple-500/10 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-50 rounded-2xl text-purple-600 group-hover:bg-purple-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-50 text-purple-700 border border-purple-100">{{ $publishedPosts }} Pub</span>
                </div>
                <h3 class="text-sm font-bold text-text-muted mb-1 uppercase tracking-wider">Total Posts</h3>
                <p class="text-4xl font-bold text-text-main font-heading" x-text="stats[2]?.value || 0"></p>
                <p class="text-sm text-text-muted mt-2 font-medium">Artikel blog</p>
            </div>
        </div>

        {{-- Today Visitors --}}
        <div class="bg-surface rounded-3xl p-6 border border-border shadow-sm hover:shadow-xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-orange-50 rounded-2xl text-orange-600 group-hover:bg-orange-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-50 text-orange-700 border border-orange-100">Hari Ini</span>
                </div>
                <h3 class="text-sm font-bold text-text-muted mb-1 uppercase tracking-wider">Pengunjung</h3>
                <p class="text-4xl font-bold text-text-main font-heading" x-text="stats[3]?.value || 0"></p>
                <p class="text-sm text-text-muted mt-2 font-medium">Visitor hari ini</p>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
        {{-- Visitor Trend Chart --}}
        <div class="bg-surface rounded-3xl p-6 border border-border shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-text-main font-heading">Trend Pengunjung</h2>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100">7 Hari Terakhir</span>
            </div>
            <div class="relative h-80 w-full">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>

        {{-- Events per Category Chart --}}
        <div class="bg-surface rounded-3xl p-6 border border-border shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-text-main font-heading">Event per Kategori</h2>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-surface-secondary text-text-muted border border-border">Statistik</span>
            </div>
            <div class="relative h-80 w-full">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mb-10">
        <h2 class="text-2xl font-bold text-text-main mb-6 font-heading">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('admin.events.create') }}" class="group block h-full">
                <div class="bg-surface rounded-2xl p-5 border border-border shadow-sm hover:shadow-xl hover:shadow-blue-500/10 hover:-translate-y-1 transition-all duration-300 h-full flex items-center gap-4">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-text-main group-hover:text-blue-600 transition-colors">Buat Event</h3>
                        <p class="text-sm text-text-muted font-medium">Tambah event baru</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.posts.create') }}" class="group block h-full">
                <div class="bg-surface rounded-2xl p-5 border border-border shadow-sm hover:shadow-xl hover:shadow-purple-500/10 hover:-translate-y-1 transition-all duration-300 h-full flex items-center gap-4">
                    <div class="p-3 bg-purple-50 rounded-xl text-purple-600 group-hover:bg-purple-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-text-main group-hover:text-purple-600 transition-colors">Buat Post</h3>
                        <p class="text-sm text-text-muted font-medium">Tulis artikel baru</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.event-categories.index') }}" class="group block h-full">
                <div class="bg-surface rounded-2xl p-5 border border-border shadow-sm hover:shadow-xl hover:shadow-green-500/10 hover:-translate-y-1 transition-all duration-300 h-full flex items-center gap-4">
                    <div class="p-3 bg-green-50 rounded-xl text-green-600 group-hover:bg-green-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-text-main group-hover:text-green-600 transition-colors">Kategori</h3>
                        <p class="text-sm text-text-muted font-medium">Kelola kategori</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" class="group block h-full">
                <div class="bg-surface rounded-2xl p-5 border border-border shadow-sm hover:shadow-xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 h-full flex items-center gap-4">
                    <div class="p-3 bg-orange-50 rounded-xl text-orange-600 group-hover:bg-orange-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-text-main group-hover:text-orange-600 transition-colors">Users</h3>
                        <p class="text-sm text-text-muted font-medium">Kelola pengguna</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Recent Activities --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Events --}}
        <div class="bg-surface rounded-3xl border border-border shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border bg-surface-secondary/50">
                <h2 class="text-lg font-bold text-text-main flex items-center gap-3 font-heading">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    Event Terbaru
                </h2>
            </div>

            <div class="divide-y divide-border">
                @forelse($recentEvents as $event)
                    <div class="p-5 hover:bg-surface-secondary transition-colors group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-text-main truncate group-hover:text-primary-600 transition-colors">
                                    {{ $event->title }}
                                </h3>
                                <div class="flex items-center gap-2 mt-1.5 text-sm text-text-muted">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $event->date->format('d M Y') }}
                                    @if($event->category)
                                        <span class="text-border">•</span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-surface-secondary text-text-muted">
                                            {{ $event->category->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $event->is_active ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-surface-secondary text-text-muted border border-border' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $event->is_active ? 'bg-status-success' : 'bg-text-muted/50' }} mr-1.5"></span>
                                    {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                                <a href="{{ route('admin.events.edit', $event) }}" class="p-2 text-text-muted hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-text-muted font-medium">Belum ada event</p>
                    </div>
                @endforelse
            </div>

            @if($recentEvents->count() > 0)
                <div class="p-4 border-t border-border bg-surface-secondary/30">
                    <a href="{{ route('admin.events.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 flex items-center justify-center gap-1 hover:gap-2 transition-all">
                        Lihat Semua Event
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>

        {{-- Recent Posts --}}
        <div class="bg-surface rounded-3xl border border-border shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border bg-surface-secondary/50">
                <h2 class="text-lg font-bold text-text-main flex items-center gap-3 font-heading">
                    <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    Postingan Terbaru
                </h2>
            </div>

            <div class="divide-y divide-border">
                @forelse($recentPosts as $post)
                    <div class="p-5 hover:bg-surface-secondary transition-colors group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-text-main truncate group-hover:text-primary-600 transition-colors">
                                    {{ $post->title }}
                                </h3>
                                <div class="flex items-center gap-2 mt-1.5 text-sm text-text-muted">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $post->created_at->format('d M Y') }}
                                    @if($post->user)
                                        <span class="text-border">•</span>
                                        <span class="font-medium text-text-muted">{{ $post->user->name }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $post->is_published ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-yellow-50 text-yellow-700 border border-yellow-100' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $post->is_published ? 'bg-green-500' : 'bg-yellow-500' }} mr-1.5"></span>
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="p-2 text-text-muted hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-text-muted font-medium">Belum ada postingan</p>
                    </div>
                @endforelse
            </div>

            @if($recentPosts->count() > 0)
                <div class="p-4 border-t border-border bg-surface-secondary/30">
                    <a href="{{ route('admin.posts.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 flex items-center justify-center gap-1 hover:gap-2 transition-all">
                        Lihat Semua Posts
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Chart.js Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Visitor Chart
    const visitorCtx = document.getElementById('visitorChart');
    if (visitorCtx) {
        const visitorData = @json($visitorsLast7Days ?? []);
        const labels = visitorData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
        });
        const data = visitorData.map(item => item.count);

        new Chart(visitorCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengunjung',
                    data: data,
                    borderColor: '#E6AD2B',
                    backgroundColor: 'rgba(230, 173, 43, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#E6AD2B',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        padding: 12,
                        cornerRadius: 8,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        titleFont: { family: 'Plus Jakarta Sans', size: 13 },
                        bodyFont: { family: 'Inter', size: 13 },
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { family: 'Inter' } },
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        border: { display: false }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter' } },
                        border: { display: false }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    }

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart');
    if (categoryCtx) {
        const categoryData = @json($eventsByCategory ?? []);
        const categoryLabels = categoryData.map(item => item.name);
        const categoryCounts = categoryData.map(item => item.count);

        new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: categoryLabels,
                datasets: [{
                    label: 'Jumlah Event',
                    data: categoryCounts,
                    backgroundColor: [
                        'rgba(230, 173, 43, 0.8)',
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(249, 115, 22, 0.8)'
                    ],
                    borderRadius: 8,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        padding: 12,
                        cornerRadius: 8,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        titleFont: { family: 'Plus Jakarta Sans', size: 13 },
                        bodyFont: { family: 'Inter', size: 13 },
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { family: 'Inter' } },
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        border: { display: false }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter' } },
                        border: { display: false }
                    }
                }
            }
        });
    }
});
</script>
</div>

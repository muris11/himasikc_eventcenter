<div>
    
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
        <div class="animate-fade-in-up">
            <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">
                Kelola Event
            </h1>
            <p class="text-text-muted mt-1 text-lg">Kelola semua event dengan mudah dan efisien</p>
        </div>
        <a href="{{ route('admin.events.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 group">
            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Event
        </a>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-800 rounded-xl flex items-center shadow-sm animate-fade-in-up">
            <div class="p-2 bg-green-100 rounded-lg mr-3 shrink-0">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-800 rounded-xl flex items-center shadow-sm animate-fade-in-up">
            <div class="p-2 bg-red-100 rounded-lg mr-3 shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Search and Filters -->
    <div class="bg-surface rounded-2xl border border-border shadow-sm p-6 mb-8 hover:shadow-xl hover:shadow-primary-500/5 transition-shadow duration-300">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Search -->
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-bold text-text-main mb-2">Cari Event</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-text-muted group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search"
                        class="block w-full pl-10 pr-4 py-2.5 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm placeholder-text-muted bg-surface-secondary/30 focus:bg-white"
                        placeholder="Cari berdasarkan judul, deskripsi, atau lokasi...">
                </div>
            </div>

            <!-- Filter Status -->
            <div>
                <label for="statusFilter" class="block text-sm font-bold text-text-main mb-2">Status</label>
                <div class="relative">
                    <select wire:model.live="statusFilter" id="statusFilter"
                        class="block w-full py-2.5 px-4 border border-border bg-surface-secondary/30 rounded-xl shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm appearance-none focus:bg-white transition-colors">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-text-muted">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Per Page -->
            <div>
                <label for="perPage" class="block text-sm font-bold text-text-main mb-2">Tampilkan</label>
                <div class="relative">
                    <select wire:model.live="perPage" id="perPage"
                        class="block w-full py-2.5 px-4 border border-border bg-surface-secondary/30 rounded-xl shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm appearance-none focus:bg-white transition-colors">
                        <option value="10">10 per halaman</option>
                        <option value="25">25 per halaman</option>
                        <option value="50">50 per halaman</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-text-muted">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Filters Display -->
        @if ($search || $statusFilter)
            <div class="mt-6 flex flex-wrap items-center gap-2 pt-4 border-t border-border animate-fade-in">
                <span class="text-sm font-medium text-text-muted">Filter aktif:</span>
                @if ($search)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700 border border-primary-100">
                        Pencarian: "{{ $search }}"
                        <button wire:click="$set('search', '')" class="ml-2 hover:bg-primary-100 rounded-full p-0.5 transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </span>
                @endif
                @if ($statusFilter)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700 border border-primary-100">
                        Status: {{ $statusFilter === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        <button wire:click="$set('statusFilter', '')" class="ml-2 hover:bg-primary-100 rounded-full p-0.5 transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </span>
                @endif
                <button wire:click="$set('search', ''); $set('statusFilter', '')" class="text-xs text-text-muted hover:text-red-500 underline ml-2 transition-colors">
                    Reset Semua
                </button>
            </div>
        @endif
    </div>

    <div class="bg-surface rounded-2xl border border-border shadow-sm overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
                <thead class="bg-surface-secondary/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-surface divide-y divide-border">
                    @forelse($events as $event)
                        <tr class="hover:bg-surface-secondary/30 transition-colors duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-border bg-surface-secondary">
                                        @if ($event->image_path)
                                            <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                src="{{ asset('storage/' . $event->image_path) }}" alt="">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-text-muted">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-text-main group-hover:text-primary-600 transition-colors">{{ $event->title }}</div>
                                        <div class="text-sm text-text-muted flex items-center gap-1 mt-0.5">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ Str::limit($event->location, 25) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-text-main">{{ $event->date->format('d M Y') }}</div>
                                <div class="text-xs text-text-muted">{{ $event->date->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $event->is_active ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-surface-secondary text-text-muted border border-border' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $event->is_active ? 'bg-green-500' : 'bg-slate-400' }} mr-1.5"></span>
                                    {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.events.edit', $event) }}"
                                        class="p-2 bg-surface border border-border text-text-muted hover:text-primary-600 hover:border-primary-200 hover:bg-primary-50 rounded-lg transition-all shadow-sm hover:shadow-md" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button wire:click="delete({{ $event->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus event ini?"
                                        class="p-2 bg-surface border border-border text-text-muted hover:text-red-600 hover:border-red-200 hover:bg-red-50 rounded-lg transition-all shadow-sm hover:shadow-md" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="animate-fade-in-up">
                                    <div class="w-20 h-20 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-10 h-10 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-text-main mb-2 font-heading">Belum ada Event</h3>
                                    <p class="text-text-muted mb-6 max-w-sm mx-auto">Mulai dengan membuat event pertama Anda untuk ditampilkan kepada pengguna.</p>
                                    <a href="{{ route('admin.events.create') }}"
                                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all duration-200 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Buat Event Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden grid grid-cols-1 divide-y divide-border">
            @forelse($events as $event)
                <div class="p-4 hover:bg-surface-secondary/30 transition-colors">
                    <div class="flex items-start gap-4">
                        <!-- Image -->
                        <div class="shrink-0 h-16 w-16 rounded-lg overflow-hidden border border-border bg-surface-secondary">
                            @if ($event->image_path)
                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $event->image_path) }}" alt="">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-text-muted">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-bold text-text-main line-clamp-2 mb-1">{{ $event->title }}</h3>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium {{ $event->is_active ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-surface-secondary text-text-muted border border-border' }}">
                                    {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                            
                            <div class="space-y-1 mt-1">
                                <div class="flex items-center text-xs text-text-muted">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $event->date->format('d M Y, H:i') }}
                                </div>
                                <div class="flex items-center text-xs text-text-muted">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ Str::limit($event->location, 30) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 flex items-center justify-end gap-3 pt-3 border-t border-border border-dashed">
                        <a href="{{ route('admin.events.edit', $event) }}"
                            class="text-xs font-medium text-primary-600 hover:text-primary-700 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <button wire:click="delete({{ $event->id }})"
                            wire:confirm="Apakah Anda yakin ingin menghapus event ini?"
                            class="text-xs font-medium text-red-600 hover:text-red-700 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-text-muted text-sm font-medium">Belum ada Event</p>
                </div>
            @endforelse
        </div>

        <div class="px-6 py-4 border-t border-border bg-surface-secondary/30">
            {{ $events->links() }}
        </div>
    </div>
</div>

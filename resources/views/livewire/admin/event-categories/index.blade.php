<div>
    
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
        <div class="animate-fade-in-up">
            <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">
                Kelola Kategori Event
            </h1>
            <p class="text-text-muted mt-1 text-lg">Kelola kategori event dengan mudah dan efisien</p>
        </div>
        <a href="{{ route('admin.event-categories.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 group">
            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori Event
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

    <div class="bg-surface rounded-2xl border border-border shadow-sm overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
                <thead class="bg-surface-secondary/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Slug</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-surface divide-y divide-border">
                    @forelse($categories as $category)
                        <tr class="hover:bg-surface-secondary/30 transition-colors duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-text-main group-hover:text-primary-600 transition-colors">{{ $category->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-text-muted">{{ $category->slug }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.event-categories.edit', $category) }}"
                                        class="h-11 w-11 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-primary-600 hover:border-primary-200 hover:bg-primary-50 rounded-xl transition-all shadow-sm hover:shadow-md" title="Ubah">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button wire:click="delete({{ $category->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus kategori event ini?"
                                        class="h-11 w-11 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-red-600 hover:border-red-200 hover:bg-red-50 rounded-xl transition-all shadow-sm hover:shadow-md" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center">
                                <div class="animate-fade-in-up">
                                    <div class="w-20 h-20 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-10 h-10 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-text-main mb-2 font-heading">Belum ada Kategori Event</h3>
                                    <p class="text-text-muted mb-6 max-w-sm mx-auto">Mulai dengan membuat kategori event pertama Anda</p>
                                    <a href="{{ route('admin.event-categories.create') }}"
                                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all duration-200 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Buat Kategori Event Pertama
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
            @forelse($categories as $category)
                <div class="p-4 hover:bg-surface-secondary/30 transition-colors">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-text-main line-clamp-1 mb-1">{{ $category->name }}</h3>
                            <div class="text-xs text-text-muted font-mono bg-surface-secondary px-2 py-0.5 rounded inline-block">
                                {{ $category->slug }}
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.event-categories.edit', $category) }}"
                                class="h-11 w-11 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-primary-600 hover:border-primary-200 hover:bg-primary-50 rounded-xl transition-all shadow-sm hover:shadow-md" title="Ubah">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button wire:click="delete({{ $category->id }})"
                                wire:confirm="Apakah Anda yakin ingin menghapus kategori event ini?"
                                class="h-11 w-11 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-red-600 hover:border-red-200 hover:bg-red-50 rounded-xl transition-all shadow-sm hover:shadow-md" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <p class="text-text-muted text-sm font-medium">Belum ada Kategori Event</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

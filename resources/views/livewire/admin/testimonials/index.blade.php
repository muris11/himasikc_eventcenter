<div>
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
        <div class="animate-fade-in-up">
            <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">
                Kelola Testimoni
            </h1>
            <p class="text-text-muted mt-1 text-lg">Kelola ulasan dan testimoni dari mahasiswa</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 group">
            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Testimoni
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

    <!-- Search and Filters -->
    <div class="bg-surface rounded-2xl border border-border shadow-sm p-6 mb-8 hover:shadow-xl hover:shadow-primary-500/5 transition-shadow duration-300">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Search -->
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-bold text-text-main mb-2">Cari Testimoni</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-text-muted group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search"
                        class="block w-full pl-10 pr-4 py-2.5 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm placeholder-text-muted bg-surface-secondary/30 focus:bg-white"
                        placeholder="Cari nama, role, atau isi testimoni...">
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
    </div>

    <div class="bg-surface rounded-2xl border border-border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
                <thead class="bg-surface-secondary/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Penulis</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Isi Testimoni</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-surface divide-y divide-border">
                    @forelse($testimonials as $testimonial)
                        <tr class="hover:bg-surface-secondary/30 transition-colors duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="shrink-0 h-10 w-10 rounded-full overflow-hidden border border-border bg-surface-secondary">
                                        @if ($testimonial->avatar)
                                            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $testimonial->avatar) }}" alt="">
                                        @else
                                            <img class="h-full w-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=E6AD2B&color=fff" alt="">
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-text-main">{{ $testimonial->name }}</div>
                                        <div class="text-xs text-text-muted">{{ $testimonial->role }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-text-muted line-clamp-2 italic">"{{ $testimonial->content }}"</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $testimonial->is_active ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-surface-secondary text-text-muted border border-border' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $testimonial->is_active ? 'bg-green-500' : 'bg-slate-400' }} mr-1.5"></span>
                                    {{ $testimonial->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                        class="p-2 bg-surface border border-border text-text-muted hover:text-primary-600 hover:border-primary-200 hover:bg-primary-50 rounded-lg transition-all shadow-sm hover:shadow-md" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button wire:click="delete({{ $testimonial->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus testimoni ini?"
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
                                <div class="w-20 h-20 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-10 h-10 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-text-main mb-2 font-heading">Belum ada Testimoni</h3>
                                <p class="text-text-muted mb-6 max-w-sm mx-auto">Tambahkan testimoni pertama untuk ditampilkan di halaman depan.</p>
                                <a href="{{ route('admin.testimonials.create') }}"
                                    class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all duration-200 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Testimoni
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-border bg-surface-secondary/30">
            {{ $testimonials->links() }}
        </div>
    </div>
</div>

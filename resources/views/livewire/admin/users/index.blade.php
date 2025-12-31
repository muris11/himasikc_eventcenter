<div>
    
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
        <div class="animate-fade-in-up">
            <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">
                Kelola Pengguna
            </h1>
            <p class="text-text-muted mt-1 text-lg">Kelola semua pengguna sistem dengan mudah dan efisien</p>
        </div>
        <button wire:click="openModal"
            class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 group">
            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pengguna
        </button>
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
                <label for="search" class="block text-sm font-bold text-text-main mb-2">Cari Pengguna</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-text-muted group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search"
                        class="block w-full pl-10 pr-4 py-2.5 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm placeholder-text-muted bg-surface-secondary/30 focus:bg-white"
                        placeholder="Cari berdasarkan nama atau email...">
                </div>
            </div>

            <!-- Filter Role -->
            <div>
                <label for="roleFilter" class="block text-sm font-bold text-text-main mb-2">Peran</label>
                <div class="relative">
                    <select wire:model.live="roleFilter" id="roleFilter"
                        class="block w-full py-2.5 px-4 border border-border bg-surface-secondary/30 rounded-xl shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm appearance-none focus:bg-white transition-colors">
                        <option value="">Semua Peran</option>
                        <option value="user">Pengguna</option>
                        <option value="admin">Admin</option>
                        <option value="super_admin">Super Admin</option>
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
        @if ($search || $roleFilter)
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
                @if ($roleFilter)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700 border border-primary-100">
                        Peran: {{ $roleFilter === 'super_admin' ? 'Super Admin' : ($roleFilter === 'admin' ? 'Admin' : 'Pengguna') }}
                        <button wire:click="$set('roleFilter', '')" class="ml-2 hover:bg-primary-100 rounded-full p-0.5 transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </span>
                @endif
                <button wire:click="$set('search', ''); $set('roleFilter', '')" class="text-xs text-text-muted hover:text-red-500 underline ml-2 transition-colors">
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
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Pengguna</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Peran</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Bergabung</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-surface divide-y divide-border">
                    @forelse($users as $user)
                        <tr class="hover:bg-surface-secondary/30 transition-colors duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="shrink-0 h-10 w-10 bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-text-main group-hover:text-primary-600 transition-colors">{{ $user->name }}</div>
                                        <div class="text-xs text-text-muted mt-0.5">ID: {{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-text-main">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $user->role === 'super_admin' ? 'bg-purple-50 text-purple-700 border border-purple-100' : 
                                       ($user->role === 'admin' ? 'bg-primary-50 text-primary-700 border border-primary-100' : 
                                       'bg-surface-secondary text-text-muted border border-border') }}">
                                    {{ $user->role === 'super_admin' ? 'Super Admin' : ($user->role === 'admin' ? 'Admin' : 'Pengguna') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-muted">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="editUser({{ $user->id }})"
                                        class="h-11 w-11 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-primary-600 hover:border-primary-200 hover:bg-primary-50 rounded-xl transition-all shadow-sm hover:shadow-md" title="Ubah">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    @if ($user->role !== 'super_admin')
                                        <button wire:click="deleteUser({{ $user->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus pengguna ini?"
                                            class="h-11 w-11 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-red-600 hover:border-red-200 hover:bg-red-50 rounded-xl transition-all shadow-sm hover:shadow-md" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="animate-fade-in-up">
                                    <div class="w-20 h-20 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-10 h-10 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-text-main mb-2 font-heading">Tidak ada pengguna ditemukan</h3>
                                    <p class="text-text-muted mb-6 max-w-sm mx-auto">Coba sesuaikan filter pencarian Anda atau tambahkan pengguna baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden grid grid-cols-1 divide-y divide-border">
            @forelse($users as $user)
                <div class="p-4 hover:bg-surface-secondary/30 transition-colors">
                    <div class="flex items-start gap-4">
                        <!-- Avatar -->
                        <div class="shrink-0 h-12 w-12 bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-full flex items-center justify-center text-lg font-bold shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-bold text-text-main line-clamp-1">{{ $user->name }}</h3>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium 
                                    {{ $user->role === 'super_admin' ? 'bg-purple-50 text-purple-700 border border-purple-100' : 
                                       ($user->role === 'admin' ? 'bg-primary-50 text-primary-700 border border-primary-100' : 
                                       'bg-surface-secondary text-text-muted border border-border') }}">
                                    {{ $user->role === 'super_admin' ? 'Super Admin' : ($user->role === 'admin' ? 'Admin' : 'Pengguna') }}
                                </span>
                            </div>
                            
                            <div class="space-y-1 mt-1">
                                <div class="flex items-center text-xs text-text-muted">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $user->email }}
                                </div>
                                <div class="flex items-center text-xs text-text-muted">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Bergabung: {{ $user->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 flex items-center justify-end gap-3 pt-3 border-t border-border border-dashed">
                        <button wire:click="editUser({{ $user->id }})"
                            class="h-10 px-4 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-primary-600 hover:border-primary-200 hover:bg-primary-50 rounded-xl transition-all shadow-sm hover:shadow-md text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Ubah
                        </button>
                        @if ($user->role !== 'super_admin')
                            <button wire:click="deleteUser({{ $user->id }})"
                                wire:confirm="Apakah Anda yakin ingin menghapus pengguna ini?"
                                class="h-10 px-4 flex items-center justify-center bg-surface border border-border text-text-muted hover:text-red-600 hover:border-red-200 hover:bg-red-50 rounded-xl transition-all shadow-sm hover:shadow-md text-sm font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <p class="text-text-muted text-sm font-medium">Tidak ada pengguna ditemukan</p>
                </div>
            @endforelse
        </div>

        <div class="px-6 py-4 border-t border-border bg-surface-secondary/30">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 z-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="relative z-10 inline-block align-bottom bg-surface rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-border">
                    <div class="bg-surface px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-50 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-text-main font-heading" id="modal-title">
                                    {{ $isEditing ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
                                </h3>
                                <div class="mt-4">
                                    <form wire:submit.prevent="{{ $isEditing ? 'updateUser' : 'createUser' }}">
                                        <div class="mb-4">
                                            <label class="block text-sm font-bold text-text-main mb-2" for="name">
                                                Nama Lengkap
                                            </label>
                                            <input wire:model="name"
                                                class="block w-full px-4 py-2.5 border border-border rounded-xl shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm bg-surface-secondary/30 focus:bg-white transition-colors"
                                                id="name" type="text" required placeholder="Masukkan nama lengkap">
                                            @error('name')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-bold text-text-main mb-2" for="email">
                                                Email
                                            </label>
                                            <input wire:model="email"
                                                class="block w-full px-4 py-2.5 border border-border rounded-xl shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm bg-surface-secondary/30 focus:bg-white transition-colors"
                                                id="email" type="email" required placeholder="nama@email.com">
                                            @error('email')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @if (!$isEditing)
                                            <div class="mb-4">
                                                <label class="block text-sm font-bold text-text-main mb-2" for="password">
                                                    Password
                                                </label>
                                                <input wire:model="password"
                                                    class="block w-full px-4 py-2.5 border border-border rounded-xl shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm bg-surface-secondary/30 focus:bg-white transition-colors"
                                                    id="password" type="password" required placeholder="********">
                                                @error('password')
                                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                        <div class="mb-6">
                                            <label class="block text-sm font-bold text-text-main mb-2" for="role">
                                                Peran
                                            </label>
                                            <select wire:model="role"
                                                class="block w-full px-4 py-2.5 border border-border rounded-xl shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm bg-surface-secondary/30 focus:bg-white transition-colors">
                                                <option value="user">Pengguna</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                            @error('role')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex items-center justify-end gap-3 mt-6">
                                            <button type="button" wire:click="closeModal"
                                                class="px-4 py-2.5 text-sm font-bold text-text-muted bg-surface-secondary hover:bg-surface-secondary/80 rounded-xl transition-colors">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transition-all">
                                                {{ $isEditing ? 'Perbarui' : 'Tambah' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

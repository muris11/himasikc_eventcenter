<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-surface rounded-3xl shadow-sm border border-border overflow-hidden">
            <div class="p-6 lg:p-8 bg-surface-secondary/30 border-b border-border">
                <div class="flex items-center mb-6">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center text-text-muted hover:text-primary-600 transition-colors group">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Pengguna
                    </a>
                </div>

                <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">Edit Pengguna</h1>
                <p class="text-text-muted mt-2">Perbarui informasi pengguna sesuai kebutuhan.</p>
            </div>

            <div class="p-6 lg:p-8">
                <form wire:submit="save" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Nama -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Nama Lengkap</label>
                            <input type="text" wire:model="name" value="{{ $name }}"
                                x-init="$el.value = '{{ $name }}'"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main placeholder-text-muted/50"
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Email</label>
                            <input type="email" wire:model="email" value="{{ $email }}"
                                x-init="$el.value = '{{ $email }}'"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main placeholder-text-muted/50"
                                placeholder="Masukkan alamat email">
                            @error('email')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Peran -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Peran</label>
                            <select wire:model="role" x-init="$el.value = '{{ $role }}'"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main">
                                <option value="user" @selected($role === 'user')>Pengguna</option>
                                <option value="admin" @selected($role === 'admin')>Admin</option>
                                @if (auth()->user()->role === 'super_admin')
                                    <option value="super_admin" @selected($role === 'super_admin')>Super Admin</option>
                                @endif
                            </select>
                            @error('role')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Section -->
                        <div class="col-span-2 pt-4 border-t border-border">
                            <h3 class="text-lg font-bold text-text-main mb-2 font-heading">Ubah Password</h3>
                            <p class="text-sm text-text-muted mb-6">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>

                        <!-- Password Baru -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Password Baru</label>
                            <input type="password" wire:model="password"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main placeholder-text-muted/50"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Konfirmasi Password</label>
                            <input type="password" wire:model="password_confirmation"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main placeholder-text-muted/50"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="fixed bottom-0 left-0 right-0 p-4 bg-surface/90 backdrop-blur-md border-t border-border flex justify-end items-center gap-4 z-20 lg:static lg:bg-transparent lg:border-t lg:border-border lg:p-0 lg:pt-8">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-6 py-3 border border-border text-text-muted font-bold rounded-xl hover:bg-surface-secondary hover:text-text-main transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

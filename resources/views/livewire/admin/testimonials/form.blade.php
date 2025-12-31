<div class="bg-surface rounded-2xl border border-border shadow-sm p-6 sm:p-8 animate-fade-in-up">
    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-text-main mb-2">Nama Penulis</label>
                <input wire:model="name" type="text" id="name"
                    class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm placeholder-text-muted bg-surface-secondary/30 focus:bg-white @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Contoh: Rina A.">
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-bold text-text-main mb-2">Role / Jabatan</label>
                <input wire:model="role" type="text" id="role"
                    class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm placeholder-text-muted bg-surface-secondary/30 focus:bg-white @error('role') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Contoh: Mahasiswa TI 2023">
                @error('role') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="block text-sm font-bold text-text-main mb-2">Isi Testimoni</label>
            <textarea wire:model="content" id="content" rows="4"
                class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm placeholder-text-muted bg-surface-secondary/30 focus:bg-white @error('content') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                placeholder="Tuliskan ulasan atau testimoni di sini..."></textarea>
            @error('content') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Avatar -->
        <div>
            <label class="block text-sm font-bold text-text-main mb-2">Foto Profil (Opsional)</label>
            
            <div class="flex items-center gap-6">
                <div class="shrink-0">
                    @if ($avatar && !is_string($avatar))
                        <img src="{{ $avatar->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-full border-2 border-primary-500 shadow-md">
                    @elseif (isset($testimonial) && $testimonial->avatar)
                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" class="h-20 w-20 object-cover rounded-full border-2 border-border shadow-sm">
                    @else
                        <div class="h-20 w-20 rounded-full bg-surface-secondary border-2 border-dashed border-border flex items-center justify-center text-text-muted">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <input type="file" wire:model="{{ isset($testimonial) ? 'newAvatar' : 'avatar' }}" id="avatar" class="hidden">
                    <label for="avatar"
                        class="inline-flex items-center px-4 py-2 bg-surface-secondary border border-border rounded-xl font-semibold text-xs text-text-main uppercase tracking-widest shadow-sm hover:bg-surface-tertiary focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                        Pilih Foto
                    </label>
                    <p class="mt-2 text-xs text-text-muted">JPG, PNG, atau GIF. Maksimal 1MB.</p>
                    @error('avatar') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    @error('newAvatar') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="flex items-center">
            <input wire:model="is_active" type="checkbox" id="is_active"
                class="rounded border-border text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 h-5 w-5">
            <label for="is_active" class="ml-2 block text-sm font-bold text-text-main">
                Aktifkan Testimoni
            </label>
        </div>
        <p class="text-xs text-text-muted ml-7 -mt-4">Jika dinonaktifkan, testimoni tidak akan muncul di halaman depan.</p>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-border mt-6">
            <a href="{{ route('admin.testimonials.index') }}"
                class="px-6 py-2.5 border border-border rounded-xl text-text-muted font-bold hover:bg-surface-secondary transition-colors">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                <svg wire:loading.remove class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Simpan Testimoni
            </button>
        </div>
    </form>
</div>

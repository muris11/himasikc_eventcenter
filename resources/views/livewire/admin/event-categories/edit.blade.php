<div>


    <div class="flex items-center mb-8">
        <a href="{{admin.event-categories.index') }}"
            class="flex items-center text-text-muted hover:text-primary-600 mr-4 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Kategori
        </a>
    </div>

    <div class="bg-surface rounded-xl border border-border shadow-sm overflow-hidden">
        <div class="p-6 lg:p-8 border-b border-border">
            <h1 class="text-2xl font-bold text-text-main font-heading">Edit Kategori Event</h1>
        </div>

        <div class="p-6 lg:p-8">
            <form wire:submit="save" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-text-main mb-2">Nama Kategori</label>
                    <input type="text" wire:model.live="name" id="name"
                        class="w-full px-3 py-2 border border-border rounded-lg shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main placeholder-text-muted/50"
                        placeholder="Masukkan nama kategori">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-border">
                    <a href="{{ route('admin.event-categories.index') }}"
                        class="px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary hover:text-text-main transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg shadow-sm shadow-primary-500/30 transition-all flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

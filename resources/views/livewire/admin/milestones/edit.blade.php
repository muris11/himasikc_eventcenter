<div>
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.milestones.index') }}" class="p-2 rounded-xl hover:bg-surface-secondary text-text-muted hover:text-text-main transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div class="animate-fade-in-up">
            <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">
                Edit Milestone
            </h1>
            <p class="text-text-muted mt-1 text-lg">Perbarui informasi milestone</p>
        </div>
    </div>

    <div class="bg-surface rounded-2xl border border-border shadow-sm p-6 md:p-8 animate-fade-in-up" style="animation-delay: 0.1s">
        <form wire:submit="update" class="space-y-6 max-w-3xl">
            <!-- Year -->
            <div>
                <label for="year" class="block text-sm font-bold text-text-main mb-2">Tahun</label>
                <input wire:model="year" type="number" id="year" placeholder="Contoh: 2024"
                    class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface-secondary/30 focus:bg-white @error('year') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
                @error('year') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-bold text-text-main mb-2">Judul Milestone</label>
                <input wire:model="title" type="text" id="title" placeholder="Contoh: Pendirian Organisasi"
                    class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface-secondary/30 focus:bg-white @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
                @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-bold text-text-main mb-2">Deskripsi</label>
                <textarea wire:model="description" id="description" rows="4" placeholder="Jelaskan secara singkat tentang pencapaian ini..."
                    class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface-secondary/30 focus:bg-white @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"></textarea>
                @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 border-t border-border flex justify-end gap-4">
                <a href="{{ route('admin.milestones.index') }}" class="px-6 py-3 rounded-xl border border-border text-text-muted font-bold hover:bg-surface-secondary transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                    <svg wire:loading.remove class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

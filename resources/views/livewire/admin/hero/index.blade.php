<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-surface rounded-3xl shadow-sm border border-border overflow-hidden">
            <div class="p-6 lg:p-8 bg-surface-secondary/30 border-b border-border">
                <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">Kelola Hero Section</h1>
                <p class="text-text-muted mt-2">Atur tampilan gambar utama dan teks pada halaman depan.</p>
            </div>

            <div class="p-6 lg:p-8">
                <form wire:submit="save" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Image Upload -->
                        <div class="col-span-2" x-data="{ imagePreview: null }">
                            <label class="block text-sm font-bold text-text-main mb-2">Gambar Utama (Hero Image)</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-border border-dashed rounded-xl hover:border-primary-500 hover:bg-primary-50/30 transition-all duration-300 group cursor-pointer"
                                @click="$refs.fileInput.click()">
                                <div class="space-y-2 text-center">
                                    <!-- New Image Preview -->
                                    <template x-if="imagePreview">
                                        <div class="relative inline-block">
                                            <img :src="imagePreview" class="mx-auto h-64 object-cover rounded-lg shadow-md">
                                            <button type="button" @click.stop="imagePreview = null; $refs.fileInput.value = ''" 
                                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>

                                    <!-- Existing Image -->
                                    @if ($heroSection && $heroSection->image_path)
                                        <div x-show="!imagePreview" class="relative inline-block">
                                            <img src="{{ asset('storage/' . $heroSection->image_path) }}"
                                                class="mx-auto h-64 object-cover rounded-lg shadow-md">
                                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                                                <span class="text-white font-medium">Klik untuk mengganti</span>
                                            </div>
                                        </div>
                                    @else
                                        <template x-if="!imagePreview">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-surface-secondary rounded-full flex items-center justify-center mb-4 group-hover:bg-primary-100 transition-colors">
                                                    <svg class="w-8 h-8 text-text-muted group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex text-sm text-text-muted">
                                                    <span class="font-bold text-primary-600 hover:text-primary-700">Unggah file baru</span>
                                                    <p class="pl-1">atau seret dan jatuhkan</p>
                                                </div>
                                                <p class="text-xs text-text-muted mt-1">PNG, JPG, GIF hingga 2MB</p>
                                            </div>
                                        </template>
                                    @endif

                                    <input x-ref="fileInput" wire:model="image" type="file" accept="image/*" class="hidden"
                                        @change="
                                            const file = $event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => imagePreview = e.target.result;
                                                reader.readAsDataURL(file);
                                            }
                                        ">

                                    <!-- Loading Indicator -->
                                    <div wire:loading wire:target="image" class="mt-2">
                                        <div class="flex items-center justify-center text-primary-600">
                                            <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span class="text-sm font-medium">Mengunggah...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Judul Utama</label>
                            <input type="text" wire:model="title"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors placeholder-text-muted/50 bg-surface text-text-main"
                                placeholder="Contoh: Tech Summit 2024">
                            @error('title')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Subtitle -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Subtitle / Tag</label>
                            <input type="text" wire:model="subtitle"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors placeholder-text-muted/50 bg-surface text-text-main"
                                placeholder="Contoh: Featured Event">
                            @error('subtitle')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Link -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Link Tujuan (Opsional)</label>
                            <input type="url" wire:model="link"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors placeholder-text-muted/50 bg-surface text-text-main"
                                placeholder="https://...">
                            @error('link')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-end pt-6 border-t border-border">
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-surface rounded-3xl shadow-sm border border-border overflow-hidden">
            <div class="p-6 lg:p-8 bg-surface-secondary/30 border-b border-border">
                <div class="flex items-center mb-6">
                    <a href="{{ route('admin.events.index') }}"
                        class="flex items-center text-text-muted hover:text-primary-600 transition-colors group">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Event
                    </a>
                </div>

                <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">Buat Event Baru</h1>
                <p class="text-text-muted mt-2">Isi formulir di bawah ini untuk membuat event baru.</p>
            </div>

            <div class="p-6 lg:p-8">
                <form wire:submit.prevent="save" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Judul -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Judul Event</label>
                            <input type="text" wire:model="title" id="title-input"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors placeholder-text-muted/50 bg-surface text-text-main"
                                placeholder="Masukkan judul event yang menarik">
                            @error('title')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Slug (URL)</label>
                            <div class="flex rounded-xl shadow-sm">
                                <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-border bg-surface-secondary text-text-muted text-sm">
                                    {{ config('app.url') }}/events/
                                </span>
                                <input type="text" wire:model="slug" id="event-slug-input"
                                    class="flex-1 min-w-0 block w-full px-4 py-3 rounded-none rounded-r-xl border border-border bg-surface-secondary text-text-muted focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                                    readonly>
                            </div>
                            @error('slug')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Tanggal Pelaksanaan</label>
                            <input type="date" wire:model="date"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main">
                            @error('date')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Lokasi</label>
                            <input type="text" wire:model="location"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors placeholder-text-muted/50 bg-surface text-text-main"
                                placeholder="contoh: Aula Utama / Zoom Meeting">
                            @error('location')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Kategori</label>
                            <select wire:model="category_id"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Jenis Peserta -->
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Jenis Peserta</label>
                            <select wire:model="participant_type"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main">
                                <option value="all">Semua Peserta</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="umum">Umum</option>
                            </select>
                            @error('participant_type')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Organizer -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Penyelenggara (Opsional)</label>
                            <input type="text" wire:model="organizer"
                                class="w-full px-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors placeholder-text-muted/50 bg-surface text-text-main"
                                placeholder="contoh: HIMA SIKC">
                            @error('organizer')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Link Pendaftaran -->
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-text-main mb-2">Link Pendaftaran (Opsional)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                </div>
                                <input type="url" wire:model="registration_link"
                                    class="w-full pl-10 pr-4 py-3 border border-border rounded-xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors placeholder-text-muted/50 bg-surface text-text-main"
                                    placeholder="https://...">
                            </div>
                            @error('registration_link')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Unggah Gambar -->
                        <div class="col-span-2" x-data="{ imagePreview: null }">
                            <label class="block text-sm font-bold text-text-main mb-2">Gambar Event</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-border border-dashed rounded-xl hover:border-primary-500 hover:bg-primary-50/30 transition-all duration-300 group cursor-pointer"
                                @click="$refs.fileInput.click()">
                                <div class="space-y-2 text-center">
                                    <!-- Image Preview -->
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

                                    <!-- Placeholder Icon -->
                                    <template x-if="!imagePreview">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-surface-secondary rounded-full flex items-center justify-center mb-4 group-hover:bg-primary-100 transition-colors">
                                                <svg class="w-8 h-8 text-text-muted group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex text-sm text-text-muted">
                                                <span class="font-bold text-primary-600 hover:text-primary-700">Unggah file</span>
                                                <p class="pl-1">atau seret dan jatuhkan</p>
                                            </div>
                                            <p class="text-xs text-text-muted mt-1">PNG, JPG, GIF hingga 2MB</p>
                                        </div>
                                    </template>

                                    <input x-ref="fileInput" id="image-upload" wire:model="image" type="file" accept="image/*" class="hidden"
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

                        <!-- Description -->
                        <x-rich-text-editor wire:model="description" :value="$description" />

                        <!-- Active Status -->
                        <div class="col-span-2">
                            <div class="flex items-center p-4 bg-surface-secondary rounded-xl border border-border">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" wire:model="is_active" id="is_active"
                                        class="rounded border-border text-primary-600 focus:ring-primary-500 h-5 w-5 cursor-pointer">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_active" class="font-bold text-text-main cursor-pointer">Aktifkan Event</label>
                                    <p class="text-text-muted">Event akan langsung terlihat oleh publik jika diaktifkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fixed bottom-0 left-0 right-0 p-4 bg-surface/90 backdrop-blur-md border-t border-border flex justify-end items-center gap-4 z-20 lg:static lg:bg-transparent lg:border-t lg:border-border lg:p-0 lg:pt-8">
                        <a href="{{ route('admin.events.index') }}"
                            class="px-6 py-3 border border-border text-text-muted font-bold rounded-xl hover:bg-surface-secondary hover:text-text-main transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Buat Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title-input');
        const slugInput = document.getElementById('event-slug-input');

        if (!titleInput || !slugInput) return;

        const slugify = (value) => {
            return value
                .toString()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        };

        titleInput.addEventListener('input', () => {
            const slug = slugify(titleInput.value || '');
            slugInput.value = slug;
            slugInput.dispatchEvent(new Event('input', {
                bubbles: true
            }));
        });
    });
</script>

<script>
    document.addEventListener('livewire:loaded', () => {
        const titleInput = document.getElementById('title-input');

        if (titleInput) {
            titleInput.addEventListener('input', function() {
                const title = this.value;
                const slug = generateSlug(title);

                // Use Livewire's $wire to set the slug
                @this.set('slug', slug);
            });
        }

        function generateSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '') // Remove special characters
                .replace(/[\s_-]+/g, '-') // Replace spaces and underscores with single dash
                .replace(/^-+|-+$/g, ''); // Remove leading/trailing dashes
        }
    });
</script>

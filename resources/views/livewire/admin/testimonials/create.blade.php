<div>
    <div class="mb-8 animate-fade-in-up">
        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center text-text-muted hover:text-primary-600 transition-colors mb-4 group">
            <svg class="w-5 h-5 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-bold text-text-main font-heading tracking-tight">
            Tambah Testimoni Baru
        </h1>
        <p class="text-text-muted mt-1 text-lg">Tambahkan ulasan baru dari mahasiswa</p>
    </div>

    @include('livewire.admin.testimonials.form')
</div>

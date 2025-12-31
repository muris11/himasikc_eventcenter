<div class="min-h-screen">
<div>
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-mesh">
    <section class="relative min-h-[85vh] flex items-center bg-gradient-to-br from-slate-50 to-white">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-100/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary-200/20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass border border-primary/20 shadow-lg">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-50 border border-primary-200 mb-6">
                    <span class="w-1.5 h-1.5 bg-primary-500 rounded-full animate-pulse"></span>
                    <span class="text-xs font-medium text-primary-700">Platform Event Mahasiswa SIKC</span>

                {{-- Main Heading with Gradient Text --}}
                {{-- Main Heading - REDUCED SIZE --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 mb-4 leading-tight">
                    Temukan Event 
                    <span class="text-primary-600">Masa Depanmu</span>

                {{-- Description --}}
                {{-- Description - SMALLER --}}
                <p class="text-base sm:text-lg text-slate-600 mb-8 leading-relaxed">
                    Jelajahi kompetisi, seminar, dan workshop terbaru untuk mengembangkan potensi

                {{-- CTA Buttons --}}
                {{-- CTA Buttons - COMPACT --}}
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        Jelajahi Event
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    <a href="{{ route('events.calendar') }}" 
                    <a href="{{ route('events.calendar') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-slate-900 text-sm font-semibold rounded-lg border border-slate-200 hover:border-primary-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Lihat Kalender
                </div>
            </div>
        </div>

</div>
    {{-- Featured Events - Bento Box Layout --}}
    {{-- Featured Events - COMPACT CARDS --}}
    <section class="py-12 sm:py-16 bg-white">
            {{-- Section Header --}}
            <div class="text-center mb-12 scroll-fade-in">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">
                        Event Terbaru
                    </h2>
                    <p class="text-sm text-slate-600">
                        Jangan lewatkan kesempatan emas
                    </p>
                </div>
                <a href="{{ route('events.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">
                    Lihat Semua →
                </a>

            @if($featuredEvents->count() > 0)
                {{-- Bento Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($featuredEvents as $event)
                        <a href="{{ route('events.show', $event->slug) }}" class="group block card card-hover">
                            {{-- Image - SMALLER HEIGHT --}}
                            <div class="relative h-40 rounded-t-xl overflow-hidden bg-slate-100">
                                            <img src="{{ asset('storage/' . $event->image_path) }}" 
                                    <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                            <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-50">
                                        <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </div>
                                        @endif
                                        
                                        {{-- Status Badge --}}
                                <div class="absolute top-2 right-2">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-500 text-white text-xs font-semibold shadow-lg">
                                        <span class="px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded-md">Aktif</span>
                                                <span class="px-3 py-1.5 rounded-full bg-slate-500 text-white text-xs font-semibold shadow-lg">
                                        <span class="px-2 py-1 bg-slate-500 text-white text-xs font-semibold rounded-md">Selesai</span>
                                        </div>
                                    </div>

                                    {{-- Content --}}
                            {{-- Content - COMPACT PADDING --}}
                            <div class="p-4">
                                <div class="flex items-center gap-2 mb-2 text-xs">
                                                <span class="px-3 py-1 rounded-full bg-primary/10 text-primary font-medium">
                                        <span class="badge badge-primary">{{ $event->category->name }}</span>
                                            <span class="flex items-center gap-1.5 text-slate-500">
                                    <span class="text-slate-500">{{ $event->date->format('d M Y') }}</span>

                                        {{-- Title --}}
                                {{-- Title - SMALLER FONT --}}
                                <h3 class="text-base font-bold text-slate-900 mb-1.5 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                        </h3>

                                        {{-- Description --}}
                                {{-- Description - SMALLER --}}
                                <p class="text-sm text-slate-600 line-clamp-2 mb-3">
                                        </p>

                                        {{-- Location --}}
                                {{-- Location --}}
                                            <div class="flex items-center text-sm text-slate-500 pt-4 border-t border-slate-200">
                                    <div class="flex items-center text-xs text-slate-500 pt-3 border-t border-slate-100">
                                        <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <span class="truncate">{{ $event->location }}</span>
                                        <span class="truncate">{{ $event->location }}</span>
                                        @endif
                                    </div>
                                </div>
                        </a>
                </div>

                <div class="glass rounded-2xl p-12 text-center">
                <div class="card p-12 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Belum Ada Event</h3>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Belum Ada Event</h3>
                    <p class="text-sm text-slate-600">Nantikan event menarik segera!</p>
            @endif
        </div>
    </section>
</div>

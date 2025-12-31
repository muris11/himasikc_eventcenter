<div>
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-surface-secondary min-h-[60vh] flex items-center">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-30">
            <div class="absolute inset-0" style="background-image: radial-gradient(#E6AD2B 0.5px, transparent 0.5px); background-size: 24px 24px;"></div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-background/50 to-background"></div>
        
        {{-- Abstract Shapes --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-500/10 rounded-full blur-3xl pointer-events-none -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-slate-500/10 rounded-full blur-3xl pointer-events-none translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-surface/50 backdrop-blur-md rounded-full text-sm font-bold text-primary-600 mb-8 border border-primary-200/50 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-primary-500 mr-2 animate-pulse"></span>
                Tentang Kami
            </div>
            
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-8 font-heading tracking-tight leading-tight text-text-main">
                Membangun Ekosistem<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-400">Digital Mahasiswa</span>
            </h1>
            
            <p class="text-xl text-text-muted max-w-2xl mx-auto leading-relaxed mb-12 font-medium">
                Platform digital terintegrasi untuk mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu. Mewujudkan inovasi dan kolaborasi.
            </p>
            
            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 max-w-3xl mx-auto bg-surface/80 backdrop-blur-xl rounded-[2rem] p-8 border border-border shadow-lg">
                <div class="text-center group">
                    <div class="text-4xl sm:text-5xl font-bold text-primary-500 mb-2 font-heading group-hover:scale-110 transition-transform duration-300">{{ $totalEvents }}</div>
                    <div class="text-xs sm:text-sm font-bold text-text-muted uppercase tracking-widest">Event</div>
                </div>
                <div class="text-center border-x border-border group">
                    <div class="text-4xl sm:text-5xl font-bold text-primary-500 mb-2 font-heading group-hover:scale-110 transition-transform duration-300">{{ $totalPosts }}</div>
                    <div class="text-xs sm:text-sm font-bold text-text-muted uppercase tracking-widest">Artikel</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl sm:text-5xl font-bold text-primary-500 mb-2 font-heading group-hover:scale-110 transition-transform duration-300">24/7</div>
                    <div class="text-xs sm:text-sm font-bold text-text-muted uppercase tracking-widest">Akses</div>
                </div>
            </div>
        </div>
    </div>

    {{-- History & Goals Section --}}
    <div class="py-24 bg-background relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-surface p-10 rounded-[2.5rem] shadow-sm border border-border hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-2 transition-all duration-500 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full blur-2xl -mr-16 -mt-16 transition-all duration-500 group-hover:bg-primary-500/10"></div>
                    
                    <div class="text-center relative z-10">
                        <div class="w-24 h-24 bg-primary-50 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:bg-primary-100 transition-colors duration-300 shadow-inner">
                            <svg class="w-12 h-12 text-primary-600 transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-text-main mb-6 font-heading">Sejarah Singkat</h3>
                        <p class="text-text-muted leading-relaxed text-lg font-medium">
                            HIMA SIKC didirikan pada tahun 2023 sebagai wadah aspirasi dan pengembangan diri mahasiswa Program Studi Sistem Informasi Kota Cerdas. Berawal dari komunitas kecil, kini kami tumbuh menjadi organisasi yang aktif mendorong inovasi digital di lingkungan kampus.
                        </p>
                    </div>
                </div>
                
                <div class="bg-surface p-10 rounded-[2.5rem] shadow-sm border border-border hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-2 transition-all duration-500 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-slate-500/5 rounded-full blur-2xl -mr-16 -mt-16 transition-all duration-500 group-hover:bg-slate-500/10"></div>

                    <div class="text-center relative z-10">
                        <div class="w-24 h-24 bg-surface-secondary rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:bg-border transition-colors duration-300 shadow-inner">
                            <svg class="w-12 h-12 text-text-main transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-text-main mb-6 font-heading">Tujuan Kami</h3>
                        <p class="text-text-muted leading-relaxed text-lg font-medium">
                            Kami berkomitmen untuk menjadi jembatan informasi antara mahasiswa, kampus, dan dunia industri. Melalui berbagai program kerja, kami memfasilitasi mahasiswa untuk mengembangkan skill teknis maupun non-teknis agar siap bersaing di era digital.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Timeline Section --}}
    <div class="py-24 bg-surface-secondary relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl sm:text-5xl font-bold text-text-main mb-6 font-heading">Perjalanan Kami</h2>
                <p class="text-xl text-text-muted">Milestone penting dalam sejarah HIMA SIKC</p>
            </div>
            
            <div class="relative">
                {{-- Vertical line --}}
                <div class="absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-primary-300 to-transparent hidden md:block"></div>
                
                {{-- Timeline Items --}}
                <div class="space-y-16">
                    @forelse($milestones as $milestone)
                        <div class="relative flex flex-col {{ $loop->even ? 'md:flex-row-reverse' : 'md:flex-row' }} gap-10 items-center group">
                            <div class="flex-1 {{ $loop->even ? 'md:text-left' : 'md:text-right' }}">
                                <div class="bg-surface p-8 rounded-[2rem] border border-border shadow-sm group-hover:shadow-xl group-hover:shadow-primary-500/10 group-hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
                                    <div class="absolute top-0 {{ $loop->even ? 'left-0 -ml-12' : 'right-0 -mr-12' }} w-24 h-24 bg-primary-500/5 rounded-full blur-xl -mt-12"></div>
                                    <div class="text-5xl font-bold {{ $loop->first ? 'text-primary-500 opacity-80' : 'text-text-muted opacity-50' }} mb-4 font-heading">{{ $milestone->year }}</div>
                                    <h3 class="text-2xl font-bold text-text-main mb-3">{{ $milestone->title }}</h3>
                                    <p class="text-text-muted leading-relaxed">{{ $milestone->description }}</p>
                                </div>
                            </div>
                            
                            {{-- Center dot --}}
                            <div class="w-16 h-16 rounded-full {{ $loop->first ? 'bg-primary-500 border-[6px] border-surface shadow-lg' : 'bg-surface-secondary border-[6px] border-surface shadow-lg group-hover:bg-primary-500 group-hover:text-white' }} flex items-center justify-center flex-shrink-0 z-10 transition-all duration-300 {{ $loop->first ? 'group-hover:scale-110' : '' }}">
                                @if($loop->first)
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-8 h-8 text-text-muted {{ $loop->first ? '' : 'group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                @endif
                            </div>
                            
                            <div class="flex-1 md:block hidden"></div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-text-muted">Belum ada data sejarah.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-background py-24 border-t border-border relative overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <div class="absolute inset-0" style="background-image: radial-gradient(#E6AD2B 0.5px, transparent 0.5px); background-size: 24px 24px;"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-4xl sm:text-5xl font-bold text-text-main mb-8 font-heading">Bergabunglah Bersama Kami</h2>
            <p class="text-xl text-text-muted mb-12 max-w-2xl mx-auto leading-relaxed">
                Jadilah bagian dari perubahan positif. Ikuti event kami atau berkontribusi melalui tulisan.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg shadow-mustard hover:shadow-mustard-lg transform hover:-translate-y-1 transition-all duration-300 px-10 py-4 text-lg rounded-full">
                    Lihat Event
                </a>
                <a href="{{ route('blog.index') }}" class="px-10 py-4 text-lg font-bold text-text-main bg-surface border border-border rounded-full hover:bg-surface-secondary hover:border-primary-300 transition-all duration-300 shadow-sm hover:shadow-md">
                    Baca Artikel
                </a>
            </div>
        </div>
    </div>
</div>

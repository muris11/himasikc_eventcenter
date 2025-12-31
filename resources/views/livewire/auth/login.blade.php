<div>
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-background">
        {{-- Abstract Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-br from-primary-500/5 to-transparent rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gradient-to-tr from-slate-800/5 to-transparent rounded-full blur-3xl translate-y-1/3 -translate-x-1/4"></div>
            <svg class="absolute top-0 left-0 w-full h-full opacity-[0.03]" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="4" height="4" patternUnits="userSpaceOnUse">
                        <path d="M 4 0 L 0 0 0 4" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>

        <!-- Login Card -->
        <div class="relative z-10 w-full max-w-md px-4 animate-fade-in-up">
            <div class="bg-surface/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-border overflow-hidden relative">
                <!-- Header -->
                <div class="px-8 pt-12 pb-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-50 rounded-2xl mb-6 shadow-sm ring-1 ring-primary-100 transform hover:scale-105 transition-transform duration-300 group">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-12 h-12 object-contain group-hover:rotate-12 transition-transform duration-300">
                    </div>

                    <h1 class="text-3xl font-bold text-text-main mb-2 font-heading tracking-tight">
                        Selamat Datang
                    </h1>
                    <p class="text-text-muted text-sm font-medium">
                        Masuk untuk mengakses dashboard admin
                    </p>
                </div>

                <!-- Form -->
                <div class="px-8 pb-12">
                    <form method="POST" action="{{ route('login.post') }}" wire:submit.prevent="login" class="space-y-6">
                        @csrf
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-text-main mb-2 ml-1">
                                Email Address
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-text-muted group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" wire:model="email" required
                                    class="block w-full pl-12 pr-4 py-3.5 border border-border rounded-xl bg-surface-secondary/50 text-text-main placeholder-text-muted focus:bg-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all duration-200 sm:text-sm font-medium"
                                    placeholder="nama@polindra.ac.id">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-text-main mb-2 ml-1">
                                Password
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-text-muted group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" wire:model="password" required
                                    class="block w-full pl-12 pr-4 py-3.5 border border-border rounded-xl bg-surface-secondary/50 text-text-main placeholder-text-muted focus:bg-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all duration-200 sm:text-sm font-medium"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-500 flex items-center animate-fade-in-up font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit"
                                class="w-full flex justify-center items-center py-3.5 px-6 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 shadow-lg shadow-primary-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                                <span class="mr-2">Masuk</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <!-- Back to Home Link -->
                    <div class="mt-8 text-center">
                        <a href="/" class="inline-flex items-center text-sm font-bold text-text-muted hover:text-primary-600 transition-colors duration-200 group">
                            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Footer Text -->
            <div class="text-center mt-8 text-xs text-text-muted/60">
                &copy; {{ date('Y') }} HIMA-SIKC. All rights reserved.
            </div>
        </div>
    </div>
</div>

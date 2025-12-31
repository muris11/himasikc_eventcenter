<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>403 - Akses Ditolak</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|outfit:400,500,700,900"
        rel="stylesheet" />

    <!-- Styles & Scripts -->
    @if (file_exists(public_path('build/manifest.json')))
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        @endphp
        @if (isset($manifest['resources/css/app.css']))
            <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
        @endif
        @if (isset($manifest['resources/js/app.js']))
            <script src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>
        @endif
    @else
        <!-- Fallback for development or when manifest is not available -->
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
        <script src="{{ asset('resources/js/app.js') }}"></script>
    @endif
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
</head>

<body
    class="font-sans antialiased bg-linear-to-br from-primary/5 via-white to-primary/5 text-gray-900 selection:bg-primary selection:text-white">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Grid Pattern -->
            <svg class="absolute left-1/2 top-0 -translate-x-1/2 opacity-20" width="600" height="600"
                fill="none" viewBox="0 0 600 600">
                <defs>
                    <pattern id="error-grid-pattern" x="0" y="0" width="30" height="30"
                        patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1.5" fill="currentColor" class="text-primary" />
                    </pattern>
                </defs>
                <rect width="600" height="600" fill="url(#error-grid-pattern)" />
            </svg>

            <!-- Floating Circles -->
            <div class="absolute top-20 left-10 w-48 h-48 bg-primary/8 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-64 h-64 bg-primary/4 rounded-full blur-3xl"></div>

            <!-- Gradient Orbs -->
            <div
                class="absolute top-1/4 right-1/4 w-32 h-32 bg-linear-to-br from-primary/15 to-transparent rounded-full blur-2xl">
            </div>
            <div
                class="absolute bottom-1/4 left-1/3 w-40 h-40 bg-linear-to-tl from-primary/10 to-transparent rounded-full blur-2xl">
            </div>
        </div>

        <div class="max-w-md w-full relative z-10">
            <!-- Error Card -->
            <div
                class="bg-white rounded-3xl shadow-2xl border border-primary/20 overflow-hidden transition-all duration-300">
                <!-- Error Code Section -->
                <div class="bg-linear-to-r from-primary to-primary-hover text-white text-center py-8 relative">
                    <div class="absolute inset-0 bg-primary/20 animate-pulse"></div>
                    <h1 class="text-6xl font-black relative z-10 font-outfit">403</h1>
                    <div class="mt-2 text-primary-100 text-sm font-medium">Akses Ditolak</div>
                </div>

                <!-- Content -->
                <div class="p-8 text-center">
                    <!-- Icon -->
                    <div class="mb-6">
                        <div
                            class="flex items-center justify-center w-20 h-20 bg-linear-to-br from-primary to-primary-hover rounded-2xl mx-auto shadow-lg shadow-primary/30">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-3xl font-black text-gray-900 mb-4 font-outfit">
                        <span
                            class="bg-linear-to-r from-gray-900 via-primary to-gray-900 bg-clip-text text-transparent">
                            Oops! Akses Ditolak
                        </span>
                    </h2>
                    <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Pastikan Anda memiliki hak akses
                        yang sesuai atau hubungi administrator.
                    </p>

                    <!-- Info Box -->
                    <div class="bg-primary/5 border border-primary/20 rounded-xl p-4 mb-8">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="ml-3 text-left">
                                <h3 class="text-sm font-semibold text-primary mb-1">Tips</h3>
                                <p class="text-sm text-gray-600">
                                    Jika Anda merasa ini adalah kesalahan, coba login dengan akun yang berbeda atau
                                    hubungi tim support.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center px-8 py-3 bg-linear-to-r from-primary to-primary-hover hover:from-primary-hover hover:to-primary text-white font-semibold rounded-full transition-all duration-300 shadow-lg shadow-primary/30 hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>

</html>

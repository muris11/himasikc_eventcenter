<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>404 - Halaman Tidak Ditemukan</title>

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
        <div class="relative max-w-md w-full z-10">
            <!-- Error Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-primary/20 overflow-hidden">
                <!-- Error Code Section -->
                <div class="bg-linear-to-r from-primary to-primary-hover text-white text-center py-8 relative">
                    <h1 class="text-6xl font-black relative z-10 font-outfit">404</h1>
                    <div class="mt-2 text-primary-100 text-sm font-medium">Halaman Tidak Ditemukan</div>
                </div>

                <!-- Content -->
                <div class="p-8 text-center">
                    <h2 class="text-3xl font-black text-gray-900 mb-4 font-outfit">
                        <span
                            class="bg-linear-to-r from-gray-900 via-primary to-gray-900 bg-clip-text text-transparent">
                            Oops! Halaman Tidak Ditemukan
                        </span>
                    </h2>
                    <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                        Maaf, halaman yang Anda cari tidak ditemukan. Mungkin sudah dipindahkan atau namanya berubah.
                    </p>

                    <!-- Actions -->
                    <div class="flex justify-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center px-8 py-3 bg-linear-to-r from-primary to-primary-hover text-white font-semibold rounded-full shadow-lg">
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

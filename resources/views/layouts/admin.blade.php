<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <style>
        /* Hard-disable any auto darkening heuristics on mobile browsers */
        html { color-scheme: light; background: #fff; }
        body { background: #fff; color: #09090B; }
    </style>

    @php
        $metaTitle = trim($__env->yieldContent('title'));
        if ($metaTitle === '') {
            $metaTitle = $title ?? ('Admin - ' . config('app.name', 'Laravel'));
        }
    @endphp

    <title>{{ $metaTitle }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @livewireStyles
</head>

<body class="font-sans antialiased bg-background text-text-main selection:bg-primary-100 selection:text-primary-900" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
    <!-- Toast Notifications -->
    <x-toast />

    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside 
            :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-72'"
            class="fixed top-0 left-0 z-50 h-screen transition-all duration-300 bg-surface/95 backdrop-blur-xl border-r border-border shadow-2xl lg:shadow-sm transform -translate-x-full lg:translate-x-0"
            x-show="sidebarOpen || window.innerWidth >= 1024"
            @click.away="if (window.innerWidth < 1024) sidebarOpen = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
        >
            {{-- Logo Section --}}
            <div class="flex items-center justify-between h-20 px-6 border-b border-border/60">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 bg-primary-500/20 rounded-xl blur group-hover:bg-primary-500/30 transition-all"></div>
                        <img src="{{ asset('logo.png') }}" alt="HIMA SIKC" class="h-10 w-10 rounded-xl relative z-10 shadow-sm">
                    </div>
                    <div x-show="!sidebarCollapsed" x-collapse class="flex flex-col">
                        <span class="font-bold text-text-main leading-tight font-heading text-lg tracking-tight">HIMA-SIKC</span>
                        <span class="text-[10px] uppercase tracking-wider text-text-muted font-bold">Admin Panel</span>
                    </div>
                </a>

                {{-- Collapse Toggle (Desktop Only) --}}
                <button 
                    @click="sidebarCollapsed = !sidebarCollapsed"
                    class="hidden lg:flex p-2 rounded-lg hover:bg-surface-secondary text-text-muted hover:text-text-main transition-colors"
                >
                    <svg class="w-5 h-5 transition-transform duration-300" :class="sidebarCollapsed && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>

                {{-- Close Button (Mobile Only) --}}
                <button 
                    @click="sidebarOpen = false"
                    class="lg:hidden p-2 rounded-lg hover:bg-red-50 text-text-muted hover:text-red-500 transition-colors"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="px-4 py-6 overflow-y-auto h-[calc(100vh-5rem)] space-y-1.5 custom-scroll">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                   :title="sidebarCollapsed ? 'Dashboard' : ''"
                >
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Dashboard</span>
                </a>

                {{-- Section: Event --}}
                <div class="pt-6 pb-3">
                    <h3 x-show="!sidebarCollapsed" x-collapse class="px-4 text-[10px] font-bold text-text-muted uppercase tracking-widest opacity-70">Event Management</h3>
                    <div x-show="sidebarCollapsed" class="h-px bg-border my-2 mx-2"></div>
                </div>

                <a href="{{ route('admin.events.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.events.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                   :title="sidebarCollapsed ? 'Manage Event' : ''"
                >
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.events.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Events</span>
                </a>

                <a href="{{ route('admin.hero.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.hero.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                   :title="sidebarCollapsed ? 'Manage Hero' : ''"
                >
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.hero.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Kelola Hero</span>
                </a>

                <a href="{{ route('admin.testimonials.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.testimonials.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                   :title="sidebarCollapsed ? 'Kelola Testimoni' : ''"
                >
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Testimoni</span>
                </a>

                <a href="{{ route('admin.event-categories.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.event-categories.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                   :title="sidebarCollapsed ? 'Kategori Event' : ''"
                >
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.event-categories.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Categories</span>
                </a>

                {{-- Section: Blog --}}
                <div class="pt-6 pb-3">
                    <h3 x-show="!sidebarCollapsed" x-collapse class="px-4 text-[10px] font-bold text-text-muted uppercase tracking-widest opacity-70">Blog Management</h3>
                    <div x-show="sidebarCollapsed" class="h-px bg-border my-2 mx-2"></div>
                </div>

                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.posts.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                   :title="sidebarCollapsed ? 'Manage Posts' : ''"
                >
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.posts.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Posts</span>
                </a>

                <a href="{{ route('admin.blog-categories.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.blog-categories.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                   :title="sidebarCollapsed ? 'Kategori Blog' : ''"
                >
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.blog-categories.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Categories</span>
                </a>

                {{-- Section: Users (Super Admin Only) --}}
                @if (auth()->check() && auth()->user()->role === 'super_admin')
                    <div class="pt-6 pb-3">
                        <h3 x-show="!sidebarCollapsed" x-collapse class="px-4 text-[10px] font-bold text-text-muted uppercase tracking-widest opacity-70">System</h3>
                        <div x-show="sidebarCollapsed" class="h-px bg-border my-2 mx-2"></div>
                    </div>

                    <a href="{{ route('admin.milestones.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.milestones.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                       :title="sidebarCollapsed ? 'Manage Milestones' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.milestones.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Milestones</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-primary-500/10 to-transparent text-primary-700 font-bold border-l-4 border-primary-500' : 'text-text-muted hover:bg-surface-secondary hover:text-text-main font-medium border-l-4 border-transparent' }}"
                       :title="sidebarCollapsed ? 'Manage Users' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.users.*') ? 'text-primary-600' : 'text-text-muted group-hover:text-text-main' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-collapse class="text-sm">Users</span>
                    </a>
                @endif
            </nav>
        </aside>

        {{-- Mobile Overlay --}}
        <div 
            x-show="sidebarOpen && window.innerWidth < 1024" 
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 bg-background/80 backdrop-blur-sm lg:hidden"
            style="display: none;"
        ></div>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col transition-all duration-300"
             :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-72'"
        >
            {{-- Top Navbar --}}
            <header class="sticky top-0 z-30 bg-surface/80 backdrop-blur-xl border-b border-border shadow-sm">
                <div class="flex items-center justify-between h-20 px-4 sm:px-6 lg:px-8">
                    {{-- Mobile Menu Button --}}
                    <button 
                        @click="sidebarOpen = true"
                        class="lg:hidden p-2 rounded-lg text-text-muted hover:bg-surface-secondary hover:text-text-main"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    {{-- Breadcrumbs (Desktop) --}}
                    <div class="hidden lg:block">
                        <nav class="flex text-sm" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1">
                                <li class="inline-flex items-center">
                                    <a href="{{ route('admin.dashboard') }}" class="text-text-muted hover:text-primary-600 transition-colors flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                        </svg>
                                    </a>
                                </li>
                                @yield('breadcrumbs')
                            </ol>
                        </nav>
                    </div>

                    {{-- Right Section --}}
                    <div class="flex items-center gap-4">
                        {{-- View Site Link --}}
                        <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-2 px-4 py-2 text-sm font-bold text-text-muted hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all border border-transparent hover:border-primary-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span>View Site</span>
                        </a>

                        {{-- User Menu --}}
                        <x-dropdown align="right">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-surface-secondary transition-colors border border-transparent hover:border-border group">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white group-hover:ring-primary-100 transition-all">
                                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="hidden sm:flex flex-col items-start text-left">
                                        <span class="text-sm font-bold text-text-main leading-tight">{{ auth()->user()->name ?? 'Admin' }}</span>
                                        <span class="text-xs text-text-muted font-medium">Administrator</span>
                                    </div>
                                    <svg class="w-4 h-4 text-text-muted group-hover:text-text-main transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="py-1">
                                    <div class="px-4 py-3 border-b border-border bg-surface-secondary/50">
                                        <p class="text-sm font-bold text-text-main">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-text-muted font-medium truncate">{{ auth()->user()->email }}</p>
                                    </div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-medium text-status-error hover:bg-red-50 flex items-center gap-2 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                {{-- Flash Messages --}}
                @if (session()->has('success'))
                    <x-alert variant="success" dismissible class="mb-6 shadow-sm border border-green-200">
                        {{ session('success') }}
                    </x-alert>
                @endif

                @if (session()->has('error'))
                    <x-alert variant="error" dismissible class="mb-6 shadow-sm border border-red-200">
                        {{ session('error') }}
                    </x-alert>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>

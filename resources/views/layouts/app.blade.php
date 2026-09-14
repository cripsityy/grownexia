<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'GrowPath' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts & Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Keeps the prototype usable before Vite assets are built. --}}
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-900 min-h-screen">
    <div x-data="{ open: false }" class="min-h-screen">
        <header class="topbar">
            <a href="{{ route('dashboard') }}" class="brand">
                <img src="{{ asset('images/grownexia-logo.png') }}?v={{ filemtime(public_path('images/grownexia-logo.png')) }}" alt="Grownexia">
            </a>
            <button class="mobile-menu" @click="open=!open">☰</button>
            <div class="user-menu">
                <span class="user-avatar">●</span>{{ auth()->user()->name }}
                <small>{{ strtoupper(auth()->user()->role) }}</small>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf<button>Keluar</button>
                </form>
            </div>
        </header>
        <aside class="sidebar sidebar-brand-bg" :class="{ 'is-open': open }">
            <x-nav-menu />
        </aside>
        <div x-show="open" x-cloak class="overlay" @click="open=false">
        </div>
        <main class="content">
            @if (session('success'))
                <div class="notice">✓ {{ session('success') }}</div>
                @endif @if ($errors->any())
                    <div class="notice error">{{ $errors->first() }}
                    </div>
                @endif @yield('content')
        </main>
    </div>
    {{-- Component views may push page styles after this layout starts rendering. --}}
    @stack('styles')
</body>

</html>

<!-- TOPBAR HEADER -->
<header class="fixed top-0 left-0 right-0 z-[1000] h-14 border-b bg-white">
    <div class="h-14 px-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <!-- Hamburger Button (Mobile only) -->
            <button class="lg:hidden p-2 rounded bg-gray-100 hover:bg-gray-200" @click="open = !open"
                aria-label="Open menu">
                ☰
            </button>
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex h-14 w-[132px] items-center overflow-hidden">
                <x-application-logo />
            </a>
        </div>
        <!-- User Dropdown (Kanan Navbar) -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 bg-white hover:text-gray-800">
                    <div>{{ Auth::user()?->name ?? 'User' }}</div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Manage Account
                </div>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <div class="border-t border-gray-100">
                </div>
                @if (Route::has('logout'))
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                @endif
            </x-slot>
        </x-dropdown>
    </div>
</header>

<!-- SIDEBAR DESKTOP -->
<aside class="hidden lg:flex fixed left-0 top-14 bottom-0 w-64 bg-red-700 text-white z-[900] sidebar-brand-bg">
    <div class="w-full overflow-y-auto">
        <x-nav-menu />
    </div>
</aside>
<!-- SIDEBAR MOBILE (Modal / Overlay Menu) -->
<div class="lg:hidden">
    <!-- Backdrop Overlay -->
    <div x-show="open" x-cloak class="fixed inset-0 bg-black/30 z-[950]" @click="open=false">
    </div>
    <!-- Mobile Drawer Content -->
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="fixed top-14 left-0 right-0 z-[1000]">
        <div class="bg-red-700 text-white shadow sidebar-brand-bg">
            <div class="px-4 py-3 flex items-center justify-between border-b border-white/10">
                <span class="text-sm font-semibold">Menu</span>
                <button class="p-2 rounded hover:bg-red-800" @click="open=false">✕</button>
            </div>
            <div class="px-2 py-3">
                <x-nav-menu />
            </div>
        </div>
    </div>
</div>

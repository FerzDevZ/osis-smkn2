<!-- Mobile Bottom Navigation Bar -->
<nav class="md:hidden fixed bottom-4 left-4 right-4 z-40">
    <div class="glass rounded-full px-4 py-3 shadow-2xl flex items-center justify-around border border-white/20">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 text-ink/70 dark:text-white/70 hover:text-primary transition {{ request()->routeIs('home') ? 'text-primary font-bold' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="text-[9px] font-medium">Beranda</span>
        </a>

        <a href="{{ route('events.calendar') }}" class="flex flex-col items-center gap-1 text-ink/70 dark:text-white/70 hover:text-primary transition {{ request()->routeIs('events.calendar') ? 'text-primary font-bold' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="text-[9px] font-medium">Event</span>
        </a>

        <a href="{{ route('menfess.index') }}" class="flex flex-col items-center gap-1 text-ink/70 dark:text-white/70 hover:text-primary transition {{ request()->routeIs('menfess.index') ? 'text-primary font-bold' : '' }}">
            <div class="relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-accent rounded-full animate-ping"></span>
            </div>
            <span class="text-[9px] font-medium">Menfess</span>
        </a>

        <a href="{{ route('tickets.index') }}" class="flex flex-col items-center gap-1 text-ink/70 dark:text-white/70 hover:text-primary transition {{ request()->routeIs('tickets.index') ? 'text-primary font-bold' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 012 2v3a2 2 0 000 4v3a2 2 0 01-2 2H5a2 2 0 01-2-2v-3a2 2 0 000-4V7a2 2 0 012-2z"></path></svg>
            <span class="text-[9px] font-medium">Tiket</span>
        </a>

        <button @click="$dispatch('open-command-palette')" class="flex flex-col items-center gap-1 text-ink/70 dark:text-white/70 hover:text-primary transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <span class="text-[9px] font-medium">Cari</span>
        </button>
    </div>
</nav>

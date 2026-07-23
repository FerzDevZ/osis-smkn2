<div 
    x-data="commandPalette()"
    x-show="open"
    @keydown.window.cmd.k.prevent="openPalette()"
    @keydown.window.ctrl.k.prevent="openPalette()"
    @keydown.escape.window="closePalette()"
    x-cloak
    class="fixed inset-0 z-[100] overflow-y-auto p-4 sm:p-6 md:p-20"
>
    <!-- Backdrop -->
    <div x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="closePalette()" class="fixed inset-0 bg-neutral-950/80 backdrop-blur-md"></div>

    <!-- Modal Container -->
    <div x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative max-w-2xl mx-auto glass rounded-3xl shadow-2xl border border-white/20 overflow-hidden text-neutral-900 dark:text-neutral-100">
        
        <!-- Search Input Header -->
        <div class="flex items-center px-6 py-4 border-b border-white/10">
            <svg class="w-5 h-5 text-primary mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input 
                x-ref="searchInput"
                type="text" 
                x-model="search" 
                placeholder="Ketik untuk mencari berita, event, sekbid, atau fitur..."
                class="w-full bg-transparent border-none text-base outline-none focus:ring-0 placeholder:text-neutral-400 dark:placeholder:text-neutral-500 font-medium"
            >
            <span class="text-[10px] font-mono font-bold bg-neutral-200 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 px-2 py-1 rounded-md">ESC</span>
        </div>

        <!-- Links & Results -->
        <div class="max-h-96 overflow-y-auto p-4 space-y-2 no-scrollbar">
            
            <div class="text-[10px] font-black uppercase tracking-widest text-neutral-400 px-3 py-1">Navigasi Pintas</div>

            <template x-for="item in filteredItems" :key="item.url">
                <a :href="item.url" class="flex items-center justify-between p-3 rounded-2xl hover:bg-primary/10 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-bold text-sm group-hover:scale-110 transition-transform" x-html="item.icon"></div>
                        <div>
                            <div class="font-bold text-sm" x-text="item.title"></div>
                            <div class="text-xs text-neutral-400" x-text="item.desc"></div>
                        </div>
                    </div>
                    <span class="text-xs font-mono text-neutral-400 group-hover:text-primary">↵</span>
                </a>
            </template>

            <div x-show="filteredItems.length === 0" class="py-12 text-center text-neutral-400 text-sm">
                Tidak ada hasil pencarian untuk "<span x-text="search"></span>"
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-3 border-t border-white/10 text-[10px] text-neutral-400 flex justify-between items-center bg-neutral-900/10">
            <span>Tip: Gunakan <kbd class="font-mono bg-neutral-200 dark:bg-neutral-800 px-1 rounded">↑</kbd> <kbd class="font-mono bg-neutral-200 dark:bg-neutral-800 px-1 rounded">↓</kbd> untuk memilih</span>
            <span>OSIS SMKN 2 Pangkalpinang</span>
        </div>
    </div>
</div>

<script>
function commandPalette() {
    return {
        open: false,
        search: '',
        items: [
            { title: 'Beranda / Landing Page', desc: 'Halaman utama portal OSIS', url: '{{ route("home") }}', icon: '🏠' },
            { title: 'E-Voting Pemilos', desc: 'Pemilihan Ketua OSIS Digital', url: '{{ route("pemilos.index") }}', icon: '🗳️' },
            { title: 'Lost & Found', desc: 'Laporan barang hilang & ditemukan', url: '{{ route("lost-found.index") }}', icon: '🔍' },
            { title: 'Suara Siswa & Kotak Surat', desc: 'Kirim saran, kritik, dan aspirasi', url: '{{ route("kotak.create") }}', icon: '📬' },
            { title: 'Menfess OSIS', desc: 'Pesan anonim antar siswa', url: '{{ route("menfess.index") }}', icon: '💌' },
            { title: 'Daftar Sekbid (1-10)', desc: 'Seksi bidang & program kerja OSIS', url: '{{ route("sekbid.index") }}', icon: '🏛️' },
            { title: 'Kalender Kegiatan', desc: 'Jadwal event & agenda bulanan', url: '{{ route("events.calendar") }}', icon: '📅' },
            { title: 'Pusat Unduhan File', desc: 'Formulir, AD/ART, & arsip berkas', url: '{{ route("downloads.index") }}', icon: '📂' },
            { title: 'Catatan OSIS & Blog', desc: 'Artikel, berita, dan inspirasi siswa', url: '{{ route("posts.blog") }}', icon: '✍️' },
            { title: 'Struktur Pengurus OSIS', desc: 'Daftar BPH dan anggota kabinet', url: '{{ route("members.index") }}', icon: '👥' },
            { title: 'Tentang OSIS SMKN 2', desc: 'Profil, visi, dan misi organisasi', url: '{{ route("about") }}', icon: 'ℹ️' },
        ],
        get filteredItems() {
            if (!this.search.trim()) return this.items;
            const q = this.search.toLowerCase();
            return this.items.filter(i => i.title.toLowerCase().includes(q) || i.desc.toLowerCase().includes(q));
        },
        openPalette() {
            this.open = true;
            this.$nextTick(() => { this.$refs.searchInput.focus(); });
        },
        closePalette() {
            this.open = false;
            this.search = '';
        }
    }
}
</script>

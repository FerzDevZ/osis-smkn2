<!DOCTYPE html>
<html lang="id" x-data="theme()" :class="{ 'dark': dark }" class="scroll-smooth">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', $site_settings['site_name'] ?? 'OSIS SMKN 2 Pangkalpinang')</title>
	<link rel="canonical" href="@yield('canonical', url()->current())">
	<meta name="description" content="@yield('meta_description', $site_settings['seo_meta_description'] ?? 'OSIS SMKN 2 Pangkalpinang: informasi event, sekbid, dokumentasi, dan kotak aspirasi siswa.')">
	<meta property="og:title" content="@yield('og_title', trim(View::yieldContent('title', 'OSIS SMKN 2 Pangkalpinang')))">
	<meta property="og:description" content="@yield('og_description', $site_settings['seo_meta_description'] ?? 'OSIS SMKN 2 Pangkalpinang: informasi event, sekbid, dokumentasi, dan kotak aspirasi siswa.')">
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:image" content="@yield('og_image', asset('favicon.ico'))">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@yield('og_title', trim(View::yieldContent('title', 'OSIS SMKN 2 Pangkalpinang')))">
	<meta name="twitter:description" content="@yield('og_description', trim(View::yieldContent('meta_description', 'OSIS SMKN 2 Pangkalpinang')))">
	<meta name="twitter:image" content="@yield('og_image', asset('favicon.ico'))">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	@vite(['resources/css/app.css', 'resources/js/app.js'])
    
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

	<style>
		.no-scrollbar::-webkit-scrollbar{display:none}
		.no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
		.scroll-snap-x{scroll-snap-type:x mandatory}
		.snap-center{scroll-snap-align:center}
        
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark .glass {
            background: rgba(26, 34, 51, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
	</style>
</head>
<body class="font-sans antialiased bg-slate-50 text-ink dark:bg-neutral-950 dark:text-neutral-100 overflow-x-hidden">
    <!-- Background Elements -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-accent2/10 blur-[120px] animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-primary/5 blur-[120px] animate-blob animation-delay-2000"></div>
    </div>

	<header class="sticky top-4 z-50 px-4">
        <nav class="max-w-7xl mx-auto glass rounded-full px-6 py-3 flex items-center justify-between shadow-glass transition-all duration-300">
			<a href="{{ route('home') }}" class="font-display font-bold text-lg md:text-xl tracking-tight text-primary dark:text-white uppercase transition-opacity hover:opacity-80">
                {{ $site_settings['school_name'] ?? 'SMKN 2' }} <span class="text-accent2">OSIS</span>
            </a>
			
            <div class="hidden md:flex gap-8 text-sm font-medium items-center text-ink/70 dark:text-white/70">
				<a href="{{ route('about') }}" class="hover:text-primary dark:hover:text-accent2 transition">Tentang</a>
				<a href="{{ route('home') }}#event" class="hover:text-primary dark:hover:text-accent2 transition">Event</a>
				<a href="{{ route('home') }}#sekbid" class="hover:text-primary dark:hover:text-accent2 transition">Sekbid</a>
				<a href="{{ route('suara-siswa.index') }}" class="hover:text-primary dark:hover:text-accent2 transition">Suara Siswa</a>
				<a href="{{ route('home') }}#dokumentasi" class="hover:text-primary dark:hover:text-accent2 transition">Gallery</a>
				<a href="{{ route('organization.index') }}" class="hover:text-primary dark:hover:text-accent2 transition">Organisasi</a>
				<a href="{{ route('ukk.index') }}" class="hover:text-primary dark:hover:text-accent2 transition">UKK</a>
                <div class="relative" x-data="{ open: false }">
                    <button @mouseover="open = true" @click="open = !open" class="hover:text-primary dark:hover:text-accent2 transition flex items-center gap-1">Lainnya <span class="text-[8px]">▼</span></button>
                    <div x-show="open" @mouseleave="open = false" @click.outside="open = false" x-transition class="absolute left-0 mt-2 w-48 glass rounded-2xl shadow-xl border border-white/20 py-2 z-50">
                        <a href="{{ route('members.index') }}" class="block px-4 py-2 hover:bg-primary/10 dark:hover:bg-white/5 transition text-xs font-bold">Struktur Organisasi</a>
                        <a href="{{ route('events.calendar') }}" class="block px-4 py-2 hover:bg-primary/10 dark:hover:bg-white/5 transition text-xs font-bold">Kalender Kegiatan</a>
                        <a href="{{ route('downloads.index') }}" class="block px-4 py-2 hover:bg-primary/10 dark:hover:bg-white/5 transition text-xs font-bold">Pusat Unduhan</a>
                        <a href="{{ route('posts.blog') }}" class="block px-4 py-2 hover:bg-primary/10 dark:hover:bg-white/5 transition text-xs font-bold">Catatan OSIS (Blog)</a>
                    </div>
                </div>
			</div>

            <div class="flex items-center gap-3">
                <a href="{{ route('kotak.create') }}" class="hidden sm:block text-white bg-primary hover:bg-primary2 rounded-full px-5 py-2 text-sm font-semibold transition shadow-sm hover:shadow-md">Aspirasi</a>
                
                <button @click="toggle()" class="p-2 rounded-full bg-white/50 dark:bg-neutral-800/50 hover:bg-white dark:hover:bg-neutral-800 transition shadow-sm"> 
                    <span x-show="!dark" class="text-lg">🌙</span>
                    <span x-show="dark" class="text-lg">☀️</span>
                </button>

                @auth
					<div class="relative" x-data="{ open: false }">
						<button @click="open = !open" class="border rounded-full px-4 py-2 text-sm bg-white/70 hover:bg-white transition flex items-center gap-2">
                            Admin <span class="text-[10px] transition-transform" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
						<div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute right-0 mt-3 w-56 glass border rounded-2xl shadow-xl overflow-hidden py-1 z-50">
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition" href="{{ route('admin.berita.index') }}">Kelola Berita & Blog</a>
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition" href="{{ route('admin.event.index') }}">Kelola Event</a>
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition" href="{{ route('admin.members.index') }}">Kelola Struktur</a>
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition" href="{{ route('admin.downloads.index') }}">Kelola File</a>
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition" href="{{ route('admin.sekbid.index') }}">Kelola Sekbid</a>
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition" href="{{ route('admin.gallery.index') }}">Kelola Dokumentasi</a>
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition" href="{{ route('admin.settings.index') }}">Pengaturan Situs</a>
							<a class="block px-4 py-2 text-sm hover:bg-accent1/80 transition border-t" href="{{ route('kotak.index') }}">Kotak Surat</a>
						</div>
					</div>
				@endauth
            </div>
		</nav>
	</header>

	<main class="min-h-screen">
		@if(session('status'))
			<div id="flashToast" class="fixed top-24 right-4 z-50 glass border-l-4 border-primary shadow-2xl rounded-xl p-4 text-sm text-gray-800 min-w-[300px] animate-fade-in">
				<div class="flex items-start justify-between gap-4">
					<div class="font-medium text-primary">{{ session('status') }}</div>
					<button id="flashClose" class="text-gray-400 hover:text-primary transition">✕</button>
				</div>
				<div class="mt-3 h-1 bg-gray-100 dark:bg-neutral-800 rounded-full overflow-hidden">
					<div id="flashBar" class="h-1 bg-primary rounded-full transition-all duration-100" style="width:100%"></div>
				</div>
			</div>
		@endif
		@if($errors->any())
			<div class="fixed top-24 right-4 z-50 bg-red-500 text-white shadow-2xl rounded-xl px-6 py-3 text-sm font-semibold animate-fade-in">
				<div class="flex items-center gap-2">
                    <span>⚠️</span>
				    Terjadi kesalahan. Periksa kembali inputan Anda.
                </div>
			</div>
		@endif
		@yield('content')
	</main>

	<footer class="mt-20 border-t border-black/[0.05] dark:border-white/[0.05] py-12 text-sm text-ink/70 dark:text-neutral-400 bg-white/50 dark:bg-neutral-900/50 backdrop-blur-md">
		<div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12">
			<div class="md:col-span-2">
                <div class="font-display font-bold text-2xl text-primary dark:text-white uppercase mb-4">{{ $site_settings['school_name'] ?? 'SMKN 2' }} <span class="text-accent2">OSIS</span></div>
				<p class="max-w-sm mb-6 leading-relaxed">{{ $site_settings['footer_text'] ?? 'Wadah aspirasi dan kreasi siswa SMKN 2 Pangkalpinang. Bersama membangun sekolah yang lebih inklusif, kreatif, dan berprestasi.' }}</p>
				<div class="flex gap-4">
					<a class="w-10 h-10 rounded-full glass flex items-center justify-center hover:scale-110 transition-transform" href="{{ $site_settings['instagram_url'] ?? '#' }}" target="_blank">IG</a>
					<a class="w-10 h-10 rounded-full glass flex items-center justify-center hover:scale-110 transition-transform" href="{{ $site_settings['tiktok_url'] ?? '#' }}" target="_blank">TT</a>
				</div>
			</div>
			<div>
				<div class="font-bold text-primary dark:text-white mb-6 uppercase tracking-wider text-xs">Menu Cepat</div>
				<ul class="space-y-3 font-medium">
					<li><a class="hover:text-accent2 transition" href="{{ route('about') }}">Tentang Kami</a></li>
					<li><a class="hover:text-accent2 transition" href="{{ route('home') }}#event">Event Terbaru</a></li>
					<li><a class="hover:text-accent2 transition" href="{{ route('organization.index') }}">Organisasi</a></li>
					<li><a class="hover:text-accent2 transition" href="{{ route('suara-siswa.index') }}">Suara Siswa</a></li>
					<li><a class="hover:text-accent2 transition" href="{{ route('kotak.create') }}">Kotak Aspirasi</a></li>
				</ul>
			</div>
			<div>
				<div class="font-bold text-primary dark:text-white mb-6 uppercase tracking-wider text-xs">Hubungi Kami</div>
				<ul class="space-y-3 leading-relaxed">
					<li class="flex gap-3">
                        <span class="text-accent2">📍</span>
                        {{ $site_settings['contact_address'] ?? 'OSIS SMKN 2 Pangkalpinang' }}
                    </li>
					<li class="flex gap-3">
                        <span class="text-accent2">📧</span>
                        {{ $site_settings['contact_email'] ?? 'osis@smkn2pp.sch.id' }}
                    </li>
				</ul>
			</div>
		</div>
        <div class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-black/[0.05] dark:border-white/[0.05] flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-ink/50 dark:text-white/40">
            <div>© {{ date('Y') }} {{ $site_settings['site_name'] ?? 'OSIS SMKN 2 Pangkalpinang' }}. Powered by SMKN2 IT Team.</div>
            <div class="flex gap-6 uppercase tracking-widest">
                <a href="#" class="hover:text-primary transition">Privacy Policy</a>
                <a href="#" class="hover:text-primary transition">Terms of Service</a>
            </div>
        </div>
	</footer>

	<script>
	function theme(){
		return {
			dark: localStorage.getItem('dark') === '1',
			toggle(){ this.dark = !this.dark; localStorage.setItem('dark', this.dark ? '1' : '0'); }
		}
	}

	// Active nav on scroll
	document.addEventListener('alpine:init', () => {
		const links = Array.from(document.querySelectorAll('header nav a[href^="'+location.origin+location.pathname+'#"]'));
		const map = new Map(links.map(a => [a.getAttribute('href').split('#')[1], a]));
		const io = new IntersectionObserver(entries => {
			entries.forEach(e => {
				const link = map.get(e.target.id);
				if (!link) return;
				if (e.isIntersecting) { link.classList.add('text-primary','dark:text-accent2','font-bold'); }
				else { link.classList.remove('text-primary','dark:text-accent2','font-bold'); }
			});
		},{ threshold: 0.5 });
		['tentang','event','sekbid','dokumentasi'].forEach(id => { const el = document.getElementById(id); if (el) io.observe(el); });
	});

	// Auto-dismiss flash toast
	window.addEventListener('load', () => {
		const toast = document.getElementById('flashToast');
		if (toast) {
			const bar = document.getElementById('flashBar');
			const close = document.getElementById('flashClose');
			let w = 100; const int = setInterval(()=>{ w-= 100/30; if (w<=0){clearInterval(int); toast.remove();} if(bar) bar.style.width = Math.max(0,w)+'%'; }, 100);
			if (close) close.addEventListener('click', ()=>{ clearInterval(int); toast.remove(); });
		}
	});
	</script>
</body>
</html>

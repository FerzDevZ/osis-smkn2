<!DOCTYPE html>
<html lang="id" x-data="theme()" :class="{ 'dark': dark }" class="scroll-smooth">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'OSIS SMKN 2 Pangkalpinang')</title>
	<link rel="canonical" href="@yield('canonical', url()->current())">
	<meta name="description" content="@yield('meta_description','OSIS SMKN 2 Pangkalpinang: informasi event, sekbid, dokumentasi, dan kotak aspirasi siswa.')">
	<meta property="og:title" content="@yield('og_title', trim(View::yieldContent('title', 'OSIS SMKN 2 Pangkalpinang')))">
	<meta property="og:description" content="@yield('og_description', trim(View::yieldContent('meta_description', 'OSIS SMKN 2 Pangkalpinang')))">
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:image" content="@yield('og_image', asset('favicon.ico'))">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@yield('og_title', trim(View::yieldContent('title', 'OSIS SMKN 2 Pangkalpinang')))">
	<meta name="twitter:description" content="@yield('og_description', trim(View::yieldContent('meta_description', 'OSIS SMKN 2 Pangkalpinang')))">
	<meta name="twitter:image" content="@yield('og_image', asset('favicon.ico'))">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
	  tailwind.config = {
		  darkMode: 'class',
		  theme: {
			  extend: {
				  colors: {
					  primary: '#1F2A44',
					  primary2: '#2D3C62',
					  accent1: '#F6E9D7',
					  accent2: '#E6B656',
					  accent3: '#638A55',
					  accent4: '#C48D60',
					  ink: '#1A2233'
				  },
				  fontFamily: {
					  display: ['"Poppins"', 'Figtree', 'sans-serif']
				  }
			  }
		  }
	  }
	</script>
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap');
		.no-scrollbar::-webkit-scrollbar{display:none}
		.no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
		.scroll-snap-x{scroll-snap-type:x mandatory}
		.snap-center{scroll-snap-align:center}
		.stripe-bg{position:relative;overflow:hidden;}
		.stripe-bg::before{
			content:'';
			position:absolute;
			inset:0;
			background-image:repeating-linear-gradient(135deg, rgba(31,42,68,0.05) 0 18px, rgba(230,182,86,0.08) 18px 36px, transparent 36px 54px);
			opacity:.7;
			z-index:-1;
		}
	</style>
</head>
<body class="bg-gradient-to-br from-accent1 via-white to-accent1/60 text-ink dark:bg-neutral-950 dark:text-neutral-100">
	<header class="sticky top-0 z-50 bg-white/85 dark:bg-neutral-950/80 backdrop-blur border-b border-white/40 dark:border-neutral-800 shadow-sm">
		<div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
			<a href="{{ route('home') }}" class="font-display text-lg md:text-xl tracking-widest text-primary uppercase">OSIS SMKN 2 Pangkalpinang</a>
			<nav class="hidden md:flex gap-6 text-sm font-semibold items-center text-ink/70">
				<a href="{{ route('about') }}" class="hover:text-primary transition">Tentang</a>
				<a href="{{ route('home') }}#event" class="hover:text-primary transition">Event</a>
				<a href="{{ route('home') }}#sekbid" class="hover:text-primary transition">Sekbid</a>
				<a href="{{ route('home') }}#dokumentasi" class="hover:text-primary transition">Dokumentasi</a>
				<a href="{{ route('organization.index') }}" class="hover:text-primary transition">Organisasi</a>
				<a href="{{ route('ukk.index') }}" class="hover:text-primary transition">UKK</a>
				<a href="{{ route('kotak.create') }}" class="text-white bg-primary hover:bg-primary2 rounded-full px-3 py-1.5 transition shadow-sm">Kotak Surat</a>
				@auth
					<div class="relative group">
						<button class="border rounded-full px-3 py-1.5 bg-white/70 hover:bg-white transition">Admin</button>
						<div class="absolute right-0 mt-3 w-56 bg-white border rounded-xl shadow-lg hidden group-hover:block overflow-hidden">
							<a class="block px-4 py-2 hover:bg-accent1/80 transition" href="{{ route('admin.berita.index') }}">Kelola Berita</a>
							<a class="block px-4 py-2 hover:bg-accent1/80 transition" href="{{ route('admin.event.index') }}">Kelola Event</a>
							<a class="block px-4 py-2 hover:bg-accent1/80 transition" href="{{ route('admin.sekbid.index') }}">Kelola Sekbid</a>
							<a class="block px-4 py-2 hover:bg-accent1/80 transition" href="{{ route('admin.gallery.index') }}">Kelola Dokumentasi</a>
							<a class="block px-4 py-2 hover:bg-accent1/80 transition" href="{{ route('admin.organization.index') }}">Kelola Organisasi</a>
							<a class="block px-4 py-2 hover:bg-accent1/80 transition" href="{{ route('admin.ukk.index') }}">Kelola UKK</a>
							<a class="block px-4 py-2 hover:bg-accent1/80 transition" href="{{ route('kotak.index') }}">Kotak Surat</a>
						</div>
					</div>
				@endauth
			</nav>
			<button @click="toggle()" class="ml-3 border rounded-full px-2.5 py-1 text-sm hover:bg-white/80 dark:hover:bg-neutral-800 transition"> <span x-show="!dark">🌙</span><span x-show="dark">☀️</span></button>
		</div>
	</header>

	<main>
		@if(session('status'))
			<div id="flashToast" class="fixed top-16 right-4 z-50 bg-white border shadow rounded px-4 py-2 text-sm text-gray-800 min-w-[260px]">
				<div class="flex items-start justify-between gap-4">
					<div>{{ session('status') }}</div>
					<button id="flashClose" class="text-gray-500 hover:text-gray-800">✕</button>
				</div>
				<div class="mt-2 h-1 bg-gray-200 rounded">
					<div id="flashBar" class="h-1 bg-primary rounded" style="width:100%"></div>
				</div>
			</div>
		@endif
		@if($errors->any())
			<div class="fixed top-16 right-4 z-50 bg-red-50 border border-red-300 shadow rounded px-4 py-2 text-sm text-red-700">
				Terjadi kesalahan. Periksa form Anda.
			</div>
		@endif
		@yield('content')
	</main>

	<footer class="border-t border-white/40 dark:border-neutral-800 py-8 text-center text-sm text-ink/70 dark:text-neutral-400 bg-white/60">
		<div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-6 text-left">
			<div>
				<div class="font-semibold text-primary mb-2 uppercase tracking-wide text-xs">Sosial Media</div>
				<ul class="space-y-1">
					<li><a class="hover:underline" href="https://instagram.com/osis_smkn2pp" target="_blank">Instagram</a></li>
					<li><a class="hover:underline" href="#" target="_blank">Tiktok</a></li>
				</ul>
			</div>
			<div>
				<div class="font-semibold text-primary mb-2 uppercase tracking-wide text-xs">Contact Person</div>
				<ul class="space-y-1">
					<li>Ferinda — 08xxxxxxxxxx</li>
					<li>Email — osis@smkn2pp.sch.id</li>
				</ul>
			</div>
			<div class="md:text-right">
				<div class="font-semibold text-primary uppercase text-xs mb-2">Alamat</div>
				<div>OSIS SMKN 2 Pangkalpinang</div>
				<div class="mt-2 text-xs text-ink/60">© {{ date('Y') }}. All Rights Reserved.</div>
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
				if (e.isIntersecting) { link.classList.add('text-primary','font-semibold'); }
				else { link.classList.remove('text-primary','font-semibold'); }
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

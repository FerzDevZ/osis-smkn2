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
    
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1F2A44">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	@vite(['resources/css/app.css', 'resources/js/app.js'])
    
	<script>
	function theme() {
		return {
			currentTheme: localStorage.getItem('theme') || '',
			dark: localStorage.getItem('theme') === 'theme-dark',
			setTheme(val) { 
				this.currentTheme = val; 
				this.dark = (val === 'theme-dark');
				localStorage.setItem('theme', val); 
			}
		}
	}

	function chatbot() {
		return {
			open: false,
			loading: false,
			userInput: '',
			messages: [
				{ role: 'assistant', content: 'Halo! Saya AI OSIS SMKN 2. Ada yang bisa saya bantu hari ini?' }
			],
			toggleChat() { this.open = !this.open; if(this.open) this.scrollToBottom(); },
			async sendMessage() {
				if(!this.userInput.trim()) return;
				const msg = this.userInput;
				this.messages.push({ role: 'user', content: msg });
				this.userInput = '';
				this.loading = true;
				this.scrollToBottom();

				try {
					const response = await fetch('{{ route("ai.chat") }}', {
						method: 'POST',
						headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
						body: JSON.stringify({ message: msg })
					});
					const data = await response.json();
					this.messages.push({ role: 'assistant', content: data.reply });
				} catch (e) {
					this.messages.push({ role: 'assistant', content: 'Maaf, koneksi ke otak AI saya terputus. Coba lagi nanti ya!' });
				} finally {
					this.loading = false;
					this.scrollToBottom();
				}
			},
			scrollToBottom() {
				setTimeout(() => {
					if(this.$refs.chatContainer) {
						this.$refs.chatContainer.scrollTop = this.$refs.chatContainer.scrollHeight;
					}
				}, 100);
			}
		}
	}
	</script>

	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>

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
    <!-- Top Reading Scroll Progress Bar -->
    <div id="readProgress" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-accent to-primary z-[110] transition-all duration-75" style="width: 0%"></div>
    <!-- Background Elements -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-accent2/10 blur-[120px] animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-primary/5 blur-[120px] animate-blob animation-delay-2000"></div>
    </div>

	<header class="sticky top-4 z-50 px-4">
        <nav class="max-w-7xl mx-auto glass rounded-full px-6 py-3 flex items-center justify-between shadow-glass transition-all duration-300">
			<a href="{{ route('home') }}" class="font-display font-bold text-lg md:text-xl tracking-tight text-primary dark:text-white uppercase transition-opacity hover:opacity-80 flex items-center gap-3">
                @if(!empty($site_settings['logo_image']))
                    <img src="{{ asset($site_settings['logo_image']) }}" class="w-8 h-8 object-contain" alt="Logo OSIS">
                @endif
                <span>{{ $site_settings['school_name'] ?? 'SMKN 2' }} <span class="text-accent2">OSIS</span></span>
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
                    <div x-show="open" @mouseleave="open = false" @click.outside="open = false" x-transition class="absolute left-0 mt-2 w-56 glass rounded-2xl shadow-xl border border-white/20 py-2 z-50">
                        <a href="{{ route('pemilos.index') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold uppercase tracking-wider">E-Voting Pemilos</a>
                        <a href="{{ route('tickets.index') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold uppercase tracking-wider text-accent">E-Pass Tiket QR</a>
                        <a href="{{ route('counseling.create') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold uppercase tracking-wider">Ruang Konseling</a>
                        <a href="{{ route('meetings.index') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold uppercase tracking-wider">Presensi Rapat</a>
                        <a href="{{ route('lost-found.index') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold uppercase tracking-wider">Lost & Found</a>
                        <div class="border-t border-white/10 my-1"></div>
                        <a href="{{ route('members.index') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold">Struktur Organisasi</a>
                        <a href="{{ route('events.calendar') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold">Kalender Kegiatan</a>
                        <a href="{{ route('downloads.index') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold">Pusat Unduhan</a>
                        <a href="{{ route('posts.blog') }}" class="block px-4 py-2 hover:bg-primary/10 transition text-xs font-bold">Catatan OSIS</a>
                    </div>
                </div>
			</div>

            <div class="flex items-center gap-3">
                <button @click="$dispatch('open-command-palette')" class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-full glass hover:bg-white/20 text-xs text-ink/70 dark:text-white/70 transition shadow-sm">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Cari...</span>
                    <kbd class="font-mono text-[9px] bg-white/20 dark:bg-black/20 px-1.5 py-0.5 rounded border border-white/30">Ctrl+K</kbd>
                </button>
                <a href="{{ route('kotak.create') }}" class="hidden sm:block text-white bg-primary hover:bg-primary2 rounded-full px-5 py-2 text-sm font-semibold transition shadow-sm hover:shadow-md">Aspirasi</a>
                
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2.5 rounded-full glass hover:bg-white/20 transition shadow-sm text-primary"> 
                        <svg x-show="currentTheme === ''" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg x-show="currentTheme === 'theme-dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="currentTheme === 'theme-cyberpunk'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <svg x-show="currentTheme === 'theme-zen'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-3 w-44 glass rounded-2xl shadow-xl border border-white/20 py-2 z-50">
                        <button @click="setTheme(''); open = false" class="flex items-center gap-3 w-full px-4 py-2.5 hover:bg-primary/10 transition text-[10px] font-black uppercase tracking-widest text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Light Mode
                        </button>
                        <button @click="setTheme('theme-dark'); open = false" class="flex items-center gap-3 w-full px-4 py-2.5 hover:bg-primary/10 transition text-[10px] font-black uppercase tracking-widest text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            Dark Mode
                        </button>
                        <button @click="setTheme('theme-cyberpunk'); open = false" class="flex items-center gap-3 w-full px-4 py-2.5 hover:bg-primary/10 transition text-[10px] font-black uppercase tracking-widest text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Cyberpunk
                        </button>
                        <button @click="setTheme('theme-zen'); open = false" class="flex items-center gap-3 w-full px-4 py-2.5 hover:bg-primary/10 transition text-[10px] font-black uppercase tracking-widest text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            Zen Mode
                        </button>
                    </div>
                </div>

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

    <!-- Menfess FAB -->
    <a href="{{ route('menfess.index') }}" class="fixed bottom-8 right-8 z-40 group">
        <div class="relative flex items-center justify-center">
            <div class="absolute inset-0 bg-accent rounded-full blur-xl opacity-40 group-hover:opacity-70 transition-opacity animate-pulse"></div>
            <div class="relative bg-accent text-white px-6 py-3 rounded-full shadow-2xl transform group-hover:scale-110 transition-transform flex items-center gap-2">
                <span class="font-bold text-xs uppercase tracking-[0.2em]">Kirim Pesan</span>
            </div>
        </div>
    </a>

    <!-- AI Chatbot FAB & Window -->
    <div x-data="chatbot()" class="fixed bottom-8 left-8 z-40">
        <button @click="toggleChat()" class="relative flex items-center justify-center group">
            <div class="absolute inset-0 bg-primary rounded-full blur-xl opacity-40 group-hover:opacity-70 transition-opacity animate-pulse"></div>
            <div class="relative bg-primary text-white p-4 rounded-full shadow-2xl transform group-hover:scale-110 transition-transform">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-10 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="absolute bottom-20 left-0 w-80 md:w-96 glass rounded-[2.5rem] shadow-2xl border-white/20 overflow-hidden flex flex-col h-[500px]">
            <div class="bg-primary p-6 text-white">
                <h3 class="font-bold text-lg flex items-center gap-2">AI Assistant</h3>
                <p class="text-[10px] opacity-70 uppercase tracking-widest">Powered by SMKN 2 Intelligence</p>
            </div>
            
            <div class="flex-1 overflow-y-auto p-6 space-y-4 no-scrollbar" x-ref="chatContainer">
                <template x-for="msg in messages">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.role === 'user' ? 'bg-primary text-white rounded-2xl rounded-tr-none' : 'glass border-white/30 text-text rounded-2xl rounded-tl-none'" class="max-w-[80%] p-4 text-xs shadow-sm" x-text="msg.content"></div>
                    </div>
                </template>
                <div x-show="loading" class="flex justify-start">
                    <div class="glass p-4 rounded-2xl rounded-tl-none flex gap-1">
                        <span class="w-1.5 h-1.5 bg-text-muted rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-text-muted rounded-full animate-bounce [animation-delay:200ms]"></span>
                        <span class="w-1.5 h-1.5 bg-text-muted rounded-full animate-bounce [animation-delay:400ms]"></span>
                    </div>
                </div>
            </div>

            <div class="p-4 border-t border-white/10">
                <form @submit.prevent="sendMessage()" class="flex gap-2">
                    <input type="text" x-model="userInput" class="flex-1 glass border-white/20 rounded-full px-4 py-2 text-xs focus:ring-primary" placeholder="Tanya sesuatu...">
                    <button type="submit" class="bg-primary text-white p-2 rounded-full hover:opacity-90 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

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
	// Global Toast Helper
	window.toast = function(message, type = 'success') {
		const container = document.createElement('div');
		container.className = `fixed top-24 right-4 z-50 glass ${type === 'error' ? 'border-l-4 border-red-500 text-red-700' : 'border-l-4 border-primary text-gray-800'} shadow-2xl rounded-xl p-4 text-sm min-w-[300px] animate-fade-in transition-all`;
		container.innerHTML = `
			<div class="flex items-start justify-between gap-4">
				<div class="font-medium">${message}</div>
				<button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-primary transition">✕</button>
			</div>
		`;
		document.body.appendChild(container);
		setTimeout(() => { container.remove(); }, 3500);
	};

	// Confetti Celebration Helper
	window.fireConfetti = function() {
		if (typeof confetti === 'function') {
			confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });
		}
	};

	// Top Scroll Progress Bar
	window.addEventListener('scroll', () => {
		const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
		const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
		const scrolled = (winScroll / height) * 100;
		const bar = document.getElementById('readProgress');
		if (bar) bar.style.width = scrolled + '%';
	});

	// Keyboard Hotkeys Navigation (G+key sequence)
	let lastKey = '';
	window.addEventListener('keydown', (e) => {
		if (['input', 'textarea', 'select'].includes(document.activeElement.tagName.toLowerCase())) return;
		const key = e.key.toLowerCase();
		if (lastKey === 'g') {
			if (key === 'h') window.location.href = '{{ route("home") }}';
			if (key === 'm') window.location.href = '{{ route("menfess.index") }}';
			if (key === 'p') window.location.href = '{{ route("pemilos.index") }}';
			lastKey = '';
		} else if (key === 'g') {
			lastKey = 'g';
			setTimeout(() => { lastKey = ''; }, 1000);
		}
	});

	// Active nav on scroll
	document.addEventListener('DOMContentLoaded', () => {
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
	</script>
    @include('components.command-palette')
    @include('components.mobile-nav')
    @yield('scripts')
</body>
</html>

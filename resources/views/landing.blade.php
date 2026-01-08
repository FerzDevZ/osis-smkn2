@extends('layouts.app')
@section('title','OSIS SMKN 2 Pangkalpinang')
@section('content')

    <!-- Hero Section -->
    <section class="relative min-h-[80vh] flex items-center pt-20 pb-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 w-full grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div class="animate-fade-in">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent2/10 border border-accent2/20 text-accent2 text-xs font-bold uppercase tracking-wider mb-6">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent2 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-accent2"></span>
                    </span>
                    Official Website OSIS
                </div>
                <h1 class="text-4xl md:text-7xl font-display font-bold leading-[1.1] text-primary dark:text-white mb-6">
                    {{ $site_settings['hero_title'] ?? 'Bersama Membangun OSIS yang Adaptif & Inspiratif' }}
                </h1>
                <p class="text-lg text-ink/70 dark:text-white/60 mb-10 leading-relaxed max-w-lg">
                    {{ $site_settings['hero_subtitle'] ?? 'Wadah koordinasi, informasi, dan ruang aspirasi siswa SMKN 2 Pangkalpinang dalam satu platform digital yang modern.' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#sekbid" class="bg-primary text-white px-8 py-4 rounded-full font-bold shadow-lg shadow-primary/20 hover:shadow-xl hover:-translate-y-1 transition-all">Lihat Sekbid</a>
                    <a href="{{ route('berita.index') }}" class="glass px-8 py-4 rounded-full font-bold dark:text-white hover:bg-white transition-all">Informasi & Berita</a>
                </div>
                <div class="mt-12 flex items-center gap-6">
                    <div class="flex -space-x-4">
                        <div class="w-12 h-12 rounded-full border-4 border-white dark:border-neutral-950 bg-accent1"></div>
                        <div class="w-12 h-12 rounded-full border-4 border-white dark:border-neutral-950 bg-accent2"></div>
                        <div class="w-12 h-12 rounded-full border-4 border-white dark:border-neutral-950 bg-accent3"></div>
                    </div>
                    <div class="text-sm">
                        <span class="block font-bold dark:text-white">50+ Pengurus Terpilih</span>
                        <span class="text-ink/60 dark:text-white/40">Masa Bakti {{ date('Y') }}/{{ date('Y')+1 }}</span>
                    </div>
                </div>
            </div>
            <div class="relative hidden md:block animate-fade-in" style="animation-delay: 200ms;">
                <div class="relative z-10 aspect-square rounded-[3rem] overflow-hidden rotate-3 border-8 border-white dark:border-neutral-800 shadow-2xl">
                    <img src="https://picsum.photos/seed/osishero/800/800" class="w-full h-full object-cover" alt="OSIS SMKN 2">
                </div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-accent2/20 blur-3xl animate-blob"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-primary/10 blur-3xl animate-blob animation-delay-2000"></div>
            </div>
        </div>
    </section>

    <!-- Bento Grid Section: Organizations & Achievements -->
    <section id="org-ukk" class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="mb-16">
                <h2 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-4">Ekosistem <span class="text-accent2">Organisasi</span></h2>
                <p class="text-ink/60 dark:text-white/40">Membangun karakter dan skill melalui berbagai organisasi dan unit kegiatan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 h-full md:h-[600px]">
                <!-- Main Stat Card -->
                <div class="md:col-span-2 md:row-span-1 glass rounded-3xl p-8 flex flex-col justify-between group hover:shadow-glass-hover transition-all">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-primary text-white flex items-center justify-center mb-6 text-2xl">✨</div>
                        <h3 class="text-2xl font-bold mb-2 dark:text-white">Prestasi Terbaru</h3>
                        <p class="text-sm text-ink/60 dark:text-white/40">Selamat kepada Tim LKS SMKN 2 yang berhasil meraih Juara 1 Tingkat Provinsi!</p>
                    </div>
                    <a href="#" class="mt-6 text-primary dark:text-accent2 font-bold flex items-center gap-2 group-hover:gap-4 transition-all">Baca Selengkapnya <span>→</span></a>
                </div>

                <!-- Organization Scroll Card -->
                <div class="md:col-span-2 md:row-span-2 glass rounded-3xl p-8 flex flex-col hover:shadow-glass-hover transition-all overflow-hidden">
                    <h3 class="text-2xl font-bold mb-6 dark:text-white">Our Organizations</h3>
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-4 overflow-y-auto no-scrollbar pr-2">
                        @foreach($organizations as $org)
                            <a href="{{ route('organization.show', $org) }}" class="group aspect-square rounded-2xl glass border-black/5 flex items-center justify-center p-2 hover:bg-white transition-all" title="{{ $org->name }}">
                                <img loading="lazy" class="w-full h-full object-contain filter grayscale group-hover:grayscale-0 transition" src="{{ $org->image_path ? Storage::url($org->image_path) : 'https://picsum.photos/seed/org'.$org->id.'/200/200' }}" alt="{{ $org->name }}">
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-auto pt-6 border-t border-black/5 dark:border-white/5 flex justify-between items-center">
                        <span class="text-sm text-ink/60 dark:text-white/40">{{ $organizations->count() }} Terdaftar</span>
                        <a href="{{ route('organization.index') }}" class="text-sm font-bold text-primary dark:text-accent2">View All</a>
                    </div>
                </div>

                <!-- UKK Spotlight -->
                <div class="md:col-span-1 md:row-span-1 glass rounded-3xl p-6 bg-accent2/5 hover:shadow-glass-hover transition-all border-accent2/20">
                    <h3 class="font-bold mb-3 dark:text-white text-lg">UKK & Ekstra</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($ukks->take(5) as $u)
                            <span class="px-3 py-1 bg-white/50 dark:bg-neutral-800/50 rounded-full text-[10px] font-bold">{{ $u->name }}</span>
                        @endforeach
                        <a href="{{ route('ukk.index') }}" class="px-3 py-1 bg-primary text-white rounded-full text-[10px] font-bold">More</a>
                    </div>
                </div>

                <!-- Fast Poll Section -->
                <div class="md:col-span-1 md:row-span-1 glass rounded-3xl p-6 flex flex-col justify-between bg-primary/5 hover:shadow-glass-hover transition-all border-primary/10">
                    <div class="text-sm">
                        <h3 class="font-bold mb-2 dark:text-white">Polling Cepat</h3>
                        <p class="text-[10px] text-ink/60 dark:text-white/40 mb-4">Gimana menurut lo event Bulan Bahasa kemarin?</p>
                        <div class="space-y-2">
                            <button class="w-full py-2 px-3 rounded-lg border border-black/5 dark:border-white/5 text-[10px] text-left hover:bg-white transition-all">🔥 Keren Banget!</button>
                            <button class="w-full py-2 px-3 rounded-lg border border-black/5 dark:border-white/5 text-[10px] text-left hover:bg-white transition-all">👍 Lumayan lah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- upcoming Events -->
    <section id="berita" class="py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-2">{!! $site_settings['section_news_title'] ?? 'Berita <span class="text-accent2">Terbaru</span>' !!}</h2>
                    <p class="text-ink/60 dark:text-white/40">{{ $site_settings['section_news_subtitle'] ?? 'Ikuti perkembangan informasi dan kegiatan terbaru dari OSIS.' }}</p>
                </div>
                <a href="{{ route('berita.index') }}" class="hidden md:flex items-center gap-2 font-bold text-primary dark:text-accent2 group">
                    Semua Berita <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestPosts as $post)
                    <a href="{{ route('berita.show', $post) }}" class="group glass rounded-[2.5rem] overflow-hidden border border-white/20 shadow-glass hover:shadow-glass-hover transition-all flex flex-col">
                        <div class="aspect-video relative overflow-hidden">
                            <img loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $post->image_path ? Storage::url($post->image_path) : 'https://picsum.photos/seed/news'.$post->id.'/800/450' }}" alt="{{ $post->title }}">
                            <div class="absolute top-4 left-4 glass px-3 py-1 rounded-full text-[10px] font-bold text-primary uppercase tracking-widest">{{ $post->category ?? 'Info' }}</div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-xl font-bold mb-4 dark:text-white group-hover:text-primary transition-colors">{{ $post->title }}</h3>
                            <p class="text-sm text-ink/60 dark:text-white/40 line-clamp-2 mb-6">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                            <div class="flex items-center justify-between pt-6 border-t border-black/5 dark:border-white/5">
                                <span class="text-[10px] font-bold text-ink/40 dark:text-white/30 uppercase tracking-tighter">{{ optional($post->published_at)->format('d M Y') }}</span>
                                <span class="text-xs font-bold text-primary dark:text-accent2">Read More →</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full glass rounded-3xl p-12 text-center">
                        <p class="text-ink/40 italic">Belum ada berita yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Event Progress Section -->
    @php
        $featuredEvents = $upcoming->where('is_featured', true)->take(2);
    @endphp
    @if($featuredEvents->count() > 0)
    <section id="event-progress" class="py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="glass p-8 md:p-12 rounded-[3.5rem] border border-white/20 shadow-2xl bg-primary/[0.02]">
                <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                    <div class="md:w-1/3">
                        <span class="text-accent2 font-bold uppercase tracking-[0.3em] text-[10px] mb-4 block">Big Projects Tracker</span>
                        <h2 class="text-3xl font-display font-bold text-primary dark:text-white mb-4">Persiapan <span class="text-accent2">Event Besar</span></h2>
                        <p class="text-sm text-ink/60 dark:text-white/40 italic">Transparansi persiapan kegiatan besar OSIS SMKN 2.</p>
                    </div>
                    <div class="flex-1 grid md:grid-cols-2 gap-8 w-full">
                        @foreach($featuredEvents as $fe)
                            <div class="space-y-4">
                                <div class="flex justify-between items-end">
                                    <div class="max-w-[70%]">
                                        <h4 class="font-bold dark:text-white text-lg truncate">{{ $fe->title }}</h4>
                                        <p class="text-[10px] text-ink/40 dark:text-white/30 uppercase tracking-widest">{{ $fe->start_at ? $fe->start_at->format('M Y') : '' }}</p>
                                    </div>
                                    <span class="text-2xl font-display font-black text-primary">{{ $fe->progress }}%</span>
                                </div>
                                <div class="w-full h-4 bg-white/50 dark:bg-white/5 rounded-full overflow-hidden border border-black/5 dark:border-white/5">
                                    <div class="h-full bg-gradient-to-r from-primary to-accent2 rounded-full transition-all duration-1000 shadow-lg shadow-primary/20" style="width: {{ $fe->progress }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- upcoming Events -->
    <section id="event" class="py-24 bg-primary/5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-2">{!! $site_settings['section_events_title'] ?? 'Event <span class="text-accent2">Mendatang</span>' !!}</h2>
                    <p class="text-ink/60 dark:text-white/40">{{ $site_settings['section_events_subtitle'] ?? 'Jangan lewatkan keseruan di SMKN 2!' }}</p>
                </div>
                <a href="{{ route('event.index') }}" class="hidden md:flex items-center gap-2 font-bold text-primary dark:text-accent2 group">
                    Semua Event <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($upcoming as $ev)
                    <a href="{{ route('event.show', $ev) }}" class="group relative bg-white dark:bg-neutral-900 rounded-[2.5rem] overflow-hidden border border-black/[0.03] dark:border-white/[0.03] shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all p-4 flex flex-col">
                        <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden mb-6">
                            @php $isUpcoming = optional($ev->start_at) && $ev->start_at->isFuture(); @endphp
                            <div class="absolute top-4 left-4 z-10 glass px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                {{ $isUpcoming ? 'Soon' : 'Passed' }}
                            </div>
                            <img loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $ev->cover_path ? Storage::url($ev->cover_path) : 'https://picsum.photos/seed/event'.$ev->id.'/800/450' }}" alt="{{ $ev->title }}">
                        </div>
                        <div class="px-2 pb-2">
                             <div class="flex items-center gap-3 text-xs font-bold text-accent2 mb-3">
                                <span class="px-2 py-0.5 rounded bg-accent2/10 uppercase tracking-tighter">{{ optional($ev->start_at)->format('d M') }}</span>
                                <span class="text-ink/40 dark:text-white/30">{{ optional($ev->start_at)->format('Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors dark:text-white">{{ $ev->title }}</h3>
                            <p class="text-sm text-ink/50 dark:text-white/40 line-clamp-2 leading-relaxed">{{ $ev->location }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full glass rounded-3xl p-12 text-center">
                        <p class="text-ink/40">Belum ada event terjadwal dalam waktu dekat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sekbid Section -->
    <section id="sekbid" class="py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-4">Sekretariat Bidang</h2>
                <div class="w-20 h-1.5 bg-accent2 mx-auto rounded-full"></div>
            </div>

            <div x-data="sekbidScroll()" class="relative">
                <div class="overflow-x-auto no-scrollbar scroll-smooth flex gap-6 pb-12" x-ref="track">
                    @foreach($sekbids as $item)
                        <div class="shrink-0 w-[280px] md:w-[320px]">
                            <a href="{{ $item->instagram_url ?: '#' }}" target="_blank" class="block group">
                                <div class="relative aspect-[4/5] rounded-[2.5rem] overflow-hidden mb-6 border-4 border-white dark:border-neutral-800 shadow-xl group-hover:scale-[1.02] transition-transform duration-500">
                                    <img loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $item->image_path ? Storage::url($item->image_path) : 'https://picsum.photos/seed/sekbid'.$item->id.'/600/750' }}" alt="{{ $item->name }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="absolute bottom-6 left-6 right-6 opacity-0 group-hover:opacity-100 transition-all translate-y-4 group-hover:translate-y-0 text-white">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-accent2 mb-1">Explore</p>
                                        <h4 class="text-sm font-bold uppercase">Follow Instagram</h4>
                                    </div>
                                </div>
                                <div class="px-4">
                                    <span class="text-[10px] items-center gap-2 inline-flex px-2 py-0.5 rounded-full bg-primary/5 dark:bg-white/5 text-ink/40 dark:text-white/40 font-bold uppercase tracking-widest mb-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Sekbid
                                    </span>
                                    <h3 class="text-lg font-bold dark:text-white">{{ $item->name }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-center gap-4 mt-4">
                    <button @click="scrollBy(-1)" class="w-12 h-12 rounded-full glass flex items-center justify-center hover:bg-primary hover:text-white transition-all">←</button>
                    <button @click="scrollBy(1)" class="w-12 h-12 rounded-full glass flex items-center justify-center hover:bg-primary hover:text-white transition-all">→</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Documentation Section -->
    <section id="dokumentasi" class="py-24 relative overflow-hidden bg-white/40 dark:bg-white/5">
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between mb-16 gap-6">
                <div>
                    <h2 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-2">{!! $site_settings['section_gallery_title'] ?? 'Moments & <span class="text-accent2">Gallery</span>' !!}</h2>
                    <p class="text-ink/60 dark:text-white/40">{{ $site_settings['section_gallery_subtitle'] ?? 'Dokumentasi kegiatan dan arsip kenangan OSIS.' }}</p>
                </div>
                <a href="{{ route('gallery.index') }}" class="glass px-8 py-3 rounded-full font-bold text-sm dark:text-white hover:bg-primary hover:text-white transition-all">Semua Dokumentasi</a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($galleries->take(8) as $index => $g)
                    <div class="aspect-square relative rounded-[2rem] overflow-hidden group border-4 border-white dark:border-neutral-800 shadow-lg @if($index % 5 == 0) md:col-span-2 md:row-span-2 md:aspect-auto @endif">
                        <img loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" src="{{ $g->cover_path ? Storage::url($g->cover_path) : 'https://picsum.photos/seed/gallery'.$g->id.'/600/600' }}" alt="{{ $g->title }}">
                        <div class="absolute inset-0 bg-primary/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center p-6 text-center">
                            <h3 class="text-white text-sm font-bold">{{ $g->title }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Suara Siswa (Aspiration Wall) -->
    @if($aspirations->count() > 0)
    <section id="suara-siswa" class="py-24 bg-white/30 dark:bg-neutral-900/30 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-accent2 font-bold uppercase tracking-[0.3em] text-xs mb-4 block animate-fade-in">Mendengar & Bergerak</span>
                <h2 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-4">{!! $site_settings['section_suara_title'] ?? 'Suara <span class="text-accent2">Siswa</span>' !!}</h2>
                <p class="text-ink/60 dark:text-white/40 max-w-2xl mx-auto">{{ $site_settings['section_suara_subtitle'] ?? 'Aspirasi, saran, dan apresiasi terpilih dari siswa untuk kemajuan sekolah kita tercinta.' }}</p>
            </div>

            <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                @foreach($aspirations as $asp)
                    <div class="break-inside-avoid glass rounded-[2.5rem] p-8 border border-white/20 shadow-glass hover:shadow-glass-hover transition-all animate-fade-in group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary to-accent1 flex items-center justify-center text-xl shadow-lg">
                                💬
                            </div>
                            <div>
                                <h4 class="font-bold text-primary dark:text-white">{{ $asp->is_anonymous ? 'Anonim' : $asp->student_name }}</h4>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 italic">
                                    {{ $asp->is_anonymous ? 'Siswa SMKN 2' : ($asp->class_name ?? 'Siswa SMKN 2') }}
                                </p>
                            </div>
                        </div>
                        <div class="relative">
                            <span class="absolute -top-4 -left-2 text-6xl text-primary/5 dark:text-white/5 font-serif font-black select-none opacity-50">"</span>
                            <p class="text-ink/70 dark:text-white/70 italic leading-relaxed text-sm relative z-10">{{ $asp->message }}</p>
                        </div>
                        <div class="mt-8 pt-6 border-t border-black/5 dark:border-white/5 flex items-center justify-between">
                            <span class="text-[10px] font-bold text-accent2 uppercase tracking-tighter">{{ $asp->created_at->format('d M Y') }}</span>
                            <span class="px-3 py-1 rounded-full bg-accent1/10 text-accent1 text-[8px] font-bold uppercase tracking-widest">Approved</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTW Section (Call to Write / Aspiration) -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-primary rounded-[3rem] p-8 md:p-16 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-12 shadow-2xl">
                <!-- Background Decoration -->
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-accent2/20 blur-[100px]"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-white/5 blur-[100px]"></div>

                <div class="relative z-10 text-center md:text-left">
                    <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-6">Punya <span class="text-accent2">Aspirasi</span> Untuk Sekolah?</h2>
                    <p class="text-white/60 text-lg max-w-xl leading-relaxed">Suara kamu berarti! Jangan ragu untuk menyampaikan kritik, saran, atau ide kreatif kamu lewat kotak aspirasi digital kami.</p>
                </div>
                <div class="relative z-10 shrink-0">
                    <a href="{{ route('kotak.create') }}" class="inline-block bg-accent2 text-primary px-10 py-5 rounded-full font-black text-lg shadow-xl shadow-accent2/20 hover:scale-105 active:scale-95 transition-all">Kirim Aspirasi Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <script>
      function sekbidScroll(){
        return {
          scrollBy(dir){
            const el = this.$refs.track;
            el.scrollBy({ left: dir * 320, behavior: 'smooth' });
          }
        }
      }
    </script>
@endsection



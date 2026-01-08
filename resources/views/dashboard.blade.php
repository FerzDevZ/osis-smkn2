@extends('layouts.app')
@section('title', 'Admin Dashboard - OSIS SMKN 2')
@section('content')
<div class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 animate-fade-in">
            <div>
                <h1 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-2">Halo, <span class="text-accent2">Admin!</span></h1>
                <p class="text-ink/60 dark:text-white/40 font-medium">Selamat datang kembali di pusat kendali OSIS SMKN 2 Pangkalpinang.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.settings.index') }}" class="glass px-6 py-3 rounded-2xl font-bold text-sm dark:text-white hover:bg-white transition-all flex items-center gap-2">
                    <span>⚙️</span> Pengaturan Situs
                </a>
                <a href="{{ route('home') }}" target="_blank" class="bg-primary text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-xl transition-all flex items-center gap-2">
                    <span>🌍</span> Lihat Web
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 animate-fade-in" style="animation-delay: 100ms;">
            <div class="glass rounded-3xl p-8 border border-white/20 shadow-glass hover:shadow-glass-hover transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-500 flex items-center justify-center mb-6 text-2xl group-hover:scale-110 transition-transform">🔥</div>
                <div class="text-3xl font-black text-primary dark:text-white mb-1">{{ \App\Models\Post::count() }}</div>
                <div class="text-xs font-bold uppercase tracking-widest text-ink/40 dark:text-white/40">Total Berita</div>
            </div>
            <div class="glass rounded-3xl p-8 border border-white/20 shadow-glass hover:shadow-glass-hover transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-accent2/10 text-accent2 flex items-center justify-center mb-6 text-2xl group-hover:scale-110 transition-transform">📅</div>
                <div class="text-3xl font-black text-primary dark:text-white mb-1">{{ \App\Models\Event::count() }}</div>
                <div class="text-xs font-bold uppercase tracking-widest text-ink/40 dark:text-white/40">Event Aktif</div>
            </div>
            <div class="glass rounded-3xl p-8 border border-white/20 shadow-glass hover:shadow-glass-hover transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-accent3/10 text-accent3 flex items-center justify-center mb-6 text-2xl group-hover:scale-110 transition-transform">📩</div>
                <div class="text-3xl font-black text-primary dark:text-white mb-1">{{ \App\Models\MailMessage::count() }}</div>
                <div class="text-xs font-bold uppercase tracking-widest text-ink/40 dark:text-white/40">Kotak Aspirasi</div>
            </div>
            <div class="glass rounded-3xl p-8 border border-white/20 shadow-glass hover:shadow-glass-hover transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 text-2xl group-hover:scale-110 transition-transform">🏛️</div>
                <div class="text-3xl font-black text-primary dark:text-white mb-1">{{ \App\Models\Organization::count() + \App\Models\Ukk::count() }}</div>
                <div class="text-xs font-bold uppercase tracking-widest text-ink/40 dark:text-white/40">Org & UKK</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in" style="animation-delay: 200ms;">
            <!-- Quick Actions -->
            <div class="lg:col-span-1 space-y-6">
                <div class="glass rounded-3xl p-8 border border-white/20 shadow-glass">
                    <h3 class="text-xl font-bold mb-6 dark:text-white">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <a href="{{ route('admin.berita.create') }}" class="flex items-center justify-between p-4 rounded-2xl bg-white/50 dark:bg-neutral-800/50 hover:bg-white transition-all border border-black/5 group">
                            <span class="font-bold text-sm">Tulis Berita Baru</span>
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                        <a href="{{ route('admin.event.create') }}" class="flex items-center justify-between p-4 rounded-2xl bg-white/50 dark:bg-neutral-800/50 hover:bg-white transition-all border border-black/5 group">
                            <span class="font-bold text-sm">Buat Event Baru</span>
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                        <a href="{{ route('kotak.index') }}" class="flex items-center justify-between p-4 rounded-2xl bg-white/50 dark:bg-neutral-800/50 hover:bg-white transition-all border border-black/5 group">
                            <span class="font-bold text-sm">Cek Kotak Aspirasi</span>
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>
                
                <div class="glass rounded-3xl p-8 border border-white/20 shadow-glass bg-primary text-white overflow-hidden relative">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-2">Butuh Bantuan?</h3>
                        <p class="text-white/60 text-sm mb-6">Hubungi tim pengembang jika Anda mengalami kendala pada sistem.</p>
                        <a href="#" class="inline-block bg-accent2 text-primary px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 active:scale-95 transition-all">Hubungi IT Team</a>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 blur-3xl"></div>
                </div>
            </div>

            <!-- Recent Messages / Activity -->
            <div class="lg:col-span-2 glass rounded-3xl p-8 border border-white/20 shadow-glass">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold dark:text-white">Aspirasi Terbaru</h3>
                    <a href="{{ route('kotak.index') }}" class="text-xs font-bold text-primary dark:text-accent2 uppercase tracking-widest">Lihat Semua</a>
                </div>
                
                <div class="space-y-4">
                    @forelse(\App\Models\MailMessage::latest()->take(5)->get() as $msg)
                        <div class="p-6 rounded-2xl border border-black/5 dark:border-white/5 hover:bg-white/40 transition-all flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-accent1 flex items-center justify-center shrink-0">👤</div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="font-bold text-sm dark:text-white">{{ $msg->sender_name ?: 'Anonim' }}</h4>
                                    <span class="text-[10px] text-ink/40">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-ink/60 dark:text-white/60 line-clamp-2">{{ $msg->message }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-ink/40 italic">Belum ada aspirasi masuk.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

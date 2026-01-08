@extends('layouts.app')
@section('title', 'Suara Siswa - OSIS SMKN 2 Pangkalpinang')
@section('content')
<div class="py-24 px-4 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-20 animate-fade-in">
            <span class="text-accent2 font-bold uppercase tracking-[0.3em] text-xs mb-4 block">Mendengar & Bergerak</span>
            <h1 class="text-4xl md:text-6xl font-display font-bold text-primary dark:text-white mb-6">Suara <span class="text-accent2">Siswa</span></h1>
            <p class="text-ink/60 dark:text-white/40 max-w-2xl mx-auto text-lg">Daftar aspirasi, saran, dan apresiasi terpilih dari siswa-siswi SMKN 2 Pangkalpinang untuk kemajuan sekolah.</p>
            
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="{{ route('kotak.create') }}" class="bg-primary text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all text-sm">Kirim Aspirasi Baru</a>
                <div class="glass px-6 py-4 rounded-full text-xs font-bold dark:text-white flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-accent2 animate-pulse"></span>
                    {{ $aspirations->total() }} Pesan Terpublikasi
                </div>
            </div>
        </div>

        <!-- Aspiration Grid -->
        <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8 animate-fade-in" style="animation-delay: 200ms;">
            @forelse($aspirations as $asp)
                <div class="break-inside-avoid glass rounded-[2.5rem] p-8 md:p-10 border border-white/20 shadow-glass hover:shadow-glass-hover transition-all group">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-accent1 flex items-center justify-center text-2xl shadow-lg transform group-hover:rotate-6 transition-transform">
                            💬
                        </div>
                        <div>
                            <h4 class="font-bold text-xl text-primary dark:text-white leading-tight">{{ $asp->is_anonymous ? 'Anonim' : $asp->student_name }}</h4>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 italic">
                                {{ $asp->is_anonymous ? 'Siswa SMKN 2' : ($asp->class_name ?? 'Siswa SMKN 2') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="relative min-h-[100px]">
                        <span class="absolute -top-8 -left-4 text-8xl text-primary/5 dark:text-white/5 font-serif font-black select-none pointer-events-none">"</span>
                        <p class="text-ink/70 dark:text-white/80 italic leading-relaxed text-sm md:text-base relative z-10 whitespace-pre-wrap">{{ $asp->message }}</p>
                    </div>

                    <div class="mt-10 pt-8 border-t border-black/5 dark:border-white/5 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                             <span class="w-1.5 h-1.5 rounded-full bg-accent2"></span>
                             <span class="text-[10px] font-bold text-accent2 uppercase tracking-tighter">{{ $asp->created_at->format('d M Y') }}</span>
                        </div>
                        <span class="px-4 py-1.5 rounded-full bg-accent1/10 text-accent1 text-[8px] font-bold uppercase tracking-[0.2em]">Verified</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 glass rounded-[3rem] text-center">
                    <div class="text-7xl mb-8 opacity-20">📭</div>
                    <h3 class="text-2xl font-bold dark:text-white mb-4">Belum ada aspirasi publik</h3>
                    <p class="text-ink/40 dark:text-white/40 italic">Jadilah yang pertama untuk memberikan masukan!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-20 flex justify-center animate-fade-in" style="animation-delay: 400ms;">
            {{ $aspirations->links() }}
        </div>
    </div>
</div>

<style>
    .columns-1 { column-count: 1; }
    @media (min-width: 768px) { .columns-2 { column-count: 2; } }
    @media (min-width: 1024px) { .columns-3 { column-count: 3; } }
    
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
        opacity: 0;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@extends('layouts.app')
@section('title', 'Pusat Unduhan - OSIS SMKN 2')
@section('content')

<div class="py-24 px-4 min-h-screen relative overflow-hidden">
    <!-- backgrounds -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 blur-[150px] -z-10 rounded-full"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-accent2/5 blur-[150px] -z-10 rounded-full"></div>

    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-16 animate-fade-in">
            <span class="text-accent2 font-bold uppercase tracking-[0.3em] text-xs mb-4 block">Arsip Digital</span>
            <h1 class="text-4xl md:text-5xl font-display font-bold text-primary dark:text-white mb-6">Pusat Unduhan</h1>
            <p class="text-ink/60 dark:text-white/40 max-w-xl mx-auto italic">Temukan dokumen resmi, formulir pendaftaran, dan panduan organisasi di sini.</p>
        </div>

        <!-- Search & Filter (Simplified) -->
        <div class="mb-12 animate-fade-in" style="animation-delay: 200ms">
            <div class="glass p-2 rounded-[2rem] flex items-center shadow-xl border border-white/20">
                <input type="text" placeholder="Cari dokumen..." class="bg-transparent border-none focus:ring-0 flex-1 px-6 dark:text-white text-sm" />
                <button class="bg-primary text-white px-8 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                    Cari
                </button>
            </div>
        </div>

        <!-- Document List -->
        <div class="space-y-6">
            @forelse($downloads->groupBy('category') as $category => $docs)
                <div class="animate-fade-in" style="animation-delay: {{ 300 + ($loop->index * 100) }}ms">
                    <h3 class="text-lg font-bold mb-6 dark:text-white flex items-center gap-3">
                        <span class="w-2 h-6 bg-accent2 rounded-full"></span>
                        {{ $category }}
                    </h3>
                    <div class="grid gap-4">
                        @foreach($docs as $doc)
                            <div class="glass p-6 rounded-[2rem] border border-white/20 shadow-glass flex flex-col md:flex-row items-center justify-between gap-6 group hover:shadow-glass-hover transition-all">
                                <div class="flex items-center gap-6">
                                    <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-3xl font-bold text-primary group-hover:bg-primary group-hover:text-white transition-all">
                                        {{ strtoupper($doc->file_type) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold dark:text-white mb-1">{{ $doc->title }}</h4>
                                        <p class="text-xs text-ink/60 dark:text-white/40 italic line-clamp-1">{{ $doc->description }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-8 shrink-0">
                                    <div class="text-right hidden sm:block">
                                        <span class="block text-[10px] font-bold text-ink/40 uppercase tracking-widest">Downloaded</span>
                                        <span class="block font-bold text-primary dark:text-accent2">{{ $doc->download_count }}x</span>
                                    </div>
                                    <a href="{{ route('downloads.download', $doc) }}" class="flex items-center gap-3 bg-white/50 dark:bg-white/5 px-8 py-3 rounded-2xl font-bold dark:text-white hover:bg-primary hover:text-white transition-all shadow-sm border border-black/5 dark:border-white/5">
                                        <span>Download</span>
                                        <span class="text-lg">↓</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="glass p-20 rounded-[3rem] text-center border border-white/20">
                    <p class="text-ink/40 dark:text-white/30 italic">Belum ada dokumen yang diunggah.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
        opacity: 0;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@endsection

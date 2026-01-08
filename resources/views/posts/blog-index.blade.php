@extends('layouts.app')
@section('title', 'Catatan OSIS - Blog & Edukasi')
@section('content')

<div class="py-24 px-4 min-h-screen relative overflow-hidden bg-white/30 dark:bg-neutral-900/10">
    <!-- background blur -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-accent1/5 blur-[120px] -z-10 rounded-full"></div>
    <div class="absolute top-1/2 -right-24 w-96 h-96 bg-primary/5 blur-[120px] -z-10 rounded-full"></div>

    <div class="max-w-7xl mx-auto">
        <div class="mb-20 animate-fade-in text-center md:text-left">
            <span class="text-accent2 font-bold uppercase tracking-[0.3em] text-xs mb-4 block">Catatan OSIS</span>
            <h1 class="text-4xl md:text-7xl font-display font-bold text-primary dark:text-white mb-6">Cerita & Edukasi</h1>
            <p class="text-lg text-ink/60 dark:text-white/40 max-w-2xl italic border-l-4 border-primary pl-6">"Lebih dari sekadar berita, ini adalah ruang berbagi inspirasi, tips, dan cerita di balik layar kehidupan siswa SMKN 2."</p>
        </div>

        <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
            @forelse($posts as $post)
                <div class="break-inside-avoid glass rounded-[2.5rem] overflow-hidden border border-white/20 shadow-glass group hover:shadow-glass-hover transition-all animate-fade-in" style="animation-delay: {{ $loop->index * 150 }}ms">
                    @if($post->cover_path)
                        <div class="aspect-video relative overflow-hidden rounded-[2rem] m-4">
                            <img src="{{ Storage::url($post->cover_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $post->title }}">
                        </div>
                    @endif
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest">Blog</span>
                            <span class="text-[10px] text-ink/40 dark:text-white/30 font-bold uppercase tracking-tighter">{{ $post->published_at->format('d M Y') }}</span>
                        </div>
                        <h2 class="text-2xl font-bold dark:text-white mb-4 group-hover:text-primary transition-colors leading-tight">
                            <a href="{{ route('berita.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-sm text-ink/60 dark:text-white/50 leading-relaxed mb-8 italic line-clamp-3">
                            {{ $post->excerpt ?: Str::limit(strip_tags($post->body), 150) }}
                        </p>
                        <div class="flex items-center justify-between pt-6 border-t border-black/5 dark:border-white/5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-accent2 text-white flex items-center justify-center text-[10px] font-bold">
                                    {{ substr($post->author->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="text-xs font-bold dark:text-white/80">{{ $post->author->name ?? 'Admin OSIS' }}</span>
                            </div>
                            <a href="{{ route('berita.show', $post) }}" class="text-primary dark:text-accent2 font-bold text-xs hover:gap-4 flex items-center gap-2 transition-all">Baca Selengkapnya <span>→</span></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full glass p-20 rounded-[3rem] text-center border border-white/20">
                    <p class="text-ink/40 dark:text-white/30 italic">Belum ada konten blog yan diunggah.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 flex justify-center">
            {{ $posts->links() }}
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

@extends('layouts.app')

@section('title', 'Pemilos Digital 2026')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-20">
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="font-display font-bold text-4xl md:text-5xl mb-4 text-primary">Pemilos <span class="text-accent">Digital</span></h1>
        <p class="text-text-muted max-w-2xl mx-auto">Gunakan hak suaramu untuk menentukan masa depan OSIS SMKN 2 Pangkalpinang. Satu suara Anda sangat berarti!</p>
    </div>

    @if($hasVoted)
        <div class="glass p-12 rounded-[3rem] text-center shadow-xl border-white/20 animate-fade-in">
            <div class="w-20 h-20 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-primary mb-4">Partisipasi Berhasil</h2>
            <p class="text-text-muted mb-8">Anda telah memberikan suara pada Pemilos tahun ini. Pantau terus hasil perolehan suara sementara.</p>
            <a href="{{ route('pemilos.results') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold shadow-lg hover:opacity-90 transition">Lihat Hasil Sementara</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($candidates as $candidate)
                <div class="glass rounded-[2.5rem] overflow-hidden border-white/20 shadow-lg hover:shadow-2xl transition-all flex flex-col animate-fade-in" style="animation-delay: {{ $loop->index * 100 }}ms">
                    <div class="aspect-[4/5] relative">
                        <img src="{{ $candidate->photo_path ? Storage::url($candidate->photo_path) : 'https://picsum.photos/seed/candidate'.$candidate->id.'/600/750' }}" class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4 w-12 h-12 glass rounded-2xl flex items-center justify-center font-display font-black text-xl text-primary shadow-lg border-white/50">
                            {{ $candidate->order }}
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-primary mb-4">{{ $candidate->name }}</h3>
                        
                        <div x-data="{ open: false }" class="mb-6">
                            <button @click="open = !open" class="text-xs font-bold text-accent uppercase tracking-widest hover:underline">Lihat Visi & Misi</button>
                            <div x-show="open" x-transition class="mt-4 p-4 bg-white/50 rounded-2xl border text-xs leading-relaxed italic text-text-muted">
                                <div class="mb-2 font-bold text-primary">Visi:</div>
                                <div class="mb-4">{{ $candidate->vision }}</div>
                                <div class="font-bold text-primary">Misi:</div>
                                <div>{{ $candidate->mission }}</div>
                            </div>
                        </div>

                        <form action="{{ route('pemilos.vote') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memberikan suara untuk {{ $candidate->name }}?')">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" class="w-full bg-primary text-white py-4 rounded-2xl font-bold shadow-lg hover:scale-[1.02] active:scale-[0.98] transition">Pilih Paslon {{ $candidate->order }}</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

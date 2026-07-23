@extends('layouts.app')

@section('title', 'Hasil Pemilos Digital 2026')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-20">
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="font-display font-bold text-4xl mb-4 text-primary">Hasil <span class="text-accent">Pemilos</span></h1>
        <p class="text-text-muted">Pantau perolehan suara secara real-time. Transparansi adalah kunci.</p>
    </div>

    <div class="space-y-12 animate-fade-in" style="animation-delay: 200ms">
        @php 
            $totalVotes = $candidates->sum('votes_count');
            $highestVotes = $candidates->max('votes_count');
        @endphp

        @foreach($candidates as $candidate)
            @php 
                $percentage = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0;
            @endphp
            <div class="glass p-8 rounded-[2.5rem] border-white/20 shadow-xl relative overflow-hidden group">
                @if($candidate->votes_count == $highestVotes && $totalVotes > 0)
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-accent/20 blur-3xl rounded-full"></div>
                    <div class="absolute top-4 right-4 text-2xl" title="Suara Terbanyak">👑</div>
                @endif

                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="w-32 h-32 rounded-3xl overflow-hidden border-4 border-white shadow-lg shrink-0">
                        <img src="{{ $candidate->photo_path ? Storage::url($candidate->photo_path) : 'https://picsum.photos/seed/candidate'.$candidate->id.'/600/750' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 w-full">
                        <div class="flex justify-between items-end mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-primary mb-1">{{ $candidate->name }}</h3>
                                <p class="text-xs font-bold text-text-muted uppercase tracking-widest">Paslon Nomor Urut {{ $candidate->order }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-display font-black text-primary">{{ $percentage }}%</div>
                                <div class="text-[10px] text-text-muted font-bold">{{ $candidate->votes_count }} SUARA</div>
                            </div>
                        </div>
                        <div class="w-full h-4 bg-primary/5 rounded-full overflow-hidden border border-black/5 p-1">
                            <div class="h-full bg-gradient-to-r from-primary to-accent rounded-full transition-all duration-1000 shadow-lg" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-16 text-center text-[10px] text-text-muted font-bold uppercase tracking-[0.5em] animate-pulse">
        • Data diperbarui secara otomatis •
    </div>
</div>
@endsection

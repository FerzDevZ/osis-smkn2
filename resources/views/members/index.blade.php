@extends('layouts.app')
@section('title', 'Struktur Organisasi - OSIS SMKN 2')
@section('content')

<div class="py-24 px-4 min-h-screen relative overflow-hidden bg-white/30 dark:bg-neutral-900/30">
    <!-- background decor -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary/5 blur-[120px] -z-10"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent2/5 blur-[120px] -z-10"></div>

    <section class="max-w-7xl mx-auto">
        <div class="text-center mb-20 animate-fade-in">
            <span class="text-accent2 font-bold uppercase tracking-[0.3em] text-xs mb-4 block">Kabinet Kolaborasi</span>
            <h1 class="text-4xl md:text-6xl font-display font-bold text-primary dark:text-white mb-6">Struktur Organisasi</h1>
            <p class="text-ink/60 dark:text-white/40 max-w-2xl mx-auto italic">"Sinergi dalam perbedaan, berpadu dalam satu visi untuk SMKN 2 yang lebih gemilang."</p>
        </div>

        <!-- BPH Section -->
        <div class="mb-24">
            <h2 class="text-2xl font-bold text-center mb-12 dark:text-white relative inline-block left-1/2 -translate-x-1/2">
                Badan Pengurus Harian
                <div class="w-full h-1 bg-accent2 mt-2 rounded-full"></div>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($members->where('department', 'BPH') as $member)
                    <div class="glass p-6 rounded-[2.5rem] border border-white/20 shadow-glass group hover:shadow-glass-hover transition-all animate-fade-in" style="animation-delay: {{ $loop->index * 100 }}ms">
                        <div class="aspect-square rounded-[2rem] overflow-hidden mb-6 relative">
                            <img src="{{ $member->photo_path ? Storage::url($member->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&background=random&size=512' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $member->name }}">
                            @if($member->instagram_url)
                                <a href="{{ $member->instagram_url }}" target="_blank" class="absolute bottom-4 right-4 w-12 h-12 rounded-2xl bg-white/90 dark:bg-neutral-800/90 flex items-center justify-center shadow-lg transform translate-y-20 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all">
                                    <span class="text-xl">📸</span>
                                </a>
                            @endif
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold dark:text-white mb-1">{{ $member->name }}</h3>
                            <p class="text-xs font-bold text-accent2 uppercase tracking-widest">{{ $member->position }}</p>
                            <p class="text-[10px] text-ink/40 dark:text-white/30 mt-2 italic">Masa Bakti {{ $member->period }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Departments Grid -->
        @foreach($members->where('department', '!=', 'BPH')->groupBy('department') as $dept => $deptMembers)
            <div class="mb-20">
                <h3 class="text-xl font-bold mb-10 dark:text-white flex items-center gap-4">
                    <span class="w-8 h-1 bg-primary rounded-full"></span>
                    {{ $dept }}
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($deptMembers as $member)
                        <div class="glass p-5 rounded-3xl border border-white/10 flex items-center gap-6 group hover:bg-white/50 dark:hover:bg-white/5 transition-all">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden shrink-0">
                                <img src="{{ $member->photo_path ? Storage::url($member->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&background=random' }}" class="w-full h-full object-cover" alt="{{ $member->name }}">
                            </div>
                            <div>
                                <h4 class="font-bold dark:text-white text-sm">{{ $member->name }}</h4>
                                <p class="text-[10px] text-primary dark:text-accent2 font-bold uppercase tracking-wider">{{ $member->position }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
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

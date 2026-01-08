@extends('layouts.app')
@section('title', 'Kalender Event - OSIS SMKN 2')
@section('content')

<div class="py-24 px-4 min-h-screen bg-white/40 dark:bg-neutral-900/40">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-between mb-16 gap-6 animate-fade-in">
            <div>
                <h1 class="text-4xl font-display font-bold text-primary dark:text-white">Kalender Kegiatan</h1>
                <p class="text-ink/60 dark:text-white/40 italic">Jadwal lengkap aktivitas dan agenda OSIS.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="glass px-6 py-2 rounded-full font-bold dark:text-white">
                    {{ now()->translatedFormat('F Y') }}
                </div>
            </div>
        </div>

        @php
            $currentMonth = now();
            $startOfMonth = $currentMonth->copy()->startOfMonth();
            $endOfMonth = $currentMonth->copy()->endOfMonth();
            $calendarStart = $startOfMonth->copy()->startOfWeek();
            $calendarEnd = $endOfMonth->copy()->endOfWeek();
            
            $days = [];
            $currentDate = $calendarStart->copy();
            while($currentDate <= $calendarEnd) {
                $days[] = $currentDate->copy();
                $currentDate->addDay();
            }
        @endphp

        <div class="glass rounded-[3rem] overflow-hidden border border-white/20 shadow-2xl animate-fade-in" style="animation-delay: 200ms">
            <!-- Web Header -->
            <div class="grid grid-cols-7 bg-primary text-white text-center font-bold text-xs uppercase tracking-[0.2em] py-4">
                @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $dayName)
                    <div>{{ $dayName }}</div>
                @endforeach
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 border-t border-black/5 dark:border-white/5">
                @foreach($days as $day)
                    @php
                        $dayEvents = $events->filter(fn($e) => $e->start_at && $e->start_at->isSameDay($day));
                        $isCurrentMonth = $day->month === $currentMonth->month;
                        $isToday = $day->isToday();
                    @endphp
                    <div class="min-h-[140px] p-4 border-r border-b border-black/5 dark:border-white/5 {{ $isCurrentMonth ? '' : 'bg-black/[0.02] dark:bg-white/[0.02]' }} relative group transition-colors hover:bg-white/50 dark:hover:bg-white/5">
                        <span class="text-xs font-bold {{ $isToday ? 'bg-primary text-white w-7 h-7 flex items-center justify-center rounded-full' : ($isCurrentMonth ? 'text-ink/80 dark:text-white' : 'text-ink/30 dark:text-white/20') }}">
                            {{ $day->day }}
                        </span>

                        <div class="mt-4 space-y-1.5">
                            @foreach($dayEvents as $ev)
                                <a href="{{ route('event.show', $ev) }}" class="block px-2 py-1 rounded-lg bg-accent2/10 border border-accent2/20 text-[9px] font-bold text-accent2 truncate hover:bg-accent2 hover:text-white transition-all" title="{{ $ev->title }}">
                                    {{ $ev->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Legend or Notes -->
        <div class="mt-12 grid md:grid-cols-3 gap-8 animate-fade-in" style="animation-delay: 400ms">
            <div class="glass p-8 rounded-[2.5rem] border border-white/20">
                <h4 class="font-bold dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent2"></span>
                    Event Mendatang
                </h4>
                <div class="space-y-4">
                    @forelse($events->where('start_at', '>', now())->take(3) as $ev)
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm font-medium dark:text-white/80 line-clamp-1">{{ $ev->title }}</span>
                            <span class="shrink-0 text-[10px] font-bold text-accent2">{{ $ev->start_at->format('d M') }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-ink/40 dark:text-white/30 italic">Tidak ada event terjadwal.</p>
                    @endforelse
                </div>
            </div>

            <div class="md:col-span-2 glass p-8 rounded-[2.5rem] border border-white/20 bg-primary/5">
                <h4 class="font-bold dark:text-white mb-4">Tips & Info</h4>
                <p class="text-sm text-ink/60 dark:text-white/50 leading-relaxed italic">"Kalender ini berisi agenda resmi OSIS SMKN 2 Pangkalpinang. Jika kamu memiliki ide kegiatan, sampaikan melalui Kotak Aspirasi!"</p>
            </div>
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

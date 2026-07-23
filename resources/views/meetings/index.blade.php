@extends('layouts.app')

@section('title', 'Presensi & Notulensi Rapat OSIS • SMKN 2')

@section('content')
<div class="min-h-screen py-16 px-4 max-w-7xl mx-auto">
    <div class="mb-12 text-center">
        <span class="text-xs font-black uppercase tracking-widest text-primary bg-primary/10 px-3 py-1 rounded-full">Internal Executive Board</span>
        <h1 class="text-4xl md:text-6xl font-display font-bold text-primary dark:text-white mt-4 mb-2">Presensi & Notulensi <span class="text-accent2">Rapat</span></h1>
        <p class="text-ink/60 dark:text-white/60 text-sm max-w-md mx-auto">Sistem presensi digital rapat pengurus OSIS dan arsip catatan notulensi transparan.</p>
    </div>

    <div class="space-y-8">
        @if(count($meetings) > 0)
            @foreach($meetings as $m)
                <div class="glass rounded-3xl p-8 shadow-xl border border-white/20 grid md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-2 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black uppercase tracking-widest bg-accent/20 text-accent px-2.5 py-0.5 rounded-full">{{ $m->location }}</span>
                            <span class="text-[10px] text-ink/60 dark:text-white/60 font-mono">{{ $m->meeting_date->format('d M Y • H:i') }} WIB</span>
                        </div>
                        <h3 class="text-2xl font-bold text-primary dark:text-white">{{ $m->title }}</h3>
                        <p class="text-xs text-ink/70 dark:text-white/70 leading-relaxed">{{ $m->agenda }}</p>
                        
                        <div class="pt-2 flex items-center gap-4 text-xs font-bold">
                            <span>👥 {{ $m->attendances_count }} Anggota Hadir</span>
                        </div>
                    </div>

                    <div class="glass p-6 rounded-2xl border border-white/10 space-y-4">
                        <div class="text-xs font-bold uppercase tracking-wider text-center">Input Presensi Rapat</div>
                        <form action="{{ route('meetings.attend', $m) }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="text" name="member_name" value="{{ auth()->user()->name ?? '' }}" required placeholder="Nama Pengurus OSIS" class="w-full glass rounded-xl p-2.5 text-xs border border-white/20">
                            <input type="text" name="position" placeholder="Jabatan / Sekbid" class="w-full glass rounded-xl p-2.5 text-xs border border-white/20">
                            <input type="password" name="passcode" maxlength="6" required placeholder="PIN Rapat (6-digit)" class="w-full glass rounded-xl p-2.5 text-xs border border-white/20 font-mono text-center">
                            <button type="submit" onclick="window.fireConfetti()" class="w-full bg-primary text-white font-bold py-2.5 rounded-xl text-xs hover:bg-primary2 transition shadow-md">
                                Confirm Attendance ✍️
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Demo Sample Meeting -->
            <div class="glass rounded-3xl p-8 shadow-xl border border-white/20 grid md:grid-cols-3 gap-8 items-center">
                <div class="md:col-span-2 space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-black uppercase tracking-widest bg-accent/20 text-accent px-2.5 py-0.5 rounded-full">Ruang Sekretariat OSIS</span>
                        <span class="text-[10px] text-ink/60 dark:text-white/60 font-mono">{{ date('d M Y') }} • 14:00 WIB</span>
                    </div>
                    <h3 class="text-2xl font-bold text-primary dark:text-white">Rapat Pleno Koordinasi SINTESA & Classmeeting</h3>
                    <p class="text-xs text-ink/70 dark:text-white/70 leading-relaxed">Pembahasan final pembagian tugas sekbid, penyusunan anggaran kegiatan, dan simulasi alur acara.</p>
                    
                    <div class="pt-2 flex items-center gap-4 text-xs font-bold">
                        <span>👥 24 Anggota BPH Hadir</span>
                    </div>
                </div>

                <div class="glass p-6 rounded-2xl border border-white/10 space-y-4">
                    <div class="text-xs font-bold uppercase tracking-wider text-center">Input Presensi Rapat</div>
                    <div class="space-y-3">
                        <input type="text" disabled value="Demo Rapat Executive" class="w-full glass rounded-xl p-2.5 text-xs border border-white/20 opacity-70">
                        <input type="password" disabled value="123456" class="w-full glass rounded-xl p-2.5 text-xs border border-white/20 font-mono text-center opacity-70">
                        <button disabled class="w-full bg-primary text-white font-bold py-2.5 rounded-xl text-xs opacity-80 cursor-not-allowed">
                            Presensi Aktif
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

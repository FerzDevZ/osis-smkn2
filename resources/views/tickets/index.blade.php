@extends('layouts.app')

@section('title', 'E-Pass Tiket Digital Event • OSIS SMKN 2')

@section('content')
<div class="min-h-screen py-16 px-4 max-w-7xl mx-auto">
    <div class="mb-12 text-center">
        <span class="text-xs font-black uppercase tracking-widest text-primary bg-primary/10 px-3 py-1 rounded-full">Digital E-Pass</span>
        <h1 class="text-4xl md:text-6xl font-display font-bold text-primary dark:text-white mt-4 mb-2">Tiket Event <span class="text-accent2">Sekolah</span></h1>
        <p class="text-ink/60 dark:text-white/60 text-sm max-w-md mx-auto">Klaim E-Pass tiket acara sekolah (Classmeeting, SINTESA, Pensi) dengan verifikasi QR Code resmi.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Klaim Tiket Form -->
        <div class="glass rounded-3xl p-8 shadow-xl border border-white/20">
            <h3 class="font-bold text-lg mb-4 text-primary dark:text-white">Klaim Tiket Event Baru</h3>
            <form action="{{ route('tickets.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold mb-2">Pilih Event</label>
                    <select name="event_id" required class="w-full glass rounded-xl p-3 text-xs border border-white/20 focus:ring-primary">
                        @foreach($events as $ev)
                            <option value="{{ $ev->id }}" class="bg-neutral-900 text-white">{{ $ev->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold mb-2">Nama Pemegang Tiket</label>
                    <input type="text" name="holder_name" value="{{ auth()->user()->name ?? '' }}" required class="w-full glass rounded-xl p-3 text-xs border border-white/20" placeholder="Nama Lengkap Siswa">
                </div>
                <div>
                    <label class="block text-xs font-bold mb-2">NISN Siswa (Opsional)</label>
                    <input type="text" name="holder_nisn" class="w-full glass rounded-xl p-3 text-xs border border-white/20" placeholder="00XXXXXXXX">
                </div>
                <button type="submit" onclick="window.fireConfetti()" class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary2 transition text-xs shadow-md">
                    Dapatkan E-Pass Tiket 🎟️
                </button>
            </form>
        </div>

        <!-- Daftar Tiket Saya -->
        <div class="md:col-span-2 space-y-4">
            <h3 class="font-bold text-lg mb-4 text-primary dark:text-white">Koleksi E-Pass Tiket Saya</h3>
            
            @if(count($tickets) > 0)
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach($tickets as $t)
                        <div class="glass rounded-3xl p-6 border border-white/20 relative overflow-hidden group hover:scale-[1.02] transition-all shadow-lg">
                            <div class="absolute top-0 right-0 bg-primary text-white text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-bl-2xl">
                                {{ strtoupper($t->status) }}
                            </div>
                            <div class="text-xs font-black text-accent uppercase tracking-widest mb-1">{{ $t->event->title ?? 'Event SMKN 2' }}</div>
                            <div class="font-bold text-base text-primary dark:text-white mb-4">{{ $t->holder_name }}</div>
                            
                            <div class="flex items-center justify-between border-t border-white/10 pt-4 mt-4">
                                <div class="font-mono text-xs font-bold text-ink/70 dark:text-white/70">{{ $t->ticket_code }}</div>
                                <div class="w-10 h-10 bg-white rounded-xl p-1 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Demo Sample Ticket -->
                <div class="glass rounded-3xl p-8 border border-white/20 text-center space-y-4">
                    <div class="w-16 h-16 rounded-full bg-accent/10 text-accent mx-auto flex items-center justify-center text-2xl font-bold">🎟️</div>
                    <h4 class="font-bold text-base">Belum Ada Tiket Dimiliki</h4>
                    <p class="text-xs text-ink/60 dark:text-white/40 max-w-sm mx-auto">Pilih event aktif di form sebelah kiri untuk mengklaim tiket E-Pass resmi kamu!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

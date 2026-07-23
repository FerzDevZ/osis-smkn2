@extends('layouts.app')

@section('title', 'Ruang Konseling & Helpdesk Privat • OSIS SMKN 2')

@section('content')
<div class="min-h-screen py-16 px-4 max-w-4xl mx-auto">
    <div class="mb-12 text-center">
        <span class="text-xs font-black uppercase tracking-widest text-accent bg-accent/10 px-3 py-1 rounded-full">Safe & Confidential Space</span>
        <h1 class="text-4xl md:text-6xl font-display font-bold text-primary dark:text-white mt-4 mb-2">Ruang Konseling <span class="text-accent2">Privat</span></h1>
        <p class="text-ink/60 dark:text-white/60 text-sm max-w-lg mx-auto">Wadah konsultasi privat, aduan perundungan (*anti-bullying helpline*), serta keluh kesah siswa kepada Pembina OSIS & Guru BK secara rahasia.</p>
    </div>

    <div class="glass rounded-3xl p-8 md:p-12 shadow-2xl border border-white/20">
        <form action="{{ route('counseling.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider mb-2">Subjek / Topik Konseling</label>
                <input type="text" name="subject" required class="w-full glass rounded-2xl p-4 text-xs font-medium border border-white/20" placeholder="Misal: Masalah Akademik / Keluhan Lingkungan Sekolah / Aduan Privat">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider mb-2">Pesan & Cerita Lengkap</label>
                <textarea name="message" rows="5" required class="w-full glass rounded-2xl p-4 text-xs font-medium border border-white/20" placeholder="Ceritakan apa yang sedang kamu alami secara bebas dan aman. Kerahasiaan identitas kamu terjamin."></textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider mb-2">Nomor WhatsApp (Opsional)</label>
                    <input type="text" name="contact_phone" class="w-full glass rounded-2xl p-4 text-xs font-medium border border-white/20" placeholder="08XXXXXXXXXX (Untuk balasan langsung)">
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_anonymous" value="1" class="w-5 h-5 rounded text-accent focus:ring-accent">
                        <div>
                            <span class="text-xs font-bold block">Kirim Sebagai Anonim</span>
                            <span class="text-[10px] text-ink/60 dark:text-white/40">Sembunyikan identitas nama akun saya</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                <div class="text-[10px] text-ink/60 dark:text-white/40 flex items-center gap-2">
                    <span>🔒</span> Terdekripsi & Dijamin Privasinya oleh Pembina OSIS
                </div>
                <button type="submit" onclick="window.fireConfetti()" class="bg-accent text-neutral-950 font-bold px-8 py-4 rounded-full hover:bg-opacity-90 transition shadow-lg text-xs uppercase tracking-wider">
                    Kirim Pesan Konseling ✉️
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

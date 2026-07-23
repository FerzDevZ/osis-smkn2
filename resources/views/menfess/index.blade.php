@extends('layouts.app')

@section('title', 'Menfess OSIS SMKN 2 - Pesan Rahasia')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-20">
    <div class="text-center mb-12 animate-fade-in">
        <h1 class="font-display font-bold text-4xl md:text-5xl mb-4 text-primary">OSIS <span class="text-accent">Menfess</span></h1>
        <p class="text-text-muted">Kirimkan pesan semangat, salam, atau shoutout secara rahasia. Semua pesan dimoderasi admin.</p>
    </div>

    <!-- Form Section -->
    <div class="glass p-8 rounded-3xl mb-16 shadow-xl border-white/20 animate-fade-in" style="animation-delay: 200ms">
        <form action="{{ route('menfess.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-sm font-bold mb-2 text-primary">Tulis Pesanmu...</label>
                <textarea name="content" id="content" rows="4" maxlength="500" class="w-full glass border-white/30 rounded-2xl p-4 text-sm focus:ring-accent focus:border-accent transition" placeholder="Contoh: Semangat buat kakak sekbid 9 yang lagi dekor pensi!"></textarea>
                <div class="text-right text-[10px] text-text-muted mt-1" x-data="{ count: 0 }" x-init="$el.parentElement.querySelector('textarea').addEventListener('input', e => count = e.target.value.length)"><span x-text="count">0</span>/500</div>
            </div>
            <button type="submit" class="w-full bg-primary hover:opacity-90 text-white font-bold py-4 rounded-2xl shadow-lg transition transform hover:-translate-y-1">Kirim Pesan Sekarang</button>
        </form>
    </div>

    <!-- Messages List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($messages as $msg)
            <div class="glass p-6 rounded-2xl border-white/20 shadow-sm hover:shadow-md transition animate-fade-in" style="animation-delay: {{ 300 + ($loop->index * 50) }}ms">
                <div class="text-xs text-accent font-bold mb-2">#MENFESS-{{ $msg->id }}</div>
                <p class="text-sm leading-relaxed mb-4 italic text-text">"{{ $msg->content }}"</p>
                <div class="text-[10px] text-text-muted flex justify-between items-center">
                    <span>{{ $msg->created_at->diffForHumans() }}</span>
                    <span class="bg-primary/5 px-2 py-1 rounded-full">via OSIS Portal</span>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10 text-text-muted italic">Belum ada pesan menfess yang disetujui. Jadi yang pertama mengirim!</div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $messages->links() }}
    </div>
</div>
@endsection

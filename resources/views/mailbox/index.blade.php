@extends('layouts.app')
@section('title', 'Moderasi Kotak Surat - OSIS SMKN 2')
@section('content')
<div class="py-12 px-4 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="mb-10 animate-fade-in text-center md:text-left flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-2">Moderasi <span class="text-accent2">Kotak Surat</span></h1>
                <p class="text-ink/60 dark:text-white/40 font-medium italic">Tinjau aspirasi siswa dan pilih pesan terbaik untuk ditampilkan di halaman depan.</p>
            </div>
            <div class="glass px-6 py-3 rounded-2xl text-xs font-bold dark:text-white flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-accent2 animate-pulse"></span>
                {{ $messages->total() }} Aspirasi Masuk
            </div>
        </div>

        @if(session('status'))
            <div class="mb-8 animate-fade-in glass border-l-4 border-l-green-500 p-4 rounded-2xl flex items-center gap-4 text-sm font-bold text-green-700 dark:text-green-400">
                <span>✅</span> {{ session('status') }}
            </div>
        @endif

        <div class="space-y-8 animate-fade-in" style="animation-delay: 100ms;">
            @forelse($messages as $m)
                <div class="glass rounded-[2rem] p-8 md:p-10 border border-white/20 shadow-glass hover:shadow-glass-hover transition-all relative group">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Message Info -->
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-6">
                                <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest">{{ $m->category }}</span>
                                <span class="text-[10px] font-bold text-ink/40 dark:text-white/30 uppercase tracking-widest">{{ $m->created_at->format('d M Y, H:i') }}</span>
                                
                                @if($m->is_public)
                                    <span class="px-3 py-1 rounded-full bg-accent2/10 text-accent2 text-[10px] font-bold uppercase tracking-widest">Aspirasi Publik</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-neutral-100 dark:bg-neutral-800 text-ink/40 text-[10px] font-bold uppercase tracking-widest">Privat</span>
                                @endif
                                
                                <span class="px-3 py-1 rounded-full @if($m->status === 'reviewed') bg-green-500/10 text-green-500 @elseif($m->status === 'archived') bg-neutral-500/10 text-neutral-500 @else bg-orange-500/10 text-orange-500 @endif text-[10px] font-bold uppercase tracking-widest">{{ $m->status }}</span>
                            </div>
                            
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-10 h-10 rounded-full bg-accent1 flex items-center justify-center text-lg">👤</div>
                                <div>
                                    <h4 class="font-bold text-primary dark:text-white">{{ $m->is_anonymous ? 'Anonim' : ($m->student_name ?: '-') }}</h4>
                                    <p class="text-xs text-ink/40 dark:text-white/40 italic">{{ $m->class_name ?: 'Siswa SMKN 2' }}</p>
                                </div>
                            </div>
                            
                            <div class="relative mb-8">
                                <span class="absolute -top-6 -left-4 text-7xl text-primary/5 dark:text-white/5 font-serif font-black pointer-events-none select-none">"</span>
                                <p class="text-ink/80 dark:text-white/80 leading-relaxed italic text-sm md:text-base relative z-10">{{ $m->message }}</p>
                                <div class="mt-4 text-xs text-ink/40 dark:text-white/40 font-mono">Kontak: {{ $m->contact ?: 'Tidak ada' }}</div>
                            </div>
                        </div>

                        <!-- Moderation Form -->
                        <div class="md:w-72 shrink-0 glass bg-white/20 dark:bg-neutral-800/20 p-6 rounded-3xl border border-white/10 self-start">
                            <h5 class="text-xs font-bold uppercase tracking-widest text-primary dark:text-accent2 mb-6 flex items-center gap-2">
                                <span>⚖️</span> Panel Moderasi
                            </h5>
                            <form action="{{ route('kotak.update', $m) }}" method="POST" class="space-y-6">
                                @csrf @method('PATCH')
                                
                                <div>
                                    <label class="block text-[10px] font-bold text-ink/40 dark:text-white/40 uppercase mb-2">Ubah Status</label>
                                    <select name="status" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-xl px-4 py-2 text-xs focus:ring-2 focus:ring-primary transition-all dark:text-white">
                                        @foreach(['pending','reviewed','archived'] as $s)
                                            <option value="{{ $s }}" {{ $m->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative w-10 h-6 bg-neutral-200 dark:bg-neutral-700 rounded-full transition-colors group-has-[:checked]:bg-accent2">
                                        <input type="checkbox" name="is_public" value="1" {{ $m->is_public ? 'checked' : '' }} class="sr-only peer">
                                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 shadow"></div>
                                    </div>
                                    <span class="text-xs font-bold text-ink/60 dark:text-white/60">Tampil Publik</span>
                                </label>

                                <button class="w-full bg-primary text-white py-3 rounded-xl text-xs font-bold uppercase tracking-widest shadow-lg shadow-primary/20 hover:scale-[1.03] active:scale-95 transition-all">Simpan Moderasi</button>
                            </form>

                            <form action="{{ route('kotak.destroy', $m) }}" method="POST" class="mt-6 pt-6 border-t border-black/5 dark:border-white/5" onsubmit="return confirm('Hapus aspirasi ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button class="w-full text-red-500 dark:text-red-400 py-1 text-[10px] font-bold uppercase tracking-widest hover:underline transition-all flex items-center justify-center gap-2">
                                    <span>🗑️</span> Hapus Aspirasi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-24 glass rounded-[3rem] text-center">
                    <div class="text-6xl mb-6">🏝️</div>
                    <h3 class="text-xl font-bold dark:text-white mb-2">Belum ada aspirasi masuk</h3>
                    <p class="text-ink/40 dark:text-white/40 italic">Kotak surat masih kosong untuk saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12 animate-fade-in" style="animation-delay: 300ms;">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection



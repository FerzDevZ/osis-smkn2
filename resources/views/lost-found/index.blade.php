@extends('layouts.app')

@section('title', 'Lost & Found - OSIS SMKN 2')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-20">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6 animate-fade-in">
        <div>
            <h1 class="font-display font-bold text-4xl mb-2 text-primary">Lost <span class="text-accent">&</span> Found</h1>
            <p class="text-text-muted">Pusat informasi barang hilang dan temuan di lingkungan sekolah.</p>
        </div>
        <button @click="$dispatch('open-modal', 'report-item')" class="bg-primary text-white px-8 py-3 rounded-full font-bold shadow-lg hover:opacity-90 transition transform hover:-translate-y-1">Buat Laporan Baru 📢</button>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-4 mb-10 animate-fade-in" style="animation-delay: 100ms">
        <button class="px-6 py-2 rounded-full bg-primary text-white text-xs font-bold shadow-md">Semua</button>
        <button class="px-6 py-2 rounded-full glass border text-xs font-bold hover:bg-white transition">Barang Hilang</button>
        <button class="px-6 py-2 rounded-full glass border text-xs font-bold hover:bg-white transition">Barang Temuan</button>
    </div>

    <!-- Items Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($items as $item)
            <div class="glass rounded-[2.5rem] overflow-hidden border-white/20 shadow-lg hover:shadow-2xl transition-all animate-fade-in flex flex-col" style="animation-delay: {{ 200 + ($loop->index * 50) }}ms">
                <div class="aspect-video relative overflow-hidden bg-primary/5">
                    @if($item->image_path)
                        <img src="{{ Storage::url($item->image_path) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-4xl">📦</div>
                    @endif
                    <div class="absolute top-4 left-4 glass px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $item->type == 'lost' ? 'text-red-500' : 'text-green-500' }}">
                        {{ $item->type == 'lost' ? 'HILANG' : 'TEMUAN' }}
                    </div>
                    @if($item->status == 'resolved')
                        <div class="absolute inset-0 bg-primary/40 backdrop-blur-[2px] flex items-center justify-center">
                            <span class="bg-white text-primary px-6 py-2 rounded-full font-black text-sm rotate-12 shadow-2xl">SUDAH KEMBALI</span>
                        </div>
                    @endif
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-xl font-bold text-primary mb-2">{{ $item->title }}</h3>
                    <p class="text-xs text-text-muted line-clamp-3 mb-6 flex-1">{{ $item->description }}</p>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-black/5">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center">
                                <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-text-muted">{{ $item->reporter->name }}</span>
                        </div>
                        <span class="text-[10px] text-text-muted font-medium italic">{{ $item->created_at->diffForHumans() }}</span>
                    </div>

                    @if($item->status == 'pending' && (Auth::id() == $item->reporter_id || Auth::user()->hasRole('Super Admin')))
                        <form action="{{ route('lost-found.resolve', $item) }}" method="POST" class="mt-4">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full py-2 bg-green-500/10 text-green-600 rounded-xl text-xs font-bold hover:bg-green-500 hover:text-white transition">Tandai Selesai</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Report Modal (Simplified as a Section for now or use real modal if available) -->
    <x-modal name="report-item" focusable>
        <div class="p-8">
            <h2 class="text-2xl font-bold text-primary mb-6">Buat Laporan Barang</h2>
            <form action="{{ route('lost-found.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold mb-2 uppercase tracking-widest text-text-muted">Judul Barang</label>
                        <input type="text" name="title" required class="w-full glass border-white/30 rounded-2xl p-4 text-sm focus:ring-accent" placeholder="Misal: Kunci Motor Beat Hitam">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-2 uppercase tracking-widest text-text-muted">Tipe Laporan</label>
                        <select name="type" required class="w-full glass border-white/30 rounded-2xl p-4 text-sm focus:ring-accent">
                            <option value="lost">Saya Kehilangan</option>
                            <option value="found">Saya Menemukan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-2 uppercase tracking-widest text-text-muted">Deskripsi Detail</label>
                        <textarea name="description" required rows="3" class="w-full glass border-white/30 rounded-2xl p-4 text-sm focus:ring-accent" placeholder="Jelaskan ciri-ciri barang dan lokasi terakhir..."></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-2 uppercase tracking-widest text-text-muted">Foto Barang (Optional)</label>
                        <input type="file" name="image" class="w-full text-xs text-text-muted">
                    </div>
                </div>
                <div class="mt-8 flex gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'report-item')" class="flex-1 py-3 rounded-2xl font-bold text-sm hover:bg-black/5 transition">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-primary text-white rounded-2xl font-bold text-sm shadow-lg hover:opacity-90 transition">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
@endsection

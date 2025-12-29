@extends('layouts.app')
@section('title','Dokumentasi - OSIS SMKN 2 Pangkalpinang')
@section('content')

  <section class="relative py-10 overflow-hidden">
    <div class="absolute inset-0 -z-10 opacity-50" style="background-image:repeating-linear-gradient(135deg, rgba(99,138,85,0.06) 0 14px, rgba(196,141,96,0.06) 14px 28px, transparent 28px 42px);"></div>
    <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-2xl md:text-3xl font-semibold text-primary mb-6">Dokumentasi Kegiatan</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
      @forelse($galleries as $g)
        <a href="{{ route('gallery.show', $g) }}" class="aspect-square overflow-hidden rounded-xl border bg-gray-100 hover:shadow-md transition">
          <img loading="lazy" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition" src="{{ $g->cover_path ? Storage::url($g->cover_path) : 'https://picsum.photos/seed/gallery'.$g->id.'/600/600' }}" alt="{{ $g->title }}">
        </a>
      @empty
        <p class="col-span-full text-gray-600">Belum ada dokumentasi.</p>
      @endforelse
    </div>

    <div class="mt-6">{{ $galleries->links() }}</div>
    </div>
  </section>

@endsection



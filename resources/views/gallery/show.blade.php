@extends('layouts.app')
@section('title', ($gallery->title ?? 'Album'). ' - Dokumentasi')
@section('content')

  <section class="relative py-10 stripe-bg">
    <div class="max-w-5xl mx-auto px-4">
    @include('components.breadcrumb', ['items' => [
      ['label' => 'Beranda', 'url' => route('home')],
      ['label' => 'Dokumentasi', 'url' => route('gallery.index')],
      ['label' => $gallery->title]
    ]])
    <div class="mb-6">
      <a href="{{ route('gallery.index') }}" class="text-sm text-primary hover:underline">← Kembali ke dokumentasi</a>
    </div>
    <h1 class="text-2xl md:text-3xl font-semibold text-primary">{{ $gallery->title }}</h1>
    <div class="text-sm text-gray-500 mt-1">
      {{ optional($gallery->album_date)->format('d M Y') }}
    </div>

    <div class="mt-6 aspect-video rounded-3xl overflow-hidden border border-white/40 bg-gray-100 shadow-lg">
      <img loading="lazy" class="w-full h-full object-cover" src="{{ $gallery->cover_path ? Storage::url($gallery->cover_path) : 'https://picsum.photos/seed/gallery'.$gallery->id.'/1200/675' }}" alt="{{ $gallery->title }}">
    </div>

    @if($gallery->description)
      <div class="prose max-w-none mt-6">{!! nl2br(e($gallery->description)) !!}</div>
    @endif

    @if($gallery->photos->count())
      <h2 class="text-xl font-semibold text-primary mt-8 mb-3">Foto</h2>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach($gallery->photos as $ph)
          <div class="aspect-square rounded overflow-hidden border bg-gray-100">
            <img loading="lazy" class="w-full h-full object-cover" src="{{ Storage::url($ph->image_path) }}" alt="{{ $ph->caption }}">
          </div>
        @endforeach
      </div>
    @endif
  </div>
  </section>

@endsection



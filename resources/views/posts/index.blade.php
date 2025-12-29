@extends('layouts.app')
@section('title','Berita')
@section('content')
<section class="max-w-7xl mx-auto px-4 py-10">
  <h1 class="text-2xl md:text-3xl font-semibold text-primary mb-6">Berita</h1>
  <div class="grid md:grid-cols-3 gap-6">
    @forelse($posts as $p)
      <a href="{{ route('berita.show',$p) }}" class="group border rounded-xl overflow-hidden bg-white dark:bg-neutral-900">
        <div class="aspect-video bg-gray-100">
          @if($p->cover_path)
            <img class="w-full h-full object-cover group-hover:scale-105 transition" src="{{ Storage::url($p->cover_path) }}" alt="{{ $p->title }}">
          @endif
        </div>
        <div class="p-4">
          <div class="text-xs text-gray-500">{{ optional($p->published_at)->format('d M Y') }}</div>
          <h3 class="font-medium mt-1">{{ $p->title }}</h3>
          <p class="text-sm text-gray-600 line-clamp-2">{{ $p->excerpt }}</p>
        </div>
      </a>
    @empty
      <p class="text-gray-600">Belum ada berita.</p>
    @endforelse
  </div>
  <div class="mt-6">{{ $posts->links() }}</div>
  </section>
@endsection



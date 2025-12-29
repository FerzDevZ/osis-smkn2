@extends('layouts.app')
@section('title',$post->title)
@section('content')
@php
  $jsonLd = [
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $post->title,
    'datePublished' => optional($post->published_at)->toIso8601String(),
    'image' => $post->cover_path ? url(Storage::url($post->cover_path)) : null,
    'description' => Str::limit(strip_tags($post->excerpt ?? $post->body), 200),
    'url' => url()->current(),
  ];
@endphp
<script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<section class="max-w-3xl mx-auto px-4 py-10">
  @include('components.breadcrumb', ['items' => [
    ['label' => 'Beranda', 'url' => route('home')],
    ['label' => 'Berita', 'url' => route('berita.index')],
    ['label' => $post->title]
  ]])
  <article class="prose prose-neutral dark:prose-invert">
  <h1>{{ $post->title }}</h1>
  <p class="text-sm text-gray-500">{{ optional($post->published_at)->format('d M Y') }}</p>
  <div class="mt-3 flex gap-3 text-sm">
    @php $shareUrl = urlencode(url()->current()); $text = urlencode($post->title); @endphp
    <a class="underline" href="https://wa.me/?text={{ $text }}%20-%20{{ $shareUrl }}" target="_blank" rel="noopener">Bagikan WhatsApp</a>
    <a class="underline" href="https://twitter.com/intent/tweet?text={{ $text }}&url={{ $shareUrl }}" target="_blank" rel="noopener">Bagikan X</a>
    <button class="underline" onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link disalin');">Salin Link</button>
  </div>
  @if($post->cover_path)
    <img loading="lazy" class="w-full rounded-xl" src="{{ Storage::url($post->cover_path) }}" alt="{{ $post->title }}">
  @endif
  @if($post->excerpt)
    <p><em>{{ $post->excerpt }}</em></p>
  @endif
  <div>{!! nl2br(e($post->body)) !!}</div>
</article>
</section>

@if(isset($related) && $related->count())
<section class="max-w-5xl mx-auto px-4 pb-12">
  <h2 class="text-xl font-semibold text-primary mb-4">Berita Lainnya</h2>
  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach($related as $rp)
      <a href="{{ route('berita.show', $rp) }}" class="border rounded-xl overflow-hidden bg-white block">
        <div class="aspect-video bg-gray-100">
          <img loading="lazy" class="w-full h-full object-cover" src="{{ $rp->cover_path ? Storage::url($rp->cover_path) : 'https://picsum.photos/seed/post'.$rp->id.'/800/450' }}" alt="{{ $rp->title }}">
        </div>
        <div class="p-3">
          <div class="text-xs text-gray-500">{{ optional($rp->published_at)->format('d M Y') }}</div>
          <h3 class="font-medium line-clamp-2">{{ $rp->title }}</h3>
        </div>
      </a>
    @endforeach
  </div>
</section>
@endif
@endsection



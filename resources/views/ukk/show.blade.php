@extends('layouts.app')
@section('title', $item->name)
@section('content')

  <section class="relative py-10 stripe-bg">
    <div class="max-w-5xl mx-auto px-4">
    @include('components.breadcrumb', ['items' => [
      ['label' => 'Beranda', 'url' => route('home')],
      ['label' => 'UKK', 'url' => route('ukk.index')],
      ['label' => $item->name]
    ]])
    <div class="grid md:grid-cols-3 gap-6">
      <div>
        <div class="aspect-[4/5] rounded-3xl overflow-hidden border border-white/40 bg-gray-100 shadow-lg">
          <img loading="lazy" class="w-full h-full object-cover" src="{{ $item->image_path ? Storage::url($item->image_path) : 'https://picsum.photos/seed/ukk'.$item->id.'/600/750' }}" alt="{{ $item->name }}">
        </div>
        @if($item->instagram_url)
          <a href="{{ $item->instagram_url }}" target="_blank" class="mt-3 inline-block text-sm text-white bg-primary hover:bg-primary2 rounded px-3 py-1.5">Instagram</a>
        @endif
      </div>
      <div class="md:col-span-2">
        <h1 class="text-2xl md:text-3xl font-semibold text-primary">{{ $item->name }}</h1>
        @if($item->contact)
          <div class="text-sm text-gray-600 mt-1">Kontak: {{ $item->contact }}</div>
        @endif
        @if($item->description)
          <div class="prose max-w-none mt-4">{!! nl2br(e($item->description)) !!}</div>
        @endif
      </div>
    </div>
  </div>
  </section>

@endsection



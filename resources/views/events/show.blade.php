@extends('layouts.app')
@section('title', ($event->title ?? 'Event'))
@section('content')
  @php
    $jsonLd = [
      '@context' => 'https://schema.org',
      '@type' => 'Event',
      'name' => $event->title,
      'startDate' => optional($event->start_at)->toIso8601String(),
      'endDate' => optional($event->end_at)->toIso8601String(),
      'eventStatus' => 'https://schema.org/EventScheduled',
      'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
      'location' => [ 'name' => $event->location ],
      'image' => $event->cover_path ? url(Storage::url($event->cover_path)) : null,
      'description' => Str::limit(strip_tags($event->description ?? ''), 200),
      'url' => url()->current(),
    ];
  @endphp
  <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

  <section class="relative py-10 stripe-bg">
    <div class="max-w-5xl mx-auto px-4">
    @include('components.breadcrumb', ['items' => [
      ['label' => 'Beranda', 'url' => route('home')],
      ['label' => 'Event', 'url' => route('event.index')],
      ['label' => $event->title]
    ]])
    <div class="mb-6">
      <a href="{{ route('event.index') }}" class="text-sm text-primary hover:underline">← Kembali ke daftar event</a>
    </div>
    @php $isUpcoming = optional($event->start_at) && $event->start_at->isFuture(); @endphp
    <div class="flex items-center gap-2 text-xs text-gray-500">
      <span class="px-2 py-0.5 text-xs rounded bg-white border">{{ $isUpcoming ? 'Mendatang' : 'Selesai' }}</span>
      <span>{{ optional($event->start_at)->format('l, d M Y H:i') }} @if($event->end_at) - {{ optional($event->end_at)->format('d M Y H:i') }} @endif</span>
    </div>
    <h1 class="text-2xl md:text-3xl font-semibold text-primary">{{ $event->title }}</h1>
    @if($event->location)
      <div class="text-sm text-gray-600 mt-1">Tempat: {{ $event->location }}</div>
    @endif

    <div class="mt-6 aspect-video rounded-3xl overflow-hidden border border-white/40 bg-gray-100 shadow-lg">
      <img loading="lazy" class="w-full h-full object-cover" src="{{ $event->cover_path ? Storage::url($event->cover_path) : 'https://picsum.photos/seed/event'.$event->id.'/1200/675' }}" alt="{{ $event->title }}">
    </div>

    <div class="mt-4 flex gap-3 text-sm">
      @php $shareUrl = urlencode(url()->current()); $text = urlencode($event->title); @endphp
      <a class="underline" href="https://wa.me/?text={{ $text }}%20-%20{{ $shareUrl }}" target="_blank" rel="noopener">Bagikan WhatsApp</a>
      <a class="underline" href="https://twitter.com/intent/tweet?text={{ $text }}&url={{ $shareUrl }}" target="_blank" rel="noopener">Bagikan X</a>
      <button class="underline" onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link disalin');">Salin Link</button>
    </div>

    @if($event->description)
      <div class="prose max-w-none mt-6">{!! nl2br(e($event->description)) !!}</div>
    @endif
  </div>
  </section>

  @if(isset($related) && $related->count())
  <section class="max-w-5xl mx-auto px-4 pb-12">
    <h2 class="text-xl font-semibold text-primary mb-4">Event Terkait</h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
      @foreach($related as $ev)
        <a href="{{ route('event.show', $ev) }}" class="border rounded-xl overflow-hidden bg-white block">
          <div class="aspect-video bg-gray-100">
            <img loading="lazy" class="w-full h-full object-cover" src="{{ $ev->cover_path ? Storage::url($ev->cover_path) : 'https://picsum.photos/seed/event'.$ev->id.'/800/450' }}" alt="{{ $ev->title }}">
          </div>
          <div class="p-3">
            <div class="text-xs text-gray-500">{{ optional($ev->start_at)->format('d M Y H:i') }}</div>
            <h3 class="font-medium line-clamp-2">{{ $ev->title }}</h3>
          </div>
        </a>
      @endforeach
    </div>
  </section>
  @endif

@endsection



@extends('layouts.app')
@section('title','Event - OSIS SMKN 2 Pangkalpinang')
@section('content')

  <section class="relative py-10 overflow-hidden">
    <div class="absolute inset-0 -z-10 opacity-50" style="background-image:repeating-linear-gradient(135deg, rgba(99,138,85,0.06) 0 14px, rgba(196,141,96,0.06) 14px 28px, transparent 28px 42px);"></div>
    <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-2xl md:text-3xl font-semibold text-primary mb-6">Daftar Event</h1>

    <form method="get" class="mb-4 flex flex-wrap gap-2 items-center text-sm">
      <span class="text-gray-600 mr-2">Rentang:</span>
      @php $r = request('range'); @endphp
      <a class="px-3 py-1 border rounded {{ $r===null? 'bg-primary text-white' : '' }}" href="{{ route('event.index') }}">Semua</a>
      <a class="px-3 py-1 border rounded {{ $r==='week'? 'bg-primary text-white' : '' }}" href="{{ route('event.index', ['range'=>'week']) }}">Minggu ini</a>
      <a class="px-3 py-1 border rounded {{ $r==='month'? 'bg-primary text-white' : '' }}" href="{{ route('event.index', ['range'=>'month']) }}">Bulan ini</a>
      <a class="px-3 py-1 border rounded {{ $r==='upcoming'? 'bg-primary text-white' : '' }}" href="{{ route('event.index', ['range'=>'upcoming']) }}">Mendatang</a>
      <a class="px-3 py-1 border rounded {{ $r==='past'? 'bg-primary text-white' : '' }}" href="{{ route('event.index', ['range'=>'past']) }}">Sudah lewat</a>
    </form>

    <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
      @forelse($events as $ev)
        <a href="{{ route('event.show', $ev) }}" class="border rounded-xl overflow-hidden bg-white block hover:shadow-md transition">
          <div class="relative aspect-video bg-gray-100">
            @php $isUpcoming = optional($ev->start_at) && $ev->start_at->isFuture(); @endphp
            <span class="absolute top-2 left-2 px-2 py-0.5 text-xs rounded bg-white/90 border">{{ $isUpcoming ? 'Mendatang' : 'Selesai' }}</span>
            <img loading="lazy" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition" src="{{ $ev->cover_path ? Storage::url($ev->cover_path) : 'https://picsum.photos/seed/event'.$ev->id.'/800/450' }}" alt="{{ $ev->title }}">
          </div>
          <div class="p-3">
            <div class="text-xs text-gray-500">{{ optional($ev->start_at)->format('d M Y H:i') }}</div>
            <h3 class="font-medium">{{ $ev->title }}</h3>
            <p class="text-sm text-gray-600 line-clamp-2">{{ $ev->location }}</p>
          </div>
        </a>
      @empty
        <p class="text-gray-600">Belum ada event.</p>
      @endforelse
    </div>

    <div class="mt-6">{{ $events->links() }}</div>
    </div>
  </section>

@endsection



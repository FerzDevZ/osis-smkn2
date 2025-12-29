@extends('layouts.app')
@section('title','Organisasi')
@section('content')

  <section class="relative py-10 overflow-hidden">
    <div class="absolute inset-0 -z-10 opacity-50" style="background-image:repeating-linear-gradient(135deg, rgba(99,138,85,0.06) 0 14px, rgba(196,141,96,0.06) 14px 28px, transparent 28px 42px);"></div>
    <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-2xl md:text-3xl font-semibold text-primary mb-6">Organisasi</h1>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      @forelse($items as $it)
        <a href="{{ route('organization.show', $it) }}" class="border rounded-2xl overflow-hidden bg-white block hover:shadow-md transition">
          <div class="aspect-[4/5] bg-gray-100">
            <img loading="lazy" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition" src="{{ $it->image_path ? Storage::url($it->image_path) : 'https://picsum.photos/seed/org'.$it->id.'/600/750' }}" alt="{{ $it->name }}">
          </div>
          <div class="p-3">
            <h3 class="font-medium line-clamp-1">{{ $it->name }}</h3>
          </div>
        </a>
      @empty
        <p class="text-gray-600">Belum ada data organisasi.</p>
      @endforelse
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
    </div>
  </section>

@endsection



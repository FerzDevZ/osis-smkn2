@extends('layouts.app')
@section('title', ($sekbid->name ?? 'Sekbid'))
@section('meta_description', Str::limit(strip_tags($sekbid->description ?? ''), 150))
@section('og_image', $sekbid->image_path ? Storage::url($sekbid->image_path) : asset('favicon.ico'))
@section('content')

  <section class="max-w-5xl mx-auto px-4 py-10">
    @include('components.breadcrumb', ['items' => [
      ['label' => 'Beranda', 'url' => route('home')],
      ['label' => 'Sekbid', 'url' => route('sekbid.index')],
      ['label' => $sekbid->name]
    ]])
    <div class="mb-6">
      <a href="{{ route('sekbid.index') }}" class="text-sm text-primary hover:underline">← Kembali ke Sekbid</a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      <div class="md:col-span-1">
        <div class="aspect-[4/5] rounded-xl overflow-hidden border bg-gray-100">
          <img loading="lazy" class="w-full h-full object-cover" src="{{ $sekbid->image_path ? Storage::url($sekbid->image_path) : 'https://picsum.photos/seed/sekbid'.$sekbid->id.'/600/750' }}" alt="{{ $sekbid->name }}">
        </div>
        @if($sekbid->instagram_url)
          <a href="{{ $sekbid->instagram_url }}" target="_blank" class="mt-3 inline-block text-sm text-white bg-primary hover:bg-primary2 rounded px-3 py-1.5">Instagram</a>
        @endif
      </div>
      <div class="md:col-span-2">
        <h1 class="text-2xl md:text-3xl font-semibold text-primary">{{ $sekbid->name }}</h1>
        @if($sekbid->description)
          <div class="prose max-w-none mt-4">{!! nl2br(e($sekbid->description)) !!}</div>
        @endif

        @if(isset($sekbid->programs) && is_array($sekbid->programs) && count($sekbid->programs))
          <h2 class="mt-8 text-xl font-semibold text-primary">Program Kerja</h2>
          <ul class="list-disc pl-5 mt-2 space-y-1">
            @foreach($sekbid->programs as $item)
              <li>{{ $item }}</li>
            @endforeach
          </ul>
        @endif
      </div>
    </div>
  </section>

  @if(isset($others) && $others->count())
  <section class="max-w-7xl mx-auto px-4 pb-12">
    <h2 class="text-xl font-semibold text-primary mb-4">Sekbid Lainnya</h2>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      @foreach($others as $s)
        <a href="{{ route('sekbid.show', $s) }}" class="border rounded-2xl overflow-hidden bg-white block">
          <div class="aspect-[4/5] bg-gray-100">
            <img loading="lazy" class="w-full h-full object-cover" src="{{ $s->image_path ? Storage::url($s->image_path) : 'https://picsum.photos/seed/sekbid'.$s->id.'/600/750' }}" alt="{{ $s->name }}">
          </div>
          <div class="p-3">
            <div class="text-xs text-gray-500">Sekbid</div>
            <h3 class="font-medium line-clamp-1">{{ $s->name }}</h3>
          </div>
        </a>
      @endforeach
    </div>
  </section>
  @endif

@endsection



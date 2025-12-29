@extends('layouts.app')
@section('title','Edit Event')
@section('content')

  <section class="relative py-10 stripe-bg">
    <div class="max-w-3xl mx-auto px-4">
    <h1 class="text-2xl font-semibold text-primary mb-6">Edit Event</h1>

    <form action="{{ route('admin.event.update', $event) }}" method="post" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PATCH')
      <div>
        <label class="block text-sm mb-1">Judul</label>
        <input name="title" value="{{ old('title', $event->title) }}" class="w-full border rounded px-3 py-2" required>
        @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="block text-sm mb-1">Deskripsi</label>
        <textarea name="description" rows="6" class="w-full border rounded px-3 py-2">{{ old('description', $event->description) }}</textarea>
      </div>
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm mb-1">Mulai</label>
          <input type="datetime-local" name="start_at" value="{{ old('start_at', optional($event->start_at)->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label class="block text-sm mb-1">Selesai</label>
          <input type="datetime-local" name="end_at" value="{{ old('end_at', optional($event->end_at)->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
        </div>
      </div>
      <div>
        <label class="block text-sm mb-1">Lokasi</label>
        <input name="location" value="{{ old('location', $event->location) }}" class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block text-sm mb-1">Cover (opsional)</label>
        <input type="file" name="cover" accept="image/*">
      </div>
      <div class="flex items-center gap-2">
        <input id="is_published" type="checkbox" name="is_published" value="1" {{ old('is_published', $event->is_published) ? 'checked' : '' }}>
        <label for="is_published" class="text-sm">Publikasikan</label>
      </div>
      <div>
        <button class="bg-primary text-white px-4 py-2 rounded">Update</button>
      </div>
    </form>
  </div>
  </section>

@endsection



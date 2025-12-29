@extends('layouts.app')
@section('title','Edit Album Dokumentasi')
@section('content')

  <section class="relative py-10 stripe-bg">
    <div class="max-w-3xl mx-auto px-4">
    <h1 class="text-2xl font-semibold text-primary mb-6">Edit Album Dokumentasi</h1>

    <form action="{{ route('admin.gallery.update', $gallery) }}" method="post" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PATCH')
      <div>
        <label class="block text-sm mb-1">Judul</label>
        <input name="title" value="{{ old('title', $gallery->title) }}" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm mb-1">Deskripsi</label>
        <textarea name="description" rows="5" class="w-full border rounded px-3 py-2">{{ old('description', $gallery->description) }}</textarea>
      </div>
      <div>
        <label class="block text-sm mb-1">Tanggal Album</label>
        <input type="date" name="album_date" value="{{ old('album_date', optional($gallery->album_date)->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block text-sm mb-1">Cover (opsional)</label>
        <input type="file" name="cover" accept="image/*">
      </div>
      <div>
        <button class="bg-primary text-white px-4 py-2 rounded">Update</button>
      </div>
    </form>

    <hr class="my-8">
    <h2 class="text-xl font-semibold text-primary mb-3">Foto Album</h2>
    <form action="{{ route('admin.gallery.photos.store', $gallery) }}" method="post" enctype="multipart/form-data" class="space-y-3">
      @csrf
      <div>
        <label class="block text-sm mb-1">Tambah Foto (bisa banyak)</label>
        <input type="file" name="photos[]" accept="image/*" multiple>
      </div>
      <button class="bg-primary text-white px-4 py-2 rounded">Upload</button>
    </form>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4">
      @forelse($gallery->photos as $ph)
        <div class="border rounded overflow-hidden">
          <img loading="lazy" class="w-full h-40 object-cover" src="{{ Storage::url($ph->image_path) }}" alt="">
          <div class="p-2 text-right">
            <form action="{{ route('admin.gallery.photos.destroy', [$gallery, $ph]) }}" method="post" onsubmit="return confirm('Hapus foto ini?')">
              @csrf
              @method('DELETE')
              <button class="text-red-600 text-sm">Hapus</button>
            </form>
          </div>
        </div>
      @empty
        <p class="text-sm text-ink/60">Belum ada foto dalam album ini.</p>
      @endforelse
    </div>
  </div>
  </section>

@endsection



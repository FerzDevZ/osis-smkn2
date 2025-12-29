@extends('layouts.app')
@section('title','Buat Album Dokumentasi')
@section('content')

  <section class="relative py-10 stripe-bg">
    <div class="max-w-3xl mx-auto px-4">
    <h1 class="text-2xl font-semibold text-primary mb-6">Buat Album Dokumentasi</h1>

    <form action="{{ route('admin.gallery.store') }}" method="post" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm mb-1">Judul</label>
        <input name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm mb-1">Deskripsi</label>
        <textarea name="description" rows="5" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
      </div>
      <div>
        <label class="block text-sm mb-1">Tanggal Album</label>
        <input type="date" name="album_date" value="{{ old('album_date') }}" class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block text-sm mb-1">Cover</label>
        <input type="file" name="cover" accept="image/*">
      </div>
      <div>
        <button class="bg-primary text-white px-4 py-2 rounded">Simpan</button>
      </div>
    </form>
  </div>
  </section>

@endsection



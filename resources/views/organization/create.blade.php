@extends('layouts.app')
@section('title','Buat Organisasi')
@section('content')

  <section class="relative py-10 stripe-bg">
    <div class="max-w-3xl mx-auto px-4">
    <h1 class="text-2xl font-semibold text-primary mb-6">Buat Organisasi</h1>

    <form action="{{ route('admin.organization.store') }}" method="post" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm mb-1">Nama</label>
        <input name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm mb-1">Slug</label>
        <input name="slug" value="{{ old('slug') }}" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm mb-1">Deskripsi</label>
        <textarea name="description" rows="6" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
      </div>
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm mb-1">Instagram URL</label>
          <input name="instagram_url" value="{{ old('instagram_url') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label class="block text-sm mb-1">Kontak</label>
          <input name="contact" value="{{ old('contact') }}" class="w-full border rounded px-3 py-2">
        </div>
      </div>
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm mb-1">Urutan Tampil</label>
          <input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label class="block text-sm mb-1">Gambar</label>
          <input type="file" name="image" accept="image/*">
        </div>
      </div>
      <div>
        <button class="bg-primary text-white px-4 py-2 rounded">Simpan</button>
      </div>
    </form>
  </div>
  </section>

@endsection



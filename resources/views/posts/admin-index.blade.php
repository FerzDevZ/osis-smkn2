@extends('layouts.app')
@section('title','Admin • Berita')
@section('content')

  <section class="relative py-10 overflow-hidden">
    <div class="absolute inset-0 -z-10 opacity-40" style="background-image:repeating-linear-gradient(135deg, rgba(31,42,68,0.07) 0 18px, rgba(230,182,86,0.09) 18px 36px, transparent 36px 54px);"></div>
    <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-primary">Kelola Berita</h1>
      <div class="flex items-center gap-3">
        <form method="get" class="hidden md:flex items-center gap-2">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul/excerpt..." class="border rounded px-3 py-2">
          <select name="status" class="border rounded px-3 py-2">
            <option value="">Semua</option>
            <option value="draft" {{ request('status')==='draft'?'selected':'' }}>Draft</option>
            <option value="published" {{ request('status')==='published'?'selected':'' }}>Published</option>
          </select>
          <button class="border px-3 py-2 rounded">Filter</button>
        </form>
        <a href="{{ route('admin.berita.create') }}" class="bg-primary text-white px-4 py-2 rounded">+ Buat Berita</a>
      </div>
    </div>

    <div class="overflow-x-auto border border-white/40 rounded-xl bg-white/70 shadow">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Dipublikasi</th>
            <th class="p-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($posts as $p)
            <tr class="border-t">
              <td class="p-3">{{ $p->title }}</td>
              <td class="p-3">{{ strtoupper($p->status) }}</td>
              <td class="p-3">{{ optional($p->published_at)->format('d M Y H:i') }}</td>
              <td class="p-3 text-right space-x-3">
                <form action="{{ route('admin.berita.toggle', $p) }}" method="post" class="inline">
                  @csrf
                  @method('PATCH')
                  <button class="text-blue-600 hover:underline">{{ $p->status === 'published' ? 'Unpublish' : 'Publish' }}</button>
                </form>
                <a href="{{ route('admin.berita.edit', $p) }}" class="text-primary hover:underline">Edit</a>
                <form action="{{ route('admin.berita.destroy', $p) }}" method="post" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td class="p-3" colspan="4">Belum ada data.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
    </div>
  </section>

@endsection



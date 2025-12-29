@extends('layouts.app')
@section('title','Admin • Dokumentasi')
@section('content')

  <section class="relative py-10 overflow-hidden">
    <div class="absolute inset-0 -z-10 opacity-40" style="background-image:repeating-linear-gradient(135deg, rgba(31,42,68,0.07) 0 18px, rgba(230,182,86,0.09) 18px 36px, transparent 36px 54px);"></div>
    <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-primary">Kelola Dokumentasi</h1>
      <div class="flex items-center gap-3">
        <form method="get" class="hidden md:block">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul..." class="border rounded px-3 py-2">
        </form>
        <a href="{{ route('admin.gallery.create') }}" class="bg-primary text-white px-4 py-2 rounded">+ Buat Album</a>
      </div>
    </div>

    <div class="overflow-x-auto border border-white/40 rounded-xl bg-white/70 shadow">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Tanggal</th>
            <th class="p-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($galleries as $g)
            <tr class="border-t">
              <td class="p-3">{{ $g->title }}</td>
              <td class="p-3">{{ optional($g->album_date)->format('d M Y') }}</td>
              <td class="p-3 text-right space-x-3">
                <a href="{{ route('admin.gallery.edit', $g) }}" class="text-primary hover:underline">Edit</a>
                <form action="{{ route('admin.gallery.destroy', $g) }}" method="post" class="inline" onsubmit="return confirm('Hapus album ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td class="p-3" colspan="3">Belum ada data.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">{{ $galleries->links() }}</div>
    </div>
  </section>

@endsection



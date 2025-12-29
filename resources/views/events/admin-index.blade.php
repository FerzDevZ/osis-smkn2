@extends('layouts.app')
@section('title','Admin • Event')
@section('content')

  <section class="relative py-10 overflow-hidden">
    <div class="absolute inset-0 -z-10 opacity-40" style="background-image:repeating-linear-gradient(135deg, rgba(31,42,68,0.07) 0 18px, rgba(230,182,86,0.09) 18px 36px, transparent 36px 54px);"></div>
    <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-primary">Kelola Event</h1>
      <div class="flex items-center gap-3">
        <form method="get" class="hidden md:flex items-center gap-2">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul/lokasi..." class="border rounded px-3 py-2">
          <select name="status" class="border rounded px-3 py-2">
            <option value="">Semua</option>
            <option value="1" {{ request('status')==='1'?'selected':'' }}>Published</option>
            <option value="0" {{ request('status')==='0'?'selected':'' }}>Draft</option>
          </select>
          <button class="border px-3 py-2 rounded">Filter</button>
        </form>
        <a href="{{ route('admin.event.create') }}" class="bg-primary text-white px-4 py-2 rounded">+ Buat Event</a>
      </div>
    </div>

    <div class="overflow-x-auto border border-white/40 rounded-xl bg-white/70 shadow">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Waktu</th>
            <th class="p-3 text-left">Lokasi</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($events as $ev)
            <tr class="border-t">
              <td class="p-3">{{ $ev->title }}</td>
              <td class="p-3">{{ optional($ev->start_at)->format('d M Y H:i') }}</td>
              <td class="p-3">{{ $ev->location }}</td>
              <td class="p-3">{{ $ev->is_published ? 'Published' : 'Draft' }}</td>
              <td class="p-3 text-right space-x-3">
                <form action="{{ route('admin.event.toggle', $ev) }}" method="post" class="inline">
                  @csrf
                  @method('PATCH')
                  <button class="text-blue-600 hover:underline">{{ $ev->is_published ? 'Unpublish' : 'Publish' }}</button>
                </form>
                <a href="{{ route('admin.event.edit', $ev) }}" class="text-primary hover:underline">Edit</a>
                <form action="{{ route('admin.event.destroy', $ev) }}" method="post" class="inline" onsubmit="return confirm('Hapus event ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td class="p-3" colspan="5">Belum ada data.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">{{ $events->links() }}</div>
    </div>
  </section>

@endsection



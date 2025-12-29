@extends('layouts.app')
@section('title','Admin • Sekbid')
@section('content')

  <section class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-primary">Kelola Sekbid</h1>
      <div class="flex items-center gap-3">
        <form method="get" class="hidden md:block">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/slug..." class="border rounded px-3 py-2">
        </form>
        <a href="{{ route('admin.sekbid.create') }}" class="bg-primary text-white px-4 py-2 rounded">+ Buat Sekbid</a>
      </div>
    </div>

    <div class="overflow-x-auto border rounded-xl">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-3 text-left">Urutan</th>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Program Kerja</th>
            <th class="p-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($sekbids as $s)
            <tr class="border-t">
              <td class="p-3">{{ $s->display_order }}</td>
              <td class="p-3">{{ $s->name }}</td>
              <td class="p-3">{{ is_array($s->programs) ? count($s->programs).' item' : '-' }}</td>
              <td class="p-3 text-right space-x-3">
                <a href="{{ route('admin.sekbid.edit', $s) }}" class="text-primary hover:underline">Edit</a>
                <form action="{{ route('admin.sekbid.destroy', $s) }}" method="post" class="inline" onsubmit="return confirm('Hapus sekbid ini?')">
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

    <div class="mt-6">{{ $sekbids->links() }}</div>
  </section>

@endsection



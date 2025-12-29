@extends('layouts.app')
@section('title','Kotak Surat - Admin')
@section('content')
<section class="max-w-7xl mx-auto px-4 py-10">
  <h1 class="text-2xl md:text-3xl font-semibold text-primary mb-6">Kotak Surat</h1>
  @if(session('status'))
    <div class="p-3 rounded bg-green-50 border text-green-700 mb-4">{{ session('status') }}</div>
  @endif
  <div class="overflow-x-auto">
    <table class="w-full text-sm border">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-2 border">Tanggal</th>
          <th class="p-2 border">Kategori</th>
          <th class="p-2 border">Nama</th>
          <th class="p-2 border">Kelas</th>
          <th class="p-2 border">Status</th>
          <th class="p-2 border">Publik</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $m)
          <tr>
            <td class="p-2 border">{{ $m->created_at->format('d M Y H:i') }}</td>
            <td class="p-2 border">{{ strtoupper($m->category) }}</td>
            <td class="p-2 border">{{ $m->is_anonymous ? 'Anonim' : ($m->student_name ?: '-') }}</td>
            <td class="p-2 border">{{ $m->class_name ?: '-' }}</td>
            <td class="p-2 border">{{ $m->status }}</td>
            <td class="p-2 border">{{ $m->is_public ? 'Ya' : 'Tidak' }}</td>
            <td class="p-2 border">
              <details>
                <summary class="cursor-pointer text-primary">Lihat</summary>
                <div class="mt-2 p-2 border rounded bg-white dark:bg-neutral-900">
                  <div class="text-sm text-gray-600">Kontak: {{ $m->contact ?: '-' }}</div>
                  <p class="mt-2 whitespace-pre-wrap">{{ $m->message }}</p>
                  <form method="post" action="{{ route('kotak.update',$m) }}" class="mt-3 flex items-center gap-2">
                    @csrf @method('PATCH')
                    <select name="status" class="border rounded p-1">
                      @foreach(['pending','reviewed','archived'] as $s)
                        <option value="{{ $s }}" {{ $m->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                      @endforeach
                    </select>
                    <label class="flex items-center gap-1 text-sm"><input type="checkbox" name="is_public" value="1" {{ $m->is_public?'checked':'' }}> Publik</label>
                    <button class="bg-primary text-white px-3 py-1 rounded">Simpan</button>
                  </form>
                  <form method="post" action="{{ route('kotak.destroy',$m) }}" class="mt-2" onsubmit="return confirm('Hapus pesan?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Hapus</button>
                  </form>
                </div>
              </details>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-4">{{ $messages->links() }}</div>
  </div>
</section>
@endsection



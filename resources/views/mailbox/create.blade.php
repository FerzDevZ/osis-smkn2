<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kotak Surat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">
  <div class="max-w-xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-semibold text-[#638A55] mb-6">Kotak Surat</h1>
    @if(session('status'))
      <div class="p-3 rounded bg-green-50 border text-green-700 mb-4">{{ session('status') }}</div>
    @endif
    <form method="post" action="{{ route('kotak.store') }}" class="space-y-4">
      @csrf
      <label class="flex items-center gap-2">
        <input type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous')?'checked':'' }}> Anonim
      </label>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
          <label class="block text-sm">Nama</label>
          <input name="student_name" value="{{ old('student_name') }}" class="mt-1 w-full border rounded p-2">
          @error('student_name')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>
        <div>
          <label class="block text-sm">Kelas</label>
          <input name="class_name" value="{{ old('class_name') }}" class="mt-1 w-full border rounded p-2">
        </div>
      </div>
      <div>
        <label class="block text-sm">Kontak (opsional)</label>
        <input name="contact" value="{{ old('contact') }}" class="mt-1 w-full border rounded p-2">
      </div>
      <div>
        <label class="block text-sm">Kategori</label>
        <select name="category" class="mt-1 w-full border rounded p-2">
          <option value="saran">Saran</option>
          <option value="keluhan">Keluhan</option>
          <option value="umum">Umum</option>
        </select>
      </div>
      <div>
        <label class="block text-sm">Pesan</label>
        <textarea name="message" rows="5" class="mt-1 w-full border rounded p-2">{{ old('message') }}</textarea>
        @error('message')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
      </div>
      <label class="flex items-center gap-2">
        <input type="checkbox" name="is_public" value="1" {{ old('is_public')?'checked':'' }}> Izinkan ditampilkan publik (setelah disetujui)
      </label>
      <div class="pt-2">
        <button class="bg-[#638A55] text-white px-4 py-2 rounded">Kirim</button>
      </div>
    </form>
  </div>
</body>
</html>



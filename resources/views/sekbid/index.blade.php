<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Sekbid</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .no-scrollbar::-webkit-scrollbar{display:none}
    .no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
    .scroll-snap-x{scroll-snap-type:x mandatory}
    .snap-center{scroll-snap-align:center}
  </style>
</head>
<body>
  <div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-semibold text-[#638A55] mb-6">Sekretariat Bidang</h1>
    <div class="overflow-x-auto no-scrollbar scroll-snap-x">
      <div class="flex gap-4 pr-4">
        @foreach($sekbids as $item)
          <div class="snap-center shrink-0 w-64">
            <div class="border rounded-2xl overflow-hidden bg-white">
              <div class="aspect-[4/5] bg-gray-100">
                @if($item->image_path)
                  <img src="{{ Storage::url($item->image_path) }}" class="w-full h-full object-cover" alt="{{ $item->name }}">
                @endif
              </div>
              <div class="p-3">
                <div class="text-xs text-gray-500">Sekbid</div>
                <h3 class="font-medium">{{ $item->name }}</h3>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>



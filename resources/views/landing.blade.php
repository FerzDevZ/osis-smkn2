@extends('layouts.app')
@section('title','OSIS SMKN 2 Pangkalpinang')
@section('content')

    <section class="relative overflow-hidden bg-gradient-to-b from-accent2 to-white">
      <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center">
        <div>
          <h1 class="text-3xl md:text-5xl font-bold leading-tight text-primary">Bersama Membangun OSIS yang Adaptif dan Inspiratif</h1>
          <p class="mt-4 text-gray-700">Informasi kegiatan, program Sekbid, dokumentasi, dan ruang aspirasi siswa dalam satu tempat.</p>
          <div class="mt-6 flex gap-3">
            <a href="#sekbid" class="bg-primary text-white px-4 py-2 rounded">Lihat Sekbid</a>
            <a href="{{ route('berita.index') }}" class="border border-primary text-primary px-4 py-2 rounded">Berita</a>
          </div>
        </div>
        <div class="relative">
          <div class="aspect-[4/3] rounded-2xl bg-accent1/40 border border-accent1"></div>
          <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-accent3/60 rounded-xl blur"></div>
          <div class="absolute -top-3 -right-6 w-32 h-32 bg-accent4/40 rounded-2xl blur"></div>
        </div>
      </div>
    </section>

    <section id="org-ukk" class="relative bg-white/60 py-12 overflow-hidden">
      <div class="absolute inset-0 -z-10 opacity-60" style="background-image:repeating-linear-gradient(135deg, rgba(99,138,85,0.06) 0 14px, rgba(196,141,96,0.06) 14px 28px, transparent 28px 42px);"></div>
      <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-center text-xl md:text-2xl tracking-widest font-semibold text-primary mb-6">ORGANISASI DAN UKK LAINNYA</h2>
        <div class="flex flex-wrap justify-center gap-5">
          @foreach($organizations as $org)
            <a href="{{ route('organization.show', $org) }}" class="w-16 h-16 md:w-20 md:h-20 rounded-full border bg-white shadow hover:shadow-md transition flex items-center justify-center overflow-hidden">
              <img loading="lazy" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition" src="{{ $org->image_path ? Storage::url($org->image_path) : 'https://picsum.photos/seed/org'.$org->id.'/200/200' }}" alt="{{ $org->name }}">
            </a>
          @endforeach
          @foreach($ukks as $u)
            <a href="{{ route('ukk.show', $u) }}" class="w-16 h-16 md:w-20 md:h-20 rounded-full border bg-white shadow hover:shadow-md transition flex items-center justify-center overflow-hidden">
              <img loading="lazy" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition" src="{{ $u->image_path ? Storage::url($u->image_path) : 'https://picsum.photos/seed/ukk'.$u->id.'/200/200' }}" alt="{{ $u->name }}">
            </a>
          @endforeach
        </div>
      </div>
    </section>

    <section id="event" class="relative py-14 overflow-hidden">
      <div class="absolute inset-0 -z-10 opacity-50" style="background-image:repeating-linear-gradient(135deg, rgba(99,138,85,0.06) 0 14px, rgba(196,141,96,0.06) 14px 28px, transparent 28px 42px);"></div>
      <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-end justify-between mb-6">
        <h2 class="text-2xl md:text-3xl font-semibold text-primary">Event Terdekat</h2>
        <a href="{{ route('event.index') }}" class="text-sm text-primary hover:underline">Lihat semua</a>
      </div>
      <div class="grid md:grid-cols-4 gap-4">
        @forelse($upcoming as $ev)
          <a href="{{ route('event.show', $ev) }}" class="border rounded-xl overflow-hidden bg-white block hover:shadow-md transition">
            <div class="relative aspect-video bg-gray-100">
              @php $isUpcoming = optional($ev->start_at) && $ev->start_at->isFuture(); @endphp
              <span class="absolute top-2 left-2 px-2 py-0.5 text-xs rounded bg-white/90 border">{{ $isUpcoming ? 'Mendatang' : 'Selesai' }}</span>
              <img loading="lazy" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition" src="{{ $ev->cover_path ? Storage::url($ev->cover_path) : 'https://picsum.photos/seed/event'.$ev->id.'/800/450' }}" alt="{{ $ev->title }}">
            </div>
            <div class="p-3">
              <div class="text-xs text-gray-500">{{ optional($ev->start_at)->format('d M Y H:i') }}</div>
              <h3 class="font-medium">{{ $ev->title }}</h3>
              <p class="text-sm text-gray-600 line-clamp-2">{{ $ev->location }}</p>
            </div>
          </a>
        @empty
          <p class="text-gray-600">Belum ada event.</p>
        @endforelse
      </div>
      </div>
    </section>

    <section id="sekbid" class="bg-accent2/30 py-14">
      <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-4">
          <h2 class="text-2xl md:text-3xl font-semibold text-primary">Sekretariat Bidang</h2>
          <a href="{{ route('sekbid.index') }}" class="text-sm text-primary hover:underline">Lihat semua</a>
        </div>
        <div x-data="sekbidScroll()" class="relative">
          <div class="overflow-x-auto no-scrollbar scroll-snap-x" x-ref="track">
            <div class="flex gap-4 pr-4">
              @foreach($sekbids as $item)
                <a href="{{ $item->instagram_url ?: '#' }}" target="_blank" class="snap-center shrink-0 w-64">
                  <div class="group border rounded-2xl overflow-hidden bg-white hover:shadow-lg transition">
                    <div class="aspect-[4/5] bg-gray-100 overflow-hidden">
                      <img loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition" src="{{ $item->image_path ? Storage::url($item->image_path) : 'https://picsum.photos/seed/sekbid'.$item->id.'/600/750' }}" alt="{{ $item->name }}">
                    </div>
                    <div class="p-3">
                      <div class="text-xs text-gray-500">Sekbid</div>
                      <h3 class="font-medium">{{ $item->name }}</h3>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
          <div class="absolute inset-y-0 left-0 flex items-center">
            <button @click="scrollBy(-1)" class="bg-white/90 border rounded-full p-2 shadow">‹</button>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center">
            <button @click="scrollBy(1)" class="bg-white/90 border rounded-full p-2 shadow">›</button>
          </div>
        </div>
      </div>
    </section>

    <section id="dokumentasi" class="relative py-14 overflow-hidden">
      <div class="absolute inset-0 -z-10 opacity-50" style="background-image:repeating-linear-gradient(135deg, rgba(99,138,85,0.06) 0 14px, rgba(196,141,96,0.06) 14px 28px, transparent 28px 42px);"></div>
      <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-end justify-between mb-6">
        <h2 class="text-2xl md:text-3xl font-semibold text-primary">Dokumentasi</h2>
        <a href="{{ route('gallery.index') }}" class="text-sm text-primary hover:underline">Lihat semua</a>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
        @foreach($galleries as $g)
          <div class="aspect-square overflow-hidden rounded-xl border bg-gray-100 hover:shadow-md transition">
            <img loading="lazy" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition" src="{{ $g->cover_path ? Storage::url($g->cover_path) : 'https://picsum.photos/seed/gallery'.$g->id.'/600/600' }}" alt="{{ $g->title }}">
          </div>
        @endforeach
      </div>
      </div>
    </section>

    <section id="tentang" class="bg-white py-14">
      <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">
        <div>
          <h2 class="text-2xl md:text-3xl font-semibold text-primary">Tentang OSIS</h2>
          <p class="mt-3 text-gray-700">OSIS SMKN 2 Pangkalpinang menjadi wadah pengembangan potensi siswa melalui program kerja setiap Sekbid, berlandaskan nilai kolaborasi, kreativitas, dan kebermanfaatan.</p>
        </div>
        <div class="aspect-video rounded-xl bg-accent1/30 border"></div>
      </div>
    </section>
    <script>
      function sekbidScroll(){
        return {
          scrollBy(dir){
            const el = this.$refs.track;
            el.scrollBy({ left: dir * 320, behavior: 'smooth' });
          }
        }
      }
    </script>
@endsection



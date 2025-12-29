@php header('Content-Type: application/xml'); @endphp
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc>{{ url('/') }}</loc></url>
  <url><loc>{{ route('event.index') }}</loc></url>
  <url><loc>{{ route('berita.index') }}</loc></url>
  <url><loc>{{ route('gallery.index') }}</loc></url>
  <url><loc>{{ route('sekbid.index') }}</loc></url>
  @foreach($posts as $p)
    <url>
      <loc>{{ route('berita.show', $p) }}</loc>
      @if($p->updated_at)<lastmod>{{ $p->updated_at->toAtomString() }}</lastmod>@endif
    </url>
  @endforeach
  @foreach($events as $e)
    <url>
      <loc>{{ route('event.show', $e) }}</loc>
      @if($e->updated_at)<lastmod>{{ $e->updated_at->toAtomString() }}</lastmod>@endif
    </url>
  @endforeach
  @foreach($sekbids as $s)
    <url>
      <loc>{{ route('sekbid.show', $s) }}</loc>
      @if($s->updated_at)<lastmod>{{ $s->updated_at->toAtomString() }}</lastmod>@endif
    </url>
  @endforeach
  @foreach($galleries as $g)
    <url>
      <loc>{{ route('gallery.show', $g) }}</loc>
      @if($g->updated_at)<lastmod>{{ $g->updated_at->toAtomString() }}</lastmod>@endif
    </url>
  @endforeach
</urlset>



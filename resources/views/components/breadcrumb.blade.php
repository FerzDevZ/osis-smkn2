<nav class="text-sm text-gray-600 mb-4" aria-label="Breadcrumb">
    <ol class="flex flex-wrap gap-1 items-center">
        @foreach($items as $i => $item)
            @if($i > 0)
                <li>/</li>
            @endif
            <li>
                @if(!empty($item['url']))
                    <a href="{{ $item['url'] }}" class="hover:underline">{{ $item['label'] }}</a>
                @else
                    <span class="text-gray-800">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
  </nav>



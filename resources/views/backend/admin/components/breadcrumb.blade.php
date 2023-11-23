<nav class="mt-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach (@$data['breadcrumbs'] as $item)
            @if ($item['route'] != '')
                <li class="breadcrumb-item"><a class="text-info"
                        href="{{ route($item['route']) }}">{{ $item['title'] }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $item['title'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
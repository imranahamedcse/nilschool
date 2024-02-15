<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="fw-semibold text-dark m-0">
            {{ $data['title'] }}
        </h6>
        <nav class="mt-3 h6 m-0" aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach (@$data['breadcrumbs'] as $item)
                    @if ($item['route'] != '')
                        <li class="breadcrumb-item"><a class="link-underline link-underline-opacity-0 text-primary"
                                href="{{ route($item['route']) }}">{{ $item['title'] }}</a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $item['title'] }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</div>

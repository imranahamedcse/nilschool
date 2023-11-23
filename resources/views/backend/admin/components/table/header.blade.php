<div class="row justify-content-between border-bottom pb-4 mb-4">
    <div class="col-6 align-self-center">
        <h4 class="m-0">{{ @$data['headers']['title'] }}</h4>
    </div>
    <div class="col-6 text-end">
        @if (hasPermission(@$data['headers']['permission']))
            <a class="btn btn-sm btn-info" href="{{ route(@$data['headers']['create-route']) }}">
                <i class="fa-solid fa-plus"></i> {{ ___('common.add') }}
            </a>
        @endif
    </div>
</div>
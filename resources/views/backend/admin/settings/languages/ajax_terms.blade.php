@foreach($data['terms'] as $key => $row)
    <div class="row mb-3">
        <div class="col-md-6">
            <input class="form-control" name="name" value="{{ $key }}" disabled>
        </div>
        <div class="col-md-6">
            <input class="form-control" placeholder="{{ ___('common.translated_language') }}" name="{{ $key }}" value="{{ $row }}">
        </div>
    </div>
@endforeach

<div class="row justify-content-between border-bottom pb-4 mb-4">
    <div class="col-3 align-self-center">
        <h4 class="m-0">{{ @$data['headers']['title'] }}</h4>
    </div>

    <div class="col-6 d-flex justify-content-center align-items-center">
        @if (@$data['headers']['filter'] != '')
            <form action="{{ route(@$data['headers']['filter'][0]) }}" method="post" id="marksheet" class="exam_assign"
                enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div>
                        @if (in_array('class', @$data['headers']['filter']))
                            <select id="getSections" class="class @error('class') is-invalid @enderror" name="class">
                                <option value="">{{ ___('student_info.select_class') }} </option>
                                @foreach ($data['classes'] as $item)
                                    <option value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                    <div>
                        @if (in_array('section', @$data['headers']['filter']))
                            <select class="sections @error('section') is-invalid @enderror" name="section">
                                <option value="">{{ ___('student_info.select_section') }} </option>
                            </select>
                            @error('section')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                    <button class="btn btn-primary" type="submit">
                        {{ ___('common.Search') }}
                    </button>
                </div>
            </form>
        @endif
    </div>
    <div class="col-3 text-end">
        @if (@$data['headers']['create-permission'] != '' && hasPermission(@$data['headers']['create-permission']))
            <a class="btn btn-sm btn-secondary" href="{{ route(@$data['headers']['create-route']) }}">
                <i class="fa-solid fa-plus"></i> {{ ___('common.add') }}
            </a>
        @endif
    </div>
</div>

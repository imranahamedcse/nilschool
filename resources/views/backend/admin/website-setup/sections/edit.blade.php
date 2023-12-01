@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ ___('website.Key') }}: {{ @$data['sections']->key }}</h4>
            </div>

            <form action="{{ route('sections.update', @$data['sections']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            @if (@$data['sections']->name)
                                <div class="col-md-6 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('common.name') }}</label>
                                    <input class="form-control ot-input @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', @$data['sections']->name) }}" list="datalistOptions"
                                        id="exampleDataList" placeholder="{{ ___('common.enter_name') }}">
                                    @error('name')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif

                            @if (@$data['sections']->upload_id)
                                <div class="col-md-6 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('common.image') }}

                                        @if (@$data['sections']->key == 'statement')
                                            {{ ___('common.(580 x 465 px)') }}
                                        @elseif(@$data['sections']->key == 'study_at')
                                            {{ ___('common.(1920 x 615 px)') }}
                                        @elseif(@$data['sections']->key == 'explore')
                                            {{ ___('common.(700 x 500 px)') }}
                                        @endif

                                    </label>
                                    <input type="file" class="form-control" name="image" accept="image/*"
                                        id="fileBrouse">
                                </div>
                            @endif

                            @if (@$data['sections']->description)
                                <div class="col-md-12 mb-3">
                                    <label for="exampleDataList" class="form-label">{{ ___('common.Description') }}</label>
                                    <textarea class="form-control ot-textarea @error('description') is-invalid @enderror" name="description"
                                        list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.Enter description') }}">{{ old('description', @$data['sections']->description) }}</textarea>
                                    @error('description')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif


                            @if (@$data['sections']->key == 'social_links')
                                {{-- -------------------------------- Social link --------------------------------- --}}
                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button type="button" onclick="addSocialLink()"
                                            class="btn btn-sm btn-info"><span><i class="fa-solid fa-add"></i>
                                            </span>{{ ___('common.add') }}</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table" id="social_links">
                                        <thead></thead>
                                        <tbody>
                                            @foreach (@$data['sections']->data as $key => $item)
                                                <tr>
                                                    <td>
                                                        <label class="form-label">{{ ___('common.name') }}</label>
                                                        <input class="form-control ot-input mb-4"
                                                            value="{{ $item['name'] }}"
                                                            name="data[name][]"placeholder="{{ ___('common.Enter name') }}">
                                                    </td>
                                                    <td>
                                                        <label class="form-label">{{ ___('common.Icon') }}</label>
                                                        <input class="form-control ot-input mb-4"
                                                            value="{{ $item['icon'] }}"
                                                            name="data[icon][]"placeholder="{{ ___('common.Enter icon') }}">
                                                    </td>
                                                    <td>
                                                        <label class="form-label">{{ ___('common.Link') }}</label>
                                                        <div class="d-flex align-items-center mb-4">
                                                            <input class="form-control ot-input mr-2"
                                                                value="{{ $item['link'] }}"
                                                                name="data[link][]"placeholder="{{ ___('common.Enter link') }}">
                                                            <button class="btn btn-danger" onclick="removeRow(this)">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'statement')
                                {{-- -------------------------------- Statement --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('common.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-18">
                                            <div class="mb-18">
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[0]['title'] }}" name="data[title][]"
                                                    placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0 mb-5" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[0]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-18">
                                            <div class="mb-18">
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[1]['title'] }}" name="data[title][]"
                                                    placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[1]['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'study_at')
                                {{-- -------------------------------- study_at --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('common.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('common.Icon') }}
                                                    {{ ___('common.(70 x 70 px)') }}</label>
                                                <input type="file" class="form-control" name="data[icon][0]"
                                                    accept="image/*" id="fileBrouse2">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[0]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0 mb-5" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[0]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('common.Icon') }}
                                                    {{ ___('common.(70 x 70 px)') }}</label>
                                                <input type="file" class="form-control" name="data[icon][1]"
                                                    accept="image/*" id="fileBrouse3">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[1]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[1]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('common.Icon') }}
                                                    {{ ___('common.(70 x 70 px)') }}</label>
                                                <input type="file" class="form-control" name="data[icon][2]"
                                                    accept="image/*" id="fileBrouse4">

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[2]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[2]['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'explore')
                                {{-- -------------------------------- explore --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('common.Details') }}</h5>
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('common.Tab') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[0]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('common.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[0]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0 mb-5" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[0]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('common.Tab') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[1]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('common.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[1]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[1]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('common.Tab') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[2]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('common.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[2]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[2]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('common.Tab') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[2]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('common.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.title') }}</label>
                                                <input class="form-control ot-input mb-2"
                                                    value="{{ @$data['sections']->data[2]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('common.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('common.Description') }}</label>
                                                <textarea class="form-control ot-textarea mt-0" name="data[description][]"
                                                    placeholder="{{ ___('common.Enter description') }}">{{ @$data['sections']->data[2]['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'why_choose_us')
                                {{-- -------------------------------- why_choose_us --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('common.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button type="button" onclick="addChooseUs()"
                                            class="btn btn-sm btn-info"><span><i class="fa-solid fa-add"></i>
                                            </span>{{ ___('common.Add') }}</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table" id="why_choose_us">
                                        <thead></thead>
                                        <tbody>
                                            @foreach (@$data['sections']->data as $key => $item)
                                                <tr>
                                                    <td>
                                                        <label class="form-label">{{ ___('common.name') }}</label>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <input class="form-control ot-input mr-2"
                                                                value="{{ $item }}"
                                                                name="data[]"placeholder="{{ ___('common.Enter name') }}">
                                                            <button class="btn btn-danger" onclick="removeRow(this)">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'academic_curriculum')
                                {{-- -------------------------------- academic_curriculum --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('common.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button type="button" onclick="addAcademicCurriculum()"
                                            class="btn btn-sm btn-info"><span><i class="fa-solid fa-add"></i>
                                            </span>{{ ___('common.Add') }}</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table" id="academic_curriculum">
                                        <thead></thead>
                                        <tbody>
                                            @foreach (@$data['sections']->data as $key => $item)
                                                <tr>
                                                    <td>
                                                        <label class="form-label">{{ ___('common.name') }}</label>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <input class="form-control ot-input mr-2"
                                                                value="{{ $item }}"
                                                                name="data[]"placeholder="{{ ___('common.Enter name') }}">
                                                            <button class="btn btn-danger" onclick="removeRow(this)">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

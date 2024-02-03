@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ ___('create.Key') }}: {{ @$data['sections']->key }}</h4>
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
                                    <label for="validationDefault01" class="form-label ">{{ ___('create.name') }}</label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', @$data['sections']->name) }}" id="validationDefault01"
                                        placeholder="{{ ___('create.enter_name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif

                            @if (@$data['sections']->upload_id)
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02" class="form-label ">{{ ___('create.image') }}

                                        @if (@$data['sections']->key == 'statement')
                                            {{ ___('create.(580 x 465 px)') }}
                                        @elseif(@$data['sections']->key == 'study_at')
                                            {{ ___('create.(1920 x 615 px)') }}
                                        @elseif(@$data['sections']->key == 'explore')
                                            {{ ___('create.(700 x 500 px)') }}
                                        @endif

                                    </label>
                                    <input id="validationDefault02" type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            @endif

                            @if (@$data['sections']->description)
                                <div class="col-md-12 mb-3">
                                    <label for="validationDefault03" class="form-label">{{ ___('create.Description') }}</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="validationDefault03"
                                        placeholder="{{ ___('create.Enter description') }}">{{ old('description', @$data['sections']->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
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
                                            </span>{{ ___('create.add') }}</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table" id="social_links">
                                        <thead></thead>
                                        <tbody>
                                            @foreach (@$data['sections']->data as $key => $item)
                                                <tr>
                                                    <td>
                                                        <label class="form-label">{{ ___('create.name') }}</label>
                                                        <input class="form-control mb-4" value="{{ $item['name'] }}"
                                                            name="data[name][]"placeholder="{{ ___('create.Enter name') }}">
                                                    </td>
                                                    <td>
                                                        <label class="form-label">{{ ___('create.Icon') }}</label>
                                                        <input class="form-control mb-4" value="{{ $item['icon'] }}"
                                                            name="data[icon][]"placeholder="{{ ___('create.Enter icon') }}">
                                                    </td>
                                                    <td>
                                                        <label class="form-label">{{ ___('create.Link') }}</label>
                                                        <div class="d-flex align-items-center mb-4">
                                                            <input class="form-control mr-2" value="{{ $item['link'] }}"
                                                                name="data[link][]"placeholder="{{ ___('create.Enter link') }}">
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
                                <h5 class="mt-3 text-info">{{ ___('create.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-18">
                                            <div class="mb-18">
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[0]['title'] }}" name="data[title][]"
                                                    placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0 mb-5" name="data[description][]"
                                                    placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[0]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-18">
                                            <div class="mb-18">
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[1]['title'] }}" name="data[title][]"
                                                    placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0" name="data[description][]" placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[1]['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'study_at')
                                {{-- -------------------------------- study_at --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('create.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('create.Icon') }}
                                                    {{ ___('create.(70 x 70 px)') }}</label>
                                                <input type="file" class="form-control" name="data[icon][0]"
                                                    accept="image/*">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[0]['title'] }}" name="data[title][]"
                                                    placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0 mb-5" name="data[description][]"
                                                    placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[0]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('create.Icon') }}
                                                    {{ ___('create.(70 x 70 px)') }}</label>
                                                <input type="file" class="form-control" name="data[icon][1]"
                                                    accept="image/*">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[1]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0" name="data[description][]" placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[1]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('create.Icon') }}
                                                    {{ ___('create.(70 x 70 px)') }}</label>
                                                <input type="file" class="form-control" name="data[icon][2]"
                                                    accept="image/*">

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[2]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0" name="data[description][]" placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[2]['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'explore')
                                {{-- -------------------------------- explore --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('create.Details') }}</h5>
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('create.Tab') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[0]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('create.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[0]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0 mb-5" name="data[description][]"
                                                    placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[0]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('create.Tab') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[1]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('create.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[1]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0" name="data[description][]" placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[1]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('create.Tab') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[2]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('create.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[2]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0" name="data[description][]" placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[2]['description'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">{{ ___('create.Tab') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[2]['tab'] }}" name="data[tab][]"
                                                    placeholder="{{ ___('create.Enter tab') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.title') }}</label>
                                                <input class="form-control mb-2"
                                                    value="{{ @$data['sections']->data[2]['title'] }}"
                                                    name="data[title][]" placeholder="{{ ___('create.Enter title') }}">
                                            </div>
                                            <div>
                                                <label class="form-label">{{ ___('create.Description') }}</label>
                                                <textarea class="form-control mt-0" name="data[description][]" placeholder="{{ ___('create.Enter description') }}">{{ @$data['sections']->data[2]['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (@$data['sections']->key == 'why_choose_us')
                                {{-- -------------------------------- why_choose_us --------------------------------- --}}
                                <h5 class="mt-3 text-info">{{ ___('create.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button type="button" onclick="addChooseUs()"
                                            class="btn btn-sm btn-info"><span><i class="fa-solid fa-add"></i>
                                            </span>{{ ___('create.Add') }}</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table" id="why_choose_us">
                                        <thead></thead>
                                        <tbody>
                                            @foreach (@$data['sections']->data as $key => $item)
                                                <tr>
                                                    <td>
                                                        <label class="form-label">{{ ___('create.name') }}</label>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <input class="form-control mr-2" value="{{ $item }}"
                                                                name="data[]"placeholder="{{ ___('create.Enter name') }}">
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
                                <h5 class="mt-3 text-info">{{ ___('create.Details') }}</h5>
                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button type="button" onclick="addAcademicCurriculum()"
                                            class="btn btn-sm btn-info"><span><i class="fa-solid fa-add"></i>
                                            </span>{{ ___('create.Add') }}</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table" id="academic_curriculum">
                                        <thead></thead>
                                        <tbody>
                                            @foreach (@$data['sections']->data as $key => $item)
                                                <tr>
                                                    <td>
                                                        <label class="form-label">{{ ___('create.name') }}</label>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <input class="form-control mr-2" value="{{ $item }}"
                                                                name="data[]"placeholder="{{ ___('create.Enter name') }}">
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
                                        </span>{{ ___('create.update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

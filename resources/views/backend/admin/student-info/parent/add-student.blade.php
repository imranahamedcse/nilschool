@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-4 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>
            <form action="{{ route('parent.student-store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf

                <input type="hidden" name="parent" value="{{ $data['id'] }}">

                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.admission_no') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('admission_no') is-invalid @enderror" type="number"
                                    name="admission_no" id="validationDefault01"
                                    placeholder="{{ ___('create.enter_admission_no') }}"
                                    value="{{ old('admission_no') }}">
                                @error('admission_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.roll_no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('roll_no') is-invalid @enderror" name="roll_no"
                                    id="validationDefault02" type="number"
                                    placeholder="{{ ___('create.enter_roll_no') }}" value="{{ old('roll_no') }}">
                                @error('roll_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.first_name') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    id="validationDefault03" placeholder="{{ ___('create.enter_first_name') }}"
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.last_name') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    id="validationDefault04" placeholder="{{ ___('create.enter_last_name') }}"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.mobile') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                    id="validationDefault05" type="number"
                                    placeholder="{{ ___('create.enter_mobile') }}" value="{{ old('mobile') }}">
                                @error('mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('create.email') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="validationDefault06" type="email"
                                    placeholder="{{ ___('create.enter_email') }}" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault07" class="form-label">{{ ___('create.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="class form-control @error('class') is-invalid @enderror" name="class"
                                    id="validationDefault07">
                                    <option value="">{{ ___('create.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->class->id }}">{{ $item->class->name }}
                                    @endforeach
                                    </option>
                                </select>

                                @error('class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-3">
                                <label for="validationDefault08" class="form-label">{{ ___('create.section') }}
                                    <span class="text-danger">*</span></label>
                                <select class="section form-control @error('section') is-invalid @enderror" name="section"
                                    id="validationDefault08">
                                    <option value="">{{ ___('create.select_section') }}</option>
                                </select>
                                @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">

                                <label for="validationDefault09" class="form-label">{{ ___('create.shift') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('shift') is-invalid @enderror" name="shift"
                                    id="validationDefault09">
                                    <option value="">{{ ___('create.select_shift') }}</option>
                                    @foreach ($data['shifts'] as $item)
                                        <option {{ old('shift') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault10" class="form-label ">{{ ___('create.date_of_birth') }}
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" id="validationDefault10"
                                    placeholder="{{ ___('create.date_of_birth') }}" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault11" class="form-label">{{ ___('create.religion') }}
                                    <span class="text-danger"></span></label>
                                <select class="form-control @error('religion') is-invalid @enderror" name="religion"
                                    id="validationDefault11">
                                    <option value="">{{ ___('create.select_religion') }}</option>
                                    @foreach ($data['religions'] as $item)
                                        <option {{ old('religion') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('religion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault12" class="form-label">{{ ___('create.gender') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    id="validationDefault12">
                                    <option value="">{{ ___('create.select_gender') }}</option>
                                    @foreach ($data['genders'] as $item)
                                        <option {{ old('gender') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault13" class="form-label">{{ ___('create.category') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category"
                                    id="validationDefault13">
                                    <option value="">{{ ___('create.select_category') }}</option>
                                    @foreach ($data['categories'] as $item)
                                        <option {{ old('category') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-3">
                                <label for="validationDefault14" class="form-label">{{ ___('create.blood') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('blood') is-invalid @enderror" name="blood"
                                    id="validationDefault14">
                                    <option value="">{{ ___('create.select_blood') }}</option>
                                    @foreach ($data['bloods'] as $item)
                                        <option {{ old('blood') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>
                                @error('blood')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault15"
                                    class="form-label ">{{ ___('create.admission_date') }}
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('admission_date') is-invalid @enderror"
                                    name="admission_date" id="validationDefault15"
                                    placeholder="{{ ___('create.admission_date') }}"
                                    value="{{ old('admission_date') }}">
                                @error('admission_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault16" class="form-label ">{{ ___('create.image') }}
                                    {{ ___('create.(100 x 100 px)') }}<span class="text-danger"></span></label>

                                <input id="validationDefault16" class="form-control" type="file" name="image"
                                    placeholder="{{ ___('create.image') }}">
                            </div>

                            <div class="col-md-3 mb-3">

                                <label class="form-label" for="validationDefault16">{{ ___('create.status') }}
                                    <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault16">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.active') }}
                                    </option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>



                        <div class="row py-3">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center gap-4 flex-wrap">
                                    <h5 class="m-0 flex-fill text-info">
                                        {{ ___('create.Upload Documents') }}
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-primary addNewDocument"
                                        onclick="addNewDocument()">
                                        <span><i class="fa-solid fa-plus"></i> </span>
                                        {{ ___('create.add') }}</button>
                                    <input type="hidden" name="counter" id="counter" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table school_borderLess_table table_border_hide2" id="student-document">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ___('create.name') }} <span
                                                        class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('document_names.*'))
                                                            <span class="text-danger">{{ 'the fields are required' }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    {{ ___('create.document') }}
                                                    <span class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('document_files.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    {{ ___('create.action') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function addNewDocument() {

            var url = $('#url').val();
            var counter = parseInt($('#counter').val()) + 1;

            var formData = {
                counter: counter,
            }

            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/students/list/add-new-document',
                success: function(data) {
                    $("#student-document tbody").append(data);
                    $("#counter").val(counter);
                    console.log(data);
                },
                error: function(data) {}
            });
        }

        function removeRow(element) {
            element.closest('tr').remove();
        }
    </script>
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
@endpush

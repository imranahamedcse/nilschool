@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-4 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>
            <form action="{{ route('parent.update',$data['parent']->id) }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $data['parent']->user_id }}">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        {{-- father --}}
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.father_name') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('father_name') is-invalid @enderror" name="father_name"
                                    id="validationDefault01"
                                    placeholder="{{ ___('create.enter_father_name') }}" type="text" value="{{ old('father_name',$data['parent']->father_name) }}">
                                @error('father_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.father_mobile') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('father_mobile') is-invalid @enderror" name="father_mobile"
                                    id="validationDefault02"
                                    placeholder="{{ ___('create.enter_father_mobile') }}" type="text" value="{{ old('father_mobile',$data['parent']->father_mobile) }}">
                                @error('father_mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.father_profession') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('father_profession') is-invalid @enderror" name="father_profession"
                                    id="validationDefault03"
                                    placeholder="{{ ___('create.enter_father_profession') }}" type="text" value="{{ old('father_profession',$data['parent']->father_profession) }}">
                                @error('father_profession')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">

                                <label class="form-label" for="validationDefault04">{{ ___('create.father_image') }} {{ ___('create.(95 x 95 px)') }}</label>
                                <input type="file" class="form-control" name="father_image" id="validationDefault04" accept="image/*">

                            </div>
                        </div>
                        {{-- end father --}}
                        {{-- mother --}}
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.mother_name') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('mother_name') is-invalid @enderror" name="mother_name"
                                    id="validationDefault05"
                                    placeholder="{{ ___('create.enter_mother_name') }}" type="text" value="{{ old('mother_name',$data['parent']->mother_name) }}">
                                @error('mother_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('create.mother_mobile') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('mother_mobile') is-invalid @enderror" name="mother_mobile"
                                    id="validationDefault06"
                                    placeholder="{{ ___('create.enter_mother_mobile') }}" type="text" value="{{ old('mother_mobile',$data['parent']->mother_mobile) }}">
                                @error('mother_mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('create.mother_profession') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('mother_profession') is-invalid @enderror" name="mother_profession"
                                    id="validationDefault07"
                                    placeholder="{{ ___('create.enter_father_profession') }}" type="text" value="{{ old('mother_profession',$data['parent']->mother_profession) }}">
                                @error('mother_profession')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">

                                <label class="form-label" for="validationDefault08">{{ ___('create.mother_image') }} {{ ___('create.(95 x 95 px)') }}</label>
                                <input type="file" class="form-control" name="mother_image" id="validationDefault08" accept="image/*">

                            </div>
                        </div>
                        {{-- end mother --}}
                        {{-- guardian --}}
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault09" class="form-label ">{{ ___('create.guardian_name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('guardian_name') is-invalid @enderror" name="guardian_name"
                                    id="validationDefault09"
                                    placeholder="{{ ___('create.enter_guardian_name') }}" type="text" value="{{ old('guardian_name',$data['parent']->user->name) }}">
                                @error('guardian_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault10" class="form-label ">{{ ___('create.guardian_mobile') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('guardian_mobile') is-invalid @enderror" name="guardian_mobile"
                                    id="validationDefault10"
                                    placeholder="{{ ___('create.enter_guardian_mobile') }}" type="text" value="{{ old('guardian_mobile',$data['parent']->user->phone) }}">
                                @error('guardian_mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault11" class="form-label ">{{ ___('create.guardian_profession') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('guardian_profession') is-invalid @enderror" name="guardian_profession"
                                    id="validationDefault11"
                                    placeholder="{{ ___('create.enter_guardian_profession') }}" type="text" value="{{ old('guardian_profession',$data['parent']->guardian_profession) }}">
                                @error('guardian_profession')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">

                                <label class="form-label" for="validationDefault12">{{ ___('create.guardian_image') }} {{ ___('create.(95 x 95 px)') }}</label>
                                <input type="file" class="form-control" name="guardian_image" id="validationDefault12" accept="image/*">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault13" class="form-label ">{{ ___('create.guardian_email') }}</label>
                                <input class="form-control @error('guardian_email') is-invalid @enderror" name="guardian_email"
                                    id="validationDefault13"
                                    placeholder="{{ ___('create.enter_guardian_email') }}" type="email" value="{{ old('guardian_email',$data['parent']->user->email) }}">
                                @error('guardian_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault14" class="form-label ">{{ ___('create.guardian_address') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('guardian_address') is-invalid @enderror" name="guardian_address"
                                    id="validationDefault14"
                                    placeholder="{{ ___('create.enter_guardian_address') }}" type="text" value="{{ old('guardian_address',$data['parent']->guardian_address) }}">
                                @error('guardian_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault15" class="form-label ">{{ ___('create.guardian_relation') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('guardian_relation') is-invalid @enderror" name="guardian_relation"
                                    id="validationDefault15"
                                    placeholder="{{ ___('create.enter_guardian_relation') }}" type="text" value="{{ old('guardian_relation',$data['parent']->guardian_relation) }}">
                                @error('guardian_relation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault16" class="form-label">{{ ___('create.status') }} <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                name="status" id="validationDefault16"
                               >
                                    <option value="{{ App\Enums\Status::ACTIVE }}" {{ $data['parent']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}
                                    </option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}" {{ $data['parent']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        {{-- end guardian --}}
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

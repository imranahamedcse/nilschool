@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>

            <form action="{{ route('room-type.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="validationDefault01" placeholder="{{ ___('create.Enter name') }}"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.Total seat') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('total_seat') is-invalid @enderror" name="total_seat" type="number"
                                    id="validationDefault02" placeholder="{{ ___('create.Enter total seat') }}"
                                    value="{{ old('total_seat') }}">
                                @error('total_seat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.Seat Fee') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('seat_fee') is-invalid @enderror" name="seat_fee" type="number"
                                    id="validationDefault03" placeholder="{{ ___('create.Enter seat fee') }}"
                                    value="{{ old('seat_fee') }}">
                                @error('seat_fee')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('create.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault04">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.Active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.Inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

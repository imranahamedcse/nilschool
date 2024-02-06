@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')
    <div class="card bg-white">
        <div class="card-body">
            <div class="row p-0 m-0">

                <!-- profile menu start -->
                <div class="col-3">
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action active"
                            href="{{ route('my.profile') }}">{{ ___('profile.my_profile') }}</a>
                        <a class="list-group-item list-group-item-action"
                            href="{{ route('passwordUpdate') }}">{{ ___('profile.Password update') }}</a>
                    </ul>
                </div>
                <!-- profile menu end -->



                <!-- profile body start -->
                <div class="col-9">
                    <div class="row justify-content-between border-bottom pb-2 mb-3">
                        <div class="col">
                            <h4>{{ @$data['title'] }}</h4>
                        </div>
                    </div>

                    <form action="{{ route('my.profile.update') }}" enctype="multipart/form-data" method="post"
                        id="visitForm">
                        @csrf
                        @method('PUT')

                        <div class="col-12 mb-3">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <img class="img-thumbnail-image-preview mb-3"
                                    src="{{ @globalAsset(Auth::user()->upload->path, '100X100.svg') }}"
                                    alt="{{ Auth::user()->name }}">
                            </div>
                            <label class="form-label" for="image">{{ ___('profile.image_') }}
                                {{ ___('profile.(95 x 95 px)') }}</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="inputname" class="form-label">{{ ___('profile.name') }} <span
                                    class="text-danger">*</span></label>
                            <input name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ Auth::user()->name }}" placeholder="{{ ___('profile.name.') }}" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="inputname" class="form-label">{{ ___('profile.date_of_birth') }}</label>
                            <div class="col-sm-12">
                                <input name="date_of_birth" type="date"
                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                    value="{{ Auth::user()->date_of_birth }}" />
                                @error('date_of_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputname" class="form-label">{{ ___('profile.phone') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input name="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="{{ ___('profile.880_249_897632') }}"
                                    value="{{ Auth::user()->phone }}" />
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="text-end">
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('profile.update') }} </button>
                            </div>
                        </div>

                    </form>


                </div>
                <!-- profile body end -->
            </div>
        </div>
    </div>
@endsection

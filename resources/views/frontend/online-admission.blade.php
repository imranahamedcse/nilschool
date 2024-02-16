@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.Online Admission') }}
@endsection

@section('main')
    <!-- Breadcrumbs start  -->
    @include('frontend.partials.breadcrumb')
    <!-- Breadcrumbs end  -->

    <!-- Contact start  -->
    <div class="container-fluid">
        <div class="page_info">
            <img class="image" src="{{ @globalAsset(@$sections['study_at']->upload->path, '1920X700.webp') }}" alt="">
            <div class="text">
                <h3 class="fw-semibold">{{ $sections['study_at']->name }}</h3>
                <h6>{{ $sections['study_at']->description }}</h6>
            </div>
        </div>

        <div class="page_items container mb-5">
            <div class="row justify-content-center">
                <div class="col-11 col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-area contact-form" id="admission" method="post">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark">{{ ___('frontend.First Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="first_name" placeholder="{{ ___('frontend.Enter first name') }}"
                                            class="form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark">{{ ___('frontend.Last Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="last_name" placeholder="{{ ___('frontend.Enter last name') }}"
                                            class="form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark">{{ ___('frontend.Phone no') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="phone" placeholder="{{ ___('frontend.Phone no') }}"
                                            class="form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark">{{ ___('frontend.Email Address') }}</label>
                                        <input name="email" placeholder="{{ ___('frontend.Type e-mail address') }}"
                                            pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                            class="form-control" type="email">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark">{{ ___('frontend.Date of birth') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="dob" placeholder="{{ ___('frontend.Enter date of birth') }}"
                                            class="form-control" required="" type="date">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark"
                                            for="#">{{ ___('frontend.Academic Year/Session') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="session">
                                            <option value="" data-display="Select">
                                                {{ ___('frontend.Select year/session') }}</option>
                                            @foreach ($data['sessions'] as $item)
                                                <option {{ old('session') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('session'))
                                            <small class="text-danger">{{ $errors->first('session') }}</small>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark" for="#">{{ ___('frontend.Class') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="class">
                                            <option value="" data-display="Select">{{ ___('frontend.Select class') }}
                                            </option>
                                        </select>
                                        @if ($errors->has('class'))
                                            <small class="text-danger">{{ $errors->first('class') }}</small>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark" for="#">{{ ___('frontend.Section') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="section">
                                            <option value="" data-display="Select">{{ ___('frontend.Select section') }}
                                            </option>
                                        </select>
                                        @if ($errors->has('section'))
                                            <small class="text-danger">{{ $errors->first('section') }}</small>
                                        @endif
                                    </div>



                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark" for="#">{{ ___('frontend.Gender') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="gender">
                                            <option value="" data-display="Select">{{ ___('frontend.Select gender') }}
                                            </option>
                                            @foreach ($data['genders'] as $item)
                                                <option {{ old('gender') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('gender'))
                                            <small class="text-danger">{{ $errors->first('gender') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark" for="#">{{ ___('frontend.Religion') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="religion">
                                            <option value="" data-display="Select">
                                                {{ ___('frontend.Select religion') }}</option>
                                            @foreach ($data['religions'] as $item)
                                                <option {{ old('religion') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('religion'))
                                            <small class="text-danger">{{ $errors->first('religion') }}</small>
                                        @endif
                                    </div>



                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark">{{ ___('frontend.Guardian name') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="guardian_name" placeholder="{{ ___('frontend.Enter guardian name') }}"
                                            class="form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label fw-semibold text-dark">{{ ___('frontend.Guardian phone') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="guardian_phone" placeholder="{{ ___('frontend.Enter guardian phone') }}"
                                            class="form-control" required="" type="text">
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">{{ ___('frontend.Submit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADMISSION::END  -->
@endsection

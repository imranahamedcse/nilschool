@extends('frontend.admission.master')
@section('title')
    {{ ___('frontend.Apply Online') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Apply Online</h3>
    <div class="border-bottom mb-3"></div>
    <div class="row mb-3">
        <div class="col-12 col-lg-8 offset-lg-2 bg-white p-5">
            <div class="text-center pb-3">
                <h5 class="text-warning fw-semibold">
                    {{ ___('frontend.Please fill out the form for admission guidance and information') }}.</h5>
            </div>
            <form method="post" id="online_admission">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">{{ ___('frontend.First Name') }} <span class="text-danger">*</span></label>
                        <input name="first_name" placeholder="{{ ___('frontend.Enter first name') }}"
                            class="first_name form-control" required="" type="text">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">{{ ___('frontend.Last Name') }} <span class="text-danger">*</span></label>
                        <input name="last_name" placeholder="{{ ___('frontend.Enter last name') }}"
                            class="last_name form-control" required="" type="text">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">{{ ___('frontend.Phone no') }} <span class="text-danger">*</span></label>
                        <input name="phone" placeholder="{{ ___('frontend.Phone no') }}" class="phone form-control"
                            required="" type="text">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">{{ ___('frontend.Email Address') }}</label>
                        <input name="email" placeholder="{{ ___('frontend.Type e-mail address') }}"
                            pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" class="email form-control"
                            type="email">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">{{ ___('frontend.Date of birth') }} <span
                                class="text-danger">*</span></label>
                        <input name="dob" placeholder="{{ ___('frontend.Enter date of birth') }}"
                            class="dob form-control" required="" type="date">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label" for="#">{{ ___('frontend.Academic Year/Session') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control session" name="session">
                            <option value="" data-display="Select">{{ ___('frontend.Select year/session') }}</option>
                            @foreach ($data['sessions'] as $item)
                                <option {{ old('session') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('session'))
                            <small class="text-danger">{{ $errors->first('session') }}</small>
                        @endif
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label" for="#">{{ ___('frontend.Class') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control classes" name="class">
                            <option value="" data-display="Select">{{ ___('frontend.Select class') }}</option>
                        </select>
                        @if ($errors->has('class'))
                            <small class="text-danger">{{ $errors->first('class') }}</small>
                        @endif
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label" for="#">{{ ___('frontend.Section') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control sections" name="section">
                            <option value="" data-display="Select">{{ ___('frontend.Select section') }}</option>
                        </select>
                        @if ($errors->has('section'))
                            <small class="text-danger">{{ $errors->first('section') }}</small>
                        @endif
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label" for="#">{{ ___('frontend.Gender') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control gender" name="gender">
                            <option value="" data-display="Select">{{ ___('frontend.Select gender') }}</option>
                            @foreach ($data['genders'] as $item)
                                <option {{ old('gender') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('gender'))
                            <small class="text-danger">{{ $errors->first('gender') }}</small>
                        @endif
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label" for="#">{{ ___('frontend.Religion') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control religion" name="religion">
                            <option value="" data-display="Select">{{ ___('frontend.Select religion') }}</option>
                            @foreach ($data['religions'] as $item)
                                <option {{ old('religion') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('religion'))
                            <small class="text-danger">{{ $errors->first('religion') }}</small>
                        @endif
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">{{ ___('frontend.Guardian name') }} <span
                                class="text-danger">*</span></label>
                        <input name="guardian_name" placeholder="{{ ___('frontend.Enter guardian name') }}"
                            class="guardian_name form-control" required="" type="text">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">{{ ___('frontend.Guardian phone') }} <span
                                class="text-danger">*</span></label>
                        <input name="guardian_phone" placeholder="{{ ___('frontend.Enter guardian phone') }}"
                            class="guardian_phone form-control" required="" type="text">
                    </div>
                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-primary">{{ ___('frontend.Submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

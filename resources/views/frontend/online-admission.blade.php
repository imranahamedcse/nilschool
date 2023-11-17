@extends('frontend.master')
@section('title')
    {{ ___('frontend.Online Admission') }}
@endsection

@section('main')


<!-- bradcam::start  -->
<div class="breadcrumb_area" data-background="{{ @globalAsset(@$sections['study_at']->upload->path, '1920X700.webp') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <div class="breadcam_wrap text-center">
                    <h3>{{ ___('frontend.Online Admission') }}</h3>
                    <div class="custom_breadcam">
                        <a href="{{url('/')}}" class="breadcrumb-item">{{ ___('frontend.home') }}</a>
                        <a href="#" class="breadcrumb-item">{{ ___('frontend.Online Admission') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bradcam::end  -->

<!-- ADMISSION::START  -->
<div class="search_result_area section_padding">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-xl-10">
                <div class="search_result_box mb_30">
                    <div class="section__title mb_50">
                        <h5 class="mb-0 text-warning text-center">{{ ___('frontend.Please fill out the form for admission guidance and information') }}.</h5>
                    </div>
                    <form class="form-area contact-form" id="admission" method="post">
                        <div class="row">
                            <div class="col-xl-6">
                                <label class="primary_label2">{{ ___('frontend.First Name') }} <span class="text-danger">*</span></label>
                                <input name="first_name" placeholder="{{ ___('frontend.Enter first name') }}" class="first_name form-control ot-input mb_30" required="" type="text">
                            </div>
                            <div class="col-xl-6">
                                <label class="primary_label2">{{ ___('frontend.Last Name') }} <span class="text-danger">*</span></label>
                                <input name="last_name" placeholder="{{ ___('frontend.Enter last name') }}" class="last_name form-control ot-input mb_30" required="" type="text">
                            </div>
                            <div class="col-xl-6">
                                <label class="primary_label2">{{ ___('frontend.Phone no') }} <span class="text-danger">*</span></label>
                                <input name="phone" placeholder="{{ ___('frontend.Phone no') }}" class="phone form-control ot-input mb_30" required="" type="text">
                            </div>
                            <div class="col-xl-6">
                                <label class="primary_label2">{{ ___('frontend.Email Address') }}</label>
                                <input name="email" placeholder="{{ ___('frontend.Type e-mail address') }}" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" class="email form-control ot-input mb_30" type="email">
                            </div>
                            <div class="col-xl-6">
                                <label class="primary_label2">{{ ___('frontend.Date of birth') }} <span class="text-danger">*</span></label>
                                <input name="dob" placeholder="{{ ___('frontend.Enter date of birth') }}" class="dob form-control ot-input mb_30" required="" type="date">
                            </div>
                            <div class="col-xl-6 mb_24">
                                <label class="primary_label2" for="#">{{ ___('frontend.Academic Year/Session') }} <span class="text-danger">*</span></label>
                                <select class="theme_select wide session" name="session">
                                    <option value="" data-display="Select">{{ ___('frontend.Select year/session') }}</option>
                                    @foreach ($data['sessions'] as $item)
                                        <option {{ old('session') == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('session'))
                                    <small class="text-danger">{{ $errors->first('session') }}</small>
                                @endif
                            </div>
                            
                            <div class="col-xl-6 mb_24">
                                <label class="primary_label2" for="#">{{ ___('frontend.Class') }} <span class="text-danger">*</span></label>
                                <select class="theme_select wide classes" name="class">
                                    <option value="" data-display="Select">{{ ___('frontend.Select class') }}</option>
                                </select>
                                @if ($errors->has('class'))
                                    <small class="text-danger">{{ $errors->first('class') }}</small>
                                @endif
                            </div>
        
                            <div class="col-xl-6 mb_24">
                                <label class="primary_label2" for="#">{{ ___('frontend.Section') }} <span class="text-danger">*</span></label>
                                <select class="theme_select wide sections" name="section">
                                    <option value="" data-display="Select">{{ ___('frontend.Select section') }}</option>
                                </select>
                                @if ($errors->has('section'))
                                    <small class="text-danger">{{ $errors->first('section') }}</small>
                                @endif
                            </div>



                            <div class="col-xl-6 mb_24">
                                <label class="primary_label2" for="#">{{ ___('frontend.Gender') }} <span class="text-danger">*</span></label>
                                <select class="theme_select wide gender" name="gender">
                                    <option value="" data-display="Select">{{ ___('frontend.Select gender') }}</option>
                                    @foreach ($data['genders'] as $item)
                                        <option {{ old('gender') == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('gender'))
                                    <small class="text-danger">{{ $errors->first('gender') }}</small>
                                @endif
                            </div>
                            <div class="col-xl-6 mb_24">
                                <label class="primary_label2" for="#">{{ ___('frontend.Religion') }} <span class="text-danger">*</span></label>
                                <select class="theme_select wide religion" name="religion">
                                    <option value="" data-display="Select">{{ ___('frontend.Select religion') }}</option>
                                    @foreach ($data['religions'] as $item)
                                        <option {{ old('religion') == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('religion'))
                                    <small class="text-danger">{{ $errors->first('religion') }}</small>
                                @endif
                            </div>



                            <div class="col-xl-6">
                                <label class="primary_label2">{{ ___('frontend.Guardian name') }} <span class="text-danger">*</span></label>
                                <input name="guardian_name" placeholder="{{ ___('frontend.Enter guardian name') }}" class="guardian_name form-control ot-input mb_30" required="" type="text">
                            </div>
                            <div class="col-xl-6">
                                <label class="primary_label2">{{ ___('frontend.Guardian phone') }} <span class="text-danger">*</span></label>
                                <input name="guardian_phone" placeholder="{{ ___('frontend.Enter guardian phone') }}" class="guardian_phone form-control ot-input mb_30" required="" type="text">
                            </div>
                            <div class="col-xl-12 text-left d-flex">
                                <button type="submit" class="theme_btn2  submit-btn text-center d-flex align-items-center m-0 w-100 justify-content-center text-uppercase large_btn">{{ ___('frontend.Submit') }}</button>
                                {{-- mail-script.js --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- ADMISSION::END  -->


@endsection
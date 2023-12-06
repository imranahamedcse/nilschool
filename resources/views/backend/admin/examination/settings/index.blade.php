@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')


    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between border-bottom pb-4 mb-4">
                <div class="col-3 align-self-center">
                    <h4 class="m-0">{{ @$data['title'] }}</h4>
                </div>
            </div>

            <form action="{{ route('examination-settings.update') }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <!--average pass marks -->
                            <div class="col-12 col-md-12 mb-3 ">
                                <label for="inputname"
                                    class="form-label">{{ ___('settings.Average Pass marks(Percentage)') }} <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="values[]"
                                    class="form-control ot-input @error('average_pass_marks') is-invalid @enderror"
                                    value="{{ examSetting('average_pass_marks') }}"
                                    placeholder="{{ ___('settings.Enter Average Pass marks(Percentage)') }}" />
                                <input type="hidden" name="fields[]" value="average_pass_marks" />
                                @error('average_pass_marks')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="text-end">
                            @if (hasPermission('exam_setting_update'))
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('common.update') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

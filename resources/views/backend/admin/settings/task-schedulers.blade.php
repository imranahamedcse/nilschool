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

            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <Span><strong>{{ ___('common.Cron Common Command For all') }} </strong> :
                        {{ ___('common.* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1') }}
                    </Span>
                </div>

                <div class="col-md-12">
                    <Span><strong>{{ ___('common.Examination Result Generate Cron Command') }} </strong> :
                        {{ ___('common.0 */6 * * * cd /path-to-your-project && php artisan exam:result-generate >> /dev/null 2>&1') }}
                    </Span> <br>
                    <Span><strong>{{ ___('common.Examination Result Generate Cron Manually') }} </strong> : <a
                            class="btn btn-primary" href="{{ route('settings.result-generate') }}">
                            {{ ___('common.Run') }}</a></Span>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

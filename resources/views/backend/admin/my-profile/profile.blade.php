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
                        <div class="col text-end">
                            <a href="{{ route('my.profile.edit') }}" class="btn btn-sm btn-info">
                                <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                                <span class="">{{ ___('profile.edit') }}</span>
                            </a>
                        </div>
                    </div>

                    <img id="id-profile-image" class="img-fluid rounded-circle"
                        src="{{ @globalAsset(Auth::user()->upload->path, '100X100.svg') }}" alt="{{ Auth::user()->name }}">

                    <h5 class="title">{{ ___('profile.name') }}</h5>
                    <p class="paragraph">{{ Auth::user()->name }}</p>

                    <h5 class="title">{{ ___('profile.e_mail_address') }}</h5>
                    <p class="paragraph">{{ Auth::user()->email }}</p>

                    <h5 class="title">{{ ___('profile.date_of_birth') }}</h5>
                    <p class="paragraph">{{ Auth::user()->date_of_birth }}</p>

                    <h5 class="title">{{ ___('profile.phone') }}</h5>
                    <p class="paragraph">{{ Auth::user()->phone }}</p>

                </div>
                <!-- profile body form end -->

            </div>
        </div>
    </div>
@endsection

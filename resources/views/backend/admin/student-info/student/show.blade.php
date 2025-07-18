@extends('backend.master')

@section('title')
    {{ @$data['title'] }}
@endsection
@section('content')
    <div class="page-content">
        <!-- profile content start -->
        <div class="profile-content">
            <div class="d-flex flex-column flex-lg-row gap-4 gap-lg-0">

                <div class="profile-menu">
                    <!-- profile menu head start -->
                    <div class="profile-menu-head">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="img-fluid rounded-circle" src="{{ @globalAsset(@$data->user->upload->path, '40X40.svg') }}"
                                    alt="{{ @$data->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <div class="body">
                                    <h2 class="title">{{ @$data->first_name }} {{ @$data->last_name }}</h2>
                                    <p class="paragraph">{{ @$data->role->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- profile menu head end -->

                    <!-- profile menu body start -->
                    <div class="profile-menu-body">
                        <nav>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="#">{{ ___('index.Profile') }}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- profile menu body end -->
                </div>

                <!-- profile menu end -->

                <div class="profile-body">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="title">{{ ___('index.Student Details') }}</h2>
                        <a href="{{ route('student.edit',@$data->id) }}" class="btn btn-primary mb-5">
                            <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                            <span class="">{{ ___('index.edit') }}</span>
                        </a>
                    </div>

                    <!-- profile body form start -->
                    <div class="profile-body-form">
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.admission_no') }}</h2>
                                    <p class="paragraph">{{ @$data->admission_no }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.roll_no') }}</h2>
                                    <p class="paragraph">{{ @$data->roll_no }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.first_name') }}</h2>
                                    <p class="paragraph">{{ @$data->first_name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.last_name') }}</h2>
                                    <p class="paragraph">{{ @$data->last_name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.mobile') }}</h2>
                                    <p class="paragraph">{{ @$data->mobile }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.email') }}</h2>
                                    <p class="paragraph">{{ @$data->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.class') }}</h2>
                                    <p class="paragraph">{{ @$data->session_class_student->class->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.section') }}</h2>
                                    <p class="paragraph">{{ @$data->session_class_student->class->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.shift') }}</h2>
                                    <p class="paragraph">{{ @$data->session_class_student->shift->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.date_of_birth') }}</h2>
                                    <p class="paragraph">{{ @$data->dob }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.religion') }}</h2>
                                    <p class="paragraph">{{ @$data->religion->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.genders') }}</h2>
                                    <p class="paragraph">{{ @$data->gender->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.blood') }}</h2>
                                    <p class="paragraph">{{ @$data->blood->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.admission_date') }}</h2>
                                    <p class="paragraph">{{ dateFormat(@$data->admission_date) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.select_parent') }}</h2>
                                    <p class="paragraph">{{ @$data->parent->guardian_name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="align-self-center">
                                    <h2 class="title">{{ ___('index.status') }}</h2>
                                    <p class="paragraph">
                                        @if (@$data->status == App\Enums\Status::ACTIVE)
                                            {{ ___('index.active') }}
                                        @else
                                            {{ ___('index.inactive') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <h3>{{ ___('index.Documents') }}</h3>
                        @if (@$data->upload_documents)
                            @foreach (@$data->upload_documents as $key=>$item)
                                <div class="form-item">
                                    <div class="d-flex justify-content-between align-content-center">
                                        <div class="align-self-center">
                                            @php
                                                $document = \App\Models\Upload::where('id', $item['file'])->first()?->path;
                                            @endphp
                                            <h2 class="title">{{ $item['title'] }}</h2>
                                            <p class="paragraph"><a href="{{ @globalAsset($document) }}" download>{{___('index.Download')}}</a></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                <!-- profile body form end -->
            </div>
            <!-- profile body end -->
        </div>
    </div>
@endsection


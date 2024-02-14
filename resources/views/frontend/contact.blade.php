@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.Contact Us') }}
@endsection

@section('main')
    <!-- Breadcrumbs start  -->
    <div class="container">
        <nav class="mt-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach (@$data['breadcrumbs'] as $item)
                    @if ($item['route'] != '')
                        <li class="breadcrumb-item"><a class="text-info"
                                href="{{ route($item['route']) }}">{{ $item['title'] }}</a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $item['title'] }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
    <!-- Breadcrumbs end  -->

    <!-- Contact start  -->
    <div class="contact">
        <div class="container py-5">
            <div class="text-center text-dark lh-1 mb-5">
                <h4><strong>{!! $sections['contact_information']->name !!}</strong></h4>
            </div>

            <div class="row">
                @foreach ($data['contactInfo'] as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card mb-4">
                            <img height="100" class="img-fluid rounded-top"
                                src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}" alt="Image"><br>
                            <div class="card-body text-center">
                                <p class="lh-1 py-2">
                                    <strong>{{ @$item->name }}</strong><br>
                                    <small class="opacity-75">{{ @$item->address }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57405.93598051925!2d88.84901045!3d25.9394602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e359358ddd831f%3A0xfbb7a3268c4659b6!2z4Kao4KeA4Kay4Kar4Ka-4Kau4Ka-4Kaw4KeA!5e0!3m2!1sbn!2sbd!4v1707894363303!5m2!1sbn!2sbd" width="600" height="336" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="section__title mb_50">
                                <h3 class="mb-0 text-white">{{ ___('frontend.Leave A Message') }}</h3>
                            </div>
                            <form class="form-area contact-form" id="myForm" method="post">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="primary_label">{{ ___('frontend.Name') }}</label>
                                        <input name="name" placeholder="{{ ___('frontend.Enter Name') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'"
                                            class="name form-control" required="" type="text">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="primary_label">{{ ___('frontend.Phone no') }}</label>
                                        <input name="phone" placeholder="{{ ___('frontend.Phone no') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'"
                                            class="phone form-control" required="" type="text">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="primary_label">{{ ___('frontend.Email Address') }}</label>
                                        <input name="email" placeholder="{{ ___('frontend.Type e-mail address') }}"
                                            pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Type e-mail address'" class="email form-control"
                                            required="" type="email">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="primary_label">{{ ___('frontend.Subject') }}</label>
                                        <input name="subject" placeholder="{{ ___('frontend.Subject') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'"
                                            class="subject form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="primary_label">{{ ___('frontend.Message') }}</label>
                                        <textarea class="message form-control" name="message" placeholder="{{ ___('frontend.Write your message') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write your message'" required=""></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">{{ ___('frontend.Send') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center text-dark lh-1 py-5">
                <h4><strong>{{ $sections['department_contact_information']->name }}</strong></h4>
                <p class="opacity-75">{{ $sections['department_contact_information']->description }}</p>
            </div>
            <div class="row">
                @foreach ($data['depContact'] as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img height="100" class="my-4"
                                    src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}" alt="Image"><br>
                                <p class="lh-1 py-2">
                                    <strong>{{ @$item->name }}</strong><br>
                                    <small class="opacity-75">
                                        {{ @$item->phone }} <br>
                                        {{ @$item->email }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Contact end  -->
@endsection

@extends('frontend.partials.master')
@section('title')
    {{ $data['title'] }}
@endsection

@section('main')
    <!-- Breadcrumbs start  -->
    @include('frontend.partials.breadcrumb')
    <!-- Breadcrumbs end  -->

    <!-- Contact start  -->
    <div class="container-fluid">
        <div class="page_info">
            <img class="image" src="{{ @globalAsset(@$sections['study_at']->upload->path, '1920X700.webp') }}"
                alt="">
            <div class="text">
                <h3 class="fw-semibold">{{ $sections['contact_information']->name }}</h3>
                <h6>{{ $sections['contact_information']->description }}</h6>
            </div>
        </div>

        <div class="page_items container">
            <div class="row justify-content-center">
                <div class="col-11 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="fw-semibold text-dark mb-2">{{ ___('frontend.Location!') }}</h6>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57405.93598051925!2d88.84901045!3d25.9394602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e359358ddd831f%3A0xfbb7a3268c4659b6!2z4Kao4KeA4Kay4Kar4Ka-4Kau4Ka-4Kaw4KeA!5e0!3m2!1sbn!2sbd!4v1707894363303!5m2!1sbn!2sbd"
                                width="100%" height="336" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-11 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="fw-semibold text-dark mb-4">{{ ___('frontend.Get in touch!') }}</h6>
                            <form id="contact" method="post">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label text-dark fw-semibold">{{ ___('frontend.Name') }}</label>
                                        <input name="name" placeholder="{{ ___('frontend.Enter Name') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'"
                                            class="name form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label text-dark fw-semibold">{{ ___('frontend.Phone no') }}</label>
                                        <input name="phone" placeholder="{{ ___('frontend.Phone no') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'"
                                            class="phone form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label text-dark fw-semibold">{{ ___('frontend.Email Address') }}</label>
                                        <input name="email" placeholder="{{ ___('frontend.Type e-mail address') }}"
                                            pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Type e-mail address'" class="email form-control"
                                            required="" type="email">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label text-dark fw-semibold">{{ ___('frontend.Subject') }}</label>
                                        <input name="subject" placeholder="{{ ___('frontend.Subject') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'"
                                            class="subject form-control" required="" type="text">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-dark fw-semibold">{{ ___('frontend.Message') }}</label>
                                        <textarea class="message form-control" name="message" placeholder="{{ ___('frontend.Write your message') }}"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write your message'" required=""></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">{{ ___('frontend.Send message') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="contact">
        <div class="container py-4">

            <div class="row">
                @foreach ($data['contactInfo'] as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card mb-4">
                            <img class="img-fluid rounded-top" src="{{ @globalAsset(@$item->upload->path, '90X60.svg') }}"
                                alt="Image"><br>
                            <div class="card-body text-center">
                                <h6 class="text-dark fw-semibold mb-0">{{ @$item->name }}</h6>
                                {{ @$item->address }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center text-dark lh-1 py-5">
                <h3 class="fw-semibold">{{ $sections['department_contact_information']->name }}</h3>
                <p class="opacity-75">{{ $sections['department_contact_information']->description }}</p>
            </div>

            <div class="row">
                @foreach ($data['depContact'] as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img height="100" class="my-4 rounded-circle"
                                    src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}" alt="Image"><br>
                                <h6 class="text-dark fw-semibold mb-0">{{ @$item->name }}</h6>
                                {{ @$item->phone }} <br>
                                {{ @$item->email }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Contact end  -->
@endsection

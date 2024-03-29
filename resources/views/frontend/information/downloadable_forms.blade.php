@extends('frontend.information.master')
@section('title')
    {{ ___('frontend.Downloadable Forms') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">{{ ___('frontend.Downloadable Forms') }}</h3>
    <div class="border-bottom mb-3"></div>
    <div class="table-responsive mb-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ ___('frontend.No') }}</th>
                    <th scope="col">{{ ___('frontend.File Name') }}</th>
                    <th scope="col">{{ ___('frontend.Download') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($forms as $key => $form)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $form->name }}</td>
                        <td><a class="text-primary" href="{{ @globalAsset(@$form->upload->path) }}" download><i class="fa-solid fa-download"></i></a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center">
                            <img src="{{ asset('images/no_data.svg') }}" alt="Image" width="100">
                            <p class="mb-0">{{ ___('common.No data available') }}</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

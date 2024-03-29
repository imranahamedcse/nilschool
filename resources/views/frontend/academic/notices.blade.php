@extends('frontend.academic.master')
@section('title')
    {{ ___('frontend.Notices') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Notices</h3>
    <div class="border-bottom mb-3"></div>
    <div class="mb-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title/Activities</th>
                        <th scope="col">Date</th>
                        <th scope="col">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['notices'] as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a class="fw-semibold text-primary" href="{{ route('academic.notice-detail',$item->id) }}">{{ $item->title }}</a></td>
                        <td>{{ dateFormat($item->date) }}</td>
                        <td><a class="text-primary" href="{{ @globalAsset(@$item->upload->path) }}" download><i class="fa-solid fa-download"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="paginations">
            @if ($data['notices']->currentPage() == 1)
                <a class="btn btn-outline-primary"
                    href="javascript:void(0)">
                    <i class="fas fa-arrow-left"></i>
                </a>
            @else
                <a class="btn btn-outline-primary"
                    href="{{ url('academic/notices?page=') }}{{ $data['notices']->currentPage() - 1 }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
            @endif
            @foreach ($data['notices']->links()['elements'][0] as $key => $item)
                <a class="btn btn-outline-primary {{ $key == $data['notices']->currentPage() ? 'active' : '' }}"
                    href="{{ $item }}">{{ $key }}</a>
            @endforeach
            @if ($data['notices']->currentPage() == count($data['notices']->links()['elements'][0]))
                <a class="btn btn-outline-primary"
                    href="javascript:void(0)">
                    <i class="fas fa-arrow-right"></i>
                </a>
            @else
                <a class="btn btn-outline-primary"
                    href="{{ url('academic/notices?page=') }}{{ $data['notices']->currentPage() + 1 }}">
                    <i class="fas fa-arrow-right"></i>
                </a>
            @endif
        </div>
    </div>
@endsection

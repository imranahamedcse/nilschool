@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@push('style')
<style>
    .quantity {
        height: 29px;
        width: 100px;
    }
</style>
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>

            <form action="{{ route('order.store') }}" enctype="multipart/form-data" method="post" id="order">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <table class="table table-bordered" id="student-document">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--  --}}
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="row">
                            @foreach ($data['items'] as $item)
                                <div class="col-12 col-md-3 mb-4">
                                    <div class="card border" onclick="addNewDocument({{ $item->id }})">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="card bg-primary-light">
                                                    <div class="card-body">
                                                        <i class="fa-solid fa-money-bill h3 mb-0 text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="px-3">
                                                    <span class="text-body-secondary">{{ $item->name }}</span>
                                                    <p class="fw-bold fs-5 mb-0">{{ $item->price }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12 mt-24">
                        <div class="text-end">
                            <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                </span>{{ ___('create.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script>
    function addNewDocument(id) {

        var url = $('#url').val();
        var formData = {
            id: id,
        }

        $.ajax({
            type: "GET",
            dataType: 'html',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url + '/canteen/order/add-new-item',
            success: function(data) {
                $("#student-document tbody").append(data);
            },
            error: function(data) {}
        });
    }

    function removeRow(element) {
        element.closest('tr').remove();
    }
</script>
@endpush

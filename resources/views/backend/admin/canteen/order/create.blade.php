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
                        <table class="table table-bordered mb-4" id="student-document">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--  --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="fw-bold" colspan="2">Total:</td>
                                    <td class="fw-bold" id="total">0</td>
                                    <td class="fw-bold" colspan="2" id="total_qun">0</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <input class="form-control" name="note" type="text" value="{{ old('note') }}"
                                    placeholder="{{ ___('create.enter_note') }}">
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <select class="form-control" name="discount_type" id="validationDefault09">
                                    <option value="fixed">{{ ___('create.fixed') }}</option>
                                    <option value="percentage">{{ ___('create.percentage') }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <input class="form-control" name="amount" type="number" value="{{ old('amount') }}"
                                    placeholder="{{ ___('create.enter_amount') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="row">
                            @foreach ($data['items'] as $item)
                                <div class="col-12 col-md-3 mb-4">
                                    <div class="card border" onclick="addNewDocument({{ $item->id }})">
                                        <div class="card-body text-center">
                                            <img height="55"
                                                src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}"
                                                alt="Photo"><br>
                                            <small>{{ $item->name }}</small> <br>
                                            <small class="fw-bold">{{ $item->price }}</small>
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
        function getSum() {
            var table = document.getElementById("student-document");
            var sum = 0;
            for (var i = 1; i < table.rows.length - 1; i++) {
                sum += parseFloat(table.rows[i].cells[4].innerText);
            }
            document.getElementById("total").innerText = sum + '.00 tk';

            getQuantitySum();
        }

        function getQuantitySum() {
            var quantities = document.querySelectorAll('.quantity');
            var total = 0;
            quantities.forEach(function(quantity) {
                total += parseFloat(quantity.value);
            });

            document.getElementById("total_qun").innerText = total + ' Pcs';
        }
    </script>
    <script>
        function calculateSubtotals() {

            var rows = document.querySelectorAll('#student-document tr');
            rows.forEach(function(row) {
                var unitPriceElement = row.querySelector('.unit_price');
                var quantityElement = row.querySelector('.quantity');
                var subtotalElement = row.querySelector('.subtotal');

                if (unitPriceElement && quantityElement && subtotalElement) {
                    var unitPrice = parseFloat(unitPriceElement.textContent);
                    var quantity = parseInt(quantityElement.value);
                    if (quantity < 1) {
                        quantity = 1;
                        quantityElement.value = 1;
                    }
                    var subtotal = unitPrice * quantity;
                    subtotalElement.textContent = subtotal.toFixed(2);
                }
            });

            getSum()
        }

        document.addEventListener('DOMContentLoaded', function() {
            var table = document.getElementById('student-document');
            table.addEventListener('keyup', handleEvent);
            table.addEventListener('click', handleEvent);

            function handleEvent(event) {
                var target = event.target;
                if (target.classList.contains('quantity')) {
                    calculateSubtotals();
                }
            }
        });
    </script>
    <script>
        function addNewDocument(id) {

            var idsInputs = document.getElementsByName('ids[]');
            var idExists = false;

            for (var i = 0; i < idsInputs.length; i++) {
                if (idsInputs[i].value == id) {
                    idExists = true;
                    break;
                }
            }

            if (!idExists) {
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
                        calculateSubtotals();
                    },
                    error: function(data) {}
                });
            } else {
                for (var i = 0; i < idsInputs.length; i++) {
                    if (idsInputs[i].value == id) {
                        var quantityInput = idsInputs[i].closest('tr').querySelector('.quantity');
                        if (quantityInput) {
                            quantityInput.value = parseInt(quantityInput.value) + 1;
                            calculateSubtotals();
                        }
                        return;
                    }
                }
            }

        }

        function removeRow(element) {
            element.closest('tr').remove();
            calculateSubtotals();
        }
    </script>
@endpush

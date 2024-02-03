<style>
    .radio-inputs {
        display: flex;
        align-items: center;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .radio-inputs > * {
        margin: 6px;
    }

    .radio-input:checked + .radio-tile {
        border-color: #2260ff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        color: #2260ff;
    }

    .radio-input:checked + .radio-tile:before {
        transform: scale(1);
        opacity: 1;
        background-color: #2260ff;
        border-color: #2260ff;
    }

    .radio-icon {
        font-size: 25px
    }

    .radio-input:checked + .radio-tile .radio-icon svg {
        fill: #2260ff;
    }

    .radio-input:checked + .radio-tile .radio-label {
        color: #2260ff;
    }

    .radio-input:focus + .radio-tile {
        border-color: #2260ff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
    }

    .radio-input:focus + .radio-tile:before {
        transform: scale(1);
        opacity: 1;
    }

    .radio-tile {
        display: flex;
        gap: 10px;
        align-items: center;
        padding: 15px 20px;
        justify-content: center;
        border-radius: 0.5rem;
        border: 2px solid #b5bfd9;
        background-color: #fff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        transition: 0.15s ease;
        cursor: pointer;
        position: relative;
    }

    .radio-tile:before {
        content: "";
        position: absolute;
        display: block;
        width: 0.75rem;
        height: 0.75rem;
        border: 2px solid #b5bfd9;
        background-color: #fff;
        border-radius: 50%;
        top: 0.25rem;
        left: 0.25rem;
        opacity: 0;
        transform: scale(0);
        transition: 0.25s ease;
    }

    .radio-tile:hover {
        border-color: #2260ff;
    }

    .radio-tile:hover:before {
        transform: scale(1);
        opacity: 1;
    }

    .radio-label {
        color: #707070;
        transition: 0.375s ease;
        text-align: center;
        font-size: 16px;
    }

    .radio-input {
        clip: rect(0 0 0 0);
        -webkit-clip-path: inset(100%);
        clip-path: inset(100%);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }
</style>

<div class="modal-content" id="modalWidth">
    <div class="modal-header modal-header-image">
        <h5 class="modal-title" id="modalLabel2">
            @php
                $amount = $feeAssignChildren->feesMaster?->amount;
                $fineAmount = 0;
                if (date('Y-m-d') > $feeAssignChildren->feesMaster?->due_date && $feeAssignChildren->fees_collect_count == 0) {
                    $fineAmount = $feeAssignChildren->feesMaster?->fine_amount;
                    $amount += $fineAmount;
                }
            @endphp
            {{ ___('common.Fee Pay') }}
        </h5>

        <button type="button" class="m-0 btn-close d-flex justify-content-center align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times text-white" aria-hidden="true"></i></button>
    </div>
    <form action="{{ route('student-panel-fees.pay-with-stripe') }}" method="POST" id="checkout-form">
        @csrf

        <input type="hidden" name="fees_assign_children_id" value="{{ $feeAssignChildren->id }}">
        <input type="hidden" name="student_id" value="{{ $feeAssignChildren->student_id }}">
        <div class="modal-body p-4">
            <div class="row mb-3">
                <div class="col-12 mb-3">
                    <label for="exampleDataList" class="form-label">{{ ___('common.Fee Amount') }} ({{ Setting('currency_symbol') }}) <span class="fillable">*</span></label>
                    <input class="form-control ot-input bg-light" value="{{ $amount }}" readonly>
                    <input type="hidden" name="amount" value="{{ $amount - $fineAmount }}">
                    <input type="hidden" name="fine_amount" value="{{ $fineAmount }}">
                </div>
                <div class="col-12 mb-3">
                    <label for="exampleDataList" class="form-label">{{ ___('common.Date') }} <span class="fillable">*</span></label>
                    <input class="form-control ot-input" name="date" list="datalistOptions" id="exampleDataList" type="date" placeholder="{{ ___('common.date') }}" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">{{ ___('common.Payment Method') }} <span class="fillable">*</span></label>
                    <div class="input-check-radio academic-section">
                        <div class="radio-inputs">
                            <label>
                                <input class="radio-input" type="radio" name="payment_method" value="Stripe" checked>
                                    <span class="radio-tile">
                                        <span class="radio-icon">
                                            <i class="lab la-stripe"></i>
                                        </span>
                                        <span class="radio-label">Stripe</span>
                                    </span>
                            </label>
                            <label>
                                <input class="radio-input" type="radio" name="payment_method" value="Paypal">
                                <span class="radio-tile">
                                    <span class="radio-icon">
                                        <i class="lab la-paypal"></i>
                                    </span>
                                    <span class="radio-label">Paypal</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3" id="stripeOption">
                    <input type='hidden' name='stripeToken' id='stripe-token-id'>
                    <br>
                    <div id="card-element" class="form-control" ></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary py-2 px-4" data-bs-dismiss="modal">{{ ___('common.cancel') }}</button>
            <button type="button" onclick="createToken()" class="btn ot-btn-primary" id='stripe-pay-btn'>{{ ___('common.confirm') }}</button>
            <a href="{{ route('student-panel-fees.pay-with-paypal') }}?fees_assign_children_id={{ $feeAssignChildren->id }}" class="btn ot-btn-primary d-none" id='paypal-pay-btn'>{{ ___('common.confirm') }}</a>
        </div>
    </form>
</div>




<script type="text/javascript">
    $(document).on('change', '.radio-input', function () {
        let paymentMethod = $(this).val();

        if (paymentMethod === 'Stripe') {
            $('#stripeOption').show();
            $('#stripe-pay-btn').show();
            $('#paypal-pay-btn').addClass('d-none');
        } else {
            $('#stripeOption').hide();
            $('#stripe-pay-btn').hide();
            $('#paypal-pay-btn').removeClass('d-none');
        }
    });





    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    function createToken() {
        document.getElementById("stripe-pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {

            if(typeof result.error != 'undefined') {
                document.getElementById("stripe-pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */
            if(typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script>

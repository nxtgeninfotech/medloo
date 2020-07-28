@extends('frontend.layouts.app')

@section('content')

<!--Start order with prescription--->
<section class="medicines-specify-options my-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <div class="medicines h-100">
                    <div class="card box-shadow h-100">
                        <div class="card-body">
                            <div class="title">
                                <h3 class="heading-5 strong-600 mb-0">
                                    {{ __('Medicines') }} 
                                </h3>
                            </div>
                            <div class="type-of-orders-box">
                                <a href="#" class="order-option-box d-flex">
                                    <div class="order-icon">
                                        <input type="radio" name="type-of-order" id="type-of-order" selected="selected">
                                    </div>
                                    <div class="order-type-text">
                                        <span class="ml-6"><input type="file" name="order-prescription" id="order-prescription">{{ __('Order everything as per prescription') }}</span>
                                    </div>
                                </a>
                                <a href="#" class="order-option-box d-flex" >
                                    <div class="order-icon">
                                        <input type="radio" name="type-of-order" id="type-of-order2">
                                    </div>
                                    <div class="order-type-text">
                                        <span>{{ __('Search and add medicines to cart') }}</span>
                                    </div>
                                </a>
                                <a href="#" class="order-option-box d-flex" >
                                    <div class="order-icon">
                                        <input type="radio" name="type-of-order" id="type-of-order3">
                                    </div>
                                    <div class="order-type-text">
                                        <span>{{ __('Call me for details') }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <div class="valid-pre-wrapper h-100">
                    <div class="card box-shadow h-100">
                        <div class="card-body">
                            <div class="title">
                                <h3 class="heading-5 strong-600 mb-0">{{ __('Attached Prescriptions') }}</h3>
                            </div>
                            <div class="valid-pre d-flex">
                                <!-- Show image here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <ul class="float-left inline-links">
                    <li>
                        <a href="#" class="active">Continue</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End order with prescription--->


@endsection




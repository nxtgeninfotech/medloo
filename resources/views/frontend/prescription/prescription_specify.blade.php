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
                               
                                <div id="product-search-box" class="hidden">
                                    <div><a href="#" onclick="orderTypeChange('0')">â†? Back to options</a></div>
                                    <div>
                                        <div>
                                            <i class="fa fa-search"></i>
                                            <input type="text"
                                                   id="srchBarShwInfoNew" value=""
                                                   placeholder="Search medicines and health products"
                                                   autocomplete="off"
                                                   onkeyup="searchProduct(this.value)">
                                            <i class="fa fa-times-circle"></i>
                                        </div>

                                        <div id="search-product-result">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <ul class="float-left inline-links">
                                                <li>
                                                    <a href="{{ url('cart') }}"
                                                       class="active continue-button">Continue</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <form method="post" action="{{ url('prescription/checkout') }}">

                                    @csrf

                                    <div class="medicines-option-box" id="type-of-orders-box">
                                        <ul>
                                            <li>
                                                <div class="c-radio">
                                                    <input type="radio" id="type-of-order1" name="type_of_order" value="1" onclick="orderTypeChange('1');">
                                                    <label for="type-of-order1">{{ __('Order everything as per prescription') }}</label>
                                                </div>
                                                <div class="specify-note choosOne hidden">
                                                    <p class="mb-0">
                                                        <input type="number" class="w-50 pres-text" placeholder="Duration of dosage in days" name="duration" id="duration" pattern="\d*">
                                                        
                                                    <small>{{ __('e.g. 60') }}</small>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="c-radio">
                                                    <input type="radio" name="type_of_order" value="2" id="type-of-order2">
                                                    <label for="type-of-order2">{{ __('Search and add medicines to cart') }}</label>
                                                </div>
                                                <div class="specify-note order-type-text choosTwo">
                                                    <p class="mb-1">{{ __('There are 2 items added in your cart') }}</p>
                                                    <a href="javascript:void(0)" class="btn btn-outline-secondary btn-md px-3 py-2 mt-2" onclick="orderTypeChange('2')">{{ __('Add Medicines') }}</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="c-radio">
                                                    <input type="radio" name="type_of_order" value="3" id="type-of-order3" onclick="orderTypeChange('3')">
                                                    <label for="type-of-order3">{{ __('Call me for details') }}</label>
                                                </div>
                                                <div class="specify-note choosThree hidden">
                                                    <p class="mb-0">{{ __('A Medloo will call you from 011-1230000 within 30 mins to confirm medicines (8 am - 8 pm)') }}</p>
                                                </div>
                                            </li>
                                        </ul>
                                        

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <ul class="float-left inline-links">
                                                    <li>
                                                        <button type="submit"
                                                                class="active continue-button continue-submit" disabled>
                                                            Continue
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                              
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

        </div>
    </section>
    <!--End order with prescription--->


    <script>
        
//        function medicineOptionOne(){
//            $(".choosOne").show();
//            $(".choosThree").hide();
//        }
//        function medicineOptionTwo(){
//            $(".choosOne").hide();
//            $(".choosThree").hide();
//        }
//        function medicineOptionThree(){
//            $(".choosThree").show();
//            $(".choosOne").hide();
//        }
        
        function orderTypeChange(orderType) {
            $('.continue-submit').removeAttr('disabled');

            if (orderType == "0") {
                $('#type-of-orders-box').show();
                $('#product-search-box').hide();
                $('input[name=type_of_order]').prop('checked', false);
                $('.continue-submit').addAttr('disabled');

            } else if (orderType == "1") {
                $('.choosOne').show();
                $('.choosThree').hide();
            } else if (orderType == "2") {
                $('#type-of-orders-box').hide();
                $('.choosOne').hide();
                $('.choosThree').hide();
                $('#product-search-box').show();
            } else if (orderType == "3") {
                $('.choosThree').show();
                $('.choosOne').hide();
            }
        }

        function searchProduct(search) {
           
            search = search.trim();
            $('#search-product-result').html('');

            if (search == null || search.length == 0) {
                return true;
            }
            $.ajax({
                method: "post",
                url: "/ajax-search",
                data: {
                    search: search,
                    prescriptionSearch: true,
                },
                success: function (response) {
                     alert('hi');
                    response.forEach(function (product) {
                        let html = '' +
                            '<form id="option-choice-form-' + product.id + '">' +

                            '<input type="hidden" name="id" value="' + product.id + '">' +
                            '<input type="hidden" name="quantity" value="1">' +

                            '<div class="row col-md-12" style="border: groove;">\n' +
                            '<div class="col-md-8">\n' +
                            '<div>' + product.name + '</div>\n';

                        if (product.description) {
                            html += '<div>' + product.description + '</div>\n';
                        }

                        html += '</div>\n' +
                            '\n' +
                            '<div class="col-md-4">\n' +
                            '<div><span>' + product.price + '</span></div>\n';

                        if (product.effected_price) {
                            html += '<div>\n';

                            if (product.discount_type == 'amount') {
                                html += '<span>' + product.discount + ' off</span>\n';
                            } else if (product.discount_type == 'percent') {
                                html += '<span>' + product.discount + '% off</span>\n';
                            }
                            html += '<span>MRP  </span>\n' +
                                '<del class="old-product-price strong-400">' + product.effected_price + '</del>\n' +
                                '</div>\n';
                        }

                        html += '<a href="#" onclick="addToCartFromPriscription(' + product.id + ')">ADD TO CART</a>\n' +
                            '</div>\n' +
                            '</div>' +
                            '</form>';

                        $('#search-product-result').append(html);
                    })

                }
            })
        }
    </script>


@endsection




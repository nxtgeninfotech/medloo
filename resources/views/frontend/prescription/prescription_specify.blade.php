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
                                    <div><a href="#" onclick="orderTypeChange('0')">← Back to options</a></div>

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


                                <div class="type-of-orders-box" id="type-of-orders-box">
                                    <a href="#" class="order-option-box d-flex">
                                        <div class="order-icon">
                                            <input type="radio" name="type_of_order" value="1"
                                                   id="type-of-order" onclick="orderTypeChange('1')">
                                        </div>
                                        <div class="order-type-text">
                                        <span class="ml-6">
                                            {{ __('Order everything as per prescription') }}
                                        </span>
                                        </div>
                                    </a>

                                    <input type="number" placeholder="Duration of dosage in days"
                                           name="duration"
                                           id="duration" pattern="\d*" class="hidden">

                                    <a href="#" class="order-option-box d-flex">
                                        <div class="order-icon">
                                            <input type="radio" name="type_of_order" value="2"
                                                   id="type-of-order2" onclick="orderTypeChange('2')">
                                        </div>
                                        <div class="order-type-text">
                                            <span>{{ __('Search and add medicines to cart') }}</span>
                                        </div>
                                    </a>

                                    <a href="#" class="order-option-box d-flex">
                                        <div class="order-icon">
                                            <input type="radio" name="type_of_order" value="3"
                                                   id="type-of-order3" onclick="orderTypeChange('3')">
                                        </div>
                                        <div class="order-type-text">
                                            <span>{{ __('Call me for details') }}</span>
                                        </div>
                                    </a>

                                    <label class="hidden" id="call_informative">
                                        A Active Ecommerce pharmacist will call you from 011-41183088 within 30
                                        mins to
                                        confirm medicines (8 am - 8 pm)
                                    </label>


                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <ul class="float-left inline-links">
                                                <li>
                                                    <a href="{{ url('prescription/checkout') }}"
                                                       class="active continue-button">Continue</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

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

        </div>
    </section>
    <!--End order with prescription--->


    <script>
        function orderTypeChange(orderType) {
            if (orderType == "0") {
                $('#type-of-orders-box').show();
                $('#product-search-box').hide();
                $('input[name=type_of_order]').prop('checked', false);
            } else if (orderType == "1") {
                $('#duration').show();
                $('#call_informative').hide();
            } else if (orderType == "2") {
                $('#type-of-orders-box').hide();
                $('#duration').hide();
                $('#call_informative').hide();
                $('#product-search-box').show();
            } else if (orderType == "3") {
                $('#call_informative').show();
                $('#duration').hide();
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




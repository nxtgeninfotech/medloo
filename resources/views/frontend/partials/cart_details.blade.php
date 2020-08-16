<div class="container">
    <div class="row cols-xs-space cols-sm-space cols-md-space">
        <div class="col-xl-8">
            <!-- <form class="form-default bg-white p-4" data-toggle="validator" role="form"> -->
           <div class="form-default bg-white p-4">
                                <div class="table-cart border-bottom cart-page">
<!--                                    <div>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="product-image"></th>
                                                    <th class="product-name">{{__('Product')}}</th>
                                                    <th class="product-price d-none d-lg-table-cell">{{__('Price')}}</th>
                                                    <th class="product-quanity d-none d-md-table-cell">{{__('Quantity')}}</th>
                                                    <th class="product-total">{{__('Total')}}</th>
                                                    <th class="product-remove"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                           
                                    </div>-->
                                   
                                        @php
                                        $total = 0;
                                        @endphp
                                        @foreach (Session::get('cart') as $key => $cartItem)
                                            @php
                                            $product = \App\Product::find($cartItem['id']);
                                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                                            $product_name_with_choice = $product->name;
                                            if ($cartItem['variant'] != null) {
                                                $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                                            }
                                            // if(isset($cartItem['color'])){
                                            //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                                            // }
                                            // foreach (json_decode($product->choice_options) as $choice){
                                            //     $str = $choice->name; // example $str =  choice_0
                                            //     $product_name_with_choice .= ' - '.$cartItem[$str];
                                            // }
                                            @endphp
                                            <div class="cart-item">
                                            <div class="row">
                                                <div class="col-2 pr-0 mr-0">
                                                <div class="product-image">
                                                    <a href="#">
                                                        <img class="img-fluid" loading="lazy"  src="{{ asset($product->thumbnail_img) }}">
                                                    </a>
                                                </div>
                                            </div>
                                                <div class="col-10 pl-0 ml-0 d-flex flex-column">
                                                    <div class="cart-pro-name d-flex">
                                                        <div class="product-detail w-100">
                                                            <div class="product-name">
                                                                <span>{{ $product_name_with_choice }}</span>
                                                            </div>
                                                            <div class="product-short-info">
                                                                <span class="text-gray">Medlife Wellness Pvt Ltd</span>
                                                            </div>
                                                            <div class="product-delivery-date">
                                                                <span> <i class="la la-truck"></i> Delivery between Aug 18th-20th</span>
                                                            </div>
                                                        </div>                                                       
                                                        <div class="cart-pro-price justify-content-end text-right">
                                                            <!-- <div class="product-price">
                                                                <span>{{ single_price($cartItem['price']) }}</span>
                                                            </div>-->
                                                            <div class="product-total">
                                                                <span>{{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}</span>
                                                            </div>
                                                            <div class="product-off">
                                                                <span>15% Off</span>
                                                            </div>
                                                            <div class="product-mrp">
                                                                <span class="mr-1 text-gray">MRP:</span><strike>Rs14,899.00</strike>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-pro-info d-flex mt-auto">
                                                        <div class="product-quantity w-50 text-left">
                                                            @if($cartItem['digital'] != 1)
                                                            <div class="input-group input-group--style-2">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-number btn-minus" type="button" data-type="minus" data-field="quantity[{{ $key }}]">
                                                                        <i class="la la-minus"></i>
                                                                    </button>
                                                                </span>
                                                                <input type="text" name="quantity[{{ $key }}]" class="form-control input-number text-center" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="10" onchange="updateQuantity({{ $key }}, this)">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-number btn-plus" type="button" data-type="plus" data-field="quantity[{{ $key }}]">
                                                                        <i class="la la-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="product-remove w-50 text-right">
                                                            <a href="#" onclick="removeFromCartView(event, {{ $key }})" class="text-center">
                                                                <i class="la la-trash"></i> {{__('Remove')}}
                                                            </a>
                                                        </div>   
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                       

                        <div class="row align-items-center pt-3">
                            <div class="col-md-6 col-4">
                                <a href="{{ route('home') }}" class="link link--style-3 text-nowrap">
                                    <i class="la la-mail-reply"></i>
                                    {{__('Return to shop')}}
                                </a>
                            </div>
                            <div class="col-md-6 col-8 text-right">
                                @if(Auth::check())
                                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary">{{__('Continue to Shipping')}}</a>
                                @else
                                    <button class="btn btn-primary" onclick="showCheckoutModal()">{{__('Continue to Shipping')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
            <!-- </form> -->
        </div>

        <div class="col-xl-4 ml-lg-auto">
            @include('frontend.partials.cart_summary')
        </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();
</script>

@extends('frontend.layouts.app')

@section('content')

<section class="gry-bg py-4 profile">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-12 mx-auto">
                <div class="main-content">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Track Order')}}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <form class="" action="{{ route('orders.track') }}" method="GET" enctype="multipart/form-data">
                        <div class="form-box bg-white mt-4">
                            <div class="form-box-title px-3 py-2">
                                {{__('Order Info')}}
                            </div>
                            <div class="form-box-content p-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{__('Order Code')}} <span class="required-star">*</span></label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-3" placeholder="{{__('Order Code')}}" name="order_code" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-styled btn-base-1">{{__('Track Order')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @isset($order)
        <div class="card mt-4">
            <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                <div class="float-left">{{__('Order Summary')}}</div>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="details-table table">
                            <tr>
                                <td class="w-50 strong-600">{{__('Order Code')}}:</td>
                                <td>{{ $order->code }}</td>
                            </tr>
                            <tr>
                                <td class="w-50 strong-600">{{__('Customer')}}:</td>
                                <td>{{ json_decode($order->shipping_address)->name }}</td>
                            </tr>
                            <tr>
                                <td class="w-50 strong-600">{{__('Email')}}:</td>
                                @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="w-50 strong-600">{{__('Shipping address')}}:</td>
                                <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="details-table table">
                            <tr>
                                <td class="w-50 strong-600">{{__('Order date')}}:</td>
                                <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                            </tr>
                            <tr>
                                <td class="w-50 strong-600">{{__('Total order amount')}}:</td>
                                <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                            </tr>
                            <tr>
                                <td class="w-50 strong-600">{{__('Shipping method')}}:</td>
                                <td>{{__('Flat shipping rate')}}</td>
                            </tr>
                            <tr>
                                <td class="w-50 strong-600">{{__('Payment method')}}:</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        @foreach ($order->orderDetails as $key => $orderDetail)
        @php
        $status = $orderDetail->delivery_status;
        @endphp
        <div class="card mt-4">
            <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                <ul class="process-steps clearfix">
                    <li @if($status == 'pending') class="active" @else class="done" @endif>
                         <div class="icon">1</div>
                        <div class="title">{{__('Order placed')}}</div>
                    </li>
                    <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                         <div class="icon">2</div>
                        <div class="title">{{__('On review')}}</div>
                    </li>
                    <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done" @endif>
                         <div class="icon">3</div>
                        <div class="title">{{__('On delivery')}}</div>
                    </li>
                    <li @if($status == 'delivered') class="done" @endif>
                         <div class="icon">4</div>
                        <div class="title">{{__('Delivered')}}</div>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="col-6">
                    <table class="details-table table">
                        @if($orderDetail->product != null)
                        <tr>
                            <td class="w-50 strong-600">{{__('Product Name')}}:</td>
                            <td>{{ $orderDetail->product->name }} ({{ $orderDetail->variation }})</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Quantity')}}:</td>
                            <td>{{ $orderDetail->quantity }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Shipped By')}}:</td>
                            <td>{{ $orderDetail->product->user->name }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        @endforeach

        @endisset
    </div>
</section>
<section class="gry-bg py-4 order-tracking-system">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-12 mx-auto">
                <div class="card order-tracking">
                    <div class="card-body">
                        <div class="order-tracking-wrapper">
                            <form role="form" action="">
                                <div class="tab-content">
                                    <div class="tab-pane order-tracking active" role="tabpanel" id="step1">
                                        <h4 class="text-left heading-6 strong-600">{{__('Order Placed')}}</h4>
                                        <div class="row mt-4">
                                            <div class="col-lg-6 mr-auto">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="text-left heading-3 strong-600 text-uppercase text-warning">{{__('In-Transit')}}</h3>
                                                        <label class="text-primary strong-600">Request Delivery</label>
                                                    </div>
                                                    <div class="col-6 d-flex align-items-center">
                                                        <div class="courier-info">
                                                            <div class="courier-company d-inline-flex float-left">
                                                                <img src="https://i.pinimg.com/originals/61/73/9f/61739f3812ad4a460377a02e7e9c8b90.png" class="img-fluid">
                                                            </div>
                                                            <div class="courier-company-name ml-2 d-inline float-left">
                                                                <span class="text-left heading-5 strong-600">{{__('DHL')}}</span>
                                                                <a href="#" class="text-left d-block text-primary strong-600 mt-2">{{__('Support?')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-right d-flex align-items-center justify-content-end">
                                                        <div class="courier-track">
                                                            <h5 class="text-right strong-600 text-uppercase">{{__('Tracking ID')}}</h5>
                                                            <a href="#" class="text-primary strong-600 mt-1 d-block">{{__('781995035907')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mt-3">
                                                    <div class="card-body">
                                                        <div class="order-tracking-details">
                                                            <ul class="tl">
                                                                <li class="tl-item active" ng-repeat="item in retailer_history">
                                                                    <div class="datetime">
                                                                        <div class="date strong-600">25 JAN 2015</div>
                                                                        <div class="time">7:00 PM</div>
                                                                    </div>
                                                                    <div class="item-status"><span class="strong-600 mr-1 text-nowrap">Activity :</span><span class="status-info">Transit</span></div>
                                                                    <div class="item-location"><span class="strong-600 mr-1">Location :</span><span class="location-name">Mumbai</span></div>
                                                                </li>
                                                                <li class="tl-item " ng-repeat="item in retailer_history">
                                                                    <div class="datetime">
                                                                        <div class="date strong-600">25 JAN 2015</div>
                                                                        <div class="time">7:00 PM</div>
                                                                    </div>
                                                                    <div class="item-status"><span class="strong-600 mr-1 text-nowrap">Activity :</span><span class="status-info">Out for Delivery</span></div>
                                                                    <div class="item-location"><span class="strong-600 mr-1">Location :</span><span class="location-name">New Delhi - 11607 (Warehouse)</span></div>
                                                                </li>
                                                                <li class="tl-item" ng-repeat="item in retailer_history">
                                                                    <div class="datetime">
                                                                        <div class="date strong-600">25 JAN 2015</div>
                                                                        <div class="time">7:00 PM</div>
                                                                    </div>
                                                                    <div class="item-status"><span class="strong-600 mr-1 text-nowrap">Activity :</span><span class="status-info">Transit</span></div>
                                                                    <div class="item-location"><span class="strong-600 mr-1">Location :</span><span class="location-name">Mumbai</span></div>
                                                                </li>
                                                                <li class="tl-item" ng-repeat="item in retailer_history">
                                                                    <div class="datetime">
                                                                        <div class="date strong-600">25 JAN 2015</div>
                                                                        <div class="time">7:00 PM</div>
                                                                    </div>
                                                                    <div class="item-status"><span class="strong-600 mr-1 text-nowrap">Activity :</span><span class="status-info">Transit</span></div>
                                                                    <div class="item-location"><span class="strong-600 mr-1">Location :</span><span class="location-name">Mumbai</span></div>
                                                                </li>

                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection








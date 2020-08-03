@extends('frontend.layouts.app')

@section('content')
    @php
        $status = "pending";
    @endphp
    <div id="page-content">
        <section class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center py-4 border-bottom mb-4">
                                    <i class="la la-check-circle la-3x text-success mb-3"></i>
                                    <h1 class="h3 mb-3">{{__('Thank You for Your Order!')}}</h1>
                                    <h2 class="h5 strong-700">{{__('Order Code:')}} {{ $order->code }}</h2>
                                    <p class="text-muted text-italic">{{ __('A copy or your order summary has been sent to') }} {{ json_decode($order->shipping_address)->email }}</p>
                                </div>
                                <div class="mb-4">
                                    <h5 class="strong-600 mb-3 border-bottom pb-2">{{__('Order Summary')}}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="details-table table">
                                                <tr>
                                                    <td class="w-50 strong-600">{{__('Order Code')}}:</td>
                                                    <td>{{ $order->code }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">{{__('Name')}}:</td>
                                                    <td>{{ json_decode($order->shipping_address)->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">{{__('Email')}}:</td>
                                                    <td>{{ json_decode($order->shipping_address)->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">{{__('Shipping address')}}:</td>
                                                    <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="details-table table">
                                                <tr>
                                                    <td class="w-50 strong-600">{{__('Order date')}}:</td>
                                                    <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 strong-600">{{__('Order status')}}:</td>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                                                </tr>

                                                <tr>
                                                    <td class="w-50 strong-600">{{__('Shipping')}}:</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

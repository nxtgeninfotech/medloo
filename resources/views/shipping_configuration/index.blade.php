@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Select Shipping Method')}}</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('shipping_configuration.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="shipping_type">
                    <div class="radio mar-btm">
                        <input id="product-shipping" class="magic-radio" type="radio" name="shipping_type" value="product_wise_shipping" <?php if(\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping') echo "checked";?>>
                        <label for="product-shipping">
                            <span>{{__('Product Wise Shipping Cost')}}</span>
                            <span></span>
                        </label>
                    </div>
                    <div class="radio mar-btm">
                        <input id="flat-shipping" class="magic-radio" type="radio" name="shipping_type" value="flat_rate" <?php if(\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') echo "checked";?>>
                        <label for="flat-shipping">{{__('Flat Rate Shipping Cost')}}</label>
                    </div>
                    <div class="radio mar-btm">
                        <input id="seller-shipping" class="magic-radio" type="radio" name="shipping_type" value="seller_wise_shipping" <?php if(\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping') echo "checked";?>>
                        <label for="seller-shipping">{{__('Seller Wise Flat Shipping Cost')}}</label>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Note')}}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        1. Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost.
                    </li>
                    <li class="list-group-item">
                        2. Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn't matter. Shipping cost is fixed.
                    </li>
                    <li class="list-group-item">
                        3. Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If a customer purchase 2 product from two seller shipping cost is calculate by addition of each seller flat shipping cost.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Flat Rate Cost')}}</h3>
            </div>
            <form action="{{ route('shipping_configuration.update') }}" method="POST" enctype="multipart/form-data">
            <div class="panel-body">
                @csrf
                <input type="hidden" name="type" value="flat_rate_shipping_cost">
                <div class="form-group">
                    <div class="col-lg-12">
                        <input class="form-control" type="text" name="flat_rate_shipping_cost" value="{{ \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value }}">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" type="submit">{{__('Update')}}</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Note')}}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Shipping Cost for Admin Products')}}</h3>
            </div>
            <form action="{{ route('shipping_configuration.update') }}" method="POST" enctype="multipart/form-data">
            <div class="panel-body">
                @csrf
                <input type="hidden" name="type" value="shipping_cost_admin">
                <div class="form-group">
                    <div class="col-lg-12">
                        <input class="form-control" type="text" name="shipping_cost_admin" value="{{ \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value }}">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" type="submit">{{__('Update')}}</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Note')}}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

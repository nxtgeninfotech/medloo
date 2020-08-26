@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Paytm Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('paytm.update_credentials') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYTM_ENVIRONMENT">
                        <div class="col-lg-4">
                            <label class="control-label">{{__('PAYTM ENVIRONMENT')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYTM_ENVIRONMENT" value="{{  env('PAYTM_ENVIRONMENT') }}" placeholder="local or production" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYTM_MERCHANT_ID">
                        <div class="col-lg-4">
                            <label class="control-label">{{__('PAYTM MERCHANT ID')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYTM_MERCHANT_ID" value="{{  env('PAYTM_MERCHANT_ID') }}" placeholder="PAYTM MERCHANT ID" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYTM_MERCHANT_KEY">
                        <div class="col-lg-4">
                            <label class="control-label">{{__('PAYTM MERCHANT KEY')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYTM_MERCHANT_KEY" value="{{  env('PAYTM_MERCHANT_KEY') }}" placeholder="PAYTM MERCHANT KEY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYTM_MERCHANT_WEBSITE">
                        <div class="col-lg-4">
                            <label class="control-label">{{__('PAYTM MERCHANT WEBSITE')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYTM_MERCHANT_WEBSITE" value="{{  env('PAYTM_MERCHANT_WEBSITE') }}" placeholder="PAYTM MERCHANT WEBSITE" >
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYTM_CHANNEL">
                        <div class="col-lg-4">
                            <label class="control-label">{{__('PAYTM CHANNEL')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYTM_CHANNEL" value="{{  env('PAYTM_CHANNEL') }}" placeholder="PAYTM CHANNEL" >
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYTM_INDUSTRY_TYPE">
                        <div class="col-lg-4">
                            <label class="control-label">{{__('PAYTM INDUSTRY TYPE')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYTM_INDUSTRY_TYPE" value="{{  env('PAYTM_INDUSTRY_TYPE') }}" placeholder="PAYTM INDUSTRY TYPE" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

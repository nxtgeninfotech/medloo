@extends('frontend.layouts.app')

@section('content')

<!--Start order with prescription--->
    <section class="order-with-prescription my-4 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="upload-prescription h-100">
                        <div class="card box-shadow h-100">
                            <div class="card-body">
                                <div class="title">
                                    <h3 class="heading-5 strong-600 mb-0">
                                        {{ __('Upload Prescription') }} 
                                    </h3>
                                    <p> {{ __('Please attach a prescription to proceed') }}</p>
                                </div>
                                <div class="upload-box">
                                    <a href="" class="upload-option-box d-flex">
                                        <div class="upload-icon">
                                            <span class="la la-upload"></span>
                                        </div>
                                        <div class="upload-text">
                                            <span class="ml-6">{{ __('UPLOAD NEW') }}</span>
                                        </div>
                                    </a>
                                    <a href="" class="upload-option-box d-flex">
                                        <div class="upload-icon">
                                            <span class="la la-save"></span>
                                        </div>
                                        <div class="upload-text">
                                            <span>{{ __('SAVED PRESCRIPTIONS') }}</span>
                                        </div>
                                    </a>
<!--                                    <div class="file-upload-wrapper" data-text="Select your file!">
                                        <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                    </div>-->
                                </div>
                                
                                <div class="title">
                                    <h3 class="heading-5 strong-600 mb-0">{{ __('Attached Prescriptions') }}</h3>
                                </div>
                                <div class="attached-pre-box">
                                    <ul>
                                        <li>
                                            <div class="pre-img-item">
                                                <a href="" class="delete-icon">
                                                    <span class="la la-times-circle"></span>
                                                </a>
                                                <a href="" class="pre-img">
                                                    <img src="https://rximages.1mg.com/320x320/eb4f6e99-492d-4620-a27e-bb90db7af184.jpeg">
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="pre-img-item">
                                                <a href="" class="delete-icon">
                                                    <span class="la la-times-circle"></span>
                                                </a>
                                                <a href="" class="pre-img">
                                                    <img src="https://rximages.1mg.com/320x320/eb4f6e99-492d-4620-a27e-bb90db7af184.jpeg">
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="valid-pre-wrapper h-100">
                        <div class="card box-shadow h-100">
                            <div class="card-body">
                                <div class="title">
                                    <h3 class="heading-5 strong-600 mb-0">{{ __('Guide for a valid prescription') }}</h3>
                                </div>
                                <div class="valid-pre d-flex">
                                    <img src="https://www.1mg.com/images/online_consultation/validate_rx.svg">
                                    <div class="valid-list">
                                        <ul>
                                            <li>{{ __('Don\'t crop out any part of the image') }}</li>
                                            <li>{{ __('Avoid blurred image') }}</li>
                                            <li>{{ __('Include details of doctor and patient + clinic visit date') }}</li>
                                            <li>{{ __('Medicines will be dispensed as per prescription') }}</li>
                                            <li>{{ __('Supported files type: jpeg , jpg , png , pdf') }}</li>
                                            <li>{{ __('Maximum allowed file size: 5MB') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <small>{{ __('Government regulations require a valid prescription') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--End order with prescription--->

<!--Start Saved Prescriptions--->
<section class="saved-prescriptions mt-4 mb-5" style="display:none;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="saved-pre-wrapper">
                   <div class="card box-shadow">
                        <div class="card-body">
                            <div class="back-to-page">
                                <a href="">
                                    <span class="la la-arrow-left"></span> {{ __('Back to options') }}
                                </a>
                            </div>
                            <div class="title">
                                <h3 class="heading-5 strong-600 mb-0">{{ __('Saved Prescriptions (1 selected)') }}</h3>
                            </div>
                            <div class="saved-pre-box">
                                <ul>
                                    <li>
                                        <div class="pre-img-item">
                                            <div class="custom-chckbox">
                                             <label><input type="checkbox" /><span class="lbl padding-8"></span></label>
                                            </div>
                                            <a href="" class="pre-img">
                                                <img src="https://rximages.1mg.com/320x320/eb4f6e99-492d-4620-a27e-bb90db7af184.jpeg">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="pre-img-item">
                                            <div class="custom-chckbox">
                                             <label><input type="checkbox" /><span class="lbl padding-8"></span></label>
                                            </div>
                                            <a href="" class="pre-img">
                                                <img src="https://rximages.1mg.com/320x320/eb4f6e99-492d-4620-a27e-bb90db7af184.jpeg">
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
</section>
<!--End Saved Prescriptions--->

@endsection



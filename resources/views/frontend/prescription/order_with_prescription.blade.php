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
                                    <h3 class="heading-5 strong-700 mb-0">
                                        {{ __('Upload Prescription') }}
                                    </h3>
                                    <p> {{ __('Please attach a prescription to proceed') }}</p>
                                </div>
                                <div class="upload-box">
                                    <a href="#" class="upload-option-box d-flex">
                                        <div class="upload-icon">
                                            <span class="la la-upload"></span>
                                        </div>
                                        <div class="upload-text upload-new">
                                        <span class="ml-6">
                                            {{ __('UPLOAD NEW') }}
                                        </span>
                                        </div>
                                        <input type="file" name="upload-prescription" multiple id="upload-prescription"
                                               class="hidden" onchange="handleFiles(this)">
                                    </a>
                                    <a href="#" class="upload-option-box d-flex" id="saved-prescriptions">
                                        <div class="upload-icon">
                                            <span class="la la-save"></span>
                                        </div>
                                        <div class="upload-text">
                                            <span>{{ __('SAVED PRESCRIPTIONS') }}</span>
                                        </div>
                                    </a>
                                    <!--                  <div class="file-upload-wrapper" data-text="Select your file!">
                                                        <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                                    </div>-->
                                </div>

                                <div class="title">
                                    <h3 class="heading-5 strong-600 mb-0">{{ __('Attached Prescriptions') }}</h3>
                                </div>
                                <div class="attached-pre-box">


                                        <div class="uploaded-pre-show  @if(count($prescriptions) > 0) hidden  @endif">
                                        <span class="uploaded-demo-img">
                                            <img src='{{ asset('uploads/image/prescription-demo.png')}}'
                                                 class="img-fluid">
                                        </span>
                                            <span class="uploaded-demo-text">
                                            <span
                                                class='text-gray'>{{ __('Uploaded prescriptions will be shown here') }}</span>
                                        </span>
                                        </div>


                                    <ul id="attached_prescriptions">

                                        @foreach($prescriptions as $prescription)
                                            <li>
                                                <div class='pre-img-item' id="prescription_{{ $prescription->id }}">
                                                    <a href='#' class='delete-icon'
                                                       onclick="deleteImage({{ $prescription->id }})">
                                                        <span class='la la-times-circle'></span>
                                                    </a>
                                                    <a href='' class='pre-img'>
                                                        <img
                                                            src='{{ asset('uploads/prescription/').'/'.$prescription->image }}'>
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach

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
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12">
                    <a href="{{ url('order-with-prescription/specify') }}"
                       class="active continue-button btn btn-primary">Continue</a>
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
                                    <a href="#" id="back-to-options" class="btn-back-small">
                                        <span class="la la-arrow-left"></span> {{ __('Back to options') }}
                                    </a>
                                </div>
                                <div class="title">
                                    <h3 class="heading-5 strong-600 mb-0">{{ __('Saved Prescriptions ') }}</h3>
                                </div>
                                <div class="saved-pre-box">
                                    <ul>

                                    </ul>
                                </div>


                            </div>


                        </div>

                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <ul class="float-left inline-links">
                                    <li>
                                        <a href="#" class="active continue-button" onclick="setPrescriptionImages()">CONTINUE</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
    </section>
    <!--End Saved Prescriptions--->



@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            // Save prescription script
            $("#saved-prescriptions").click(function () {
                $(".order-with-prescription").hide();
                $(".saved-prescriptions").show();

                getAllPrescriptionImages();
            });
            // Back to options click script
            $("#back-to-options").click(function () {
                $(".order-with-prescription").show();
                $(".saved-prescriptions").hide();
            });
        });

        $(function () {
            $('.upload-new').click(function () {
                $(this).next('input[type="file"]').trigger('click');
                return false;
            });
        });


        function handleFiles(fileInput) {
            var files = fileInput.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;

                if (!file.type.match(imageType)) {
                    continue;
                }


                var img = document.createElement("img");
                img.classList.add("obj");
                img.file = file;


                var reader = new FileReader();
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result;

                        var html = "<li>";
                        html += "<div class='pre-img-item'>";
                        html += "<a href='' class='delete-icon'>";
                        html += "<span class='la la-times-circle'></span>";
                        html += "</a>";
                        html += " <a href='' class='pre-img'>";
                        html += "<img src='" + aImg.src + "'>";
                        html += " </a>";
                        html += "</div>";
                        html += "</li>";
                        $('#attached_prescriptions').append(html);
                        $('.uploaded-pre-show').hide();

                        $.ajax({
                            url: "ajax/prescription/image/store",
                            method: "post",
                            dataType: 'json',
                            data: {
                                image: aImg.src
                            }
                        });

                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }

        function deleteImage(pId) {
            $.ajax({
                method: "post",
                url: "ajax/prescription/image/delete",
                data: {
                    "pid": pId
                },
                success: function () {
                    $('#prescription_' + pId).hide();
                }
            })
        }

        function getAllPrescriptionImages() {

            $('.saved-prescriptions .saved-pre-box ul').html('');

            $.ajax({
                method: "get",
                url: "ajax/prescription/image/list",
                success: function (response) {
                    response.data.forEach(function (item) {

                        let checked = item.is_default ? 'checked' : '';

                        var html = '<li>';
                        html += '<div class="pre-img-item">';
                        html += '<div class="custom-chckbox">';
                        html += ' <label > <input type = "checkbox" ' + checked + ' value="' + item.id + '" /> <span class= "lbl padding-8" > </span></label>';
                        html += '</div>';
                        html += '<a href = "" class= "pre-img" >';
                        html += '<img src ={{ asset("uploads/prescription") }}/' + item.image + ' >';
                        html += '</a>';
                        html += '</div>';
                        html += ' </li>';

                        $('.saved-prescriptions .saved-pre-box ul').append(html);
                    });
                }
            })
        }

        function setPrescriptionImages() {

            let active = [];
            $('.saved-prescriptions .saved-pre-box ul li').each(function (item) {
                var $cb = $(this).find(":checkbox");
                if ($cb.prop("checked")) {
                    active.push($cb.val());
                    $('.uploaded-pre-show').hide();
                }
            });

            $.ajax({
                method: "post",
                url: "ajax/prescription/image/update-default",
                data: {
                    ids: active
                },
                success: function () {
                    location.reload();
                }
            })
        }


    </script>
@endsection



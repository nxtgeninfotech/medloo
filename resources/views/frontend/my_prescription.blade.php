@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('My Prescription')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a
                                                    href="{{ route('my-prescription') }}">{{__('My prescription')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count($prescriptions) > 0)
                            <div class="saved-prescriptions card no-border mt-4">
                                <div class="saved-pre-box">
                                    <ul>
                                        @foreach($prescriptions as $prescription)
                                            <li>
                                                <div class="pre-img-item">
                                                    <a href="#" class="pre-img">
                                                        <img class="img-fluid"
                                                             id="pre-img-{{ $prescription->id }}"
                                                             src="{{ asset("uploads/prescription") .'/'. $prescription->image }}"
                                                             onclick="openImageInModal(this.id)"
                                                        >
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- The Modal -->
    <div id="myModal" class="image-modal modal" style="z-index: 9999;">
        <button class="close-modal close">&times;</button>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>



@endsection



@section('script')
    <script>

        function openImageInModal(id) {
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById(id);
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function () {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close-modal")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }
        }

    </script>
@endsection

<script type="text/javascript">
    function signUpModal(redirectURL = null) {

        $.ajax({
            url: "{{ url('check-auth') }}",
            method: "get",
            data: {
                redirect_url: redirectURL
            },
            success: function (response) {
                if (response == "true") {
                    window.location.replace("/order-with-prescription");
                } else {
                    $('#signUpModal').modal('toggle');

                    $('#LoginModel').hide();
                    $('#RegisterModel').show();
                }


            }
        });
    }

    function signInForm() {
        $('#LoginModel').show();
        $('#RegisterModel').hide();
    }

    function signUpForm() {
        $('#LoginModel').hide();
        $('#RegisterModel').show();
    }

    function closeModal() {
        $("#login").trigger("reset");
        $("#register").trigger("reset");
        $('#signUpModal').modal('toggle');
    }

</script>


<div class="modal fade signup-modal" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <button type="button" class="close" onclick="closeModal()">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="row mx-0">
                <div class="col-lg-6 col-md-6 text-center d-flex align-items-center bg-primary bg-img">
                    <div class="signup-leftside text-center">
                        <img src="{{ asset('uploads/image/drug.png') }}" class="img-fluid w-25 mb-5">
                        <div class="title">
                            <h3 class="heading-5 strong-600 mb-4 text-white">
                                {{ __('Health Related Queries?') }}
                            </h3>
                            <p class="text-white"> {{ __('Get medicine information, order medicines, book lab tests and consult doctors online from the comfort of your home.') }}</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 align-self-center">


                    <div class="signup-rightside">


                        <div id="LoginModel">
                            <div class="title">
                                <h3 class="heading-3 strong-600 mb-0">
                                    {{ __('Sign In') }}
                                </h3>
                                <p>
                                    <small>{{ __('Please enter your Mobile number to receive One Time Password (OTP)') }}</small>
                                </p>
                            </div>
                            <div class="signup-form">
                                <form method="POST" action="{{ route('login') }}" id="login">

                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter email"
                                               id="email">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password"
                                               placeholder="Password"
                                               id="password">
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4 w-100">Continue</button>
                                </form>
                                <div class="form-bottom text-center">
                                    <p class="mb-1">New user ? <a href="#" class="text-secondary strong-600"
                                                                  onclick="signUpForm()">Sign
                                            Up</a>
                                    </p>
                                    <p class="text-gray mt-3">By signing up, you agree to our <br>
                                        <a href=""
                                           class="text-underline strong-600">Terms
                                            and Conditions</a> & <a href="" class="text-underline strong-600">Privacy
                                            Policy</a></p>
                                </div>
                            </div>


                        </div>

                        <div id="RegisterModel">
                            <div class="title">
                                <h3 class="heading-3 strong-600 mb-0">
                                    {{ __('Sign Up') }}
                                </h3>
                                <p>
                                    <small>{{ __('Please enter your Mobile number to receive One Time Password (OTP)') }}</small>
                                </p>
                            </div>
                            <div class="signup-form">
                                <form method="POST" action="{{ route('register') }}" id="register">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" required name="name" placeholder="Name"
                                               id="name">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" required name="email"
                                               placeholder="Enter email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" required min="6" name="password"
                                               placeholder="Password"
                                               id="password">
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4 w-100">Continue</button>
                                </form>
                                <div class="form-bottom text-center">
                                    <p class="mb-1">have an account? <a href="#" class="text-secondary strong-600 "
                                                                        onclick="signInForm()">Login</a>
                                    </p>

                                    <p class="text-gray mt-3">By signing up, you agree to our <br> <a href=""
                                                                                                      class="text-underline strong-600">Terms
                                            and Conditions</a> & <a href="" class="text-underline strong-600">Privacy
                                            Policy</a></p>
                                </div>
                            </div>

                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

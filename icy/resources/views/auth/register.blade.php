@extends('layouts.main')

@section('content')
<!--================================================== log_in_page ==============================================-->
<div class="container-fluid">
    <!-- Register section -->
    <section class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Material form Register -->
                <div class="card mt-4 mb-4">
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Sign up</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <div class="text-center mt-2" style="color: #757575;">
                            <small><strong>The Hip Hop, Rap, R&B community to discuss topics involving the culture.
                                    Write and share
                                    knowledge, news, music and connect with the best people.</strong></small>
                            <!-- Password -->
                            <div class="form-row">
                                <div class="col">
                                    <a href="{{ url('login/facebook') }}">
                                        <button type="button"
                                            class="btn btn-outline-primary btn-block my-4 waves-effect">
                                            <i class="fab fa-facebook-square"></i> Facebook</button>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ url('login/google') }}">
                                        <button type="button" style="border: 2px solid #DB4437!important; 
                                        background-color: transparent!important;
                                        color: #DB4437!important;"
                                            class="btn btn-outline-danger btn-block my-4 waves-effect">
                                            <i class="fab fa-google"></i> Google</button>
                                    </a>
                                </div>
                            </div>
                            <span style="text-align: center;">Already have an accout? <a href="/login">Login</a></span>
                            <br />
                            <br />
                            <small>To make Icytape work, we log user data and share it with service providers. Click
                                “Facebook” or "Google" above to accept Icytape's <a href="/terms">Terms of Service</a>,
                                <a href="/privacy">Privacy Policy</a>, <a href="/content-policy">Content Policy</a>, <a href="/guidelines">Community Guidelines</a>.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--================================================== log_in_page ==============================================-->
@endsection

@extends('layouts.main')

@section('content')

<!-- This Page Needs Deletion -->

@if(Auth::user()->role_id == '1')
<!--================ EMAIL Password Reset Link PAGE  ===================================== -->
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<!--================================================== FORM EMAIL SITE ==============================================-->
<form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
    @csrf
    <div class="form-group label-floating">
        <label class="control-label">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
            value="{{ old('email') }}" required placeholder="E-Mail Address">
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <button type="submit" class="btn btn-lg btn-primary full-width">
        {{ __('Send Password Reset Link') }}
    </button>
</form>

<div class="container-fluid">
    <section class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card mt-4 mb-4">
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Reset Password</strong>
                    </h5>
                    <div class="card-body px-lg-5 pt-0">
                        <form class="text-center" style="color: #757575;">
                            <div class="md-form">
                                <input type="email" id="materialLoginFormEmail" class="form-control">
                                <label for="materialLoginFormEmail">E-mail</label>
                            </div>
                            <button class="btn btn-outline-info btn-block my-4 waves-effect" type="submit">
                                Send Password Reset Link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endif
<!--================ EMAIL Password Reset Link PAGE  ===================================== -->
@endsection

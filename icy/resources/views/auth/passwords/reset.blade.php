@extends('layouts.main')

@section('content')

<!-- This Page Needs Deletion -->

@if(Auth::user()->role_id == '1')
<!--================ EMAIL Reset PAGE  ===================================== -->
<form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group label-floating">
        <label class="control-label">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
            value="{{ $email ?? old('email') }}" required autofocus placeholder="E-Mail Address">
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group label-floating">
        <label class="control-label">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
            name="password" required>
        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group label-floating">
        <label class="control-label">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-lg btn-primary full-width">
        {{ __('Reset Password') }}
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
<!--================ EMAIL PAGE  ===================================== -->
@endsection

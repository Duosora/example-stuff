@extends('layouts.main')

@section('content')
<div class="container">
    <section class="mt-4">
        <div class="row">
            <h3 class="col-md-12 pb-2">Edit Your Profile</h3>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <center class="m-t-30"> <img 
                                data-src="{!! asset(Voyager::image( $User->avatar )) !!}"
                                alt="{{ $User->name }}" class="lazy rounded-circle img-fluid" width="150">
                            <h5 class="card-title m-t-10">{{ $User->name }}</h5>
                            <div class="row text-center justify-content-md-center grey-text pt-1">
                                <div class="col-12">
                                    <p class="card-subtitle">Points: {{ COUNT($User->Points)  }}</p>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['url'=>"users/$User->name",'files' => 'true', 'method' => 'PUT']) }}
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <input class="form-control" type="text" name="name" placeholder="Username"
                                    value="{{ $User->name }}">
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="input-default-wrapper">
                                    <input type="file" id="file-with-current" name="avatar" class="input-default-js">
                                    <label class="label-for-default-js rounded-right" for="file-with-current"><span
                                            class="span-choose-file">Choose
                                            file</span>
                                        <div class="float-right span-browse">Browse</div>
                                    </label>
                                </div>
                            </div>

                            <div style="display:none;">
                                <div class="col-md-6">
                                    <label>Email Address:</label>
                                    <input type="Email" class="form-control" name="email" placeholder="Email Address :"
                                        value="{{ $User->email }}">
                                </div>
                                <div class="col-md-6">
                                    <label> Password (leave blank to keep the original password) </label>
                                    <input type="text" class="form-control" name="password" placeholder="Password">
                                    {{ Form::hidden('password', $User->password) }}
                                    {{ Form::hidden('remember_token', $User->remember_token) }}
                                </div>
                            </div>

                        </div>
                        <!-- Sign up button -->
                        <button class="btn button-br-95rem btn-info btn-sm my-4 float-right waves-effect waves-light" type="submit"
                            id="contact_submit">Save</button>
                        {{ Form::close() }}

                        <!-- Default form register -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- ===================================================  User EDIT ================================= -->
@endsection

@extends('layouts.main')

@section('content')
<div class="container">
    <section class="my-5">
        <h2 class="h1-responsive font-weight-bold text-center my-5">Contact us</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="fas fa-question fa-2x blue-text"></i>
                <p class="mt-4">Any Questions | Call us 24/7!</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-phone fa-2x blue-text"></i>
                <p class="mt-4">{{ setting('page-contact.Phone') }}</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-envelope fa-2x  blue-text"></i>
                <p class="mt-4">{{ setting('page-contact.Email') }}</p>
            </div>
        </div>
    </section>
</div>
@endsection

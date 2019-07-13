@extends('layouts.main')

@section('content')
<div class="container">
    <!-- Profile section -->
    <section class="mt-4">
        <div class="row">
            <h3 class="col-md-12 pb-2">Profile</h3>
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
                        <h5 class="card-title mt-1">My Uploads</h5>
                        <hr>
                        @if(COUNT($Posts) == 0)
                        <div class="col-sm-12 ">
                            <div class="alert alert-success text-center mt-30" role="alert">
                                No posts yet! <a href="{{ url('posts') }}/create"
                                    class="alert-link">Create Something</a>
                            </div>
                        </div>
                        @elseif(COUNT($Posts) != 0)
                        <div class="profiletimeline">
                            @foreach ($Posts as $Post)
                            <div class="sl-item">
                                <div class="sl-right">
                                    <div>
                                        <p class="link mb-0">
                                            @if($User->id == Auth::user()->id)
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $Post->id]]) }}
                                            {{ csrf_field() }}
                                            <button type="submit" style="background: none; 
                                            border:none;
                                            padding:0;
                                            float: right!important;">
                                                <i class="fas fa-trash-alt float-right text-info" title="Delete post"
                                                    data-toggle="tooltip"></i>
                                            </button>
                                            {{ Form::close() }}
                                            @endif
                                        </p>
                                        <p class="mb-0"> <a
                                                href="/{{ $Post->category->name }}/{{ $Post->slug }}-{{ $Post->id }}"
                                                class="title">{!! substr($Post->title,
                                                0, 90) !!}</a> <span> |
                                            </span><span>{{ date('n/j/y', strtotime($Post->created_at)) }}</span><span>
                                                | </span><span>{{ $Post->category->name }}</span>
                                        </p>
                                        <!--TODO add number of comments and views-->
                                        <div class="like-comm"> <a class="link m-r-10"><i class="far fa-comments"></i>
                                                2</a> <a class="link m-r-10"><i class="far fa-eye"></i>5</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            <div class="col-sm-12 text-center">
                                <!-- ========================================== Posts User PAGINATE  ============================ -->
                                {{ $Posts->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile section end -->
</div>
@endsection

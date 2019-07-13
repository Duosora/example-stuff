@extends('layouts.main')

@section('content')


<!--================ ALl Categores Post===================================== -->
<div class="container max-width-900">
    <!-- All Posts section -->
    <section class="mt-4">
        <div class="row mb-2">
            @foreach ($Posts as $Post)
            @if ($loop->first)
            <h3 class="col">All {{ $Post->category->name }} Posts</h3>
            @endif
            @endforeach
            <div class="col">
                <select class=" post-sort float-right">
                    <option value="" disabled>Choose option</option>
                    <option value="1" selected>Trending</option>
                    <option value="2">Controversial</option>
                    <option value="3">Newest</option>
                    <option value="4">Oldest</option>
                </select>
                <label class="sort-title float-right small-screen-only">SORT</label>
            </div>
        </div>

        <div class="row">
            @foreach ($Posts as $Post)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <!-- Card -->
                <div class="card custom-card mb-4 all-post-card">
                    <!-- Card image -->
                    <div class="view overlay">
                        @if($Post->category->name === "NSFW")
                        <a href="/{{ $Post->category->name }}/{{ $Post->slug }}-{{ $Post->id }}">
                            <div class="lazy card-img-top" role="img" aria-label="{{$Post->title}}"
                                data-src="/assets/img/nsfw.png">
                                <img alt="{{$Post->title}}" class="d-none">
                            </div>
                        </a>
                        @else
                        <a href="/{{ $Post->category->name }}/{{ $Post->slug }}-{{ $Post->id }}">
                            <div class="lazy card-img-top" role="img" aria-label="{{$Post->title}}"
                                data-src="{{ Voyager::image($Post->image) }}">
                                <img alt="{{$Post->title}}" class="d-none">
                            </div>
                        </a>
                        @endif
                        <div class="post-category">{{ $Post->category->name }}</div>
                    </div>

                    <div class="height-auto-pt-10 card-body pb-0">
                        <a href="/{{ $Post->category->name }}/{{ $Post->slug }}-{{ $Post->id }}">
                            <h5 class="text-dark font-size-14 card-title text-center font-weight-bold mb-1"
                                data-toggle="tooltip" title="{{$Post->title}}">
                                {!! str_limit($Post->title, 52, '...') !!}
                            </h5>
                        </a>
                    </div>

                    <div class="rounded-bottom text-center datetime-likes-comments">
                        <div class="datetime grey-text"><i class="far fa-clock pr-1"></i>
                            {{ date('n/j/y', strtotime($Post->created_at)) }}</div>
                        <div class="likes-comments">
                            <div class="likes  pr-2"><a href="JavaScript:Void(0);" class="grey-text"><i
                                        class="far fa-comment pr-1"></i>21</a></div>
                            <!--TODO add number of comments-->
                            <div class="comments"><a href="JavaScript:Void(0);" class="grey-text"><i
                                        class="far fa-eye pr-1"></i>5</a>
                            </div>
                            <!--TODO add number of views-->
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div>
            @endforeach
        </div>
    </section>
    <!-- All Posts section end -->
</div>

<div class="col-sm-12 text-center">
    {{ $Posts->links() }}
</div>

@endsection

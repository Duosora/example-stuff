@extends('layouts.main')

@section('content')
<div class="container max-width-900">
    <!-- Featured Posts section -->
    <section class="mt-4">
        <div class="row mb-2">
            <h3 class="col">Featured Posts</h3>
        </div>

        <div class="responsive-featured">
            @foreach ($FeatPosts->shuffle() as $fPost)
            <div class="col">
                <!-- Card -->
                <div class="card custom-card mb-4 all-post-card">
                    <div class="view overlay">
                        @if($fPost->category->name === "NSFW")
                        <a href="/{{ $fPost->category->name }}/{{ $fPost->slug }}-{{ $fPost->id }}" data-toggle="modal"
                            data-target="#centralModalInfo">
                            <div class="lazy card-img-top" role="img" aria-label="{{$fPost->title}}"
                                data-src="/assets/img/nsfw.png">
                                <img alt="{{$fPost->title}}" class="d-none">
                            </div>
                        </a>
                        @else
                        <a href="/{{ $fPost->category->name }}/{{ $fPost->slug }}-{{ $fPost->id }}">
                            <div class="lazy card-img-top" role="img" aria-label="{{$fPost->title}}"
                                data-src="{{ Voyager::image($fPost->image) }}">
                                <img alt="{{$fPost->title}}" class="d-none">
                            </div>
                        </a>
                        @endif
                        <div class="post-category">{{ $fPost->category->name }}</div>
                    </div>
                    <div class="height-auto-pt-10 card-body pb-0">
                        <a href="/{{ $fPost->category->name }}/{{ $fPost->slug }}-{{ $fPost->id }}">
                            <h5 class="text-dark font-size-14 card-title text-center font-weight-bold mb-1"
                                data-toggle="tooltip" title="{{$fPost->title}}">{!! str_limit($fPost->title, 52, '...')
                                !!}</h5>
                        </a>
                    </div>

                    <div class="rounded-bottom text-center datetime-likes-comments">
                        <div class="datetime grey-text"><i class="far fa-clock pr-1"></i>
                            {{ date('n/j/y', strtotime($fPost->created_at)) }}</div>
                        <div class="likes-comments">
                            <div class="likes pr-2"><a href="JavaScript:Void(0);" class="grey-text"><i
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
        <div class="paginator-center text-color text-center">
            <span class="prev-0">
                <span class="prev btn btn-primary btn-circle btn-xl" style="border-radius: 35px;"><i
                        class="fa fa-chevron-left"></i>
                </span>
            </span>
            <span class="next-0">
                <span class="next btn btn-primary btn-circle btn-xl" style="border-radius: 35px;"><i
                        class="fa fa-chevron-right"></i>
                </span>
            </span>
        </div>
        <section class="my-3">
            <div class="border-bottom"></div>
        </section>
</div>


<div class="container max-width-900">
    <!-- All Posts section -->
    <section class="mt-4">
        <div class="row mb-2">
            <h3 class="col">All Posts</h3>
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
                        <a href="/{{ $Post->category->name }}/{{ $Post->slug }}-{{ $Post->id }}" data-toggle="modal"
                            data-target="#centralModalInfo">
                            <div class="lazy card-img-top" role="img" aria-label="{{$Post->title}}"
                                data-src="/assets/img/nsfw.png">
                                <img alt="{{$Post->title}}" class="d-none">
                            </div>
                        </a>
                        <!-- ll@elseif($Post->body != null)ll -->
                        <!--<a href="/{{ $Post->category->name }}/{{ $Post->slug }}-{{ $Post->id }}">
                            <div class="lazy card-img-top" role="img" aria-label="{{$Post->title}}"
                                data-src="/assets/img/text-post.png">
                                <img alt="{{$Post->title}}" class="d-none">
                            </div>
                        </a>-->
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
    <!-- Central Modal Medium Info -->
    <div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">Test 18+ MODAL <!--Age Verification Required --></p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <div class="text-center">
                        <p><b>THIS CONTENT IS INTENDED FOR ADULT AUDIENCES ONLY.</b></p>
                        <p>You must be 18 or over to access this content.</p>
                        <p>If you have reached this page in error or are
                            under the age of 18 please click the exit link below.</p>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <a role="button" class="btn btn-info btn-sm button-br-95rem waves-effect waves-light">Yes, I'm over 18</a>
                    <a role="button" class="btn btn-info btn-sm button-br-95rem waves-effect waves-light" data-dismiss="modal">Exit</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Central Modal Medium Info-->
</div>
{{ $Posts->links() }}

@endsection

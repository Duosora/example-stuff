@extends('layouts.main') 

@section('title', $Post->title.' - IcyTape')
 
@section('content') 
 
<div class="container max-width-900"> 
    <section class="mt-4"> 
        <div class="row"> 
            <div class="col-md-8 mb-4"> 
                <div class="card mb-4 "> 
                    <!--Card content--> 
                    <div class="card-body"> 
                        <p class="h3 mb-3">{!! substr($Post->title, 0, 290) !!}</p> 
 
                        @if($Post->image != null) 
                        <div class="card mb-2"> 
                            <img data-src="{!! asset(Voyager::image($Post->image)) !!}" class="lazy img-fluid img-max-height-512" 
                                alt="{!! substr($Post->title, 0, 290) !!} Post Image"> 
                        </div> 
                        @endif 
 
                        @if($Post->body != null) 
                        <div id="text-body" class="card mb-2 p-2"> 
                            {!! $Post->body !!} 
                        </div> 
                        @endif 
 
                        @if($Post->url != null) 
                        <div class="card mb-2"> 
                            <!-- Get Image URL ---> 
                            <!-- Get Image Thumbnail ---> 
                            {!! $Embed->code !!} 
                        </div> 
                        @endif 
                        <div class="post-social-icon"> 
                            <div class="row"> 
                                <div class="col text-center"> 
                                    <a href="#" class="m-10 text-success like" id="{{ $Post->id }}"> 
                                        <i class="far fa-thumbs-up" title="Like" id="{{ $Post->id }}" 
                                            data-toggle="tooltip"></i> 
                                    </a> 
                                    <a class="m-10"> 
                                        <i class="far fa-eye" title="views" data-toggle="tooltip"></i> 250 
                                    </a> 
                                    <a href="JavaScript:Void(0);" class="m-10 text-muted" data-toggle="modal" 
                                        data-target="#flag"> 
                                        <i class="far fa-flag" title="Report" data-toggle="tooltip"></i> 
                                    </a> 
                                    <a class="m-10"> 
                                        <i class="far fa-comment" title="comments" data-toggle="tooltip"></i> 50 
                                    </a> 
                                    <a href="#" class="m-10 text-danger dislike" id="{{ $Post->id }}"> 
                                        <i class="far fa-thumbs-down" title="Dislike" id="{{ $Post->id }}" 
                                            data-toggle="tooltip"></i> 
                                    </a> 
                                </div> 
                            </div> 
                            <div class="row"> 
                                <div class="col text-center mt-2"> 
                                    <input type="text" id="url_post_detail" readonly /> 
                                    <button id="copy-link-button" 
                                        class="btn btn-sm button-br-95rem btn-outline-info waves-effect" 
                                        onclick="copy('url_post_detail')">Share link <span 
                                            class="far fa-copy ml-1"></span></button> 
                                    @if(Auth::id()) 
                                    @if(Auth::user()->role_id === 1) 
                                    <div class="altgroup"> 
                                        @if($Post->feature === null) 
                                        <a href="#" id="{{ $Post->id }}_F" 
                                            class="feature altbtn btn btn-sm button-br-95rem btn-outline-info waves-effect">Feature 
                                            Post</a> 
                                        @else 
                                        <a href="#" id="{{ $Post->id }}_U" 
                                            class="feature altbtnX btn btn-sm button-br-95rem btn-outline-info waves-effect">UnFeature 
                                            Post</a> 
                                        @endif 
                                    </div> 
                                    @endif 
                                    @endif 
                                </div> 
                            </div> 
                        </div> 
                        <div id="feature_info"></div> 
                        <div id="like_info"></div> 
                        <hr> 
                        <!--/.Featured Image--> 
                        <div class="media d-block d-md-flex mt-3"> 
                            <img class="lazy d-flex mb-3 mx-auto z-depth-1 rounded-circle img-fluid" 
                                data-src="{!! asset(Voyager::image( $Post->user->avatar )) !!}" alt="Avatar image" 
                                style="height: 40px;"> 
                            <div class="media-body text-center text-md-left ml-md-3 ml-0"> 
                                <h6>Posted by:</h6> 
                                <h5 href="{{ url('users') }}/{{ $Post->user->name }}" class="mt-0 font-weight-bold"> 
                                    {{ $Post->user->name }}</h5> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
 
 
 
                <!-- =========================================== Flag Modal body (Does not Show By default) ============================ --> 
                <div id="flag" class="flag-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="flagLabel" 
                    aria-hidden="true"> 
                    <div class="modal-dialog" role="document"> 
                        <div class="modal-content"> 
                            <div class="modal-body"> 
                                <ul> 
                                    <li><a href="JavaScript:Void(0);" class="flag" id="{{ $Post->id }}_broken">This link 
                                            is 
                                            broken</a></li> 
                                    <li><a href="JavaScript:Void(0);" class="flag" id="{{ $Post->id }}_spam">This Post 
                                            is a spam 
                                            post</a></li> 
                                    <li><a href="JavaScript:Void(0);" class="flag" id="{{ $Post->id }}_nsfw">This Post 
                                            has NSFW 
                                            Content</a></li> 
                                </ul> 
                                <div id="flag_info"> Click Any of the links to report on this Post </div> 
                            </div> 
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
                <!-- =========================================== Flag Modal body (Does not Show By default) ============================ --> 
 
 
                <!--Comments--> 
                <div class="card card-comments mb-3 "> 
                    <div class="card-header info-color white-text">{{ COUNT($comments) }} comments</div> 
                    <div class="card-body"> 
                        @foreach($comments as $comment) 
                        <div class="media d-md-flex mt-4"> 
                            <a href="{{ url('users') }}/{{ $comment->user->name }}"> 
                                <img class="lazy d-flex mb-3 mx-auto rounded-circle img-fluid" 
                                    data-src="{!! asset(Voyager::image( $comment->user->avatar )) !!}" 
                                    alt="avatar {{ $comment->user->name }} image"> 
                            </a> 
                            <div class="media-body text-md-left ml-md-3 ml-2"> 
                                <p class="m-0 font-size-12">{{ $comment->user->name }} 
                                    <small 
                                        class="text-muted">{{ date('n/j/y', strtotime($comment->created_at)) }}</small> 
                                </p> 
                                <p>{{ $comment->content }}</p> 
                            </div> 
 
                            @if(Auth::id()) 
                            <div class="post-social-icon"> 
                                <div class="row"> 
                                    <div class="col text-center"> 
                                        <a href="#{{ $comment->id }}" class="m-10 text-success" 
                                            onclick="commentLike({{ $comment->id }})"> 
                                            <i class="far fa-thumbs-up" title="like" data-toggle="tooltip"></i> 
                                        </a> 
                                        <a href="#{{ $comment->id }}" onclick="commentDislike({{ $comment->id }})" 
                                            class="m-10 text-danger"> 
                                            <i class="far fa-thumbs-down" title="dislike" data-toggle="tooltip"></i> 
                                        </a> 
                                    </div> 
                                </div> 
                            </div> 
                            @endif 
 
 
                            <!-- ============= Below For Form Submission Messages================= --> 
 
                            @if (Session::has('msg')) 
                            <div class="form-group mt-4"> 
                                <div class="col-md-12"> 
                                    <div class="alert alert-danger alert-dismissable"> 
                                        <button type="button" class="close" data-dismiss="alert" 
                                            aria-hidden="true">×</button> 
                                        {{Session::get('msg')}} 
                                    </div> 
                                </div> 
                            </div> 
                            @endif 
 
                        </div> 
                        <div id="comment_info_{{ $comment->id }}" name="{{ $comment->id }}"></div> 
                        @endforeach 
 
                        <!-- ============= Below For Form Submission Messages================= --> 
 
                        @if (Session::has('msg')) 
                        <div class="form-group mt-4"> 
                            <div class="col-md-12"> 
                                <div class="alert alert-danger alert-dismissable"> 
                                    <button type="button" class="close" data-dismiss="alert" 
                                        aria-hidden="true">×</button> 
                                    {{Session::get('msg')}} 
                                </div> 
                            </div> 
                        </div> 
                        @endif
                        
                        @if (Session::has('dmsg')) 
                        <div class="form-group mt-4"> 
                            <div class="col-md-12"> 
                                <div class="alert alert-danger alert-dismissable"> 
                                    <button type="button" class="close" data-dismiss="alert" 
                                        aria-hidden="true">×</button> 
                                    {!! Session::get('dmsg') !!} 
                                </div> 
                            </div> 
                        </div> 
                        @endif
 
                        @if (Session::has('goodmsg')) 
                        <div class="form-group mt-4"> 
                            <div class="col-md-12"> 
                                <div class="alert alert-success alert-dismissable"> 
                                    <button type="button" class="close" data-dismiss="alert" 
                                        aria-hidden="true">×</button> 
                                    {!! Session::get('goodmsg') !!} 
                                </div> 
                            </div> 
                        </div> 
                        @endif 
 
                        @if(Auth::id()) 
                        {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }} 
                        {{ csrf_field() }} 
                        {{ Form::hidden('post_id', $Post->id) }} 
                        <div class="form-group mt-4"> 
                            <label for="quickReplyFormComment">Your comment</label> 
                            <textarea class="form-control" name="content" id="quickReplyFormComment" 
                                rows="5" required></textarea> 
                            <div class="text-center"> 
                                <button class="btn button-br-95rem btn-info btn-sm waves-effect waves-light" 
                                    type="submit" name="submit">Post</button> 
                            </div> 
                        </div> 
                        {{ Form::close() }} 
                        @endif 
 
                        @if(!Auth::id()) 
                        {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }} 
                        {{ csrf_field() }} 
                        {{ Form::hidden('post_id', $Post->id) }} 
                        <div class="form-group mt-4"> 
                            <label for="quickReplyFormComment">Post Comment As Guest</label> 
                            <textarea class="form-control" name="content" id="quickReplyFormComment" 
                                rows="5" required></textarea> 
                        </div> 
                        
                        
                                <!--- Modal for --->
                                <div class="modal fade" id="guestcheck1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">SignUp / Post As Guest <!--Age Verification Required --></p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body" style="padding: 0px;">
                    <div class="text-center">
                        
                    <div class="form-row" style="padding: 1rem;margin: 0px;">
                                <div class="col">
                                    <a href="{{ url('login/facebook') }}">
                                        <button type="button" style="background-color: rgba(169,169,169,0.6)"
                                            class="btn btn-block my-4 waves-effect">
                                            <i class="fab fa-facebook-square"></i> Sign Up With Facebook To Post</button>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ url('login/google') }}">
                                        <button type="button" style="background-color: rgba(169,169,169,0.6)"
                                            class="btn btn-block my-4 waves-effect">
                                            <i class="fab fa-google"></i> Sign Up With Google To Post</button>
                                    </a>
                                </div>
                            </div>
                    </div>

                    <div class="form-row" style="border-top: 2px #ddd solid;margin: 0px;">
                    <div class="col" style="padding: 1rem"><label><input type='checkbox' onclick='handleGuest(`guest_submit4`);'>&nbsp;&nbsp; Click Checkbox to Post As Guest</label></div></div>

                    <div class="form-row" id="guest_submit4" style="border-top: 2px #ddd solid;margin: 0px;visibility: hidden;">
                        <div class="col" style="padding: 1rem"><div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div></div>
                        <div class="col" style="padding: 1rem">
                <button class="btn button-br-95rem btn-info btn-sm my-4 float-right waves-effect waves-light" type="submit">Post As Guest</button></div>
            </div>


                     <!--Footer-->
               
                    
                </div>
                <div class="modal-footer">
                    <a role="button" class="btn btn-info btn-sm button-br-95rem waves-effect waves-light" data-dismiss="modal">Exit</a>
                </div>
                
            </div>
               
            </div>
</div>






<a class="btn button-br-95rem btn-info btn-sm my-4 float-right waves-effect waves-light" type="submit" data-toggle="modal" data-target="#guestcheck1" >Post</a>

                        {{ Form::close() }} 
                        @endif 
                    </div> 
                </div> 
            </div> 
 
            <div class="col-md-4 mb-4"> 
                <div class="card mb-4 "> 
                    <div class="card-header info-color white-text">Popular Posts</div> 
                    <div class="card-body"> 
                        <ul class="list-unstyled mb-0"> 
                            @foreach ($PopularPosts as $PopularPost) 
                            <li class="media mb-2"> 
                                <a 
                                    href="/{{ $PopularPost->category->name }}/{{ $PopularPost->slug }}-{{ $PopularPost->id }}"> 
                                    <img class="lazy d-flex mr-3" width="100" height="50" 
                                        href="/{{ $PopularPost->category->name }}/{{ $PopularPost->slug }}-{{ $PopularPost->id }}" 
                                        data-src="{!! asset(Voyager::image($PopularPost->image)) !!}" 
                                        alt="Popular Post image"> 
                                </a> 
                                <div class="media-body font-size-12"> 
                                    <a 
                                        href="/{{ $PopularPost->category->name }}/{{ $PopularPost->slug }}-{{ $PopularPost->id }}"> 
                                        <p class="mt-0 mb-1">{!! str_limit($PopularPost->title, 30, '...') !!}</p> 
                                    </a> 
                                    <!-- TODO Make this View count and Comment Count --> 
                                    <div class="post-social-icon"> 
                                        <a> 
                                            <i class="far fa-eye" title="views" data-toggle="tooltip"></i>2200 
                                        </a> 
                                        <a> 
                                            <i class="far fa-comment" title="comments" data-toggle="tooltip"></i>50 
                                        </a> 
                                    </div> 
                                </div> 
                            </li> 
                            @endforeach 
                        </ul> 
                    </div> 
                </div> 
 
                <div class="card mb-4 "> 
                    <div class="card-header info-color white-text">Categories</div> 
                    <div class="card-body pt-0"> 
                        <ul class="list-group list-group-flush post-category-card"> 
                            @foreach ($Catmenus as $Catmenu) 
                            <li class="list-group-item"> 
                                <a href="{{ url('categories') }}/{{ $Catmenu->slug }}"> 
                                    <i class="fas fa-chevron-circle-right"></i> 
                                    {{ $Catmenu->name}} 
                                </a> 
                            </li> 
                            @endforeach 
                        </ul> 
                    </div> 
                </div> 
            </div> 
 
        </div> 
</div> 
</section> 
<!--Section: Post--> 
</div> 
 
<!--================================================== Post Detail page ============================================== --> 
@stop 

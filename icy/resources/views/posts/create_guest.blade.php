@extends('layouts.main')

@section('content')
<!--================================================== create_page ============================================== -->
<div class="container">
    <!-- Create Posts section -->
    <section class="mt-4">
        <div class="row">
            <h3 class="col-md-12 pb-2">Create Post</h3>
            
            @if (Session::has('msg'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        {{Session::get('msg')}}
                                    </div>
                                </div>
                                @endif

                                @if (Session::has('goodmsg'))
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        {!! Session::get('goodmsg') !!}
                                    </div>
                                </div>
                                @endif

            <div class="col-md-12 text-center">
                <div class="card create-post-page">
                    <nav class="nav-justified ">
                        <div class="nav nav-tabs " id="nav-tab" role="tablist">
                            <a class="nav-item nav-link waves-effect waves-light active" id="pop1-tab" data-toggle="tab"
                                href="#pop1" role="tab" aria-controls="pop1" aria-selected="true"><i
                                    class="fas fa-file-alt mr-1"></i>Text</a>
                            <a class="nav-item nav-link waves-effect waves-light" id="pop2-tab" data-toggle="tab"
                                href="#pop2" role="tab" aria-controls="pop2" aria-selected="false"><i
                                    class="fas fa-image mr-1"></i>Image</a>
                            <a class="nav-item nav-link waves-effect waves-light" id="pop3-tab" data-toggle="tab"
                                href="#pop3" role="tab" aria-controls="pop3" aria-selected="false"><i
                                    class="fas fa-link mr-1"></i>Link</a>
                        </div>
                    </nav>
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">

                            {{ Form::open(['route' => ['posts.store'],'files' => 'true', 'method' => 'POST']) }}
                                {{ csrf_field() }}

                                    <div class="form-row form-group">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Post Title"
                                                name="title" required>
                                        </div>

                                        <div class="col">
                                            <select class="browser-default custom-select" name="category_id" required>
                                                <option value="" selected="" disabled=""> Post Category</option>
                                                @foreach ($Categores as $Category)
                                                <option value="{{ $Category->id }}" name="category_id">
                                                    {{ $Category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" id="" rows="7"
                                            placeholder="Content Post Body" name="body"></textarea>
                                    </div>


                                    
                                


                                <!--- Modal for --->
                                <div class="modal fade" id="guestcheck2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <div class="col" style="padding: 1rem"><label><input type='checkbox' onclick='handleGuest(`guest_submit1`);'>&nbsp;&nbsp; Click Checkbox to Post As Guest</label></div></div>

                    <div class="form-row" id="guest_submit1" style="border-top: 2px #ddd solid;margin: 0px;visibility:hidden;">
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

<a class="btn button-br-95rem btn-info btn-sm my-4 float-right waves-effect waves-light" type="submit" data-toggle="modal" data-target="#guestcheck2" >Post</a>




                                        {{ Form::close() }}
                            </div>

                            <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                                {{ Form::open(['route' => ['posts.store'],'files' => 'true', 'method' => 'POST']) }}
                                {{ csrf_field() }}
                                <div class="form-row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Post Title" name="title"
                                            required>
                                    </div>

                                    <div class="col">
                                        <select class="browser-default custom-select" name="category_id" required>
                                            <option value="" selected="" disabled=""> Post Category</option>
                                            @foreach ($Categores as $Category)
                                            <option value="{{ $Category->id }}" name="category_id">
                                                {{ $Category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!--================ Needs to work without Body ===================================== -->
                                <div style="display:none;" class="col-md-12">
                                    <label>Post Body</label>
                                    <textarea class="form-control" rows="4"
                                        value="This Content Needs to work without Body" placeholder="Content Post Body"
                                        name="body">This Content Needs to work without Body</textarea>
                                </div>
                                <!--================ Needs to work without Body ===================================== -->

                                <div class="form-group files">
                                    <input type="file" name="image" class="file form-control" placeholder="upload"
                                        required>
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
                    <div class="col" style="padding: 1rem"><label><input type='checkbox' onclick='handleGuest(`guest_submit2`);'>&nbsp;&nbsp; Click Checkbox to Post As Guest</label></div></div>

                    <div class="form-row" id="guest_submit2" style="border-top: 2px #ddd solid;margin: 0px;visibility:hidden;">
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
                            </div>

                            <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                                {{ Form::open(['route' => ['posts.store'],'files' => 'true', 'method' => 'POST']) }}
                                {{ csrf_field() }}
                                <div class="form-row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Post Title" name="title"
                                            required>
                                    </div>

                                    <div class="col">
                                        <select class="browser-default custom-select" name="category_id" required>
                                            <option value="" selected="" disabled=""> Post Category</option>
                                            @foreach ($Categores as $Category)
                                            <option value="{{ $Category->id }}" name="category_id">
                                                {{ $Category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="url" class="form-control" placeholder="URL" required>
                                </div>


                                <!--- Modal for --->
<div class="modal fade" id="guestcheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <div class="col" style="padding: 1rem"><label><input type='checkbox' onclick='handleGuest(`guest_submit3`);'>&nbsp;&nbsp; Click Checkbox to Post As Guest</label></div></div>

                    <div class="form-row" id="guest_submit3" style="border-top: 2px #ddd solid;margin: 0px;visibility:hidden;">
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
<div>
                                <a class="btn button-br-95rem btn-info btn-sm my-4 float-right waves-effect waves-light" type="submit" data-toggle="modal" data-target="#guestcheck" >Post</a>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Create Posts section end -->
</div>
<!--================================================== create_page ============================================== -->
@endsection

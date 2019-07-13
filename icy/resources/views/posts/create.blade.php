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
                <div class="alert alert-error"> 
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
                                    <textarea class="form-control" rows="7" 
                                        placeholder="Content Post Body" name="body"></textarea> 
                                </div> 
 
                                <button 
                                    class="btn btn-info button-br-95rem btn-sm my-4 float-right waves-effect waves-light" 
                                    type="submit">Post</button> 
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
 
                                <div class="form-group files"> 
                                    <input type="file" name="image" class="file form-control" placeholder="upload" 
                                        required> 
                                </div> 
                                <button 
                                    class="btn button-br-95rem btn-info btn-sm my-4 float-right waves-effect waves-light" 
                                    type="submit">Post</button> 
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
                                <button 
                                    class="btn button-br-95rem btn-info btn-sm my-4 float-right waves-effect waves-light" 
                                    type="submit">Post</button> 
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

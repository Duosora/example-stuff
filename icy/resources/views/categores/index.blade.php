@extends('layouts.main')

@section('content')


<!-- video-item -->
<div class="container max-width-900">
    <section class="mt-4">
        <div class="row">
            @foreach ($Categores as $Category)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media d-block d-md-flex">
                            <a href="{{ url('categories') }}/{{ $Category->slug }}">
                                <img class="lazy d-flex mb-3 mx-auto z-depth-1"
                                    data-src="{{ Voyager::image($Category->imagecat) }}" alt="Category Image"
                                    style="width: 50px;">
                            </a>
                            <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                <h5 class="mt-0 font-weight-bold ">
                                    <a href="{{ url('categories') }}/{{ $Category->slug }}" class="text-info">{!!
                                        substr($Category->name, 0, 90) !!}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
<!--================================================== CATEGORY_page ============================================== -->
@endsection

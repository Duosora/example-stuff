<!DOCTYPE html> 
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage"> 
 
<head> 
    <!-- ====== Meta site ================== --> 
    <meta charset="utf-8"> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"> 
    <meta name="referrer" content="origin-when-crossorigin"> 

    @section('title', 'Icytape: rap & hip hop community of the internet') 
    <title>@yield('title')</title> 
 
    @section('description', setting('site.description')) 
    <meta name="description" content="@yield('description')"> 
    @section('url', Request::url() ) 
    <meta itemprop="image" content="/assets/img/icon-256x256.png"> 
    <meta name="url" content="@yield('url')"> 
    <meta name="robots" content="index, follow"> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
 
    <meta property="og:title" content="@yield('title')"> 
    <meta property="og:description" content="@yield('description')"> 
    <meta property="og:url" content="@yield('url')"> 
    <meta property="og:ttl" content="600"> 
    <meta property="og:site_name" content="Icytape"> 
    <meta property="og:type" content="website"> 
    <meta property="og:image" content="/assets/img/icon-256x256.png"> <!-- Make Image tag dynamic --> 
    <meta property="og:image:width" content="256"> 
    <meta property="og:image:height" content="256"> 
 
    <meta property="twitter:title" content="@yield('title')"> 
    <meta name="twitter:description" content="@yield('description')"> 
    <meta name="twitter:url" content="@yield('url')"> 
    <meta property="twitter:site" content="@icytape"> 
    <meta property="twitter:card" content="summary"> 
    <meta property="twitter:image" content="/assets/img/icon-256x256.png"> 
 
    <meta name="apple-mobile-web-app-title" content="@yield('title')"> 
    <meta name="application-name" content="Icytape"> 
    <meta name="msapplication-TileColor" content="#f2f2f2"> 
    <meta name="msapplication-TileImage" content="/assets/img/favicon/mstile-144x144.png"> 
    <meta name="theme-color" content="#ffffff"> 
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-touch-icon.png"> 
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png"> 
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon/favicon-16x16.png"> 
    <link rel="manifest" href="/assets/img/favicon/site.webmanifest"> 
    <link rel="mask-icon" href="/assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5"> 
    <link rel="canonical" href="https://www.icytape.com/"> 
 
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" 
        integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"> 
    </script> 
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.5/css/mdb.min.css" rel="stylesheet"> 
 
    <link 
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:400,500,700|Roboto:300,400,500,700,900|Ubuntu:300,300i,400,400i,500,500i,700" 
        rel="stylesheet"> 
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" 
        integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" /> 
 
    <script src='https://www.google.com/recaptcha/api.js'></script> 
 
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" /> 
 
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" /> 
</head> 
 
<body> 
 
    <header> 
        <!--Navbar --> 
        <nav class="mobile-only mb-1 navbar navbar-expand-lg navbar-light white top-nav-collapse"> 
            <a class="navbar-brand" href="{{ url('/') }}"> 
                <img data-src="/assets/img/logo/mobile-logo.png" alt="mobile logo" class="lazy logo"> 
            </a> 
            <div class="mobile-menu"> 
                <!-- toggle button --> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" 
                    data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" 
                    aria-expanded="false" aria-label="Toggle navigation"> 
                    <i class="fas fa-search " aria-hidden="true"></i> 
                </button> 
 
                <a alt="Post" class="btn btn-info post-mobile" href="{{ url('posts') }}/create" role="button"> 
                    <i class="fas fa-pencil-alt"></i> 
                </a> 
                @guest 
                <a alt="Login" class="btn btn-info btn-sm button-br-95rem" href="{{ route('login') }}" role="button"> 
                    login <i class="fas fa-sign-in-alt ml-1"></i> 
                </a> 
                @else 
                @if(Auth::user()->role_id == '1') 
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false"> 
                    Admin 
                </a> 
                <!-- profile drop-down --> 
                <div class="dropdown-menu dropdown-menu-right dropdown-default" 
                    aria-labelledby="navbarDropdownMenuLink-333"> 
                    <a class="dropdown-item" href="{{ url('admin') }}"><i 
                            class="fas fa-user-circle mr-2 ml-2 text-info"></i>My Admin</a> 
                    <a class="dropdown-item" href="{{ url('users') }}/{{ Auth::user()->name }}"><i 
                            class="far fa-edit mr-2 ml-2 text-info"></i>Edit Profile</a> 
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i 
                            class="fas fa-sign-out-alt mr-2 ml-2 text-info"></i>Logout</a> 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                        @csrf 
                    </form> 
                </div> 
                @else 
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false" href="{{ url('users') }}/{{ Auth::user()->name }}"> 
                    <img id="avatar-image" 
                        data-src="{!! asset(Voyager::image(Auth::user()->avatar)) !!}" class="lazy rounded-circle z-depth-0" 
                        alt="avatar image"> 
                </a> 
                <!-- profile drop-down --> 
                <div class="dropdown-menu dropdown-menu-right dropdown-default" 
                    aria-labelledby="navbarDropdownMenuLink-333"> 
                    <a class="dropdown-item" href="{{ url('users') }}/{{ Auth::user()->name }}"><i 
                            class="fas fa-user-circle mr-2 ml-2 text-info"></i>Profile</a> 
                    <a class="dropdown-item" href="{{ url('users') }}/{{ Auth::user()->name }}/edit"><i 
                            class="far fa-edit mr-2 ml-2 text-info"></i>Edit Profile</a> 
                    <a class="dropdown-item" href="{{ url('posts') }}/create"><i 
                            class="fas fa-pen-square mr-2 ml-2 text-info"></i>Post</a> 
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"> 
                        <i class="fas fa-sign-out-alt mr-2 ml-2 text-info"></i>Logout</a> 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                        @csrf 
                    </form> 
                </div> 
                @endif 
                @endguest 
            </div> 
            <div class="collapse navbar-collapse" id="navbarSupportedContent-333"> 
                <ul class="navbar-nav w-75 custom-nav-search"> 
                    <li class="nav-item"> 
                        {!! Form::open(['method'=>'GET','url'=>'search','role'=>'search','id'=>'search']) !!} 
                        {{ csrf_field() }} 
                        <div class="form-inline mt-0 mb-0 form-sm"> 
                            <input class="form-control form-control-sm ml-3 w-75 custom-search" type="search" 
                                name="search" placeholder="Search here...." aria-label="Search" autocomplete="off"> 
                        </div> 
                        {!! Form::close() !!} 
                    </li> 
                </ul> 
            </div> 
        </nav> 
 
        <nav class="desktop-only mb-1 navbar navbar-expand-lg navbar-light white top-nav-collapse"> 
            <a class="navbar-brand" href="{{ url('/') }}"> 
                <img data-src="/assets/img/logo/desktop-logo.png" alt="logo" class="lazy"> 
            </a> 
            <ul class="navbar-nav" style="width: 50%;"> 
                <li class="nav-item" style="width: 100%;"> 
                    {!! Form::open(['method'=>'GET','url'=>'search','role'=>'search','id'=>'search']) !!} 
                    {{ csrf_field() }} 
                    <div class="form-inline mt-0 mb-0 form-sm"> 
                        <!-- TODO remove inline style --> 
                        <input class="form-control form-control-sm ml-3 w-100 custom-search" type="search" name="search" 
                            placeholder="Search here...." aria-label="Search" autocomplete="off"> 
                    </div> 
                    {!! Form::close() !!} 
                </li> 
            </ul> 
            <!-- Post, login and profile section --> 
            <ul class="navbar-nav ml-auto nav-flex-icons md-right"> 
                <li class="nav-item desktop-only"> 
                    <a alt="Post" class="btn btn-info btn-sm button-br-95rem" href="{{ url('posts') }}/create" 
                        role="button"> 
                        Post <i class="fas fa-pencil-alt ml-1"></i></a> 
                </li> 
                @guest 
                <li class="nav-item"> 
                    <a alt="Login" class="btn btn-info btn-sm button-br-95rem" href="{{ route('login') }}" 
                        role="button"> 
                        login <i class="fas fa-sign-in-alt ml-1"></i></a> 
                </li> 
                @else 
                @if(Auth::user()->role_id == '1') 
                <li class="nav-item dropdown"> 
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false"> 
                        Admin 
                    </a> 
                    <!-- profile drop-down --> 
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" 
                        aria-labelledby="navbarDropdownMenuLink-333"> 
                        <a href="{{ url('admin') }}" class="dropdown-item">My Admin</a> 
                        <a href="{{ url('users') }}/{{ Auth::user()->name }}" class="dropdown-item">Profile</a> 
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a> 
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                            @csrf 
                        </form> 
                    </div> 
                </li> 
                @else 
                <li class="nav-item dropdown"> 
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false" href="{{ url('users') }}/{{ Auth::user()->name }}"> 
                        <img id="avatar-image" 
                            data-src="{!! asset(Voyager::image(Auth::user()->avatar)) !!}" class="lazy rounded-circle z-depth-0" 
                            alt="avatar image"> 
                    </a> 
                    <!-- profile drop-down --> 
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" 
                        aria-labelledby="navbarDropdownMenuLink-333"> 
                        <a class="dropdown-item" href="{{ url('users') }}/{{ Auth::user()->name }}"><i 
                                class="fas fa-user-circle mr-2 ml-2 text-info"></i>Profile</a> 
                        <a class="dropdown-item" href="{{ url('users') }}/{{ Auth::user()->name }}/edit"><i 
                                class="far fa-edit mr-2 ml-2 text-info"></i>Edit Profile</a> 
                        <a class="dropdown-item" href="{{ url('posts') }}/create"><i 
                                class="fas fa-pen-square mr-2 ml-2 text-info"></i>Post</a> 
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i 
                                class="fas fa-sign-out-alt mr-2 ml-2 text-info"></i>Logout</a> 
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                            @csrf 
                        </form> 
                    </div> 
                </li> 
                @endif 
                @endguest 
            </ul> 
        </nav> 
 
    </header> 
 
    <!-- ============================================================= Header End ============================================================= --> 
 
    <main> 
        @yield('content') 
    </main> 
 
     
    <footer class="footer font-small"> 
        <hr class="divider-footer"> 
        <div class="container-fluid text-center"> 
            <div class="row"> 
                <div class="col-md-4"> 
                    <div class="text-md-center py-1"> 
                        <a href="/terms">Terms</a> | 
                        <a href="/privacy">Privacy</a> | 
                        <a href="/content-policy">Content</a> | 
                        <a href="/guidelines">Guidelines</a> 
                    </div> 
                </div> 
                <div class="col-md-4"> 
                    <div class="text-md-center py-1"> 
                        <a href="/get-featured">GET FEATURED</a> | 
                        <a href="/leaderboard">Leaderboard</a> | 
                        <a href="/categories">Categories</a> | 
                        <a href="/contact">Contact</a> 
                    </div> 
                </div> 
                <div class="col-md-4"> 
                    <div class="footer-copyright text-md-center py-1">© 2019 Copyright: 
                        <a href="/">IcyTape</a> 
                    </div> 
                </div> 
            </div> 
        </div> 
        <hr class="divider-footer mb-0"> 
    </footer> 
     
 
    <!-- ====== jquery-min.js  ================== --> 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" 
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> 
 
    <!-- ====== popper ================== --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"> 
    </script> 
 
    <!-- ====== bootstrap.min.js ================== --> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"> 
    </script> 
 
    <!-- MDB core JavaScript --> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.5/js/mdb.min.js"> 
    </script> 
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" 
        integrity="sha256-NXRS8qVcmZ3dOv3LziwznUHPegFhPZ1F/4inU7uC8h0=" crossorigin="anonymous"></script> 
 
    <script type="text/javascript" src="{{ asset('assets/js/lazy-load.min.js') }}"></script> 
 
    <!-- ====== custom.js ================== --> 
    <script src="{{ asset('assets/js/custom.js') }}"></script> 
     
    <script src="{{ asset('assets/js/extra.js') }}"></script> 
 
</body> 
 
</html>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>
    <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>
    <meta property="fb:app_id" content="222301579012442" />
    @if(isset($og))
    {!! $og->renderTags() !!}
    @endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Learning 21') }}</title>
    <!-- Script -->
    <script src="/js/jquery-3.4.1.slim.min.js"></script>
    <script src="/css/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha256-T/f7Sju1ZfNNfBh7skWn0idlCBcI3RwdLSS4/I7NQKQ=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css').'?v='.filemtime('css/app.css') }}" rel="stylesheet">
    <link href="/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link href="/css/font-awesome/css/all.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-primary bg-primary mb-3">
    <a class="navbar-brand text-bold text-white" href="{{ route('welcome') }}">
        <img src="{{ asset('images/digital-library.png') }}" alt="Play Store" class="logo-admin" style="width: 50px;">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        @if(!Auth::guest() && Auth::user()->admin == 0)
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('book') }}"><i class="fa fa-book" aria-hidden="true"></i> จัดการหนังสือ</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('shelf', base64_encode(Auth::user()->email) ) }}"><i class="fa fa-paper-plane"></i> ห้องสมุดของฉัน</a></li>
        @endif
        <!-- for Admin -->
        @if(!Auth::guest() && Auth::user()->role_id == 1)
            <!-- <li class="nav-item"><a class="nav-link text-primary" href="{{ route('books') }}"><i class="fas fa-book" aria-hidden="true"></i> หนังสือทั้งหมด</a></li> -->
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('users') }}"><i class="fas fa-users" aria-hidden="true"></i> สมาชิก</a></li>
        @endif
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}"><span class="fa fa-sign-in"></span> Login</a></li>
            @else
            @if(Auth::user()->email_verified == 0)
                <li class="nav-item bg-warning rounded-pill px-3">
                    <a href="{{ route('verification.resend') }}" data-toggle="popover" data-content="ส่งอีเมล์ยืนยันตัวตนอีกครั้ง" title="Resend verification email" class="nav-link text-danger">
                        <i class="fa fa-warning" aria-hidden="true"></i> กรุณายืนยันอีเมล์
                        <i class="fas fa-paper-plane"></i>
                    </a>
                </li>
            @endif
            <li class="nav-item"><a class="nav-link text-warning" href="{{ route('upload') }}"><i class="fa fa-upload" aria-hidden="true"></i> Upload</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-white" id="userNavmenu" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="userNavmenu">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-cog"></i> ตั้งค่าโปรไฟล์</a>
                    @if(Auth::user()->email_verified == 0)
                        <a class="dropdown-item text-danger" href="{{ route('verification.resend') }}"><i class="fas fa-exclamation-triangle"></i> ส่งอีเมล์ยืนยันอีกครั้ง</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('banner') }}"><i class="fas fa-image" aria-hidden="true"></i> แบนเนอร์</a>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                       <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
<!--             
            <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('search')}}">
                {{ csrf_field() }}
                <input class="form-control mr-sm-2" type="search" name="q" value="{{app('request')->input('q')}}" placeholder="Search" aria-label="Search">
            </form> -->
            @endif
        </ul>
    </div>
    </nav>
    @yield('content')
        
    <!-- <p class="text-center border-top pt-3 mt-5">
        <a href="#" class="btn-link mx-1">เกี่ยวกับเรา</a>
        <a href="{{route('privacy')}}" class="btn-link mx-1">ความเป็นส่วนตัว</a>
        <a href="#" class="btn-link mx-1">เงื่อนไขการให้บริการ</a>
    </p> -->
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>

<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Learning 21') }}</title>
        <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>
        <link rel="shortcut icon" type="image/png" href="/images/icon.png"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Sarabun:400,700" rel="stylesheet" type="text/css">
        <link href="/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
        <link href="/css/font-awesome/css/all.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background: #fff;
                color: #333;
                font-family: 'Sarabun', sans-serif;
                font-weight: 100;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .content {
                width: 100%;
            }
            .title {
                font-size: 64px;
            }
            .subtitle {
                display: block;
                margin: 10px auto;
                margin-bottom: 25px;
                color: #333;
                font-size: 18px;
            }
            .bottom-info{
                text-align: center;
                width: 100%;
                margin: 20px auto;
            }
            .bottom-info p {
                text-align: center;
            }
            .partner_logo{
                height: 60px;
                width: auto;
            }
            .bg-black-opaciy{
                background-color: rgba(3,3,3,0.75)
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark mb-5">
            <a class="navbar-brand text-bold text-dark" href="{{ route('welcome') }}">
                <img src="{{ asset('images/digital-library.png') }}" alt="Play Store" class="logo-admin" style="width: 50px;">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><span class="fa fa-sign-in"></span> Login</a></li>
                    @else
                    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">แดชบอร์ด</a></li>
                    <li class="nav-item"><a class="nav-link text-info" href="{{ route('upload') }}"><i class="fa fa-cloud-upload" aria-hidden="true"></i> อัพโหลด</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="userNavmenu" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userNavmenu">
                            <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-gear"></i> ตั้งค่าโปรไฟล์</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                    <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('search')}}">
                        <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search">
                    </form>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="d-flex flex-row px-3">
                    <div class="text-right d-sm-none d-none d-md-block d-lg-block w-50 py-3">
                        <img src="images/ebook-home.jpg" class="w-50 mr-5" alt="E BOOK - Your personal ebook platform">
                    </div>
                    <div class="flex-column">
                        <div class="title my-5">
                            eBOOK
                        </div>
                        <div class="subtitle my-3">
                            <p>แหล่งรวมและเผยแพร่ อีบุ๊ค</p>
                            อัพโหลดและจัดาการเนื้อหาอีบุ๊ค พร้อมชั้นหนังสือที่แบ่งปันได้ในแบบของคุณเอง
                        </div>
                        <div class="text-left my-5">
                            <a href="{{ url('/login') }}" class="btn btn-dark btn-lg text-white">เข้าสู่ระบบ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

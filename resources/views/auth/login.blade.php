@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <h1 class="text-center">เข้าสู่ระบบ</h1>
            <div class="row">
                <form class="form-horizontal col-md-12 mt-3 mb-3 p-5 border shadow" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    @if (session('confirmation'))
                        <div class="alert alert-info" role="alert">
                            {!! session('confirmation') !!}
                        </div>
                    @endif
                    @if ($errors->has('confirmation') > 0 )
                        <div class="alert alert-danger" role="alert">
                            {!! $errors->first('confirmation') !!}
                        </div>
                    @endif
                   
		            <div class="form-group">
                        <!-- <div class="col-md-6 offset-md-4">
                            <a href="/login/facebook" class="btn btn-primary btn-outline-primary btn-block text-white">Login with Facebook</a>
                        </div> -->
                        <!-- <div class="col-md-6 offset-md-4 mt-2">
                            <a href="/login/google" class="btn btn-danger btn-outline-danger btn-block text-white">Login with Google</a>
                        </div> -->
                        <!-- <div class="col-md-6 offset-md-4 mt-3">หรือ</div> -->
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label text-right d-inline-block">E-Mail Address</label>

                        <div class="col-md-6 d-inline-block">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label text-right d-inline-block">Password</label>

                        <div class="col-md-6 d-inline-block">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                            <a class="btn-link ml-3" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

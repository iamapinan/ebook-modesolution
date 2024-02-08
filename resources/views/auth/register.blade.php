@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
                <h1>ลงทะเบียน</h1>
                <div class="row">
                    <form class="form-horizontal col-md-12 mt-3 mb-3 p-5 col-md-offset-4 border shadow" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <!--
			<div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <a href="/login/facebook" class="btn btn-primary btn-outline-primary btn-block text-white">Join with Facebook</a>
                            </div>
                            <div class="col-md-6 offset-md-4 mt-2">
                                <a href="/login/google" class="btn btn-danger btn-outline-danger btn-block text-white">Join with Google</a>
                            </div>
                            <div class="col-md-6 offset-md-4 mt-3">หรือ</div>
                        </div>-->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label text-right d-inline-block">Name *</label>
                            <div class="col-md-6 d-inline-block">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label text-right d-inline-block">E-Mail Address *</label>
                            <div class="col-md-6 d-inline-block">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label text-right d-inline-block">Password *</label>
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
                            <label for="password-confirm" class="col-md-4 control-label text-right d-inline-block">Confirm Password *</label>

                            <div class="col-md-6 d-inline-block">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthday" class="col-md-4 control-label text-right d-inline-block">Birth day *</label>

                            <div class="col-md-6 d-inline-block">
                                <input id="birthday" type="date" class="form-control" name="birthday" required>
                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="organization" class="col-md-4 control-label text-right d-inline-block">School/Organization *</label>

                            <div class="col-md-6 d-inline-block">
                                <input id="organization" type="text" class="form-control" name="organization" required>
                                @if ($errors->has('organization'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="col-md-4 d-inline-block">&nbsp;</div>
                            <div class="col-md-6 d-inline-block text-sm text-muted">
                                <input type="checkbox" required name="accept_term" value="yes">
                                 Accept term of agreement and privacy policy?
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="col-md-4 d-inline-block">&nbsp;</div>
                            <div class="col-md-6 d-inline-block">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                <a href="{{url('/login')}}" type="button" class="btn btn-light">
                                    Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

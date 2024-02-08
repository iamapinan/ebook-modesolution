@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-5 shadow mt-5 round">
            <h1 class="text-left"><i class="fas fa-user-circle"></i> แก้ไขโปรไฟล์</h1>
                 <!-- Default panel contents -->
                 @if (session('status'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Status</strong> {{ session('status') }}
                </div>
                @endif
                <form action="{{route('update_profile', [$profile->id])}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table class="table my-5 profile-table">
                    <tbody>
                        <tr>
                            <th>Fullname (*)</th>
                            <td><input type="text" name="fullname" class="form-control" value="{{$profile->name}}" required></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="email" class="form-control" value="{{$profile->email}}" disabled></td>
                        </tr>
                        <tr>
                            <th>Organization</th>
                            <td><input type="text" name="organization" class="form-control" value="{{$profile->organization}}"></td>
                        </tr>
                        <tr>
                            <th>Verified</th>
                            <td><input type="checkbox" name="email_verified" disabled value="{{$profile->email_verified}}" {{$profile->email_verified ? 'checked':''}}></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><input type="submit" value="บันทึกการแก้ไข" class="btn btn-primary"></td>
                        </tr>
                    </tbody>
                </table>
                </form>
            
        </div>
    </div>
</div>
@endsection
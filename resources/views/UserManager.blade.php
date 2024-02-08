@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-left"><i class="fas fa-users"></i> User manager</h1>
                 <!-- Default panel contents -->
                 <ul class="nav mt-3">
                    <li class="nav-item">
                        <form class="form-inline">
                            <input type="text" class="form-control mr-3" id="seach-input" placeholder="ค้นหา" name="s" value='{{@request()->get("s")}}'>
                            <input type="button" value="ค้นหา" class='btn btn-dark'>
                        </form>
                    </li>
                </ul>
                <table class="table table-striped table-hover border p-5 shadow mt-3 round">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Organization</th>
                            <th>Verified</th>
                            <th>Last Modify</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td><a href="/shelf/{{base64_encode($u->email)}}">{{$u->name}}</a></td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->organization}}</td>
                            <td><span class="text-{{$u->email_verified == 1 ? 'success':'warning'}}">{{$u->email_verified == 1 ? 'Verified': 'Not verify'}}</span></td>
                            <td>{{$u->created_at}}</td>
                            <!-- <td>
                                <button class="btn btn-info disabled"><i class="fas fa-pen"></i></button>
                                <button class="btn btn-danger disabled"><i class="fa fa-trash"></i></button>
                            </td> -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center flex-row mt-5">
                {{ $users->links() }}
                </div>
            
        </div>
    </div>
</div>
@endsection
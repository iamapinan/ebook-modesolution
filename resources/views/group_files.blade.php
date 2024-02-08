@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3><i class="fa fa-file-archive" aria-hidden="true"></i>  Download เอกสาร</h3>
    <div class="my-3">
        <a href="{{$user_groups->content_uri}}" class="btn btn-primary">แสดง E-Book สำหรับ {{$user_groups->name}}</a>
    </div>
    <div class="row mt-3 mb-5 rounded shadow">
        <iframe src="https://drive.google.com/embeddedfolderview?id={{$user_groups->drive_uri}}#list" style="width:100%; height:700px; border:0;"></iframe>
    </div>
</div>
@endsection

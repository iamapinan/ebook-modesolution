@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3><i class="fa fa-file-archive" aria-hidden="true"></i>  Robot Camp</h3>
    <div class="my-3">
        <a href="https://learning21.in.th/shelf/cGFzZWVyb2JvdEBvdXRsb29rLmNvbQ==" class="btn btn-primary">แสดง E-Book</a>
    </div>
    <div class="row mt-3 mb-5 rounded shadow">
        <iframe src="https://drive.google.com/embeddedfolderview?id=1sC5S29D37WHF_05FMa_QeW8PERchRhtj#list" style="width:100%; height:700px; border:0;"></iframe>
    </div>
</div>
@endsection

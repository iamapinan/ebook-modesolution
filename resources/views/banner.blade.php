@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mb-5 border shadow p-5 rounded mt-3">
            <h3>แบนเนอร์สำหรับหน้าชั้นหนังสือ (แสดงเป็นสาธารณะ)</h3>
            
            @if (isset($status))
                <div class="alert alert-{{$respone_type}}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Status</strong> {{ $status }}
                </div>
            @endif
            @if (isset($banner))
            <div class="banner-area my-3">
                <img src="{{$banner['file']}}" width="100%" class="rounded">
            </div>
            @endif
            <form action="{{route('upload_banner')}}" method="POST" role="form" class="mt-5" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="bannerfile">ไฟล์แบนเนอร์</label>
                    <input type="file" name="bannerfile" accept="image/png, image/jpeg" required>
                    <p class="help-block text-secondary">กรุณาเลือกไฟล์ jpg, png เท่านั้นและจำกัดไม่เกิน 2mb และมีขนาด 1100x560 เท่านั้น</p>
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="Upload banner"/>
            </form>
        </div>
    </div>
</div>
@endsection
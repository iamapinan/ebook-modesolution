@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="tabs" role="tablist">
        <li class="tab-link current" data-tab="book"><a href="#" class="btn-link">หนังสือ</a></li>
        @if($content[0]->link_pretest != '')
        <li class="tab-link" data-tab="quizebefore"><a href="#"class="btn-link">กิจกรรม</a>
        @endif
        @if($content[0]->link_test != '')
        <li class="tab-link" data-tab="quize"><a href="#"class="btn-link">ข้อสอบหลังเรียน</a>
        @endif
        <li class="tab-link" data-tab="about"><a href="#"class="btn-link">รายละเอียด</a>
        @if( !Auth::guest() )
            <li class="tab-link" data-tab="share"><a href="#"class="text-info"> <i class="fa fa-share"></i> &nbsp;แชร์</a>
        @endif
        <li class="tab" id="screenToggle"><a href="#"class="text-danger"><i class="fa fa-expand"></i> &nbsp;แสดงเต็มจอ</a>
    </ul>


    <div class="tab-contents shadow">
        <div class="tab-pane current" id="book">
            @if($content[0]->type_book == 0)
                <iframe src="{{asset('storage/book/'.$content[0]->fileUrl)}}" frameborder="0" class="w-100"></iframe>
            @else
                <iframe src="/viewer/?file={{asset('storage/book/'.$content[0]->fileUrl)}}" frameborder="0" class="w-100"></iframe>
            @endif
        </div>
        <div class="tab-pane" id="quize">
        @if($content[0]->link_test != '')
            <iframe src="{{$content[0]->link_test}}" frameborder="0" class="w-100"  allowfullscreen></iframe>
        @endif
        </div>
        <div class="tab-pane" id="quizebefore">
        @if($content[0]->link_pretest != '')
            <iframe src="{{$content[0]->link_pretest}}" frameborder="0" class="w-100"  allowfullscreen></iframe>
        @endif
        </div>
        <div class="tab-pane" id="about">
            <h3>{{$content[0]->title}}</h3>
            <p class="text-secondary ml-3">โดย <a href="{{url('/shelf/'.base64_encode($user_info->email))}}">{{$content[0]->author}}</a></p>
            <p class="ml-3">
                @if(!empty($content[0]->gradetitle))
                <span class="badge badge-light"><i class="fa fa-graduation-cap"></i> {{$content[0]->gradetitle}} </span>
                @endif
                @if(!empty($content[0]->subject))
                <span class="badge badge-light"><i class="fa fa-folder"></i> {{$content[0]->subject}} </span>
                @endif
            </p>
            <div class="text-muted ml-3">{{$content[0]->description}}</div>
        </div>

        <div class="tab-pane" id="share">
            <h3>Share</h3>
            <div class="shareContainer">
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://www.facebook.com/share.php?u={{urlencode(url()->current())}}" class="btn btn-default text-dark"><i class="fab fa-facebook-square"></i> Facebook</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://www.instagram.com/?url={{urlencode(url()->current())}}" class="btn btn-default text-dark"><i class="fab fa-instagram"></i> Instagram</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://twitter.com/share?text={{urlencode($content[0]->title)}}&url={{urlencode(url()->current())}}" class="btn btn-default text-dark"><i class="fab fa-twitter"></i> Twitter</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="https://lineit.line.me/share/ui?url={{urlencode(url()->current())}}" class="btn btn-default text-dark"><i class="fab fa-line"></i> Line</a></div>
                <div class="d-flex justify-content-between"><a target="_blank" rel="noopener" href="mailto:?subject={{urlencode($content[0]->title)}}&body={{urlencode(url()->current())}}" class="btn btn-default text-dark"><i class="fa fa-envelope"></i> Email</a></div>
            </div>
            <h3>QR Code</h3>
            <img src="https://chart.googleapis.com/chart?cht=qr&chs=500x500&choe=UTF-8&chl={{urlencode(url()->current())}}" class="mw-100">
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
    var height = window.innerHeight;
    $('iframe').css('height', height-200)
	$('.tabs li.tab-link').on('click', function() {
		var tabId = $(this).attr('data-tab');

		$('.tabs li.tab-link').removeClass('current');
		$('.tab-pane').removeClass('current'); 

		$(this).addClass('current');
		$('#' + tabId).addClass('current');
    });
    $('#screenToggle').on('click', function() {
        var content = $('.tab-contents')
        if(content.hasClass('fullscreen')) {
            $(this).find('a').html('<i class="fa fa-expand"></i>&nbsp; แสดงเต็มจอ')
            content.removeClass('fullscreen')
        }
        else {
            $(this).find('a').html('<i class="fa fa-compress"></i>&nbsp; ย่อขนาด')
            content.addClass('fullscreen')
        }
        // content.find('iframe').css('height')
    })
});
</script>
@endsection

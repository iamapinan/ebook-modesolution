@extends('layouts.app')

@section('content')
<div class="container-fluid px-0 pt-3" style="margin-top: -3rem!important">
    <div style="background-color: #eaeff5;" class="mb-5" >
        <div class="px-0 w-75 mx-auto  pt-5" style="background-image: url(/images/header-image-learning.jpg);background-repeat: no-repeat;background-size: contain;height: 300px;background-position: center center;">
            <h1>ยินดีต้อนรับ, {{ Auth::user()->name }}</h1>
        </div>
    </div>
    <div class="container">
    <h3>ล่าสุด</h3>
    <div class="row mt-5">
                    @foreach($books as $b)
                        <div class="col-md-3">
                            <div class="card shadow rounded">
                                <a href="view/{{$b->id}}">
                                    <img src="{{url('storage/book/'.str_replace('thumb','large', $b->cover_file) ) }}" alt="{{$b->title}}" style="height: 190px;object-fit: contain;" class="card-img-top overflow-hidden">
                                </a>
                                <div class="card-body">
                                    <p class="text-bold mb-1"><a href="view/{{$b->id}}">{{$b->title}}</a></p>
                                    <div class="card-text">
                                        <p class="mb-3 text-secondary">{{$b->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(count($books) == 0)
                        <div class="alert alert-warning text-center mt-1 w-75 mx-auto py-5" role="alert">
                            คุณยังไม่มีหนังสือ
                        </div>
                    @endif
                    
                  </div>
                  {{ $books->links() }}
                </div>
    </div>
</div>
@endsection

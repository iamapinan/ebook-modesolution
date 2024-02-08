@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div class="mb-5" style="background-image: url(/images/header-image-store.jpg);background-repeat: no-repeat;background-size: contain;height: 300px">
                    <h3 class="pl-5 text-lg-left pt-4">จัดการหนังสือ</h3>
                </div>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active" aria-current="page">จัดการหนังสือ</li>
                </ol>
                </nav>

                 <!-- Default panel contents -->
                 @if (session('status'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Status</strong> {{ session('status') }}
                </div>
                @endif
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
                                        <ul>
                                            @if(!empty($b->gradetitle))
                                            <li><i class="fa fa-graduation-cap"></i> {{$b->gradetitle}} </li>
                                            @endif
                                            @if(!empty($b->subject))
                                            <li><i class="fa fa-folder"></i> {{$b->subject}} </li>
                                            @endif
                                            <li><i class="fa fa-chart-pie"></i> {{$b->view}} </li>
                                        </ul>
                                        <ul class="list-group list-group-flush mt-3">
                                            <li class="list-group-item"><a href="#" class="disabled text-muted" aria-disabled="true"><i class="fas fa-pen"></i> แก้ไข <span class="text-danger">ยังไม่รองรับ</span></a> </li>
                                            @if($b->recommend!=1)
                                            <li class="list-group-item"><a href="{{route('recommend',$b->id)}}"  class="card-link text-secondary"><i class="fas fa-star"></i> ตั้งเป็นแนะนำ</a></li>
                                            @else
                                            <li class="list-group-item"><a href="{{route('un_recommend',$b->id)}}"  class="card-link text-warning"><i class="fas fa-star"></i> ยกเลิกตั้งเป็นแนะนำ</a></li>
                                            @endif
                                            <li class="list-group-item"><a href="{{route('delete',$b->id)}}" class="card-link text-danger"><i class="fas fa-trash"></i> ลบ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(count($books) == 0)
                        <div class="alert alert-warning text-center mt-1 w-75 mx-auto py-5" role="alert">
                            คุณยังไม่มีหนังสือ
                            <a href="{{route('upload')}}" class="btn btn-primary">อัพโหลดหนังสือ</a>
                        </div>
                    @endif
                    
                  </div>
                  {{ $books->links() }}
                </div>
            
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
       function rmb(id) {    
            if(confirm('ต้องการลบหนังสือ ใช่หรือไม่?')){
                axios.get('/api/remove/book?id=' + id)
                .then( res => {
                    console.log(res)
                    Alert('ลบเรียบร้อยแล้ว')
                })                      
            }
        }
    </script>
@endsection
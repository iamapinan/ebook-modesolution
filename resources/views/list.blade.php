@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div class="mb-3 rounded d-flex flex-column justify-content-end shelf_cover" style="background-image: url({{$banner['file']}});">
                    <h3 class="pl-3 text-lg-left pt-4 text-white text-shadow"><i class="fa fa-user-circle"></i> {{$user->name}}</h3>
                    <p class="pl-3 pt-3">
                    @if(!Auth::guest() && ($user->id != 2249 && $user->id != 2256))
                        <a href="#" class="btn btn-dark text-white bg-opacity-80" role="button" data-toggle="modal" data-target="#shareModal">
                            <i class="fa fa-share"></i> Share
                        </a>
                        <a href="#" class="btn btn-dark text-white bg-opacity-80" role="button" data-toggle="modal" data-target="#qrModal">
                            <i class="fa fa-qrcode"></i> QR Code
                        </a>
                    @endif
                    </p>
                </div>

                <!-- modal -->
                <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLable" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrModalLable">QR Code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-3">
                            <img src="https://chart.googleapis.com/chart?cht=qr&chs=500x500&choe=UTF-8&chl={{url()->current()}}" class="mw-100">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLable" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="shareModalLable">Share</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">URL</span>
                                </div>
                                <input type="text" class="form-control" value="{{url()->current()}}" aria-describedby="basic-addon1" onClick="this.select();">
                            </div>
                            <div class="d-flex flex-row justify-content-around">
                                <a href="https://www.facebook.com/share.php?u={{urlencode(url()->current())}}" class="btn btn-default" role="button" target="_blank"><i class="fab fa-facebook-square"></i> Facebook</a>
                                <a href="https://twitter.com/share?text=ครั้งหนังสือของ%20{{$user->name}}&url={{urlencode(url()->current())}}" class="btn btn-default" role="button" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                                <a href="https://lineit.line.me/share/ui?url={{urlencode(url()->current())}}" class="btn btn-default" role="button" target="_blank"><i class="fab fa-line"></i> Line</a>
                                <a href="mailto:?subject=ครั้งหนังสือของ%20{{$user->name}}&body={{urlencode(url()->current())}}" class="btn btn-default" role="button" target="_blank"><i class="fa fa-envelope"></i> Email</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>

                 <!-- Default panel contents -->
                 <h3>แนะนำ</h3>
                 <div class="mt-3 row mb-5">
                    @for($x=0;$x<count($recommend);$x++)
                        <div class="col-md-3 book"  onclick="window.location.href='{{url('/view/'.$recommend[$x]->id)}}'">
                            <div class="book-item shadow rounded d-flex flex-column justify-content-end" style="background-size: contain;height: 350px;background-image: url({{url('storage/book/'.str_replace('thumb','large', $recommend[$x]->cover_file))}});">
                                <div class="book-body p-3 gradient">
                                    <div class="book-text">
                                        <a class="badge badge-light"><i class="fa fa-graduation-cap"></i> {{$recommend[$x]->gradetitle}} </a>
                                        <a class="badge badge-light"><i class="fa fa-folder"></i> {{$recommend[$x]->subject}} </a>
                                        <a class="badge badge-light"><i class="fa fa-eye"></i> {{$recommend[$x]->view}} </a>
                                        <a class="badge badge-warning"><i class="fa fa-star"></i></a>
                                        </ul>
                                    </div>
                                    <p class="mt-2 text-bold"><a href="{{url('/view/'.$recommend[$x]->id)}}" class="text-white">{{$recommend[$x]->title}}</a></p>
                                </div>
                            </div>
                        </div>
                    @endfor
                    @if(count($recommend) == 0)
                        <div class="alert alert-light text-center mt-5" role="alert">คุณยังไม่มีหนังสือ</div>
                    @endif
                </div>
                <h3>ทั้งหมด</h3>
                <div class="mt-3 row">
                    @foreach($list as $b)
                        <div class="col-md-3 book" onclick="window.location.href='{{url('/view/'.$b->id)}}'">
                            <div class="book-item shadow rounded d-flex flex-column justify-content-end" style="background-size: contain;height: 350px;background-image: url({{url('storage/book/'.str_replace('thumb','large', $b->cover_file))}});">
                                <div class="book-body p-3 gradient">
                                    <div class="book-text">
                                        <a class="badge badge-light"><i class="fa fa-graduation-cap"></i> {{$b->gradetitle}} </a>
                                        <a class="badge badge-light"><i class="fa fa-folder"></i> {{$b->subject}} </a>
                                        <a class="badge badge-light"><i class="fa fa-eye"></i> {{$b->view}} </a>
                                        </ul>
                                    </div>
                                    <p class="mt-2 text-bold"><a href="{{url('/view/'.$b->id)}}" class="text-white">{{$b->title}}</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(count($list) == 0)
                        <div class="alert alert-light text-center mt-5" role="alert">คุณยังไม่มีหนังสือ</div>
                    @endif
                    
                  </div>
                </div>
                <div class="mt-5 d-flex justify-content-center flex-row">
                {{ $list->links() }}
                </div>
            
            
        </div>
    </div>
</div>
@endsection

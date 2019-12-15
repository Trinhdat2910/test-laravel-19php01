@extends('home.layouts.app')
@section('content_home')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.html">Home</a></span> / <span>Đơn hàng</span></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container">  
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="product-name d-flex">
                    <div class="one-eight text-center">
                        <span>Mã Đơn Hàng</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Mã Bill Giao Hàng</span>
                    </div>
                    <div class="one-forth text-center px-4">
                        <span>Chi Tiết Đơn Hàng</span>
                    </div>
                    
                    <div class="one-eight text-center">
                        <span>Tổng tiền</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Trạng thái</span>
                    </div>
                </div>
                @if(count($listOrder) > 0)
                    @foreach($listOrder as $key => $order)
                        <div class="product-cart d-flex">
                            <div class="one-eight">
                                <div class="display-tc">
                                    <h3>{{$order->id}}</h3>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price">
                                        @if(isset($order->tracking_number))
                                            {{$order->tracking_number}}
                                        @else 
                                            Chưa có mã
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="one-forth text-center">
                                <div class="display-tc">
                                    @if(count($order->orderdetails))
                                        <div class="d-flex">
                                            <div class="col-6 d-flex align-self-center">
                                                <p class="col-8 mb-0"> Tên sản phẩm </p>
                                                <p class="col-4 mb-0">size</p>
                                            </div>
                                            <div class="d-flex col-6 align-self-center">
                                                <p class="col-4 mb-0">Số lượng</p>
                                                <p class="col-4 mb-0">Giá</p>
                                                <p class="col-4 mb-0">Tổng</p>
                                            </div>
                                        </div>
                                        @foreach($order->orderdetails as $key1 => $orderdetail)
                                        <div class="d-flex">
                                            <div class="col-6 d-flex align-self-center">
                                                <p class="col-8 mb-0"> {{$orderdetail->productdetail->product->name}}</p>
                                                <p class="col-4 mb-0">{{$orderdetail->productdetail->size}}</p>
                                            </div>
                                            <div class="d-flex col-6 align-self-center">
                                                <p class="col-4 mb-0">{{$orderdetail->quantity}}</p>
                                                <p class="col-4 mb-0">{{number_format($orderdetail->price)}}</p>
                                                <p class="col-4 mb-0">{{number_format($orderdetail->price * $orderdetail->quantity)}}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price">{{number_format($order->total)}} VND</span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price" >{{$order->status->name }}</span>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                @else
                    <h2 class="text-center text-uppercase">
                        Không có đơn hàng nào
                    </h2>
                @endif
                
            </div>
        </div>
    </div>
</div>


@endsection
@section('script_home')
<script>
     $(document).ready(function(){
        @if(Session::has('message'))
            @if (Session::get('class') == 'error')
                toastr.error('{{ Session::get('message') }}')
            @else
                toastr.success('{{ Session::get('message') }}')
            @endif
        @endif
         
     })
</script>
@endsection
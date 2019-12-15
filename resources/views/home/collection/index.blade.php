@extends('home.layouts.app')
@section('content_home')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.html">Home</a></span> / <span>
                    @if($key == 'men')
                        Men
                    @elseif($key == 'women')
                        Women
                    @else
                        New Collection
                    @endif
                </span></p>
            </div>
        </div>
    </div>
</div>

<div class="breadcrumbs-two">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumbs-img" style="background-image: url({{ asset('layout_home/images/cover-img-1.jpg')}});">
                    <h2>
                        @if($key == 'men')
                            MEN'S
                        @elseif($key == 'women')
                            WOMEN'S
                        @else
                            NEW COLLECTION
                        @endif
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>Tất cả sản phẩm</h2>
            </div>
        </div>
        <div class="row row-pb-md">
            @if(count($listProduct) > 0)
                @foreach($listProduct as $key => $products)
                <div class="col-md-3 col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="{{route('home.product.detail', ['id' => $products->id])}}" class="prod-img">
                            <img src="{{ asset($products->image)}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
                        </a>
                        <div class="desc">
                            <h2><a href="{{route('home.product.detail', ['id' => $products->id])}}">{{$products->name}}</a></h2>
                            <span class="price">{{number_format($products->price)}} VND</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @else 
                <div class="text-center"><h2>Không có sản phẩm</h2></div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 text-center d-flex justify-content-center">
                <div class="align-self-center">
                    @if(count($listProduct) > 20)
                        {{$listProduct->links()}}
                    @endif
                </div>
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
@extends('home.layouts.app')
@section('content_home')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.html">Home</a></span> / <span>Shopping Cart</span></p>
            </div>
        </div>
    </div>
</div>





<div class="colorlib-product">
    <div class="container">
        
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="product-name d-flex">
                    <div class="one-forth text-left px-4">
                        <span>Product Details</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>size</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Price</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Quantity</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Total</span>
                    </div>
                    <div class="one-eight text-center px-4">
                        <span>Remove</span>
                    </div>
                </div>
                @if(Cart::count() > 0)
                    @foreach(Cart::content() as $row)
                        <div class="product-cart d-flex">
                            <div class="one-forth">
                                <div class="product-img" style="background-image: url('{{$row->options->image}}');">
                                </div>
                                <div class="display-tc">
                                    <h3>{{$row->name}}</h3>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price">{{$row->options->size}}</span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price">{{number_format($row->price)}}</span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <input 
                                        type="number" 
                                        id="quantity" 
                                        name="quantity" 
                                        class="form-control input-number text-center" 
                                        value="{{$row->qty}}" min="1" max="100"
                                        data-id="{{$row->rowId}}">
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price" id="total-{{$row->rowId}}">{{number_format($row->price * $row->qty)}}</span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <a href="{{route('home.cart.removeItem', ['id' => $row->rowId])}}" class="closed" ></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2 class="text-center text-uppercase">
                        Giỏ hàng trống
                    </h2>
                @endif
                
            </div>
        </div>
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="total-wrap">
                    <div class="row">
                        @if(Cart::count() > 0)
                        <form action="{{route('home.products.order')}}" method="POST" class="row col-12">
                            @csrf
                        <div class="col-sm-8">
                            <h2 class="text-center">Thông tin </h2>
                            <div class="form-group mb-0">
                                <div class="input-group ">
                                    <label class="align-self-center col-4" >Tên Người Nhận</label>
                                    <input type="text" class="form-control" placeholder="Tên Người Nhận" name="name" value="{{ Auth::user()->name }}">
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <div class="input-group ">
                                    <label class="align-self-center col-4">Địa chỉ</label>
                                    <input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="{{ Auth::user()->address }}">
                                </div>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <div class="input-group ">
                                    <label class="align-self-center col-4">Số điện thoại</label>
                                    <input type="text" class="form-control" placeholder="Địa chỉ" name="phone" value="{{ Auth::user()->phone_number }}">
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <div class="input-group ">
                                    <label class="align-self-center col-4">Phương Thức thanh toán</label>
                                    <select class="form-control" name="payment_type" >
                                        <option value="1">Thanh toán khi nhận hàng</option>
                                        <option value="2">Thanh toán qua thẻ tin dụng</option>
                                    </select>
                                </div>
                                @error('payment_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div class="total">
                                <div class="grand-total">
                                    <p><span><strong>Total:</strong></span> <span id="total">{{number_format(floatval( preg_replace( '#[^\d.]#', '', Cart::total()))) }} VNĐ</span></p>
                                </div>
                                <input type="submit" value="Đặt Mua" class="btn btn-primary">
                            </div>
                        </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>Related Products</h2>
            </div>
        </div>
        <div class="row">
            @foreach($listProductHot as $key => $productsHot)
                <div class="col-md-3 col-lg-3 mb-4 text-center">
                    <div class="product-entry border">
                        <a href="{{route('home.product.detail', ['id' => $productsHot->id])}}" class="prod-img">
                            <img src="{{asset($productsHot->image)}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
                        </a>
                        <div class="desc">
                            <h2><a href="{{route('home.product.detail', ['id' => $productsHot->id])}}">{{$productsHot->name}}</a></h2>
                            <span class="price">${{number_format($productsHot->price)}} VNĐ</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>



@endsection
@section('script_home')
<script>
     var _token = '{{ csrf_token() }}'
     $(document).ready(function(){
        @if(Session::has('message'))
            @if (Session::get('class') == 'error')
                toastr.error('{{ Session::get('message') }}')
            @else
                toastr.success('{{ Session::get('message') }}')
            @endif
        @endif
         $('#quantity').change(function(){
             
             var rowId = $(this).attr('data-id'),
                quantity = $(this).val()
             $.ajax({
                    url: '{{ route("home.cart.updateCart") }}',
                    method: 'POST',
                    data:{
                        rowId : rowId,
                        quantity : quantity,
                        _token : _token
                    },
                    success: function (result) {

                        $('#total-'+rowId).text( result.oCart.price * result.oCart.qty )
                        $('#total').text(result.totalCart+ " VNĐ")
                    },
                    error: function (errors) {
                        
                        toastr.clear()
                        var errorList = $.parseJSON(errors.responseText)
                        if (typeof errorList.errors !== 'undefined') {
                            $.each(errorList.errors, function(index, error) {
                                toastr.error(error[0])
                            })
                        }

                    }
                        
                })
         })
     })
</script>
@endsection
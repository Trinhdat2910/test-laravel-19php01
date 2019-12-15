@extends('layouts.app')
@section('content')
@include("layouts.menu")
@include('layouts.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Đơn hàng</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật Đơn Hàng</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  method="POST" action="{{ route('admin.order.update', ['id' => $oOrder->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputTracking1">Mã Bill</label>
                        <input type="text" class="form-control" name="tracking_number" id="exampleInputTracking1" placeholder="Mã Bill" value="{{$oOrder->tracking_number}}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputName1">Tên Người Nhận</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Tên Sản Phẩm" value="{{$oOrder->recipient}}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPhone1">Số điện thoại Người Nhận</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputPhone1" placeholder="Số điện thoại Sản Phẩm" value="{{$oOrder->phone_number}}">
                    </div>
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputAddress1">Địa chỉ Người Nhận</label>
                        <input type="text" class="form-control" name="address" id="exampleInputAddress1" placeholder="Địa chỉ Sản Phẩm" value="{{$oOrder->address}}">
                    </div>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPayment1">Phương thức thanh toán</label>
                        <select class="form-control" id="exampleInputPayment1" name="payment">
                            <option {{ $oOrder->payment_type == "1" ? 'selected="selected"' : "" }} value="1">Thanh toán khi nhận hàng</option>
                            <option {{ $oOrder->payment_type == "2" ? 'selected="selected"' : "" }} value="2">Thanh toán qua thẻ tín dụng</option>
                        </select>
                    </div>
                    @error('payment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputTotal1">Tổng tiền</label>
                        <input type="text" class="form-control" name="total" id="exampleInputTotal1" placeholder="Tổng tiền" value="{{$oOrder->total}}">
                    </div>
                    @error('total')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputStatus1">Trạng thái</label>
                        <select class="form-control" id="exampleInputStatus1" name="status">
                            @foreach($status as $key => $row)
                                <option {{ $oOrder->status_id == $row->id ? 'selected="selected"' : "" }} value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Cập Nhật">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
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

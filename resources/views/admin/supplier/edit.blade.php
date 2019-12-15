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
                <li class="breadcrumb-item"><a href="#">Nhà cung cấp</a></li>
                <li class="breadcrumb-item active">Cập nhật</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật nhà cung cấp</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  method="POST" action="{{ route('admin.supplier.postEdit', ['id'=>$oSupplier->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Tên Nhà cung cấp</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Tên Nhà cung cấp" value="{{$oSupplier->name}}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPhone2">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputPhone2" placeholder="Số điện thoại" value="{{$oSupplier->phone_number}}">
                    </div>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputAddress1">Địa chỉ</label>
                        <textarea class="form-control" id="exampleInputAddress1" name="address" placeholder="Địa chỉ">{{$oSupplier->address}}</textarea>
                    </div>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Cập nhật">
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

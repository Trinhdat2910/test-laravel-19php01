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
                <li class="breadcrumb-item"><a href="#">Nhập kho</a></li>
                <li class="breadcrumb-item active">Cập nhật </li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật nhập kho</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  method="POST" action="{{ route('admin.warehouse.postEdit',['id' => $oWarehouse->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    
                    <div class="form-group">
                        <label for="exampleSupplier1">Nhà cung cấp</label>
                        <select class="form-control" id="exampleSupplier1" name="supplier">
                            <option value="0">--Chọn nhà cung cấp--</option>
                            @foreach($listSupplier as $key => $supplier)
                                <option {{ $oWarehouse->supplier_id == $supplier->id ? 'selected="selected"' : "" }} value="{{$supplier->id}}"> {{$supplier->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('supplier')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleProducts1">Sản phẩm</label>
                        <select class="form-control" id="exampleProducts1" name="products">
                            <option value="0">--Chọn nhà cung cấp--</option>
                            @foreach($listProducts as $key => $product)
                                <option {{ $oWarehouse->products_id == $product->id ? 'selected="selected"' : "" }} value="{{$product->id}}"> {{$product->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('products')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleSize1">Size</label>
                        <select class="form-control" id="exampleSize1" name="size">
                            <option value="0">--chọn size--</option>
                            <option {{ $oWarehouse->size == '26' ? 'selected="selected"' : "" }} value="26">26</option>
                            <option {{ $oWarehouse->size == '27' ? 'selected="selected"' : "" }} value="27">27</option>
                            <option {{ $oWarehouse->size == '28' ? 'selected="selected"' : "" }} value="28">28</option>
                            <option {{ $oWarehouse->size == '29' ? 'selected="selected"' : "" }} value="29">29</option>
                            <option {{ $oWarehouse->size == '30' ? 'selected="selected"' : "" }} value="30">30</option>
                            <option {{ $oWarehouse->size == '31' ? 'selected="selected"' : "" }} value="31">31</option>
                            <option {{ $oWarehouse->size == '32' ? 'selected="selected"' : "" }} value="32">32</option>
                            <option {{ $oWarehouse->size == '33' ? 'selected="selected"' : "" }} value="33">33</option>
                            <option {{ $oWarehouse->size == '34' ? 'selected="selected"' : "" }} value="34">34</option>
                        </select>
                    </div>
                    @error('size')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPrice1">Giá</label>
                        <input type="text" class="form-control" id="exampleInputPrice1" name="price" placeholder="Giá" value="{{ $oWarehouse->price}}">
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputQuantity1">Số lượng</label>
                        <input type="number" class="form-control" id="exampleInputQuantity1" name="quantity" placeholder="Số lượng" value="{{ $oWarehouse->quantity}}">
                    </div>
                    @error('quantity')
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
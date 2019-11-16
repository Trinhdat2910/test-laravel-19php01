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
                <li class="breadcrumb-item"><a href="#">Warehouse</a></li>
                <li class="breadcrumb-item active">Add</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Warehouse</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  method="POST" action="{{ route('admin.warehouse.postadd') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    
                    <div class="form-group">
                        <label for="exampleSupplier1">Supplier</label>
                        <select class="form-control" id="exampleSupplier1" name="supplier">
                            <option value="0">--SELECT SUPPLIER--</option>
                            @foreach($listSupplier as $key => $supplier)
                                <option value="{{$supplier->id}}"> {{$supplier->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('supplier')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleProducts1">Products</label>
                        <select class="form-control" id="exampleProducts1" name="products">
                            <option value="0">--SELECT PRODUCTS--</option>
                            @foreach($listProducts as $key => $product)
                                <option value="{{$product->id}}"> {{$product->name}} </option>
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
                            <option value="0">--SELECT SIZE--</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                        </select>
                    </div>
                    @error('size')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPrice1">Price</label>
                        <input type="text" class="form-control" id="exampleInputPrice1" name="price" placeholder="Price">
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputQuantity1">Quantity</label>
                        <input type="number" class="form-control" id="exampleInputQuantity1" name="quantity" placeholder="Quantity">
                    </div>
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="ADD">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

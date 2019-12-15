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
                <li class="breadcrumb-item"><a href="#">Sản Phẩm</a></li>
                <li class="breadcrumb-item active">Sửa Sản Phẩm</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sửa Sản Phẩm</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  method="POST" action="{{ route('admin.products.postEdit', ['id' => $oProduct->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Tên Sản Phẩm" value="{{$oProduct->name}}">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleProductsType1">Loại Sản Phẩm</label>
                        <select class="form-control" id="exampleProductsType1" name="products_type">
                            <option value="0">--SELECT PRODUCTS TYPE--</option>
                            @foreach($listProductsType as $key => $productsType)
                                <option {{ $oProduct->product_type_id == $productsType->id ? 'selected="selected"' : "" }} value="{{ $productsType->id }}">{{ $productsType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputFile">Hình Ảnh</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"  name="image" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Tải Lên</span>
                        </div>
                        </div>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputDescription1">Mô Tả</label>
                        <textarea class="form-control" CLASS="ckeditor" id="editor2" name="description" placeholder="Mô Tả">{{$oProduct->description}}</textarea>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPrice1">Giá</label>
                        <input type="text" class="form-control" id="exampleInputPrice1" name="price" placeholder="Giá" value="{{$oProduct->price}}">
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputStatus1">Trạng thái</label>
                        <select class="form-control" id="exampleInputStatus1" name="status">
                            <option {{ $oProduct->status == "0" ? 'selected="selected"' : "" }} value="0">Hết Hàng</option>
                            <option {{ $oProduct->status == "1" ? 'selected="selected"' : "" }} value="1">Còn Hàng</option>
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
<script type="text/javascript">  
    CKEDITOR.replace( 'editor2' );  
 </script>
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

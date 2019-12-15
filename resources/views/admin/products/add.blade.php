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
                <li class="breadcrumb-item active">Thêm</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm Sản Phẩm</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  method="POST" action="{{ route('admin.products.postadd') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder=" Tên Sản Phẩm">
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleProductsType1">Loại Sản Phẩm</label>
                        <select class="form-control" id="exampleProductsType1" name="products_type">
                            <option value="0">--Chọn loại Sản Phẩm--</option>
                            @foreach($listProductsType as $key => $productsType)
                                <option value="{{ $productsType->id }}">{{ $productsType->name }}</option>
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
                            <span class="input-group-text" id="">Tải lên</span>
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
                        <textarea class="form-control" CLASS="ckeditor" id="editor1" name="description" placeholder="Mô tả"></textarea>
                    </div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPrice1">Giá</label>
                        <input type="text" class="form-control" id="exampleInputPrice1" name="price" placeholder="Giá">
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputStatus1">Trạng Thái</label>
                        <select class="form-control" id="exampleInputStatus1" name="status">
                            <option value="0">Hết Hàng</option>
                            <option value="1">Còn Hàng</option>
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
                    <input type="submit" class="btn btn-primary" value="Thêm">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script type="text/javascript">  
    CKEDITOR.replace( 'editor1' );  
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
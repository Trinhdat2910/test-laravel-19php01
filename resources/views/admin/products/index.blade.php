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
                <li class="breadcrumb-item active">Products</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Products</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dssp" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Tên</th>
                  <th>Loại</th>
                  <th>Hình Ảnh</th>
                  <th>Giá</th>
                  <th>Trạng thái</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listProducts as $key => $products)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$products->name}}</td>
                  <td>{{$products->producttype->name}}</td>
                  <td>
                    <img src="{{ asset($products->image)}}" style="width: auto; height: auto;max-width: 150px;max-height: 150px">
                  </td>
                  <td>{{number_format($products->price)}}</td>
                  <td>
                    @if($products->status == "0")
                      Hết Hàng
                    @else 
                      Còn Hàng
                    @endif 
                  </td>
                  <td>
                      <a href="{{ route('admin.products.detail', ['id'=>$products->id])}}" class="btn btn-primary rounded-circle ml-3 mb-3"><i class="fas fa-eye text-white"></i>
                      </a>
                      <br>
                      <a href="{{ route('admin.products.getEdit', ['id'=>$products->id])}}" class="btn btn-primary rounded-circle ml-3 mb-3"><i class="fas fa-pen text-white"></i>
                      </a>
                      <br>
                      <a href="{{ route('admin.products.delete',['id'=> $products->id])}}" class="btn btn-danger rounded-circle ml-3 mb-3"><i class="fas fa-trash-alt text-white"></i>
                      </a>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Loại</th>
                    <th>Hình Ảnh</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
      $('#dssp').DataTable();
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
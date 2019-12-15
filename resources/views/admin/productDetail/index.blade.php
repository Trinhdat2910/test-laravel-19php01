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
                <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
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
              <h3 class="card-title">Danh sách chi tiết sản phẩm</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listProductDetail as $key => $productDetail)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$productDetail->size}}</td>
                        <td>{{$productDetail->quantity}}</td>
                        <td>
                            <a href="{{ route('admin.warehouse.getEdit', ['id'=>$productDetail->id])}}" class="btn btn-primary rounded-circle ml-3"><i class="fas fa-pen text-white"></i>
                            </a>
                            <a href="{{ route('admin.warehouse.delete',['id'=> $productDetail->id])}}" class="btn btn-danger rounded-circle ml-3"><i class="fas fa-trash-alt text-white"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Size</th>
                        <th>Quantity</th>
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

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
                <li class="breadcrumb-item active">Warehouse</li>
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
              <h3 class="card-title">LIST WAREHOUSE</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dskho" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Thông tin</th>
                  <th>Size</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
                  <th>Tổng tiền</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listWarehouse as $key => $warehouse)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <li>Supplier: {{$warehouse->supplier->name}}</li>
                        <li>Products: {{$warehouse->products->name}}</li>
                        <li>By: {{$warehouse->users->name}}</li>
                    </td>
                    <td>{{$warehouse->size}}</td>
                    <td>{{$warehouse->quantity}}</td>
                    <td>{{number_format($warehouse->price)}}</td>
                    <td>{{number_format($warehouse->total)}}</td> 
                    <td>
                        @if($warehouse->approved == "0" )
                            <a href="{{ route('admin.warehouse.approved', ['id'=>$warehouse->id])}}" class="btn btn-primary rounded-circle ml-3"><i class="fas fa-check text-white"></i>
                            </a>
                            <a href="{{ route('admin.warehouse.getEdit', ['id'=>$warehouse->id])}}" class="btn btn-primary rounded-circle ml-3"><i class="fas fa-pen text-white"></i>
                            </a>
                            <a href="{{ route('admin.warehouse.delete',['id'=> $warehouse->id])}}" class="btn btn-danger rounded-circle ml-3"><i class="fas fa-trash-alt text-white"></i>
                            </a>
                        @else
                            @if(count($warehouse->transaction) > 0)
                            Đã Thanh Toán
                            @else
                             <a href="{{ route('admin.warehouse.payment',['id'=> $warehouse->id])}}" class="btn btn-primary ml-3">THANH TOÁN 
                            </a>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Thông tin</th>
                  <th>Size</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
                  <th>Tổng tiền</th>
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
      $('#dskho').DataTable();
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
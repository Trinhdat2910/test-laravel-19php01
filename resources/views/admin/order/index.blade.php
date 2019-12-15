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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách đơn hàng</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Mã Bill</th>
                        <th>Tổng tiền</th>
                        <th>Tình Trạng</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listOrder as $key => $order)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->id}}</td>
                            <td>
                                @if(isset($order->tracking_number))
                                    {{$order->tracking_number}}
                                @else
                                    Chưa có mã Bill
                                @endif

                            </td>
                            <td>{{number_format($order->total)}} VND</td>
                            <td>{{$order->status->name}}</td>
                            <td>
                                <a href="{{ route('admin.order.detail', ['id'=>$order->id])}}" class="btn btn-primary rounded-circle ml-3 "><i class="fas fa-eye text-white"></i>
                                </a>
                                <br>
                                <a href="{{ route('admin.order.edit', ['id'=>$order->id])}}" class="btn btn-primary rounded-circle ml-3"><i class="fas fa-pen text-white"></i>
                                </a>
                                <br>
                                @if($order->approved == 0)
                                    <a href="{{ route('admin.order.delete', ['id'=>$order->id])}}" class="btn btn-danger rounded-circle ml-3"><i class="fas fa-trash-alt text-white"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Mã Bill</th>
                        <th>Tổng tiền</th>
                        <th>Tình Trạng</th>
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

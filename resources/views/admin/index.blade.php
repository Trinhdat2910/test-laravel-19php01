@extends('layouts.app')
@section('content')
@include("layouts.menu")
@include('layouts.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="font-size: 20px">{{$quantityOrder}}</h3>

                <p>Tổng số đơn hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('admin.order.list')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 style="font-size: 20px">
                  @if(!empty($totalChiThisMonth['total_value']))
                    {{number_format($totalChiThisMonth['total_value'])}} VNĐ
                  @else 
                    0 VNĐ
                  @endif</h3>

                <p>Tổng Chi</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('admin.transaction.list',['sort' => 'chi']) }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 style="font-size: 20px">
                  @if(!empty($totalThuThisMonth['total_value']))
                    {{number_format($totalThuThisMonth['total_value'])}} VNĐ
                  @else 
                    0 VNĐ
                  @endif
                </h3>

                <p>Tổng thu</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('admin.transaction.list',['sort' => 'thu']) }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 style="font-size: 20px">
                  {{number_format($totalThuThisMonth['total_value'] - $totalChiThisMonth['total_value'])}} VNĐ
                </h3>

                <p>Doanh Thu</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('admin.transaction.list')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách giao dịch</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dsgiaodich" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Số tiền</th>
                    <th>Thanh Toán</th>
                    <th>Ghi chú</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($listTransaction as $key => $transaction)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$transaction->tittle}}</td>
                      <td>{{number_format($transaction->amount)}} VND</td>
                      <td>
                          @if(empty($transaction->order_id))
                              Mã Nhập Kho: {{$transaction->warehousing_id}}
                          @else
                              Mã Đơn Hàng: {{$transaction->order_id}}
                          @endif
                      </td>
                      <td>{{$transaction->note}}</td>
                      
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Tiêu đề</th>
                      <th>Số tiền</th>
                      <th>Thanh Toán</th>
                      <th>Ghi chú</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
@section('script')
<script>
    $(document).ready(function(){
      $('#dsgiaodich').DataTable();
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
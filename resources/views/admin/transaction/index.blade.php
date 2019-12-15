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
                <li class="breadcrumb-item active">Supplier</li>
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
                    <td>{{number_format($transaction->amount)}}</td>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
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
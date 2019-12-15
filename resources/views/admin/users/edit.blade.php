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
              <h3 class="card-title">Thêm User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <form action="{{ route('admin.users.postEdit', ['id' => $oUser->id]) }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $oUser->name }}" placeholder="Full name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="{{ $oUser->phone_number }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address"> {{ $oUser->address }}</textarea>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-address-book"></span>
                                </div>
                            </div>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-control" name="role_id" >
                                    <option value="10">
                                        -- Quyền sử dụng --
                                    </option>
                                    <option {{ $oUser->role_id == '0' ? 'selected ' : '' }} value="0">Admin</option>
                                    <option {{ $oUser->role_id == '1' ? 'selected ' : '' }} value="1">Member</option>
                            </select>
                        </div>
                        <div class="row">
                           
                            <!-- /.col -->
                            <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Cập nhật</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
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
      $('#dsnguoidung').DataTable();
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

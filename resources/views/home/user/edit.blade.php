@extends('home.layouts.app')
@section('content_home')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.html">Home</a></span> / <span>Cập nhập thông tin</span></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container">  
        <div class="row row-pb-lg justify-content-center">
            <div class="col-8">
                    <h2 class="text-center">CẬP NHẬT THÔNG TIN</h2>
                    <form action="{{ route('home.user.update', ['id' => $oUser->id]) }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$oUser->name}}" placeholder="Full name">
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="{{$oUser->phone_number}}">
                            
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" > {{$oUser->address}}</textarea>
                            
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">UPDATE</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script_home')
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
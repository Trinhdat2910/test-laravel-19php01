@extends('home.layouts.app')
@section('content_home')
<div class="colorlib-intro">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2 class="intro">It started with a simple idea: Create quality, well-designed products that I wanted myself.</h2>
			</div>
		</div>
	</div>
</div>
<div class="colorlib-product">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 text-center">
				<div class="featured">
					<a href="{{route('home.collection', ['key' => 'men'])}}" class="featured-img" style="background-image: url({{ asset('layout_home/images/men.jpg')}});"></a>
					<div class="desc">
						<h2><a href="{{route('home.collection', ['key' => 'men'])}}">Shop Men's Collection</a></h2>
					</div>
				</div>
			</div>
			<div class="col-sm-6 text-center">
				<div class="featured">
					<a href="{{route('home.collection', ['key' => 'women'])}}" class="featured-img" style="background-image: url({{ asset('layout_home/images/women.jpg')}});"></a>
					<div class="desc">
						<h2><a href="{{route('home.collection', ['key' => 'women'])}}">Shop Women's Collection</a></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="colorlib-product">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
				<h2>Best Sellers</h2>
			</div>
		</div>
		<div class="row row-pb-md">
			@if(count($listProductHot) > 0)
				@foreach($listProductHot as $key => $products)
					<div class="col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="{{route('home.product.detail', ['id' => $products->id])}}" class="prod-img">
								<img src="{{ asset($products->image)}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="{{route('home.product.detail', ['id' => $products->id])}}">{{$products->name}}</a></h2>
								<span class="price">{{$products->price}} VND</span>
							</div>
						</div>
					</div>
				@endforeach
			@endif
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
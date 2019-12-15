<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div id="colorlib-logo"><a href="index.html">Footwear</a></div>
                </div>
                <div class="col-sm-5 col-md-3">
                <form action="{{route('home.collection', ['key' => 'collection'])}}" class="search-wrap" method="GET">
                   <div class="form-group">
                      <input type="search" class="form-control search" name="search" placeholder="Search">
                      <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
                   </div>
                </form>
             </div>
         </div>
            <div class="row">
                <div class="col-sm-12 text-left menu-1">
                    <ul>
                        <li class="active"><a href="{{route('home.index')}}">Home</a></li>
                        <li><a href="{{route('home.collection', ['key' => 'men'])}}">Men</a></li>
                        <li><a href="{{route('home.collection', ['key' => 'women'])}}">Women</a></li>
                        <li><a href="/about">About</a></li>
                        @if(Auth::check())
                        <li class="cart">
                            <div class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-mine-shaft mr-2">Hi, {{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('home.products.getOrder')}}">Đơn Hàng</a>
                                    <a class="dropdown-item" href="{{route('home.user.getProfile', ['id' => Auth::user()->id])}}">Cập Nhật Thông Tin</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Đăng Xuất
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li class="cart"><a href="{{route('home.cart')}}"><i class="icon-shopping-cart"></i> Giỏ Hàng </a></li>
                        @else
                        <li class="cart"><a href="{{route('login')}}"> Đăng Nhập</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</nav>
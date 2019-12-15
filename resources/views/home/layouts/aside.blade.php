<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
           <li style="background-image: url({{ asset('layout_home/images/img_bg_1.jpg')}});">
               <div class="overlay"></div>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-sm-6 offset-sm-3 text-center slider-text">
                           <div class="slider-text-inner">
                               <div class="desc">
                                   <h1 class="head-1">Men's</h1>
                                   <h2 class="head-2">Shoes</h2>
                                   <h2 class="head-3">Collection</h2>
                                   <p class="category"><span>New trending shoes</span></p>
                                   <p><a href="{{route('home.collection', ['key' => 'collection'])}}" class="btn btn-primary">Xem Bộ Sưu Tập</a></p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </li>
           <li style="background-image: url({{ asset('layout_home/images/img_bg_2.jpg')}});">
               <div class="overlay"></div>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-sm-6 offset-sm-3 text-center slider-text">
                           <div class="slider-text-inner">
                               <div class="desc">
                                   <h1 class="head-1">Huge</h1>
                                   <h2 class="head-2">Sale</h2>
                                   <h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
                                   <p class="category"><span>Big sale sandals</span></p>
                                   <p><a href="{{route('home.collection', ['key' => 'collection'])}}" class="btn btn-primary">Xem Bộ Sưu Tập</a></p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </li>
           
          </ul>
      </div>
</aside>
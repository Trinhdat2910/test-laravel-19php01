<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin')}}" class="brand-link">
    <img src="{{ asset('layout/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">FOOTWEAR SHOP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('layout/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('admin')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
              <a href="{{ route('admin.order.list')}}" class="nav-link ">
                  <i class="nav-icon  fas fa-copy"></i>
                  <p>
                    Đơn Hàng
                  </p>
                </a>
            </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Sản Phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.products.add')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.products.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Nhà cung cấp
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.supplier.add')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.supplier.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Nhập Kho
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.warehouse.add')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.warehouse.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.users.add')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.users.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('admin.transaction.list')}}" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Giao dịch
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Đăng Xuất</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

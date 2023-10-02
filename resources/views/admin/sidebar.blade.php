<style>
  .nav-item ul {
    display: none;
  }

  .nav-item.active ul {
    display: block;
  }

  .nav-item.active .nav-icon i {
    color: black; /* Đổi màu icon khi mục được chọn */
  }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/template/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}
      {{-- Tổng quan --}}


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Tổng quan -->
          <li class="nav-item">
            <a href="/admin/revenue/list" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>Tổng quan</p>
            </a>
          </li>

          <!-- Danh mục -->
          <li class="nav-item" onclick="toggleSubMenu(this)">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Danh mục<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/menus/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm danh mục</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/menus/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách danh mục</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Sản phẩm -->
          <li class="nav-item" onclick="toggleSubMenu(this)">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Sản phẩm<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/products/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Slider -->
          <li class="nav-item" onclick="toggleSubMenu(this)">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Slider<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/sliders/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/sliders/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách slider</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Giỏ hàng -->
          <li class="nav-item" onclick="toggleSubMenu(this)">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>Giỏ hàng<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/customers" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách giỏ hàng</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Bình luận -->
          <li class="nav-item" onclick="toggleSubMenu(this)">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>Bình luận<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/comment/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách bình luận</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Tin tức -->
          <li class="nav-item" onclick="toggleSubMenu(this)">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-blog"></i>
              <p>Tin tức<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/blog/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm tin tức</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/blog/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách tin tức</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Mã khuyến mãi -->
          <li class="nav-item" onclick="toggleSubMenu(this)">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Coupon<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/coupons/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm coupon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/coupons/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách coupon</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
    function toggleSubMenu(element) {
      element.classList.toggle('active');
    }



  </script>

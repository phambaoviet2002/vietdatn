<div class="nav-container primary-menu">
    <div class="mobile-topbar-header">
        <div>
            <img src="/assets_admin_rocker/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rukada</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl w-100">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
            <!-- menu thống kê  -->
            
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin')}}">
                    <div class="parent-icon"><i class="bx bx-home-circle"></i>
                    </div>
                    <div class="menu-title">Thống Kê</div>
                </a>
            </li>

            <!-- menu danh mục  -->
            @php
                $QuanLy = true;

                if ($BanHang || $DangBai) {
                    $QuanLy = false;
                }
            @endphp

            @if ($QuanLy)
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/danhmuc')}}">
                    <div class="parent-icon"><i class="bx bx-cookie"></i>
                    </div>
                    <div class="menu-title">Danh Mục</div>
                </a>
            </li>
            @endif

            <!-- menu thể loại  -->
            @php
                $QuanLy = true;

                if ($BanHang || $DangBai) {
                    $QuanLy = false;
                }
            @endphp

            @if ($QuanLy)
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/theloai')}}">
                    <div class="parent-icon"><i class="bx bx-tag"></i>
                    </div>
                    <div class="menu-title">Thể Loại</div>
                </a>
            </li>
            @endif

            <!-- menu sản phẩm  -->
            
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/sanpham')}}">
                    <div class="parent-icon"><i class="bx bx-cart"></i>
                    </div>
                    <div class="menu-title">Sản Phẩm</div>
                </a>
            </li>

            <!-- menu liên hệ  -->
            
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/lien-he')}}">
                    <div class="parent-icon"><i class="bx bx-phone"></i>
                    </div>
                    <div class="menu-title">Liên Hệ</div>
                </a>
            </li>

            <!-- menu Khách hàng  -->
            
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/quan-ly-tai-khoan')}}">
                    <div class="parent-icon"><i class="bx bx-user"></i>
                    </div>
                    <div class="menu-title">Khách hàng</div>
                </a>
            </li>

            <!-- menu nhân viên  -->
            @php
                $QuanLy = true;

                if ($BanHang || $DangBai) {
                    $QuanLy = false;
                }
            @endphp

            @if ($QuanLy)
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('admin/quan-ly-nhan-vien') }}">
                        <div class="parent-icon"><i class="bx bx-user"></i></div>
                        <div class="menu-title">Nhân Viên</div>
                    </a>
                </li>
            @endif

            <!-- menu bai viết  -->
            @php
                $QuanLy = true;

                if ($BanHang || $DangBai) {
                    if($BanHang) {
                        $QuanLy = false;
                    }
                    if($DangBai) {
                        $QuanLy = true;
                    }
                }
            @endphp

            @if ($QuanLy)
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/baiviet')}}">
                    <div class="parent-icon"><i class="bx bx-cookie"></i>
                    </div>
                    <div class="menu-title">Bài viết</div>
                </a>
            </li>
            @endif

            <!-- menu hoá đơn  -->
            @php
                $QuanLy = true;

                if ($BanHang || $DangBai) {
                    if($BanHang) {
                        $QuanLy = true;
                    }
                    if($DangBai) {
                        $QuanLy = false;
                    }
                }
            @endphp

            @if ($QuanLy)
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/hoa-don')}}">
                    <div class="parent-icon"><i class="bx bx-notepad"></i>
                    </div>
                    <div class="menu-title">Hoá Đơn</div>
                </a>
            </li>
            @endif

            <!-- menu bình luận  -->
            
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/binhluan')}}">
                    <div class="parent-icon"><i class="bx bx-comment"></i>
                    </div>
                    <div class="menu-title">Bình luận</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/magiamgia')}}">
                    <div class="parent-icon"><i class="bx bx-price-tag"></i>
                    </div>
                    <div class="menu-title">Mã Giảm Giá</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{asset('admin/banner')}}">
                    <div class="parent-icon"><i class="bx bx-outline-post-add"></i>
                    </div>
                    <div class="menu-title">Banner</div>
                </a>
            </li>
        </ul>
    </nav>
</div>
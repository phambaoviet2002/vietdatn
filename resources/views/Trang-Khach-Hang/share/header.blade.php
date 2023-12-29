<!-- announcement bar start --?
<div class="announcement-bar bg-4 py-1 py-lg-2">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3 d-lg-block d-none">
                <div class="announcement-call-wrapper">
                    <div class="announcement-call">
                        <a class="announcement-text text-white" href="tel:+1-078-2376">Call: +1 078 2376</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="announcement-text-wrapper d-flex align-items-center justify-content-center">
                    <p class="announcement-text text-white">New year sale - 30% off</p>
                </div>
            </div>
            <div class="col-lg-3 d-lg-block d-none">
                <div class="announcement-meta-wrapper d-flex align-items-center justify-content-end">
                    <div class="announcement-meta d-flex align-items-center">
                        <span class="separator-login d-flex px-3">
                            <svg width="2" height="9" viewBox="0 0 2 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M1 0.5V8.5" stroke="#FEFEFE" stroke-linecap="round" />
                            </svg>
                        </span>
                        <div class="currency-wrapper">
                            <button type="button" class="currency-btn btn-reset text-white" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="flag" src="/assets_client/img/flag/usd.jpg" alt="img">
                                <span>USD</span>
                                <span>
                                    <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                        stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>

                            <ul class="currency-list dropdown-menu dropdown-menu-end px-2">
                                <li class="currency-list-item ">
                                    <a class="currency-list-option" href="#" data-value="USD">
                                        <img class="flag" src="/assets_client/img/flag/usd.jpg" alt="img">
                                        <span>USD</span>
                                    </a>
                                </li>
                                <li class="currency-list-item ">
                                    <a class="currency-list-option" href="#" data-value="CAD">
                                        <img class="flag" src="/assets_client/img/flag/cad.jpg" alt="img">
                                        <span>CAD</span>
                                    </a>
                                </li>
                                <li class="currency-list-item ">
                                    <a class="currency-list-option" href="#" data-value="EUR">
                                        <img class="flag" src="/assets_client/img/flag/eur.jpg" alt="img">
                                        <span>EUR</span>
                                    </a>
                                </li>
                                <li class="currency-list-item ">
                                    <a class="currency-list-option" href="#" data-value="JPY">
                                        <img class="flag" src="/assets_client/img/flag/jpy.jpg" alt="img">
                                        <span>JPY</span>
                                    </a>
                                </li>
                                <li class="currency-list-item ">
                                    <a class="currency-list-option" href="#" data-value="GBP">
                                        <img class="flag" src="/assets_client/img/flag/gbp.jpg" alt="img">
                                        <span>GBP</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- announcement bar end -->

<!-- header start -->
<header class="sticky-header border-btm-black">
    <div class="header-top border-btm-black">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-4">
                    <div class="header-logo">
                        <a href="/" class="logo-main">
                            <img src="/assets_client/img/Gucci_Logo.svg.png" loading="lazy" alt="GUCCI">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-block d-none">
                    <div class="header-search">
                        <form action="/tim-kiem" method="get" role="search"
                            class="search-form d-flex justify-content-center">
                            @csrf
                            <div class="field field-search">
                                <input class="field-input input-reset" v-model="tim_kiem" type="text" name="search"
                                    placeholder="Tìm kiếm sản phẩm" autocomplete="off">

                                <button class="search-button btn-reset" type="submit">
                                    <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                                            fill="black" />
                                    </svg>
                                </button>
                            </div>

                        </form>

                        <div v-if="ds_tim_kiem && ds_tim_kiem.length > 0" v-cloak>
                            <div  class="header-action-item ms-4 d-none d-lg-block">
                                <ul class="submenu list-unstyled field-search"
                                    style="box-shadow: 0 0 5px #55555545; position: absolute;
                                    z-index: 1000; background-color: #fff; margin-left: 6px;">
                                    <li v-for="(value, key) in ds_tim_kiem" :key="key" class="menu-list-item nav-item-sub">
                                        <a class="nav-link-sub nav-text-sub d-flex" :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug + '/' + value.ten_san_pham_slug + '/' + value.id">
                                            <div style="border: 1px solid #999; width: 100px; margin-right: 10px">
                                                <img  :src="'/img/' + value.hinh_anh" alt="product-img" width="100px">
                                            </div>
                                            <div>
                                                <h6>@{{value.ten_san_pham}}</h6>
                                                <div class="product-card-price">
                                                    <span class="card-price-regular">@{{ formatCurrency(value.giam_gia_san_pham) }}</span>

                                                    <span class="card-price-compare text-decoration-line-through"
                                                        v-if="value.giam_gia_san_pham == value.gia_san_pham"></span>
                                                    <span class="card-price-compare text-decoration-line-through"
                                                        v-else>@{{ formatCurrency(value.gia_san_pham) }}</span>
                                                </div>
                                                 <span v-html="value.mo_ta.substring(0, 10)+ '...'"></span>
                                                
                                            </div>
                                        </a>
                                    </li>
                                  <div v-if="ds_tim_kiem.length == 3" class="text-end">
                                    <form action="/tim-kiem" method="get">
                                        @csrf
                                        <input type="hidden" :value="tim_kiem" name="search">
                                        <button class="btn">Xem thêm ...</button>
                                    </form>
                                  </div>
                                
                                   
                                </ul>
                                
                            </div>

                            
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-8 col-8">
                    <div class="header-action d-flex align-items-center justify-content-end">
                        <a class="header-action-item header-search d-lg-none" href="javascript:void(0)">
                            <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                                    fill="black" />
                            </svg>
                        </a>

                        @if ($check)
                            <div class="header-action-item header-wishlist ms-4 d-none d-lg-block">
                                <ul class="main-menu list-unstyled">
                                    <li class="menu-list-item nav-item has-dropdown" style=" padding: 0 !important;">
                                        <div class="mega-menu-header">
                                            <a class="nav-link p-0" href="/"><i class="fa-regular fa-user "
                                                    style="font-size: 23px; "></i></a>
                                        </div>
                                        <div class="submenu-transform submenu-transform-desktop">
                                            <ul class="submenu list-unstyled">
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="/khach-hang/ho-so">Trang Cá
                                                        Nhân</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="/khach-hang/cap-nhap-mat-khau">Đổi Mật
                                                        Khẩu</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="/khach-hang/lich-su-mua-hang">Lịch sử mua hàng</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="/dang-xuat">Đăng
                                                        Xuất</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="header-action-item header-wishlist ms-4 d-none d-lg-block">
                                <ul class="main-menu list-unstyled">
                                    <li class="menu-list-item nav-item has-dropdown" style=" padding: 0 !important;">
                                        <div class="mega-menu-header">
                                            <a class="nav-link p-0" href="/dang-nhap"><i class="fa-regular fa-user "
                                                    style="font-size: 23px; "></i></a>
                                        </div>
                                        <div class="submenu-transform submenu-transform-desktop">
                                            <ul class="submenu list-unstyled">
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="/dang-nhap">Đăng
                                                        Nhập</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="/dang-ky">Đăng Ký</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        <a class="header-action-item header-wishlist ms-4 d-none d-lg-block"
                            href="/san-pham-yeu-thich">
                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-cart ms-4" href="#drawer-cart"
                            data-bs-toggle="offcanvas">
                            <svg class="icon icon-cart" width="24" height="26" viewBox="0 0 24 26"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-hamburger ms-4 d-lg-none" href="#drawer-menu"
                            data-bs-toggle="offcanvas">
                            <svg class="icon icon-hamburger" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-wrapper d-lg-none">
            <div class="container">
                <form action="#" class="search-form d-flex align-items-center">
                    <button type="submit" class="search-submit bg-transparent pl-0 text-start">
                        <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                                fill="black" />
                        </svg>
                    </button>
                    <div class="search-input mr-4">
                        <input type="text" placeholder="Search your products..." autocomplete="off">
                    </div>
                    <div class="search-close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="header-bottom d-lg-block d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <nav class="site-navigation">
                        <ul class="main-menu list-unstyled">
                            <li class="menu-list-item nav-item has-dropdown active">
                                <div class="mega-menu-header">
                                    <a class="nav-link" href="/">
                                        Trang Chủ
                                    </a>

                                </div>
                            </li>
                            <li class="menu-list-item nav-item has-megamenu">
                                <div class="mega-menu-header">
                                    <a class="nav-link" href="/san-pham">
                                        Cửa Hàng
                                    </a>
                                    <span class="open-submenu">
                                        <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div class="submenu-transform submenu-transform-desktop">
                                    <div class="container">
                                        <ul class="submenu megamenu-container list-unstyled">
                                            @if ($danhMuc->count() > 0)
                                                @foreach ($danhMuc as $danhmuc)
                                                    @if ($danhmuc->is_delete == 0)
                                                        <li class="menu-list-item nav-item-sub">
                                                            <div class="mega-menu-header">
                                                                <a class="nav-link-sub nav-text-sub megamenu-heading"
                                                                    href="/san-pham/{{ $danhmuc->ten_danh_muc_slug }}">
                                                                    {{ $danhmuc->ten_danh_muc }}
                                                                </a>
                                                            </div>
                                                            <div class="submenu-transform megamenu-transform">
                                                                <ul class="megamenu list-unstyled">
                                                                    @foreach ($theLoai as $theloai)
                                                                        @if ($theloai->is_delete == 0 && $theloai->ma_danh_muc == $danhmuc->id)
                                                                            <li class="menu-list-item nav-item-sub">
                                                                                <a class="nav-link-sub nav-text-sub"
                                                                                    href="/san-pham/{{ $danhmuc->ten_danh_muc_slug }}/{{ $theloai->ten_loai_slug }}">{{ $theloai->ten_loai }}</a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @else
                                                <p style="color: red;">Danh mục sản phẩm không có</p>
                                            @endif



                                             <li class="menu-list-item nav-item-sub">
                                                <div
                                                    class="mega-menu-header d-flex align-items-center justify-content-between">
                                                    <a class="mega-menu-img nav-link-sub nav-text-sub"
                                                        href="/gioi-thieu">
                                                        <img class="menu-img" src="https://th.bing.com/th?id=OSK.HEROYkb_xgamewall7oODLNvuTRaVrROfqFY0VOjSGnU_DE&w=472&h=280&c=1&rs=2&o=6&pid=SANGAM"
                                                            alt="img">
                                                        <h2 class="img-menu-heading text_16 mt-2">GUCCI THƯƠNG HIỆU SANG TRỌNG</h2>
                                                        <div class="img-menu-action text_12 bg-transparent p-0">
                                                            <span>KHÁM PHÁ NGAY</span>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                    height="18" fill="#000"
                                                                    class="icon-right-long" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="menu-list-item nav-item has-dropdown">
                                <div class="mega-menu-header">
                                    <a class="nav-link" href="/tin-tuc">Tin Tức</a>
                                    <span class="open-submenu">
                                        <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div class="submenu-transform submenu-transform-desktop">
                                    <ul class="submenu list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                            <a class="nav-link-sub nav-text-sub" href="/tin-tuc/1">Tin khuyến mãi</a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                            <a class="nav-link-sub nav-text-sub" href="/tin-tuc/2">Tin tức mới</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-list-item nav-item">
                                <a class="nav-link" href="/lien-he">Liên Hệ</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="member-signup d-flex justify-content-end">
                        <a href="/gioi-thieu" class="btn-member text-white">Giới Thiệu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<button id="scrollup">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</button>
<!-- scrollup end -->
<!-- drawer menu start -->
<div class="offcanvas offcanvas-start d-flex d-lg-none" tabindex="-1" id="drawer-menu">
    <div class="offcanvas-wrapper">
        <div class="offcanvas-header border-btm-black">
            <h5 class="drawer-heading">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 d-flex flex-column justify-content-between">
            <nav class="site-navigation">
                <ul class="main-menu list-unstyled">
                    <li class="menu-list-item nav-item has-dropdown active">
                        <div class="mega-menu-header">
                            <a class="nav-link active" href="index.html">
                                Home
                            </a>
                            <span class="open-submenu">
                                <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="submenu-transform submenu-transform-desktop">
                            <div class="offcanvas-header border-btm-black">
                                <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                    <svg class="icon icon-menu-back" xmlns="http://www.w3.org/2000/svg"
                                        width="40" height="40" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>
                                    <span class="menu-back-text">Home</span>
                                </h5>
                            </div>
                            <ul class="submenu list-unstyled">
                                <li class="menu-list-item nav-item-sub"><a class="nav-link-sub nav-text-sub"
                                        href="index.html">Home
                                        1</a>
                                </li>
                                <li class="menu-list-item nav-item-sub"><a class="nav-link-sub nav-text-sub"
                                        href="index-shoe.html">Home
                                        2</a>
                                </li>
                                <li class="menu-list-item nav-item-sub"><a class="nav-link-sub nav-text-sub"
                                        href="index-bag.html">Home
                                        3</a>
                                </li>
                                <li class="menu-list-item nav-item-sub"><a class="nav-link-sub nav-text-sub"
                                        href="index-tools.html">Home
                                        4</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-list-item nav-item has-megamenu">
                        <div class="mega-menu-header">
                            <a class="nav-link" href="collection-left-sidebar.html">
                                Shop
                            </a>
                            <span class="open-submenu">
                                <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="submenu-transform submenu-transform-desktop">
                            <div class="container">
                                <div class="offcanvas-header border-btm-black">
                                    <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                        <svg class="icon icon-menu-back" xmlns="http://www.w3.org/2000/svg"
                                            width="40" height="40" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="15 18 9 12 15 6"></polyline>
                                        </svg>
                                        <span class="menu-back-text">Shop</span>
                                    </h5>
                                </div>
                                <ul class="submenu megamenu-container list-unstyled">
                                    <li class="menu-list-item nav-item-sub">
                                        <div class="mega-menu-header">
                                            <a class="nav-link-sub nav-text-sub megamenu-heading"
                                                href="collection-left-sidebar.html">
                                                Category Pages
                                            </a>
                                            <span class="open-submenu">
                                                <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="submenu-transform">
                                            <div class="offcanvas-header border-btm-black">
                                                <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                                    <svg class="icon icon-menu-back"
                                                        xmlns="http://www.w3.org/2000/svg" width="40"
                                                        height="40" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="15 18 9 12 15 6"></polyline>
                                                    </svg>
                                                    <span class="menu-back-text">Category Pages</span>
                                                </h5>
                                            </div>
                                            <ul class="megamenu list-unstyled megamenu-container">
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="collection-left-sidebar.html">With Left
                                                        Sidebar</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="collection-right-sidebar.html">With Right
                                                        Sidebar</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="collection-left-sidebar.html">3 Column
                                                        Layout</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="collection-without-sidebar.html">4 Column
                                                        Layout</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub"
                                                        href="collection-without-sidebar.html">Without
                                                        Sidebar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-list-item nav-item-sub">
                                        <div class="mega-menu-header">
                                            <a class="nav-link-sub nav-text-sub megamenu-heading" href="index.html">
                                                Product Pages
                                            </a>
                                            <span class="open-submenu">
                                                <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="submenu-transform">
                                            <div class="offcanvas-header border-btm-black">
                                                <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                                    <svg class="icon icon-menu-back"
                                                        xmlns="http://www.w3.org/2000/svg" width="40"
                                                        height="40" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="15 18 9 12 15 6"></polyline>
                                                    </svg>
                                                    <span class="menu-back-text">Product Pages</span>
                                                </h5>
                                            </div>
                                            <ul class="megamenu list-unstyled">
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Simple
                                                        Product</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Variable
                                                        Product</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Sale
                                                        Product</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Featured
                                                        & On Sale</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product-2.html">Tab
                                                        Inside</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-list-item nav-item-sub">
                                        <div class="mega-menu-header">
                                            <a class="nav-link-sub nav-text-sub megamenu-heading" href="index.html">
                                                Product Layouts
                                            </a>
                                            <span class="open-submenu">
                                                <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="submenu-transform">
                                            <div class="offcanvas-header border-btm-black">
                                                <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                                    <svg class="icon icon-menu-back"
                                                        xmlns="http://www.w3.org/2000/svg" width="40"
                                                        height="40" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="15 18 9 12 15 6"></polyline>
                                                    </svg>
                                                    <span class="menu-back-text">Product Layouts</span>
                                                </h5>
                                            </div>
                                            <ul class="megamenu list-unstyled">
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product-2.html">Grid
                                                        Images</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Vertical
                                                        Thumb</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Gallery
                                                        Type</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Product
                                                        Width Layout</a>
                                                </li>
                                                <li class="menu-list-item nav-item-sub">
                                                    <a class="nav-link-sub nav-text-sub" href="product.html">Sticky
                                                        Gallery</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-list-item nav-item-sub">
                                        <div class="mega-menu-header">
                                            <a class="nav-link-sub nav-text-sub megamenu-heading"
                                                href="collection-left-sidebar.html">
                                                Featured Collection
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-list-item nav-item">
                        <a class="nav-link" href="blog.html">Blog</a>
                    </li>
                    <li class="menu-list-item nav-item has-dropdown">
                        <div class="mega-menu-header">
                            <a class="nav-link active" href="about-us.html">
                                Pages
                            </a>
                            <span class="open-submenu">
                                <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="submenu-transform submenu-transform-desktop">
                            <div class="offcanvas-header border-btm-black">
                                <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                    <svg class="icon icon-menu-back" xmlns="http://www.w3.org/2000/svg"
                                        width="40" height="40" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>
                                    <span class="menu-back-text">Pages</span>
                                </h5>
                            </div>
                            <ul class="submenu list-unstyled">
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="about-us.html">About Us</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="contact.html">Contact</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="faq.html">FAQ</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="404.html">404 page</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="login.html">Login</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="register.html">Register</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="wishlist.html">Wishlist</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="cart.html">Cart</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="checkout.html">Checkout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-list-item nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                </ul>
            </nav>
            <ul class="utility-menu list-unstyled">
                <li class="menu-list-item nav-item has-dropdown">
                    <div class="mega-menu-header">

                        <span class="open-submenu utilty-icon-wrapper">
                            <i class="fa-regular fa-user " style="font-size: 20px;"></i>
                        </span>
                    </div>
                    @if ($check)
                        <div class="submenu-transform submenu-transform-desktop">
                            <div class="offcanvas-header border-btm-black">
                                <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                    <svg class="icon icon-menu-back" xmlns="http://www.w3.org/2000/svg"
                                        width="40" height="40" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>

                                </h5>
                            </div>
                            <ul class="submenu list-unstyled">
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="/khach-hang/ho-so">Trang Cá
                                        Nhân</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="/khach-hang/cap-nhap-mat-khau">Đổi Mật
                                        Khẩu</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="/khach-hang/lich-su-mua-hang">Lịch sử
                                        mua hàng</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="/dang-xuat">Đăng
                                        Xuất</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="submenu-transform submenu-transform-desktop">
                            <div class="offcanvas-header border-btm-black">
                                <h5 class="drawer-heading btn-menu-back d-flex align-items-center">
                                    <svg class="icon icon-menu-back" xmlns="http://www.w3.org/2000/svg"
                                        width="40" height="40" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>

                                </h5>
                            </div>
                            <ul class="submenu list-unstyled">
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="/dang-nhap">Đăng Nhập</a>
                                </li>
                                <li class="menu-list-item nav-item-sub">
                                    <a class="nav-link-sub nav-text-sub" href="/dang-ky">Đăng Ký</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                </li>
                <li class="utilty-menu-item">
                    <a class="header-action-item header-wishlist" href="wishlist.html">
                        <span class="utilty-icon-wrapper">
                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                fill="#000" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                    fill="#000" />
                            </svg>
                        </span>
                        <span>My wishlist</span>
                    </a>
                </li>
                <li class="utilty-menu-item">
                    <a class="announcement-text" href="tel:+1-078-2376">
                        <span class="utilty-icon-wrapper">
                            <svg class="icon icon-phone" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </span>
                        Call: +1 078 2376
                    </a>
                </li>

                <li class="utilty-menu-item">
                    <button type="button" class="currency-btn btn-reset" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="flag" src="/assets_client/img/flag/usd.jpg" alt="img">
                        <span>USD</span>
                        <span class="utilty-icon-wrapper">
                            <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </button>

                    <ul class="currency-list dropdown-menu dropdown-menu-end px-2">
                        <li class="currency-list-item ">
                            <a class="currency-list-option" href="#" data-value="USD">
                                <img class="flag" src="/assets_client/img/flag/usd.jpg" alt="img">
                                <span>USD</span>
                            </a>
                        </li>
                        <li class="currency-list-item ">
                            <a class="currency-list-option" href="#" data-value="CAD">
                                <img class="flag" src="/assets_client/img/flag/cad.jpg" alt="img">
                                <span>CAD</span>
                            </a>
                        </li>
                        <li class="currency-list-item ">
                            <a class="currency-list-option" href="#" data-value="EUR">
                                <img class="flag" src="/assets_client/img/flag/eur.jpg" alt="img">
                                <span>EUR</span>
                            </a>
                        </li>
                        <li class="currency-list-item ">
                            <a class="currency-list-option" href="#" data-value="JPY">
                                <img class="flag" src="/assets_client/img/flag/jpy.jpg" alt="img">
                                <span>JPY</span>
                            </a>
                        </li>
                        <li class="currency-list-item ">
                            <a class="currency-list-option" href="#" data-value="GBP">
                                <img class="flag" src="/assets_client/img/flag/gbp.jpg" alt="img">
                                <span>GBP</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- header end -->

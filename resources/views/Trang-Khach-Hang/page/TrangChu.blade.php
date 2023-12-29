@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
@php
$check = Auth::guard('khach_hang')->check();
$user = Auth::guard('khach_hang')->user();
@endphp
<main id="MainContent" class="content-for-layout" v-cloak>
    <!-- slideshow start -->
    <div class="slideshow-section position-relative">
        <div class="slideshow-active activate-slider" data-slick='{
        "slidesToShow": 1, 
        "slidesToScroll": 1, 
        "dots": true,
        "arrows": true,
        "responsive": [
          {
            "breakpoint": 768,
            "settings": {
              "arrows": false
            }
          }
        ]
    }'>
            <!-- <div class="slide-item position-relative overlay">
                        <img class="slide-img d-none d-md-block" style="height: 600px !important; width:100%"
                            src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg"
                            alt="slide-1">
                        <img class="slide-img d-md-none"
                            src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg"
                            alt="slide-1">
                        <div class="content-absolute content-slide">
                            <div class="container height-inherit d-flex align-items-center justify-content-start">
                                <div class="content-box slide-content py-4">
                                    <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                                        data-animation="animate__animated animate__fadeInUp">
                                        Chinh phục thế giới thời trang với
                                    </p>
                                    <h2 class="slide-heading heading_72 text-white animate__animated animate__fadeInUp"
                                        data-animation="animate__animated animate__fadeInUp">
                                        Thiết Kế Độc Đáo tại Guci
                                    </h2>
                                    <p class="slide-subheading heading_18 text-white animate__animated animate__fadeInUp"
                                        data-animation="animate__animated animate__fadeInUp">
                                        Tiết kiệm ngay tới 56% cho mọi đơn hàng
                                    </p>
                                    <a class="btn-primary slide-btn animate__animated animate__fadeInUp"
                                        href="collection-left-sidebar.html"
                                        data-animation="animate__animated animate__fadeInUp">KHÁM PHÁ NGAY</a>
                                </div>
                            </div>

                        </div>
                    </div> -->
            @if (count($data_banner) < 3) <div class="slide-item position-relative overlay">
                <img class="slide-img d-none d-md-block" style="height: 600px !important; width:100%"
                    src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg"
                    alt="slide-1">
                <img class="slide-img d-md-none"
                    src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg"
                    alt="slide-1">
                <div class="content-absolute content-slide">
                    <div class="container height-inherit d-flex align-items-center justify-content-start">
                        <div class="content-box slide-content py-4">
                            <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                                data-animation="animate__animated animate__fadeInUp">
                                Chinh phục thế giới thời trang với
                            </p>
                            <h2 class="slide-heading heading_72 text-white animate__animated animate__fadeInUp"
                                data-animation="animate__animated animate__fadeInUp">
                                Thiết Kế Độc Đáo tại Guci
                            </h2>
                            <p class="slide-subheading heading_18 text-white animate__animated animate__fadeInUp"
                                data-animation="animate__animated animate__fadeInUp">
                                Tiết kiệm ngay tới 56% cho mọi đơn hàng
                            </p>
                            <a class="btn-primary slide-btn animate__animated animate__fadeInUp" href="/gioi-thieu"
                                data-animation="animate__animated animate__fadeInUp">KHÁM PHÁ NGAY</a>
                        </div>
                    </div>

                </div>
        </div>

        <div class="slide-item position-relative overlay">
            <img class="slide-img d-none d-md-block" style="height: 600px !important; width:100%"
                src="https://authenticvietnam.vn/wp-content/uploads/banner-that-lung-gucci-cua-nuoc-nao-chinh-hang-chia-se-tu-gucci-vietnam.jpg"
                alt="slide-1">
            <img class="slide-img d-md-none"
                src="https://authenticvietnam.vn/wp-content/uploads/banner-that-lung-gucci-cua-nuoc-nao-chinh-hang-chia-se-tu-gucci-vietnam.jpg"
                alt="slide-1">
            <div class="content-absolute content-slide">
                <div class="container height-inherit d-flex align-items-center justify-content-start">
                    <div class="content-box slide-content py-4">
                        <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Chinh phục thế giới thời trang với
                        </p>
                        <h2 class="slide-heading heading_72 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Thiết Kế Độc Đáo tại Guci
                        </h2>
                        <p class="slide-subheading heading_18 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Tiết kiệm ngay tới 56% cho mọi đơn hàng
                        </p>
                        <a class="btn-primary slide-btn animate__animated animate__fadeInUp" href="/gioi-thieu"
                            data-animation="animate__animated animate__fadeInUp">KHÁM PHÁ NGAY</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="slide-item position-relative overlay">
            <img class="slide-img d-none d-md-block" style="height: 600px !important; width:100%"
                src="https://image.meovathay.vn/upload/2020/06/08/660/cach-nhan-biet-mat-kinh-gucci-chinh-hang-phan-biet.jpg"
                alt="slide-1">
            <img class="slide-img d-md-none"
                src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg"
                alt="slide-1">
            <div class="content-absolute content-slide">
                <div class="container height-inherit d-flex align-items-center justify-content-start">
                    <div class="content-box slide-content py-4">
                        <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Chinh phục thế giới thời trang với
                        </p>
                        <h2 class="slide-heading heading_72 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Thiết Kế Độc Đáo tại Guci
                        </h2>
                        <p class="slide-subheading heading_18 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Tiết kiệm ngay tới 56% cho mọi đơn hàng
                        </p>
                        <a class="btn-primary slide-btn animate__animated animate__fadeInUp" href="/gioi-thieu"
                            data-animation="animate__animated animate__fadeInUp">KHÁM PHÁ NGAY</a>
                    </div>
                </div>

            </div>
        </div>
        @foreach ($data_banner as $banner)
        <div class="slide-item position-relative overlay">
            <img class="slide-img d-none d-md-block" style="height: 600px !important; width:100%"
                src="{{ asset('img/') }}/{{ $banner->anh_banner }}" alt="slide-1">
            <!-- <img class="slide-img d-md-none"
                            src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg"
                            alt="slide-1"> -->
            <div class="content-absolute content-slide">
                <div class="container height-inherit d-flex align-items-center justify-content-start">
                    <div class="content-box slide-content py-4">
                        @if ($banner->loai_tin == 1)
                        <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Tin Khuyến Mãi
                        </p>
                        @else
                        <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Tin Tức
                        </p>
                        @endif
                        <h2 class="slide-heading heading_48 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            {{ $banner->ten_bai_viet }}
                        </h2>
                        <p class="slide-subheading heading_18 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            {{ $banner->mo_ta_ngan }}
                        </p>
                        <a class="btn-primary slide-btn animate__animated animate__fadeInUp"
                            href="/tin-tuc-chi-tiet/{{ $banner->ma_bai_viet }}"
                            data-animation="animate__animated animate__fadeInUp">KHÁM PHÁ NGAY</a>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
        @elseif(count($data_banner) == 3)
        @foreach ($data_banner as $banner)
        <div class="slide-item position-relative overlay">
            <img class="slide-img d-none d-md-block" style="height: 600px !important; width:100%"
                src="{{ asset('img/') }}/{{ $banner->anh_banner }}" alt="slide-1">
            <!-- <img class="slide-img d-md-none"
                            src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg"
                            alt="slide-1"> -->
            <div class="content-absolute content-slide">
                <div class="container height-inherit d-flex align-items-center justify-content-start">
                    <div class="content-box slide-content py-4">
                        @if ($banner->loai_tin == 1)
                        <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Tin Khuyến Mãi
                        </p>
                        @else
                        <p class="slide-text heading_34 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            Tin Tức
                        </p>
                        @endif
                        <h2 class="slide-heading heading_48 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            {{ $banner->ten_bai_viet }}
                        </h2>
                        <p class="slide-subheading heading_18 text-white animate__animated animate__fadeInUp"
                            data-animation="animate__animated animate__fadeInUp">
                            {{ $banner->mo_ta_ngan }}
                        </p>
                        <a class="btn-primary slide-btn animate__animated animate__fadeInUp"
                            href="/tin-tuc-chi-tiet/{{ $banner->ma_bai_viet }}"
                            data-animation="animate__animated animate__fadeInUp">KHÁM PHÁ NGAY</a>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
        @endif

    </div>
    <div class="activate-arrows arrows-white"></div>
    <div class="activate-dots dots-white"></div>
    </div>
    <!-- slideshow end -->

    <!-- trusted badge start -->
    <div class="trusted-section mt-100 overflow-hidden">
        <div class="trusted-section-inner">
            <div class="container">
                <div class="row justify-content-center trusted-row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="trusted-badge bg-4 rounded">
                            <div class="trusted-icon">
                                <img class="icon-trusted" style="filter: brightness(0) invert(1);"
                                    src="https://img.icons8.com/ios-filled/452/delivery.png" alt="icon-1">
                            </div>
                            <div class="trusted-content">
                                <h2 class="heading_18 trusted-heading text-white text-nowrap">Miễn phí vận chuyển & Trả
                                    hàng</h2>
                                <p class="text_16 trusted-subheading trusted-subheading-3 text-nowrap">trên đơn đặt
                                    hàng
                                    từ 1.000.000 ₫ trở lên</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="trusted-badge bg-4 rounded">
                            <div class="trusted-icon">
                                <img class="icon-trusted" src="https://img.icons8.com/ios-filled/452/return.png"
                                    style="filter: brightness(0) invert(1);" alt="icon-2">
                            </div>
                            <div class="trusted-content">
                                <h2 class="heading_18 trusted-heading text-white">Hỗ trợ khách hàng 24/7</h2>
                                <p class="text_16 trusted-subheading trusted-subheading-3">Truy cập tức thì để được hỗ
                                    trợ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="trusted-badge bg-4 rounded">
                            <div class="trusted-icon">
                                <img class="icon-trusted" src="https://img.icons8.com/ios/452/card-exchange.png"
                                    style="filter: brightness(0) invert(1);" alt="icon-3">
                            </div>
                            <div class="trusted-content">
                                <h2 class="heading_18 trusted-heading text-white">Thanh toán an toàn 100%</h2>
                                <p class="text_16 trusted-subheading trusted-subheading-3 text-nowrap">Chúng tôi đảm
                                    bảo
                                    thanh toán an toàn!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- trusted badge end -->

    <!-- collection tab start -->
    <div class="collection-tab-section mt-100 overflow-hidden">
        <div class="collection-tab-inner">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-heading">Sản Phẩm yêu thích</h2>

                </div>
                <div class="tab-list collection-tab-list">
                    <nav class="nav justify-content-center">
                        @foreach ($danhMuc as $danhmuc)
                        @if ($danhmuc->deleted_at == null)
                        <a class="tab-link" href="#{{ $danhmuc->ten_danh_muc_slug }}" data-bs-toggle="tab">{{
                            $danhmuc->ten_danh_muc }}</a>
                        @endif
                        @endforeach
                    </nav>
                </div>
                <div class="tab-content collection-tab-content">
                    <div id="collection-all" class="tab-pane fade show active">
                        <div class="row">

                            @foreach ($san_pham_yeu_thich as $key => $value)
                            @if ($value->deleted_at == null)
                            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-duration="700">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <a class="hover-switch"
                                            href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->ma_san_pham }}">
                                            <img class="secondary-img" src="/img/{{ $value->hinh_anh }}"
                                                alt="product-img">
                                            <img class="primary-img" src="/img/{{ $value->hinh_anh }}"
                                                alt="product-img">
                                        </a>

                                        <div class="product-card-action product-card-action-2">
                                            @if ($check)
                                            <a href="javascript:void(0)"
                                                v-on:click="them_so_luong({{ $value->ma_san_pham }})"
                                                class="addtocart-btn btn-primary text-nowrap"
                                                style="margin: 0 auto; ">Thêm
                                                Vào Giỏ Hàng</a>
                                            @else
                                            <form action="/khach-hang/them-so-luong/{{ $value->ma_san_pham }}"
                                                method="post" class="addtocart-btn btn-primary text-nowrap"
                                                style="margin: 0 auto;">
                                                @csrf
                                                <button type="submit" class="addtocart-btn btn-primary text-nowrap">
                                                    Thêm Vào Giỏ Hàng
                                                </button>
                                            </form>
                                            @endif
                                        </div>

                                        @if ($check)
                                        <button v-if="isFavorite({{ $value->ma_san_pham }})"
                                            v-on:click="quan_ly_san_pham_yeu_thich({{ $value->ma_san_pham }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: #ffae00; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>

                                        </button>
                                        <button v-else
                                            v-on:click="quan_ly_san_pham_yeu_thich({{ $value->ma_san_pham }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>

                                        </button>
                                        @else
                                        <form action="/khach-hang/quan-ly-san-pham-yeu-thich/{{ $value->ma_san_pham }}"
                                            method="post" class="wishlist-btn card-wishlist">

                                            @csrf
                                            <button type="submit" class="wishlist-btn card-wishlist">
                                                <svg class="icon icon-wishlist" width="26" height="22"
                                                    viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                        fill="black" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="product-card-details text-center">
                                        <h3 class="product-card-title"><a
                                                href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->ma_san_pham }}">{{
                                                $value->ten_san_pham }}</a>
                                        </h3>
                                        <div class="product-card-price">
                                            <span class="card-price-regular">{{ number_format($value->giam_gia_san_pham,
                                                0, '.', '.') }}
                                                ₫</span>
                                            @if ($value->giam_gia_san_pham == $value->gia_san_pham)
                                            @else
                                            <span class="card-price-compare text-decoration-line-through">{{
                                                number_format($value->gia_san_pham, 0, '.', '.') }}

                                                ₫</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            @endif
                            @endforeach

                        </div>
                    </div>
                    @foreach ($danhMuc as $danhmuc)
                    <div id="{{ $danhmuc->ten_danh_muc_slug }}" class="tab-pane fade">
                        @if ($danhmuc->deleted_at == null)
                        <div class="row">
                            @foreach ($san_pham_danh_muc[$danhmuc->id] as $sp)
                            @if ($sp->deleted_at == null && $sp->trang_thai == 1)
                            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-duration="700">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <a class="hover-switch"
                                            href="/san-pham/{{ $sp->ten_danh_muc_slug }}/{{ $sp->ten_loai_slug }}/{{ $sp->ten_san_pham_slug }}/{{ $sp->ma_san_pham }}">
                                            <img class="secondary-img" src="/img/{{ $sp->hinh_anh }}" alt="product-img">
                                            <img class="primary-img" src="/img/{{ $sp->hinh_anh }}" alt="product-img">
                                        </a>

                                        <div class="product-card-action product-card-action-2">
                                            @if ($check)
                                            <a href="javascript:void(0)"
                                                v-on:click="them_so_luong({{ $sp->ma_san_pham }})"
                                                class="addtocart-btn btn-primary text-nowrap"
                                                style="margin: 0 auto; ">Thêm
                                                Vào Giỏ Hàng</a>
                                            @else
                                            <form action="/khach-hang/them-so-luong/{{ $sp->ma_san_pham }}"
                                                method="post" class="addtocart-btn btn-primary text-nowrap"
                                                style="margin: 0 auto;">
                                                @csrf
                                                <button type="submit" class="addtocart-btn btn-primary text-nowrap">
                                                    Thêm Vào Giỏ Hàng
                                                </button>
                                            </form>
                                            @endif
                                        </div>

                                        @if ($check)
                                        <button v-if="isFavorite({{ $value->ma_san_pham }})"
                                            v-on:click="quan_ly_san_pham_yeu_thich({{ $value->ma_san_pham }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: #ffae00; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>

                                        </button>
                                        <button v-else
                                            v-on:click="quan_ly_san_pham_yeu_thich({{ $value->ma_san_pham }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>

                                        </button>
                                        @else
                                        <form action="/khach-hang/quan-ly-san-pham-yeu-thich/{{ $value->ma_san_pham }}"
                                            method="post" class="wishlist-btn card-wishlist">

                                            @csrf
                                            <button type="submit" class="wishlist-btn card-wishlist">
                                                <svg class="icon icon-wishlist" width="26" height="22"
                                                    viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                        fill="black" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="product-card-details text-center">
                                        <h3 class="product-card-title"><a
                                                href="/san-pham/{{ $sp->ten_danh_muc_slug }}/{{ $sp->ten_loai_slug }}/{{ $sp->ten_san_pham_slug }}/{{ $sp->ma_san_pham }}">{{
                                                $sp->ten_san_pham }}</a>
                                        </h3>
                                        <div class="product-card-price">
                                            <span class="card-price-regular">{{ number_format($value->giam_gia_san_pham,
                                                0, '.', '.') }}
                                                ₫</span>
                                            @if ($value->giam_gia_san_pham == $value->gia_san_pham)
                                            @else
                                            <span class="card-price-compare text-decoration-line-through">{{
                                                number_format($value->gia_san_pham, 0, '.', '.') }}

                                                ₫</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="view-all text-center" data-aos="fade-up" data-aos-duration="700">
                            <a class="btn-secondary" href="/san-pham">Xem tất cả</a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- collection tab end -->



    <!-- promotinal product start -->
    <div class="promotinal-product-section overlay-tools mt-100 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12 d-flex align-items-center">
                    <div class="promotinal-product-content" data-aos="fade-up" data-aos-duration="700">
                        <p class="heading_18 primary-color mb-3">Khám Phá Sản Phẩm Mới Tại Gucci</p>
                        <h2 class="heading_34 text-white mb-3">Dòng Sản Phẩm Mới Đẳng Cấp Từ Gucci</h2>
                        <p class="text_16 text-white mb-3">Chúng tôi hân hạnh giới thiệu dòng sản phẩm mới với sự kết
                            hợp hoàn hảo giữa sáng tạo và sang trọng của Gucci. Đối với hành khách doanh nghiệp và những
                            người thưởng thức du lịch, Groundlink đã trở thành điểm đáng tin cậy cho dịch vụ đỗ xe
                            chuyên nghiệp, an toàn và đáng tin cậy tại các thành phố lớn trên toàn thế giới. Quả thật,
                            đã hơn một thập kỷ và năm năm qua, Groundlink đã không ngừng mang lại trải nghiệm độc đáo
                            cho khách hàng.</p>
                        <div class="view-all mt-4">
                            <a class="btn-secondary" href="/san-pham">KHÁM PHÁ NGAY</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-12 align-self-center">
                    <div class="promotinal-product-container position-relative" data-aos="fade-left"
                        data-aos-duration="1200">
                        <div class="common-slider" data-slick='{
                "slidesToShow": 3, 
                "slidesToScroll": 1,
                "dots": false,
                "arrows": true,
                "responsive": [
                  {
                    "breakpoint": 1281,
                    "settings": {
                      "slidesToShow": 2
                    }
                  },
                  {
                    "breakpoint": 602,
                    "settings": {
                      "slidesToShow": 1
                    }
                  }
                ]
            }'>
                            @foreach ($san_pham_moi as $key => $value)
                            <div class="product-grid-slideshow">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <a class="hover-switch"
                                            href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->id }}">
                                            <img class="secondary-img" src="/img/{{ $value->hinh_anh }}"
                                                alt="product-img">
                                            <img class="primary-img" src="/img/{{ $value->hinh_anh }}"
                                                alt="product-img">
                                        </a>

                                        <div class="product-card-action product-card-action-2">
                                            @if ($check)
                                            <a href="javascript:void(0)" v-on:click="them_so_luong({{ $value->id }})"
                                                class="addtocart-btn btn-primary text-nowrap"
                                                style="margin: 0 auto; ">Thêm
                                                Vào Giỏ Hàng</a>
                                            @else
                                            <form action="/khach-hang/them-so-luong/{{ $value->id }}" method="post"
                                                class="addtocart-btn btn-primary text-nowrap" style="margin: 0 auto;">
                                                @csrf
                                                <button type="submit" class="addtocart-btn btn-primary text-nowrap">
                                                    Thêm Vào Giỏ Hàng
                                                </button>
                                            </form>
                                            @endif
                                        </div>

                                        @if ($check)
                                        <button v-if="isFavorite({{ $value->id }})"
                                            v-on:click="quan_ly_san_pham_yeu_thich({{ $value->id }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: #ffae00; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>
                                        </button>
                                        <button v-else v-on:click="quan_ly_san_pham_yeu_thich({{ $value->id }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>

                                        </button>
                                        @else
                                        <form action="/khach-hang/quan-ly-san-pham-yeu-thich/{{ $value->id }}"
                                            method="post" class="wishlist-btn card-wishlist">

                                            @csrf
                                            <button type="submit" class="wishlist-btn card-wishlist">
                                                <svg class="icon icon-wishlist" width="26" height="22"
                                                    viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                        fill="black" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="product-card-details text-center">
                                        <h3 class="product-card-title"><a
                                                href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->id }}">{{
                                                $value->ten_san_pham }}</a>
                                        </h3>
                                        <div class="product-card-price">
                                            <span class="card-price-regular">{{ number_format($value->giam_gia_san_pham,
                                                0, '.', '.') }}
                                                ₫</span>
                                            @if ($value->giam_gia_san_pham == $value->gia_san_pham)
                                            @else
                                            <span class="card-price-compare text-decoration-line-through">{{
                                                number_format($value->gia_san_pham, 0, '.', '.') }}

                                                ₫</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                        <div class="activate-arrows show-arrows-always"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- promotinal product end -->


    <!-- collection tab start -->
    <div class="collection-tab-section mt-100 overflow-hidden">
        <div class="collection-tab-inner">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-heading">Sản Phẩm Đặc Biệt</h2>

                </div>
                <div class="tab-content collection-tab-content">
                    <div id="collection-all" class="tab-pane fade show active">
                        <div class="row">
                            @foreach ($san_pham_dac_biet as $key => $value)
                            @if ($value->deleted_at == null)
                            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-duration="700">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <a class="hover-switch"
                                            href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->ma_san_pham }}">
                                            <img class="secondary-img" src="/img/{{ $value->hinh_anh }}"
                                                alt="product-img">
                                            <img class="primary-img" src="/img/{{ $value->hinh_anh }}"
                                                alt="product-img">
                                        </a>

                                        <div class="product-card-action product-card-action-2">
                                            @if ($check)
                                            <a href="javascript:void(0)" v-on:click="them_so_luong({{ $value->id }})"
                                                class="addtocart-btn btn-primary text-nowrap"
                                                style="margin: 0 auto; ">Thêm
                                                Vào Giỏ Hàng</a>
                                            @else
                                            <form action="/khach-hang/them-so-luong/{{ $value->id }}" method="post"
                                                class="addtocart-btn btn-primary text-nowrap" style="margin: 0 auto;">
                                                @csrf
                                                <button type="submit" class="addtocart-btn btn-primary text-nowrap">
                                                    Thêm Vào Giỏ Hàng
                                                </button>
                                            </form>
                                            @endif
                                        </div>

                                        @if ($check)
                                        <button v-if="isFavorite({{ $value->id }})"
                                            v-on:click="quan_ly_san_pham_yeu_thich({{ $value->id }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: #ffae00; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>

                                        </button>
                                        <button v-else v-on:click="quan_ly_san_pham_yeu_thich({{ $value->id }})"
                                            class="wishlist-btn card-wishlist"
                                            style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#00234D" />
                                            </svg>

                                        </button>
                                        @else
                                        <form action="/khach-hang/quan-ly-san-pham-yeu-thich/{{ $value->id }}"
                                            method="post" class="wishlist-btn card-wishlist">

                                            @csrf
                                            <button type="submit" class="wishlist-btn card-wishlist">
                                                <svg class="icon icon-wishlist" width="26" height="22"
                                                    viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                        fill="black" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="product-card-details text-center">
                                        <h3 class="product-card-title"><a
                                                href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->id }}">{{
                                                $value->ten_san_pham }}</a>
                                        </h3>
                                        <div class="product-card-price">
                                            <span class="card-price-regular">{{ number_format($value->giam_gia_san_pham,
                                                0, '.', '.') }}
                                                ₫</span>
                                            @if ($value->giam_gia_san_pham == $value->gia_san_pham)
                                            @else
                                            <span class="card-price-compare text-decoration-line-through">{{
                                                number_format($value->gia_san_pham, 0, '.', '.') }}

                                                ₫</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            @endif
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- collection tab end -->

    <!-- video start -->
    <div class="video-section mt-100 overflow-hidden">
        <div class="overlay-tools section-spacing"
            style="background: url('https://th.bing.com/th/id/OIP.s6D6-4q7q_Shldt__CuCvwHaDw?rs=1&pid=ImgDetMain') no-repeat fixed bottom center/cover">
            <div class="container video-container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-5 col-md-4 col-12">
                        <div class="video-tools d-flex align-items-center">
                            <div class="video-button-area">
                                <a class="video-button" href="#video-modal" data-bs-toggle="modal">
                                    <svg width="22" height="26" viewBox="0 0 22 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.5 12.134C22.1667 12.5189 22.1667 13.4811 21.5 13.866L2 25.1244C1.33333 25.5093 0.499999 25.0281 0.499999 24.2583L0.5 1.74167C0.5 0.971867 1.33333 0.490743 2 0.875643L21.5 12.134Z"
                                            fill="#FEFEFE" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-8 col-12">
                        <div class="video-tools d-flex align-items-center">
                            <div class="video-content">

                                <h2 class="video-heading heading_48 text-white" data-aos="fade-up"
                                    data-aos-duration="700">
                                    Khám Phá Thế Giới của Gucci<br>
                                </h2>
                                <h4 class="text-white" data-aos="fade-up" data-aos-duration="700">Khám phá bộ sưu
                                    tập mới nhất từ Gucci, biểu tượng của sự sang trọng và phong cách. Đắm chìm trong
                                    nghệ thuật và sự khéo léo làm nên bản chất của Gucci.</h4>
                                {{-- <a class="btn-primary mt-4" href="contact.html" data-aos="fade-up"
                                    data-aos-duration="1000">Mua Ngay</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="video-modal">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe height="600" class="embed-responsive-item"
                                src="https://www.youtube.com/embed/grC4QCP1R0M?si=ssOjMt6skABJl1RO"
                                title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- video end -->



    <!-- latest blog start -->
    <div class="latest-blog-section mt-100 overflow-hidden mb-5">
        <div class="latest-blog-inner">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-heading">Tin Tức</h2>
                </div>
                <div class="article-card-container">
                    <div class="row justify-content-center">
                        @foreach ($data_tintuc as $tin_tuc)
                        <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-duration="700">
                            <div class="article-card">
                                <a class="article-card-img-wrapper" href="/tin-tuc-chi-tiet/{{ $tin_tuc->id }}">
                                    <img src="{{ asset('img/') }}/{{ $tin_tuc->hinh_anh }}" alt="img"
                                        class="article-card-img rounded">
                                </a>
                                <p class="article-card-published text_12">{{ $tin_tuc->created_at }}</p>
                                <h2 class="article-card-heading heading_18">
                                    <a class="heading_18" href="article.html">
                                        {{ $tin_tuc->ten_bai_viet }}
                                    </a>
                                </h2>
                                <a class="article-card-read-more text_14 link-underline"
                                    href="/tin-tuc-chi-tiet/{{ $tin_tuc->id }}">Xem thêm</a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest blog end -->
</main>
@endsection

@section('js')
<script>
    new Vue({
        el: '#app',
        data: {
            ds_sp_yeu_thich: [],
                @include('Trang-Khach-Hang.share.datavue')
            },
        watch: {
        tim_kiem: function (newVal) {
            // Clear previous timeout
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout);
            }

            // Set a new timeout to debounce the search
            this.searchTimeout = setTimeout(() => {
                this.gui_tim_kiem();
            }, 100); // Thời gian chờ là 300 milliseconds (tùy chỉnh theo nhu cầu)
        },
    },
        created() {
        this.tai_gio_hang(); // Gọi hàm này để tải dữ liệu khi component được tạo
        this.tai_san_pham_yeu_thich();
    },
        methods: {

        quan_ly_san_pham_yeu_thich(id) {
            axios
                .post('/khach-hang/quan-ly-san-pham-yeu-thich/' + id)
                .then((res) => {
                    if (res.data.status) {
                        toastr.success(res.data.message);
                        this.tai_san_pham_yeu_thich();
                    } else {
                        toastr.error('Có lỗi không mong muốn!');
                    }
                });
        },

        tai_san_pham_yeu_thich() {
            axios
                .get('/hien-thi-san-pham-yeu-thich')
                .then((res) => {
                    this.ds_sp_yeu_thich = res.data.du_lieu;
                });
        },

        isFavorite(productId) {
            if (this.ds_sp_yeu_thich === undefined) {
                this.tai_san_pham_yeu_thich();
            }
            if (this.ds_sp_yeu_thich && this.ds_sp_yeu_thich.length > 0) {
                const isFav = this.ds_sp_yeu_thich.some(favorite => favorite.ma_san_pham === productId);
                return isFav;
            }
            return false;
        },
                @include('Trang-Khach-Hang.share.vue')
            },
        });
</script>
@endsection
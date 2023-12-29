@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
    @php
        $check = Auth::guard('khach_hang')->check();
        $user = Auth::guard('khach_hang')->user();
    @endphp
    <main class="content-for-layout">
        <div class="collection mt-100" style="margin-bottom: 100px;">
            <div class="container">
                <div class="row flex-row-reverse">
                    <!-- product area start -->
                    <div class="col-lg-9 col-md-12 col-12">
                        <div class="filter-sort-wrapper d-flex justify-content-between flex-wrap">
                            <div class="collection-title-wrap d-flex align-items-end">
                                <h2 class="collection-title heading_24 mb-0">Sản Phẩm</h2>
                                <p class="collection-counter text_16 mb-0 ms-2">(237 items)</p>
                            </div>

                        </div>
                        <div class="collection-product-container">
                            <div v-if="ds_loc.length > 0">
                                <div class="row">
                                    <!-- Hiển thị danh sách đã lọc -->
                                    <div v-for="(value, key) in displayedProducts" :key="key"
                                        class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="700">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <a class="hover-switch"
                                                    :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug +
                                                        '/' + value
                                                        .ten_san_pham_slug + '/' + value.ma_san_pham">
                                                    <img class="secondary-img" :src="'/img/' + value.hinh_anh"
                                                        alt="product-img">
                                                    <img class="primary-img" :src="'/img/' + value.hinh_anh"
                                                        alt="product-img">
                                                </a>

                                                {{-- <div class="product-badge">
                                            <span class="badge-label badge-percentage rounded">-44%</span>
                                        </div> --}}

                                                <div
                                                    class="product-card-action product-card-action-2 justify-content-center">
                                                    <a href="#quickview-modal" class="action-card action-quickview"
                                                        data-bs-toggle="modal">
                                                        <svg width="26" height="26" viewBox="0 0 26 26"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                                                                fill="#00234D" />
                                                        </svg>
                                                    </a>

                                                    @if ($check)
                                                        <button v-if="isFavorite(value.ma_san_pham)"
                                                            v-on:click="quan_ly_san_pham_yeu_thich(value.ma_san_pham)"
                                                            class="action-card action-wishlist"
                                                            style="background-color: #ffae00; border: none; padding: 0; cursor: pointer;">
                                                            <svg class="icon icon-wishlist" width="26" height="22"
                                                                viewBox="0 0 26 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                                    fill="#00234D" />
                                                            </svg>

                                                        </button>
                                                        <button v-else
                                                            v-on:click="quan_ly_san_pham_yeu_thich(value.ma_san_pham)"
                                                            class="action-card action-wishlist"
                                                            style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                                            <svg class="icon icon-wishlist" width="26" height="22"
                                                                viewBox="0 0 26 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                                    fill="#00234D" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <form
                                                            action="/khach-hang/quan-ly-san-pham-yeu-thich/(value.ma_san_pham)"
                                                            method="post">
                                                            @csrf
                                                            <button class="action-card action-wishlist"
                                                                style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                                                <svg class="icon icon-wishlist" width="26"
                                                                    height="22" viewBox="0 0 26 22" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                                        fill="#00234D" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif


                                                    @if ($check)
                                                        <a href="javascript:void(0)" class="action-card action-addtocart"
                                                            v-on:click="them_so_luong(value.ma_san_pham)">
                                                            <svg class="icon icon-cart" width="24" height="26"
                                                                viewBox="0 0 24 26" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                                                    fill="#00234D" />
                                                            </svg>
                                                        </a>
                                                    @else
                                                        <form action="/khach-hang/them-so-luong/(value.ma_san_pham)"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="action-card action-addtocart">
                                                                <svg class="icon icon-cart" width="24" height="26"
                                                                    viewBox="0 0 24 26" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                                                        fill="#00234D" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product-card-details">
                                                <!-- <ul class="color-lists list-unstyled d-flex align-items-center">
                                                    <li><a href="javascript:void(0)"
                                                            class="color-swatch swatch-black active"></a></li>
                                                    <li><a href="javascript:void(0)" class="color-swatch swatch-cyan"></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)" class="color-swatch swatch-purple"></a>
                                                    </li>
                                                </ul> -->
                                                <h3 class="product-card-title">
                                                    <a
                                                        :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value
                                                            .ten_loai_slug + '/' + value
                                                            .ten_san_pham_slug + '/' + value.ma_san_pham">@{{ value.ten_san_pham }}</a>
                                                </h3>
                                                <div class="product-card-price">
                                                    <span class="card-price-regular">@{{ formatCurrency(value.giam_gia_san_pham) }}</span>

                                                    <span class="card-price-compare text-decoration-line-through"
                                                        v-if="value.giam_gia_san_pham == value.gia_san_pham"></span>
                                                    <span class="card-price-compare text-decoration-line-through"
                                                        v-else>@{{ formatCurrency(value.gia_san_pham) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pagination justify-content-center mt-100">
                                        <nav>
                                            <ul class="pagination m-0 d-flex align-items-center">
                                                <li class="item disabled">
                                                    <a class="link" href="javascript:void(0)"
                                                        v-on:click="changePage(1)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="100"
                                                            height="100" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon icon-left">
                                                            <polyline points="15 18 9 12 15 6"></polyline>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <!-- Loop through your pages and create buttons -->
                                                <li v-for="page in totalPages" :key="page" class="item"
                                                    :class="{ 'active': page === currentPage }">
                                                    <a class="link" href="javascript:void(0)"
                                                        v-on:click="changePage(page)">@{{ page }}</a>
                                                </li>
                                                <li class="item disabled">
                                                    <a class="link" href="javascript:void(0)"
                                                        v-on:click="changePage(totalPages)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="100"
                                                            height="100" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon icon-right">
                                                            <polyline points="9 18 15 12 9 6"></polyline>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                </div>

                            </div>
                            <div v-else>
                                <div class="row">
                                    @if (count($san_pham_danh_muc) > 0)
                                        @foreach ($san_pham_danh_muc as $key => $value)
                                            @if ($value->deleted_at == null && $value->trang_thai == 1)
                                                <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up"
                                                    data-aos-duration="700">
                                                    <div class="product-card">
                                                        <div class="product-card-img">

                                                            <a class="hover-switch"
                                                                href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->id }}">
                                                                @if (isset($value->hinh_anh))
                                                                    <img class="secondary-img"
                                                                        src="/img/{{ $value->hinh_anh }}"
                                                                        alt="/img/{{ $value->hinh_anh }}">
                                                                    <img class="primary-img"
                                                                        src="/img/{{ $value->hinh_anh }}"
                                                                        alt="/img/{{ $value->hinh_anh }}">
                                                                @endif
                                                            </a>

                                                            <div class="product-badge">
                                                                <span
                                                                    class="badge-label badge-percentage rounded">{{ $value->giam_gia_san_pham }}</span>
                                                            </div>

                                                            <div
                                                                class="product-card-action product-card-action-2 justify-content-center">
                                                                <a href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->id }}"
                                                                    class="action-card action-quickview"
                                                                    data-bs-toggle="modal">
                                                                    <svg width="26" height="26"
                                                                        viewBox="0 0 26 26" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                                                                            fill="#00234D" />
                                                                    </svg>
                                                                </a>
                                                                @if ($check)
                                                                    <button v-if="isFavorite({{ $value->id }})"
                                                                        v-on:click="quan_ly_san_pham_yeu_thich({{ $value->id }})"
                                                                        class="action-card action-wishlist"
                                                                        style="background-color: #ffae00; border: none; padding: 0; cursor: pointer;">
                                                                        <svg class="icon icon-wishlist" width="26"
                                                                            height="22" viewBox="0 0 26 22"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                                                fill="#00234D" />
                                                                        </svg>

                                                                    </button>
                                                                    <button v-else
                                                                        v-on:click="quan_ly_san_pham_yeu_thich({{ $value->id }})"
                                                                        class="action-card action-wishlist"
                                                                        style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                                                        <svg class="icon icon-wishlist" width="26"
                                                                            height="22" viewBox="0 0 26 22"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                                                fill="#00234D" />
                                                                        </svg>
                                                                    </button>
                                                                @else
                                                                    <form
                                                                        action="/khach-hang/quan-ly-san-pham-yeu-thich/{{ $value->id }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button class="action-card action-wishlist"
                                                                            style="background-color: white; border: none; padding: 0; cursor: pointer;">
                                                                            <svg class="icon icon-wishlist" width="26"
                                                                                height="22" viewBox="0 0 26 22"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                                                    fill="#00234D" />
                                                                            </svg>
                                                                        </button>
                                                                    </form>
                                                                @endif



                                                                @if ($check)
                                                                    <a href="javascript:void(0)"
                                                                        class="action-card action-addtocart"
                                                                        v-on:click="them_so_luong({{ $value->id }})">
                                                                        <svg class="icon icon-cart" width="24"
                                                                            height="26" viewBox="0 0 24 26"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                                                                fill="#00234D" />
                                                                        </svg>
                                                                    </a>
                                                                @else
                                                                    <form
                                                                        action="/khach-hang/them-so-luong/{{ $value->id }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="action-card action-addtocart">
                                                                            <svg class="icon icon-cart" width="24"
                                                                                height="26" viewBox="0 0 24 26"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                                                                    fill="#00234D" />
                                                                            </svg>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="product-card-details">
                                                            <!-- <ul
                                                                class="color-lists list-unstyled d-flex align-items-center">
                                                                <li><a href="javascript:void(0)"
                                                                        class="color-swatch swatch-black active"></a></li>
                                                                <li><a href="javascript:void(0)"
                                                                        class="color-swatch swatch-cyan"></a></li>
                                                                <li><a href="javascript:void(0)"
                                                                        class="color-swatch swatch-purple"></a>
                                                                </li>
                                                            </ul> -->
                                                            <h3 class="product-card-title">
                                                                <a
                                                                    href="/san-pham/{{ $value->ten_danh_muc_slug }}/{{ $value->ten_loai_slug }}/{{ $value->ten_san_pham_slug }}/{{ $value->id }}">{{ $value->ten_san_pham }}</a>
                                                            </h3>
                                                            <div class="product-card-price">
                                                                <span
                                                                    class="card-price-regular">{{ number_format($value->giam_gia_san_pham, 0, '.', '.') }}
                                                                    ₫</span>
                                                                @if ($value->giam_gia_san_pham == $value->gia_san_pham)
                                                                @else
                                                                    <span
                                                                        class="card-price-compare text-decoration-line-through">{{ number_format($value->gia_san_pham, 0, '.', '.') }}

                                                                        ₫</span>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>Không có sản phẩm nào.</p>
                                    @endif
                                </div>
                                <div>{{ $san_pham_danh_muc->links('Trang-Khach-Hang.page.custompagination') }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- product area end -->

                    <!-- sidebar start -->
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="collection-filter filter-drawer">
                            <div class="filter-widget d-lg-none d-flex align-items-center justify-content-between">
                                <h5 class="heading_24">Filter By</h4>
                                    <button type="button"
                                        class="btn-close text-reset filter-drawer-trigger d-lg-none"></button>
                            </div>

                            <div class="filter-widget d-lg-none">
                                <div class="filter-header faq-heading heading_18 d-flex align-items-center justify-content-between border-bottom"
                                    data-bs-toggle="collapse" data-bs-target="#filter-mobile-sort">
                                    <span>
                                        <span class="sorting-title me-2">Sort by:</span>
                                        <span class="active-sorting">Featured</span>
                                    </span>
                                    <span class="faq-heading-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-down">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div id="filter-mobile-sort" class="accordion-collapse collapse show">
                                    <ul class="sorting-lists-mobile list-unstyled m-0">
                                        <li><a href="#" class="text_14">Featured</a></li>
                                        <li><a href="#" class="text_14">Best Selling</a></li>
                                        <li><a href="#" class="text_14">Alphabetically, A-Z</a></li>
                                        <li><a href="#" class="text_14">Alphabetically, Z-A</a></li>
                                        <li><a href="#" class="text_14">Price, low to high</a></li>
                                        <li><a href="#" class="text_14">Price, high to low</a></li>
                                        <li><a href="#" class="text_14">Date, old to new</a></li>
                                        <li><a href="#" class="text_14">Date, new to old</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-widget">

                                @if ($danhMuc->count() > 0)
                                    @foreach ($danhMuc as $danhmuc)
                                        @if ($danhmuc->is_delete == null)
                                            <div class="filter-header faq-heading heading_18 d-flex align-items-center justify-content-between border-bottom pt-5"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#filter-collection{{ $danhmuc->ten_danh_muc_slug }}">
                                                {{ $danhmuc->ten_danh_muc }}
                                                <span class="faq-heading-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="#000"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div id="filter-collection{{ $danhmuc->ten_danh_muc_slug }}"
                                                class="accordion-collapse collapse show">
                                                <ul class="filter-lists list-unstyled mb-0">
                                                    @foreach ($theLoai as $theloai)
                                                        @if ($theloai->is_delete == 0 && $theloai->ma_danh_muc == $danhmuc->id)
                                                            <li class="filter-item">
                                                                <label class="filter-label">
                                                                    <input type="checkbox" v-model="selectedTheLoai"
                                                                        :value="{{ $theloai->id }}" />
                                                                    <span class="filter-checkbox rounded me-2"></span>
                                                                    {{ $theloai->ten_loai }}
                                                                </label>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p style="color: red;">Danh mục sản phẩm không có</p>
                                @endif
                            </div>
                            <div class="filter-widget">
                                <div class="filter-header faq-heading heading_18 d-flex align-items-center justify-content-between border-bottom"
                                    data-bs-toggle="collapse" data-bs-target="#filter-price">
                                    Lọc giá tiền
                                    <span class="faq-heading-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-down">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div id="filter-price" class="accordion-collapse collapse show">
                                    <div class="filter-price d-flex align-items-center justify-content-between">
                                        <div class="filter-field">
                                            <div class="filter-field">
                                                <input v-model="minPrice" class="field-input" type="number"
                                                    placeholder="0 ₫" min="0" :max="maxPrice">
                                            </div>
                                        </div>
                                        <div class="filter-separator px-3">Đến</div>
                                        <div class="filter-field">
                                            <input v-model="maxPrice" class="field-input" type="number" min="0"
                                                placeholder="20.000.000 ₫" :max="200000000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-widget pt-5">
                            <div class="filter-header faq-heading heading_18 d-flex align-items-center border-bottom">
                                Khuyến mãi mới
                            </div>
                            <div class="filter-related">
                                @foreach ($tin_khuyen_mai as $tin)
                                    <div class="related-item d-flex">
                                        <div class="related-img-wrapper">
                                            <img class="related-img" src="{{ asset('img/') }}/{{ $tin->hinh_anh }}"
                                                alt="{{ $tin->hinh_anh }}">
                                        </div>
                                        <div class="related-product-info">
                                            <h2 class="related-heading heading_18">
                                                <a
                                                    href="/tin-tuc-chi-tiet/{{ $tin->id }}">{{ $tin->ten_bai_viet }}</a>
                                            </h2>
                                            <!-- <div class="related-review-icon product-icon-star d-flex align-items-center">
                                            <img src="/assets_client/img/icon/star.png" alt="img">
                                            <img src="/assets_client/img/icon/star.png" alt="img">
                                            <img src="/assets_client/img/icon/star.png" alt="img">
                                            <img src="/assets_client/img/icon/star.png" alt="img">
                                            <img src="/assets_client/img/icon/star.png" alt="img">
                                        </div> -->
                                            <p class="related-price text_16">{{ $tin->ten_tai_khoan }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                    <!-- sidebar end -->
                </div>
            </div>
        </div>
    </main>

@endsection
@section('js')
<script>
    new Vue({
        el: '#app',
        data: {
            selectedTheLoai: [],
            currentPage: 1,
            itemsPerPage: 9,
            minPrice: null,
            maxPrice: null,
            ds_loc: [],
            ds_sp_yeu_thich: [],
            @include('Trang-Khach-Hang.share.datavue')
        },
        created() {
            this.tai_gio_hang();
            this.tai_san_pham_yeu_thich();
        },
        watch: {
            selectedTheLoai: {
                handler(newVal) {
                    this.guiDuLieuLenServer();
                },
                deep: true,
            },
            minPrice: {
                handler(newVal) {
                    if (newVal !== null && this.maxPrice !== null) {
                        this.guiDuLieuLenServer();
                    }
                },
            },
            maxPrice: {
                handler(newVal) {
                    if (newVal !== null && this.minPrice !== null) {
                        setTimeout(() => {
                            this.guiDuLieuLenServer();
                        }, 400);

                    }
                },
            },
            tim_kiem: function(newVal) {
                if (this.searchTimeout) {
                    clearTimeout(this.searchTimeout);
                }
                this.searchTimeout = setTimeout(() => {
                    this.gui_tim_kiem();
                }, 100);
            },
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
            guiDuLieuLenServer() {
                // Check if selectedTheLoai is not empty

                if (this.selectedTheLoai.length === 0 && (this.minPrice === null || this.maxPrice === null)) {
                    this.ds_loc = [];
                    return;
                }
                let postData = {
                    the_loai_ids: this.selectedTheLoai,
                };

                if (this.minPrice !== null && this.maxPrice !== null) {
                    postData.minPrice = this.minPrice;
                    postData.maxPrice = this.maxPrice;
                }

                axios.post('/loc-san-pham', postData)
                    .then((res) => {
                        if (res.data.status) {
                            this.ds_loc = res.data.ds_loc;
                            this.currentPage = 1;

                            // Check if ds_loc is empty
                            if (Array.isArray(this.ds_loc) && this.ds_loc.length === 0) {
                                toastr.warning('Không có sản phẩm với giá tiền này.');
                            }
                        } else {
                            toastr.error('Không có dữ liệu');
                        }
                    })
                    .catch((error) => {
                        toastr.error('Có lỗi khi gửi yêu cầu!');
                        console.error(error);
                    });
            },
            changePage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                }
            },
        },
        computed: {
            totalPages() {
                if (Array.isArray(this.ds_loc) && this.ds_loc.length > 0) {
                    return Math.ceil(this.ds_loc.length / this.itemsPerPage);
                }
                return 0;
            },
            displayedProducts() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.ds_loc.slice(start, end);
            },
        },
    });
</script>
@endsection

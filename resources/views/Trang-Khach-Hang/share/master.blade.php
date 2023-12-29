<!doctype html>
<html lang="en" class="no-js">

@include('Trang-Khach-Hang.share.css')
<title>@yield('TieuDeTrang')</title>

<body>
    <div class="body-wrapper">
        @php
            $check = Auth::guard('khach_hang')->check();
            $user = Auth::guard('khach_hang')->user();
        @endphp
        <div id="app">
            @include('Trang-Khach-Hang.share.header')
            <div class="offcanvas offcanvas-end" tabindex="-1" id="drawer-cart">
                <div class="offcanvas-header border-btm-black">
                    <h5 class="cart-drawer-heading text_16">Giỏ hàng (@{{ tong_so_luong }})</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <div class="cart-content-area d-flex justify-content-between flex-column">
                        <div class="minicart-loop custom-scrollbar">
                            <!-- minicart item -->
                            <div v-if="ds_gio_hang">
                                <div class="minicart-item d-flex" v-for="(value, key) in ds_gio_hang"
                                    :key="key">
                                    <a :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug + '/' + value.ten_san_pham_slug + '/' + value.id" class="mini-img-wrapper">

                                        <img class="mini-img"  :src="'/img/' + value.hinh_anh" alt="img">
                                    </a>
                                    <div class="product-info">
                                        <h2 class="product-title"><a :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug + '/' + value.ten_san_pham_slug + '/' + value.id" >@{{ value.ten_san_pham }}</a></h2>
                                        <p class="product-vendor">Mã Loại @{{ value.id }} </p>
                                        <div class="misc d-flex align-items-end justify-content-between">
                                            <div class="quantity d-flex align-items-center justify-content-between">
                                                <button class="qty-btn dec-qty" v-on:click="tru_so_luong(value.id)"><img
                                                        src="/assets_client/img/icon/minus.svg" alt="minus"></button>
                                                <input class="qty-input" type="number" name="qty"
                                                    :value="value.tong_so_luong" min="0" readonly>
                                                <button
                                                    class="qty-btn inc-qty"v-on:click="them_so_luong(value.id)"><img
                                                        src="/assets_client/img/icon/plus.svg" alt="plus"></button>
                                            </div>
                                            <div class="product-remove-area d-flex flex-column align-items-end">
                                                <div class="product-price">@{{ formatCurrency(value.giam_gia_san_pham) }}</div>                                 
                                                <a href="javascript:void(0)" class="product-remove"  v-on:click="xoa_san_pham_gio_hang(value.id)" >Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <p>Giỏ hàng trống.</p>
                            </div>
                        </div>
                        <div class="minicart-footer">
                            <div class="minicart-calc-area">
                                <div class="minicart-calc d-flex align-items-center justify-content-between">
                                    <span class="cart-subtotal mb-0">Tổng Tiền</span>
                                    <span class="cart-subprice" v-if="tong_tien_tat_ca > 0">@{{ formatCurrency(tong_tien_tat_ca) }}</span>
                                    <span class="cart-subprice" v-else>0 ₫</span>
                                </div>
                                <p class="cart-taxes text-center my-4">Thuế và phí vận chuyển sẽ được tính khi thanh
                                    toán.
                                </p>
                            </div>
                            <div class="minicart-btn-area d-flex align-items-center justify-content-between">
                                <a href="/gio-hang" class="minicart-btn btn-secondary">Xem Giỏ Hàng</a>
                                <a href="/thanh-toan" class="minicart-btn btn-primary">Thanh Toán</a>
                            </div>
                        </div>
                    </div>
                    <div class="cart-empty-area text-center py-5 d-none">
                        <div class="cart-empty-icon pb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </div>
                        {{-- <p class="cart-empty">You have no items in your cart</p> --}}
                    </div>
                </div>
            </div>
            @yield('noi-dung')
             <!-- drawer cart start -->
            
        </div>
     
        <!-- all js -->
        @include('Trang-Khach-Hang.share.footer')
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js"></script>
        @yield('js')
        <script src="/assets_client/js/vendor.js"></script>
        <script src="/assets_client/js/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        @include('Trang-Khach-Hang.share.js')
    </div>
</body>

</html>

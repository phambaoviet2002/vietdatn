@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
@php
        $check = Auth::guard('khach_hang')->check();
        $user = Auth::guard('khach_hang')->user();
    @endphp
    <main id="MainContent" class="content-for-layout" style="margin-bottom: 100px">
        <div class="cart-page mt-100">
            <div class="checkout-progress overflow-hidden text-center">
                <ol class="checkout-bar px-0" style="display: flex; justify-content: center; align-items: center; list-style: none;">
                    <li class="progress-step step-done"><a href="cart.html">Giỏ hàng</a></li>
                    <li class="progress-step step-todo"><a href="checkout.html">Thanh toán</a></li>
                    <li class="progress-step step-todo"><a href="checkout.html">Hóa đơn</a></li>
                </ol>
            </div>
            
            <div class="container mt-100">
                
                <div class="cart-page-wrapper">
                   
                    <div class="row">
                        
                        <div class="col-lg-7 col-md-12 col-12">
                            <table class="cart-table w-100">
                                <thead>
                                    <tr>
                                        <th class="cart-caption heading_18">Sản phẩm</th>
                                        <th class="cart-caption heading_18"></th>
                                        <th class="cart-caption text-center heading_18 d-none d-md-table-cell">Số lượng</th>
                                        <th class="cart-caption text-end heading_18">Giá</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div v-if="ds_gio_hang">
                                        <tr class="cart-item" v-for="(value, key) in ds_gio_hang" :key="key">
                                            <td class="cart-item-media">
                                                <a  :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug + '/' + value
                                                .ten_san_pham_slug + '/' + value.ma_san_pham" class="mini-img-wrapper">
                                                    <img  class="mini-img" :src="'/img/' + value.hinh_anh" alt="img">
                                                </a>
                                            </td>
                                            <td class="cart-item-details">
                                                <h2 class="product-title"><a :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug + '/' + value
                                                    .ten_san_pham_slug + '/' + value.ma_san_pham">@{{ value.ten_san_pham }}</a></h2>
                                                <p class="product-vendor">Mã Loại @{{ value.id }}</p>
                                            </td>
                                            <td class="cart-item-quantity">
                                                <div class="quantity d-flex align-items-center justify-content-between">
                                                    <button class="qty-btn dec-qty" v-on:click="tru_so_luong(value.id)"><img
                                                            src="/assets_client/img/icon/minus.svg" alt="minus"></button>
                                                    <input class="qty-input" type="number" name="qty"
                                                        :value="value.tong_so_luong" min="0" readonly>
                                                    <button class="qty-btn inc-qty"
                                                        v-on:click="them_so_luong(value.id)"><img
                                                            src="/assets_client/img/icon/plus.svg" alt="plus"></button>
                                                </div>
                                                <a href="#" class="product-remove mt-2"
                                                    v-on:click="xoa_san_pham_gio_hang(value.id)">Xóa</a>
                                            </td>
                                            <td class="cart-item-price text-end">
                                                <div class="product-price">@{{ formatCurrency(value.tong_tien) }}</div>
                                            </td>
                                        </tr>
                                    </div>
                                    <div v-else>

                                        <p>Giỏ hàng trống.</p>



                                    </div>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-5 col-md-12 col-12">
                            <div class="cart-total-area">
                                <h3 class="cart-total-title d-none d-lg-block mb-0 text-center">Tổng giỏ hàng</h4>
                                    <div class="cart-total-box mt-4">
                                        <div class="subtotal-item subtotal-box">
                                            <h4 class="subtotal-title">Tổng Tiền:</h4>
                                            <p class="subtotal-value" v-if="tong_tien_tat_ca > 0">@{{ formatCurrency(tong_tien_tat_ca) }}</p>
                                            <p class="subtotal-value" v-else>0 ₫</p>
                                        </div>
                                        <div class="subtotal-item shipping-box">
                                            <h4 class="subtotal-title">Phí vận chuyển:</h4>
                                            @if ($check)
                                                <p class="subtotal-value" v-if="tong_tien_tat_ca > 1000000">0 ₫</p>
                                                <p class="subtotal-value" v-else>20.000 ₫</p>
                                            @else
                                                <p class="subtotal-value">0 ₫</p>
                                                
                                            @endif
                                          
                                        </div>
                                    
                                        <hr />
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Tổng tiền:</h4>
                                            @if ($check)
                                                <p class="subtotal-value" v-if="tong_tien_tat_ca > 1000000">@{{ formatCurrency((tong_tien_tat_ca + 0)* 1.005) }}</p>
                                                <p class="subtotal-value" v-else>@{{ formatCurrency((tong_tien_tat_ca + 20000) * 1.005) }}</p>
                                            @else
                                                <p class="subtotal-value" >0 ₫</p>
                                                
                                            @endif
                                           
                                        </div>
                                        <p class="shipping_text">Thuế và phí vận chuyển sẽ được tính khi thanh</p>
                                        <div class="d-flex justify-content-center mt-4">
                                            <a href="/thanh-toan" class="position-relative btn-primary text-uppercase">
                                                Thanh Toán
                                            </a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
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
                @include('Trang-Khach-Hang.share.datavue')
            },
            watch: {
                tim_kiem: function(newVal) {
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
            },
            methods: {
                @include('Trang-Khach-Hang.share.vue')
            },
        });
    </script>
@endsection

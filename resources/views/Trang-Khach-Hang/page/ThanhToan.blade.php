@extends('Trang-Khach-Hang.share.master')

@section('noi-dung')
    @php
        $check = Auth::guard('khach_hang')->check();
        $user = Auth::guard('khach_hang')->user();
    @endphp
    <main id="MainContent" class="content-for-layout" style="margin-bottom: 100px">
        <div class="checkout-page mt-100">
            <div class="container">
                <div class="checkout-page-wrapper">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                            <div class="section-header mb-3">
                                <h2 class="section-heading">Thanh toán</h2>
                            </div>

                            <div class="checkout-progress overflow-hidden text-center">
                                <ol class="checkout-bar px-0 d-flex justify-content-center align-items-center"
                                    style="list-style: none;">
                                    <li class="progress-step step-done"><a href="cart.html">Giỏ hàng</a></li>
                                    <li class="progress-step step-active"><a href="checkout.html">Thanh toán</a></li>
                                    <li class="progress-step step-todo"><a href="checkout.html">Hóa đơn</a></li>
                                </ol>
                            </div>

                            <div class="shipping-address-area">
                                <h2 class="shipping-address-heading pb-1">Đặt Hàng</h2>
                                <div class="shipping-address-form-wrapper">
                                    <form method="POST" action="/khach-hang/thanh-toan" class="shipping-address-form common-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Họ Và Tên</label>
                                                    <input type="text" name="ho_va_ten" value="{{ isset($user) ? $user->ho_va_ten : '' }}" />
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Số Điện Thoại</label>
                                                    <input  type="text" name="so_dien_thoai" value="{{ isset($user) ? $user->so_dien_thoai : '' }}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Địa Chỉ</label>
                                                    <input type="text" name="dia_chi" value="{{ isset($user) ? $user->so_dien_thoai : '' }}"/>
                                                </fieldset>
                                            </div>
                                                                                                       
                                            <div v-if="calculatedTotal >=10000" class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Phương thức thanh toán</label>
                                                    <select name="trang_thai_thanh_toan"> 
                                                        <option value="0">Thanh toán khi nhận hàng</option>
                                                        <option value="1">Thanh toán online</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div v-else class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Phương thức thanh toán</label>
                                                    <select name="trang_thai_thanh_toan"> 
                                                        <option value="0">Thanh toán khi nhận hàng</option>
                                                       
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <input type="hidden" name="tong_tien_tat_ca" :value="calculatedTotal" />
                                        </div>
                                        <div class="shipping-address-area billing-area">
                                            <h2 class="shipping-address-heading pb-1"></h2>
                                            <div class="form-checkbox d-flex align-items-center mt-4">
                                                {{-- <input class="form-check-input mt-0" type="checkbox">
                                            <label class="form-check-label ms-2">
                                                Same as shipping address
                                            </label> --}}
                                            </div>
                                        </div>
                                        <div class="shipping-address-area billing-area">
                                            <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                                                <a href="/gio-hang" class="checkout-page-btn minicart-btn btn-secondary">Quay Lai Giỏ
                                                    Hàng</a>
                                                <button class="checkout-page-btn minicart-btn btn-primary" name="redirect" type="submit">Thanh Toán</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                            <div class="cart-total-area checkout-summary-area">
                                <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Đơn Hàng</h4>
                                    <div class="minicart-item d-flex" v-for="(value, key) in ds_gio_hang"
                                        :key="key">
                                        <div class="mini-img-wrapper">
                                            <a  :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug + '/' + value
                                                .ten_san_pham_slug + '/' + value.ma_san_pham" class="mini-img-wrapper">
                                                    <img  class="mini-img" :src="'/img/' + value.hinh_anh" alt="img">
                                                </a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a :href="'/san-pham/' + value.ten_danh_muc_slug + '/' + value.ten_loai_slug + '/' + value
                                                .ten_san_pham_slug + '/' + value.ma_san_pham">@{{ value.ten_san_pham }}</a></h2>
                                            <p class="product-vendor">@{{ formatCurrency(value.giam_gia_san_pham) }} x @{{ value.tong_so_luong }}</p>
                                        </div>
                                    </div>

                                    <div class="cart-total-box mt-4 bg-transparent p-0">
                                        <div class="subtotal-item subtotal-box">
                                            <h4 class="subtotal-title">Tổng tiền:</h4>
                                            <p class="subtotal-value">@{{ formatCurrency(tong_tien_tat_ca) }}</p>
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
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">giảm giá:</h4>
                                            <p class="subtotal-value">@{{ formatCurrency(giam_gia) }} ₫</p>
                                        </div>
                                        <hr />
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Tổng tiền:</h4>
                                            <p class="subtotal-value">@{{  formatCurrency(calculatedTotal) }}
                                            </p>
                                        </div>
                                        <div class="mt-4 checkout-promo-code">
                                            <input class="input-promo-code" v-model="ma_giam_gia" type="text"
                                                placeholder="Mã giảm giá" />
                                            <button type="button"
                                                class="btn-apply-code position-relative btn-secondary text-uppercase mt-3 "
                                                v-on:click="kiem_tra_ma_giam_gia()">Áp mã giảm giá</button>
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
                giam_gia: 0,
                ma_giam_gia: '',
                @include('Trang-Khach-Hang.share.datavue')
            },
            created() {
                this.tai_gio_hang();
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
            computed: {
                calculatedTotal() {
                    if (this.tong_tien_tat_ca > 1000000) {
                        if(((this.tong_tien_tat_ca - this.giam_gia) * 1.005)<=0){
                            return 0;
                        }else{
                            return (this.tong_tien_tat_ca - this.giam_gia) * 1.005;
                        }
                        
                    } else {
                        if(((this.tong_tien_tat_ca - this.giam_gia + 20000) * 1.005)<=0){
                            return 0;
                        }else{

                        // Hoặc trả về giá trị khác nếu điều kiện không đúng
                        return (this.tong_tien_tat_ca - this.giam_gia + 20000) * 1.005;
                        }
                    }
                },
            },

            methods: {
                @include('Trang-Khach-Hang.share.vue')

                kiem_tra_ma_giam_gia() {
                    if(this.giam_gia === 0){
                        axios
                        .post('/ma-giam-gia/' + this.ma_giam_gia)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                                this.giam_gia = res.data.tien_giam_gia;
                            }else{
                                toastr.error(res.data.message);
                            }
                           
                        })
                        .catch((error) => {
                            console.error("Lỗi khi kiểm tra mã giảm giá:", error);
                        });
                    }else{
                        toastr.error("Khách hàng đã nhập mã giảm giá");
                    }
                    // axios
                    //     .post('/ma-giam-gia/' + this.ma_giam_gia)
                    //     .then((res) => {
                            
                    //         toastr.success(res.data.message);
                    //         this.giam_gia = res.data.tien_giam_gia;
                    //     })
                    //     .catch((error) => {
                    //         console.error("Lỗi khi kiểm tra mã giảm giá:", error);
                    //     });
                },
            },
        });
    </script>
@endsection

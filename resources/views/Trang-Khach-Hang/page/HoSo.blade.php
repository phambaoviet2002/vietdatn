@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
    <main class="content-for-layout" v-cloak>
        <div class="login-page mt-100" style="margin-bottom: 100px;">
            <div class="container">
                <div class="login-form common-form mx-auto">
                    <div class="section-header">
                        <h2 class="section-heading text-center">Thông Tin của bạn</h2>
                    </div>

                    <div class="row">
                        <input type="hidden" name="id" v-model="ng_dang_nhap.id">
                        <div class="col-12">
                            <fieldset>
                                <label class="label">Họ Và Tên</label>
                                <input v-model="ng_dang_nhap.ho_va_ten" type="text" />
                                <div v-if="errors.ho_va_ten" class="alert alert-warning">@{{ errors.ho_va_ten[0] }}</div>
                        </div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Số Điện Thoại</label>
                            <input v-model="ng_dang_nhap.so_dien_thoai" type="number" />
                            <div v-if="errors.so_dien_thoai" class="alert alert-warning">@{{ errors.so_dien_thoai[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Địa Chỉ</label>
                            <input v-model="ng_dang_nhap.dia_chi" type="text" />
                            <div v-if="errors.dia_chi" class="alert alert-warning">@{{ errors.dia_chi[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Ngày sinh</label>
                            <input v-model="ng_dang_nhap.ngay_sinh" type="date" />
                            <div v-if="errors.ngay_sinh" class="alert alert-warning">@{{ errors.ngay_sinh[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Giới Tính</label>
                            <select v-model="ng_dang_nhap.gioi_tinh">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                            <div v-if="errors.gioi_tinh" class="alert alert-warning">@{{ errors.gioi_tinh[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12 mt-3">
                        <button  v-on:click="cap_nhap_thong_tin()" type="submit" class="btn-primary d-block mt-3 btn-signin">Cập Nhật</button>
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
            el: "#app",
            data: {
                ng_dang_nhap: {},
                errors: {
                    ho_va_ten: '',
                    so_dien_thoai: '',
                    dia_chi: '',
                    ngay_sinh: '',
                    gioi_tinh: ''
                },
                @include('Trang-Khach-Hang.share.datavue')
            },
            watch: {
                'ng_dang_nhap.ho_va_ten': function(newVal) {
                    if (newVal) {
                        this.errors.ho_va_ten = '';
                    }
                },
                'ng_dang_nhap.so_dien_thoai': function(newVal) {
                    if (newVal) {
                        this.errors.so_dien_thoai = '';
                    }
                },
                'ng_dang_nhap.dia_chi': function(newVal) {
                    if (newVal) {
                        this.errors.dia_chi = '';
                    }
                },
                'ng_dang_nhap.ngay_sinh': function(newVal) {
                    if (newVal) {
                        this.errors.ngay_sinh = '';
                    }
                },
                'ng_dang_nhap.gioi_tinh': function(newVal) {
                    if (newVal) {
                        this.errors.gioi_tinh = '';
                    }
                },
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
                this.tai_thong_tin_dang_nhap();
                this.tai_gio_hang(); // Gọi hàm này để tải dữ liệu khi component được tạo
            },
            methods: {
                tai_thong_tin_dang_nhap() {
                    axios
                        .get('/khach-hang/thong-tin-khach-hang')
                        .then((res) => {
                            this.ng_dang_nhap = res.data.khach_hang;
                        })
                        .catch((error) => {
                            if (error.response && error.response.data && error.response.data.errors) {
                                this.errors = error.response.data.errors;
                            } else {
                                toastr.error('Có lỗi không mong muốn!');
                            }
                        });
                },
                cap_nhap_thong_tin() {
                    axios
                        .post('/khach-hang/kich-hoat-cap-nhap-thong-tin', this.ng_dang_nhap)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.tai_thong_tin_dang_nhap();
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((error) => {
                            if (error.response && error.response.data && error.response.data.errors) {
                                this.errors = error.response.data.errors;
                            } else {
                                toastr.error('Có lỗi không mong muốn!');
                            }
                        });
                },
                @include('Trang-Khach-Hang.share.vue')
                
            }
        });
    </script>
@endsection

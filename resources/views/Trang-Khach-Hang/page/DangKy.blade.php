@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
    <main  class="content-for-layout" v-cloak>
        <div class="login-page mt-100" style="margin-bottom: 100px;">
            <div class="container">
                <div class="login-form common-form mx-auto">
                    <div class="section-header">
                        <h2 class="section-heading text-center">Đăng Ký</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <fieldset>
                                <label class="label">Họ Và Tên</label>
                                <input v-model="dang_ky.ho_va_ten" type="text" />
                                <div v-if="errors.ho_va_ten" class="alert alert-warning">@{{ errors.ho_va_ten[0] }}</div>
                        </div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Email</label>
                            <input v-model="dang_ky.email" type="email" />
                            <div v-if="errors.email" class="alert alert-warning">@{{ errors.email[0] }}</div>

                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Mật Khẩu</label>
                            <input v-model="dang_ky.password" type="password" />
                            <div v-if="errors.password" class="alert alert-warning">@{{ errors.password[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Nhập lại Mật Khẩu</label>
                            <input v-model="dang_ky.nhap_lai_password" type="password" />
                            <div v-if="errors.nhap_lai_password" class="alert alert-warning">@{{ errors.nhap_lai_password[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Số Điện Thoại</label>
                            <input v-model="dang_ky.so_dien_thoai" type="number" />
                            <div v-if="errors.so_dien_thoai" class="alert alert-warning">@{{ errors.so_dien_thoai[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Địa Chỉ</label>
                            <input v-model="dang_ky.dia_chi" type="text" />
                            <div v-if="errors.dia_chi" class="alert alert-warning">@{{ errors.dia_chi[0] }}</div>

                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Ngày sinh</label>
                            <input v-model="dang_ky.ngay_sinh" type="date" />
                            <div v-if="errors.ngay_sinh" class="alert alert-warning">@{{ errors.ngay_sinh[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Giới Tính</label>
                            <select v-model="dang_ky.gioi_tinh">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                            <div v-if="errors.gioi_tinh" class="alert alert-warning">@{{ errors.gioi_tinh[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" v-on:click="kich_hoat_dang_ky()"
                            class="btn-primary d-block mt-3 btn-signin">Đăng Ký</button>
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
                dang_ky: {},
                errors: {
                    ho_va_ten: '',
                    email: '',
                    password: '',
                    nhap_lai_password: '',
                    so_dien_thoai: '',
                    dia_chi: '',
                    ngay_sinh: '',
                    gioi_tinh: ''
                },
                @include('Trang-Khach-Hang.share.datavue')
            },
            watch: {
                'dang_ky.ho_va_ten': function(newVal) {
                    if (newVal) {
                        this.errors.ho_va_ten = '';
                    }
                },
                'dang_ky.email': function(newVal) {
                    if (newVal) {
                        this.errors.email = '';
                    }
                },
                'dang_ky.password': function(newVal) {
                    if (newVal) {
                        this.errors.password = '';
                    }
                },
                'dang_ky.nhap_lai_password': function(newVal) {
                    if (newVal) {
                        this.errors.nhap_lai_password = '';
                    }
                },
                'dang_ky.so_dien_thoai': function(newVal) {
                    if (newVal) {
                        this.errors.so_dien_thoai = '';
                    }
                },
                'dang_ky.dia_chi': function(newVal) {
                    if (newVal) {
                        this.errors.dia_chi = '';
                    }
                },
                'dang_ky.ngay_sinh': function(newVal) {
                    if (newVal) {
                        this.errors.ngay_sinh = '';
                    }
                },
                'dang_ky.gioi_tinh': function(newVal) {
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
            methods: {
                @include('Trang-Khach-Hang.share.vue')
                
                kich_hoat_dang_ky() {
                    axios
                        .post('/kich-hoat-dang-ky', this.dang_ky)
                        .then((res) => {
                            if (res.data.status) {
                                this.dang_ky = {};
                                toastr.success(res.data.message);
                                setTimeout(() => {
                                    window.location.href = "/dang-nhap";
                                }, 1000); // Delay for 2 seconds (2000 milliseconds)
                            } else {
                                toastr.error('Có lỗi không mong muốn!');
                            }
                        })
                        .catch((error) => {
                            if (error.response && error.response.data && error.response.data.errors) {
                                this.errors = error.response.data.errors;
                            } else {
                                toastr.error('Có lỗi không mong muốn!');
                            }
                        })
                },
            }
        });
    </script>
@endsection

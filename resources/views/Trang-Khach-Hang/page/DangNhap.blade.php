@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
<main class="content-for-layout" style="margin-bottom: 100px;" v-cloak>
    <div class="login-page mt-100">
        <div class="container">
            <div class="login-form common-form mx-auto">
                <div class="section-header mb-3">
                    <h2 class="section-heading text-center">Đăng Nhập</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Email address</label>
                            <input v-model="dang_nhap.email" type="email" />
                            <div v-if="errors.email" class="alert alert-warning">@{{ errors.email[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Mật Khẩu</label>
                            <input v-model="dang_nhap.password" type="password" />
                            <div v-if="errors.password" class="alert alert-warning">@{{ errors.password[0] }}</div>
                        </fieldset>
                    </div>
                    <div class="col-12 mt-3">
                        <a href="/quen-mat-khau" class="text_14 d-block">Quên Mật Khẩu?</a>
                        <button type="submit" v-on:click="kich_hoat_dang_nhap()"
                            class="btn-primary d-block mt-4 btn-signin">Đăng Nhập</button>
                        <a href="/dang-ky" class="btn-secondary mt-2 btn-signin">Tạo Tài Khoản</a>
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
            dang_nhap: {},
            errors: {
                email: '', // Thêm trường này để theo dõi lỗi email
                password: '' // Thêm trường này để theo dõi lỗi password
            },
            @include('Trang-Khach-Hang.share.datavue')
        },
        watch: {
        'dang_nhap.email': function (newVal) {
            if (newVal) {
                this.errors.email = ''; // Xóa thông báo lỗi khi người dùng bắt đầu nhập
            }
        },
        'dang_nhap.password': function (newVal) {
            if (newVal) {
                this.errors.password = ''; // Xóa thông báo lỗi khi người dùng bắt đầu nhập
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
        kich_hoat_dang_nhap() {
            axios
                .post('/kich-hoat-dang-nhap', this.dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        toastr.success(res.data.message);
                        this.dang_nhap = {};
                        setTimeout(() => {
                            window.location.href = "/";
                        }, 1000); // Delay for 2 seconds (2000 milliseconds)
                    } else {
                        toastr.warning(res.data.message);
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
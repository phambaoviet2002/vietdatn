@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
    <main id="app" class="content-for-layout" style="margin-bottom: 100px;" v-cloak>
        <div class="login-page mt-100">
            <div class="container">
                <div class="login-form common-form mx-auto">
                    <div class="section-header mb-3">
                        <h2 class="section-heading text-center text-nowrap">Quên Mật Khẩu</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <fieldset>
                                <label class="label">Nhập Email Muốn Đổi Lại Mật Khẩu</label>
                                <input v-model="quen_mat_khau.email" type="email" />
                                <div v-if="errors.email" class="alert alert-warning">@{{ errors.email[0] }}</div>
                            </fieldset>
                        </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" v-on:click="kich_hoat_quen_mat_khau()"
                                class="btn-primary d-block mt-4 btn-signin">Gửi</button>
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
                quen_mat_khau: {},
                errors: {
                    email: '', // Thêm trường này để theo dõi lỗi email
                },
                @include('Trang-Khach-Hang.share.datavue')
            },
            watch: {
                'quen_mat_khau.email': function(newVal) {
                    if (newVal) {
                        this.errors.email = ''; // Xóa thông báo lỗi khi người dùng bắt đầu nhập
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
                kich_hoat_quen_mat_khau() {
                    axios
                        .post('/kich-hoat-quen-mat-khau', this.quen_mat_khau)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.quen_mat_khau = {};
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

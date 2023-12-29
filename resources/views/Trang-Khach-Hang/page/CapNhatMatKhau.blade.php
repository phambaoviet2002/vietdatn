@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
    <main  class="content-for-layout" style="margin-bottom: 100px;" v-cloak>
        <div class="login-page mt-100">
            <div class="container">
                <div class="login-form common-form mx-auto">
                    <div class="section-header mb-3">
                        <h2 class="section-heading text-center text-nowrap">Cập Nhật Mật Khẩu</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <fieldset>
                                <label class="label">Nhập Mật Khẩu </label>
                                <input  v-model="cap_nhat_mat_khau.password" type="password" />
                            <div v-if="errors.password" class="alert alert-warning">@{{ errors.password[0] }}</div>

                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset>
                                <label class="label">Nhập lại Mật Khẩu</label>
                                <input v-model="cap_nhat_mat_khau.nhap_lai_password" type="password" />
                                <div v-if="errors.nhap_lai_password" class="alert alert-warning">@{{ errors.nhap_lai_password[0] }}</div>
                            </fieldset>
                        </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" v-on:click="kich_hoat_cap_nhat_mat_khau()"
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
                @include('Trang-Khach-Hang.share.datavue')
                cap_nhat_mat_khau:{},
                errors: {
                    password: '',// Thêm trường này để theo dõi lỗi password
                    nhap_lai_password:''
                },
            },
            created() {
                this.tai_gio_hang(); // Gọi hàm này để tải dữ liệu khi component được tạo
            },
            watch: {
                'cap_nhat_mat_khau.password': function(newVal) {
                    if (newVal) {
                        this.errors.password = ''; // Xóa thông báo lỗi khi người dùng bắt đầu nhập
                    }
                },
                'cap_nhat_mat_khau.nhap_lai_password': function(newVal) {
                    if (newVal) {
                        this.errors.nhap_lai_password = ''; // Xóa thông báo lỗi khi người dùng bắt đầu nhập
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
                kich_hoat_cap_nhat_mat_khau(){
                    axios
                        .post('/khach-hang/kich-hoat-cap-nhap-mat-khau', this.cap_nhat_mat_khau)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.cap_nhat_mat_khau = {};
                            } else {
                                toastr.error('Hình như có vấn đề về đổi mật khẩu');
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
                @include('Trang-Khach-Hang.share.vue')
            }
        });
    </script>
@endsection

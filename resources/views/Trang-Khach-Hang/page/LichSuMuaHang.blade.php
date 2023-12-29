@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
    <!-- collection tab start -->
    <div class="collection-tab-section mt-100 mb-100 overflow-hidden">
        <div class="collection-tab-inner">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-heading">Lịch Sử Mua Hàng</h2>
                </div>
                <div class="tab-list collection-tab-list mb-5">
                    <nav class="nav justify-content-center">
                        <a class="tab-link" href="#collection-tools" data-bs-toggle="tab">Đang xử lý</a>
                        <a class="tab-link" href="#collection-dang-giao" data-bs-toggle="tab">Đang giao</a>
                        <a class="tab-link" href="#collection-hoan-tat" data-bs-toggle="tab">Hoàn tất</a>
                        <a class="tab-link" href="#collection-don-huy" data-bs-toggle="tab">Đơn hủy</a>
                    </nav>
                </div>
                <div class="tab-content collection-tab-content">
                    <div id="collection-tools" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="table" class="table table-bordered">
                                    <thead style="background: #ffae00">
                                        <tr>
                                            <th class="text-center">Họ và tên</th>
                                            <th class="text-center">Số điện thoại</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Mã hóa đơn</th>
                                            <th class="text-center">Trạng thái đơn</th>
                                            <th class="text-center">Trạng thái thanh toán</th>
                                            <th class="text-center">Hủy đơn</th>
                                            <th class="text-center">Sản Phẩm Chi Tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr v-for="(value, key) in ds_du_lieu" :key="key"
                                            v-if="value && value.trang_thai_don == 0">
                                            <th class="align-middle text-center">@{{ value.ho_va_ten }}</th>
                                            <th class="align-middle text-center">@{{ value.so_dien_thoai }}</th>
                                            <th class="align-middle text-center">@{{ value.dia_chi }}</th>
                                            <th class="align-middle text-center">@{{ value.id }}</th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_don === -1" class="btn btn-danger">Hủy
                                                    đơn</button>
                                                <button v-else-if="value.trang_thai_don === 0" class="btn btn-info">Đang xử
                                                    lý</button>
                                                <button v-else-if="value.trang_thai_don === 1" class="btn btn-success">Đang
                                                    giao</button>
                                                <button v-else-if="value.trang_thai_don === 2" class="btn btn-success">Hoàn
                                                    tất</button>
                                                <button v-else class="btn btn-warning">Không xác định</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_thanh_toan === 0" class="btn btn-danger">Chưa
                                                    thanh toán</button>
                                                <button v-else class="btn btn-success">Đã thanh toán</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-danger" v-if="value.trang_thai_don == 0"   v-on:click="huy_don = value" data-bs-toggle="modal" data-bs-target="#huy_don_Modal">Hủy
                                                    đơn</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-info" data-bs-toggle="modal"
                                                    :data-bs-target="'#exampleModal' + key">Chi Tiết</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                    <!-- Modal -->
                                    <div class="modal fade" id="huy_don_Modal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn có chắc chắn muốn hủy đơn hàng này không </p>
                                                    <p class="text-danger"><b >Lưu ý:</b> Việc này không thể hoàn tác, hãy cẩn thận!</p>
                                                    <input type="hidden" class="form-control" v-model="huy_don.id">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button v-on:click="kich_hoat_huy_don()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Hủy đơn</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="collection-dang-giao" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="table" class="table table-bordered">
                                    <thead style="background: #ffae00">
                                        <tr>
                                            <th class="text-center">Họ và tên</th>
                                            <th class="text-center">Số điện thoại</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Tổng tiền tất cả</th>
                                            <th class="text-center">Trạng thái đơn</th>
                                            <th class="text-center">Trạng thái thanh toán</th>
                                            <th class="text-center">Hủy đơn</th>
                                            <th class="text-center">Sản Phẩm Chi Tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(value, key) in ds_du_lieu" :key="key"
                                            v-if="value && value.trang_thai_don == 1">
                                            <th class="align-middle text-center">@{{ value.ho_va_ten }}</th>
                                            <th class="align-middle text-center">@{{ value.so_dien_thoai }}</th>
                                            <th class="align-middle text-center">@{{ value.dia_chi }}</th>
                                            <th class="align-middle text-center">@{{ formatCurrency(value.tong_tien_tat_ca) }}</th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_don === -1" class="btn btn-danger">Hủy
                                                    đơn</button>
                                                <button v-else-if="value.trang_thai_don === 0" class="btn btn-info">Đang
                                                    xử lý</button>
                                                <button v-else-if="value.trang_thai_don === 1"
                                                    class="btn btn-success">Đang giao</button>
                                                <button v-else-if="value.trang_thai_don === 2"
                                                    class="btn btn-success">Hoàn tất</button>
                                                <button v-else class="btn btn-warning">Không xác định</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_thanh_toan === 0"
                                                    class="btn btn-danger">Chưa thanh toán</button>
                                                <button v-else class="btn btn-success">Đã thanh toán</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-danger" v-if="value.trang_thai_don == 0">Hủy
                                                    đơn</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-info" data-bs-toggle="modal"
                                                    :data-bs-target="'#exampleModal' + key">Chi Tiết</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="collection-hoan-tat" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="table" class="table table-bordered">
                                    <thead style="background: #ffae00">
                                        <tr>
                                            <th class="text-center">Họ và tên</th>
                                            <th class="text-center">Số điện thoại</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Tổng tiền tất cả</th>
                                            <th class="text-center">Trạng thái đơn</th>
                                            <th class="text-center">Trạng thái thanh toán</th>
                                            <th class="text-center">Hủy đơn</th>
                                            <th class="text-center">Sản Phẩm Chi Tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(value, key) in ds_du_lieu" :key="key"
                                            v-if="value && value.trang_thai_don == 2">
                                            <th class="align-middle text-center">@{{ value.ho_va_ten }}</th>
                                            <th class="align-middle text-center">@{{ value.so_dien_thoai }}</th>
                                            <th class="align-middle text-center">@{{ value.dia_chi }}</th>
                                            <th class="align-middle text-center">@{{ formatCurrency(value.tong_tien_tat_ca) }}</th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_don === -1" class="btn btn-danger">Hủy
                                                    đơn</button>
                                                <button v-else-if="value.trang_thai_don === 0" class="btn btn-info">Đang
                                                    xử lý</button>
                                                <button v-else-if="value.trang_thai_don === 1"
                                                    class="btn btn-success">Đang giao</button>
                                                <button v-else-if="value.trang_thai_don === 2"
                                                    class="btn btn-success">Hoàn tất</button>
                                                <button v-else class="btn btn-warning">Không xác định</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_thanh_toan === 0"
                                                    class="btn btn-danger">Chưa thanh toán</button>
                                                <button v-else class="btn btn-success">Đã thanh toán</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-danger" v-if="value.trang_thai_don == 0"
                                                   >Hủy đơn</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-info" data-bs-toggle="modal"
                                                    :data-bs-target="'#exampleModal' + key">Chi Tiết</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="collection-don-huy" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="table" class="table table-bordered">
                                    <thead style="background: #ffae00">
                                        <tr>
                                            <th class="text-center">Họ và tên</th>
                                            <th class="text-center">Số điện thoại</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Tổng tiền tất cả</th>
                                            <th class="text-center">Trạng thái đơn</th>
                                            <th class="text-center">Trạng thái thanh toán</th>
                                            <th class="text-center">Hủy đơn</th>
                                            <th class="text-center">Sản Phẩm Chi Tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(value, key) in ds_du_lieu" :key="key"
                                            v-if="value && value.trang_thai_don == -1">
                                            <th class="align-middle text-center">@{{ value.ho_va_ten }}</th>
                                            <th class="align-middle text-center">@{{ value.so_dien_thoai }}</th>
                                            <th class="align-middle text-center">@{{ value.dia_chi }}</th>
                                            <th class="align-middle text-center">@{{ formatCurrency(value.tong_tien_tat_ca) }}</th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_don === -1" class="btn btn-danger">Hủy
                                                    đơn</button>
                                                <button v-else-if="value.trang_thai_don === 0" class="btn btn-info">Đang
                                                    xử lý</button>
                                                <button v-else-if="value.trang_thai_don === 1"
                                                    class="btn btn-success">Đang giao</button>
                                                <button v-else-if="value.trang_thai_don === 2"
                                                    class="btn btn-success">Hoàn tất</button>
                                                <button v-else class="btn btn-warning">Không xác định</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button v-if="value.trang_thai_thanh_toan === 0"
                                                    class="btn btn-danger">Chưa thanh toán</button>
                                                <button v-else class="btn btn-success">Đã thanh toán</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-danger" v-if="value.trang_thai_don == 0">Hủy
                                                    đơn</button>
                                            </th>
                                            <th class="align-middle text-center">
                                                <button class="btn btn-info" data-bs-toggle="modal"
                                                    :data-bs-target="'#exampleModal' + key">Chi Tiết</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- collection tab end -->

    <!-- Modal -->
    <div v-for="(value, key) in ds_du_lieu" :key="key">
        <div class="modal fade" :id="'exampleModal' + key" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Đơn Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nội dung chi tiết đơn hàng -->
                        <table class="table table-bordered">
                            <thead style="background: #ffae00">
                                <tr>
                                    <th class="text-center">Mã sản phẩm</th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Ảnh sản phẩm</th>
                                    <th class="text-center">Giá sản phẩm</th>
                                    <th class="text-center">Ngày đặt sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in value.ds_hoa_don_chi_tiet" :key="key">
                                    <th class="align-middle text-center">@{{ value.id }}</th>
                                    <th class="align-middle text-center">@{{ value.ten_san_pham }}</th>
                                    <th class="align-middle text-center">
                                        <img :src="'/img/' + value.hinh_anh" alt="Ảnh sản phẩm"
                                            style="width: 50px; height: 50px;">
                                    </th>
                                    <th class="align-middle text-center">
                                        @{{ formatCurrency(value.giam_gia_san_pham) }}
                                    </th>

                                    <th class="align-middle text-center">@{{ formatDate(value.created_at) }}</th>
                                    <th class="align-middle text-center">@{{ value.tong_so_luong }}</th>
                                    <th class="align-middle text-center">@{{ formatCurrency(value.tong_tien) }}</th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="align-middle text-center" colspan="7">
                                        Tổng tiền bảo gồm cả thuế và phí ship: @{{ formatCurrency(value.tong_tien_tat_ca) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                ds_du_lieu: [],
                huy_don: {},
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
                this.tai_gio_hang();
                this.lich_su_mua_hang();
            },
            methods: {
                @include('Trang-Khach-Hang.share.vue')
                lich_su_mua_hang() {
                    axios.get('/khach-hang/ds-lich-su-mua-hang')
                        .then((res) => {
                            this.ds_du_lieu = res.data.du_lieu;

                        });
                },
                formatDate(timestamp) {
                    return moment(timestamp).format('YYYY-MM-DD HH:mm:ss');
                },
                kich_hoat_huy_don() {
                    axios
                        .post('/khach-hang/huy-don/' + this.huy_don.id)
                        .then((res) => {
                            toastr.success('hủy đơn thành công!');
                            this.lich_su_mua_hang();
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

            },
        });
    </script>
@endsection

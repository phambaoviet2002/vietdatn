@extends('Trang-Khach-Hang.share.master')
@section('noi-dung')
    <main id="MainContent" class="content-for-layout" style="margin-bottom: 100px">
        <div class="cart-page mt-100">
            <div class="checkout-progress overflow-hidden text-center">
                <ol class="checkout-bar px-0"
                    style="display: flex; justify-content: center; align-items: center; list-style: none;">
                    <li class="progress-step step-done"><a href="cart.html">Giỏ hàng</a></li>
                    <li class="progress-step step-done"><a href="checkout.html">Thanh toán</a></li>
                    <li class="progress-step step-active"><a href="checkout.html">Hóa đơn</a></li>
                </ol>
            </div>
            <div class="container mt-100">
                <div class="cart-page-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table" class="table table-bordered">
                                <thead style="background: #ffae00">
                                    <tr>
                                        <th class="text-center">Họ và tên</th>
                                        <th class="text-center">Số điện thoại</th>
                                        <th class="text-center">Địa chỉ</th>
                                        <th class="text-center">Mã đơn hàng</th>
                                        <th class="text-center">Trạng thái đơn</th>
                                        <th class="text-center">Trạng thái thanh toán</th>
                                        <th class="text-center">Hóa đơn chi tiết</th>
                                    </tr>
                                <tbody>
                                    <tr>
                                        <th class="align-middle text-center">{{ $hoa_don_moi->ho_va_ten }}</th>
                                        <th class="align-middle text-center">{{ $hoa_don_moi->so_dien_thoai }}</th>
                                        <th class="align-middle text-center">{{ $hoa_don_moi->dia_chi }}</th>
                                        <th class="align-middle text-center">
                                            {{$hoa_don_moi->id}}</th>
                                        <th class="align-middle text-center">
                                            @if ($hoa_don_moi->trang_thai_don == -1)
                                                <button class="btn btn-danger">Hủy đơn</button>
                                            @elseif($hoa_don_moi->trang_thai_don == 0)
                                                <button class="btn btn-info">Đang xử lý</button>
                                            @elseif($hoa_don_moi->trang_thai_don == 1)
                                                <button class="btn btn-success">Đang giao</button>
                                            @elseif($hoa_don_moi->trang_thai_don == 2)
                                                <button class="btn btn-success">Hoàn tất</button>
                                            @else
                                                <button class="btn btn-warning">Không xác định</button>
                                            @endif
                                        </th>
                                        <th class="align-middle text-center">
                                            @if ($hoa_don_moi->trang_thai_thanh_toan == 0)
                                                <button class="btn btn-danger">Chưa thanh toán</button>
                                            @else
                                                <button class="btn btn-success">Đã thanh toán</button>
                                            @endif
                                        </th>
                                        <th>
                                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Hóa đơn chi tiết</button>
                                        </th>
                                    </tr>
                                </tbody>

                               
                                </thead>
                            </table>
                             <!-- Modal -->
                      
                                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <table  class="table table-bordered">
                                            <thead style="background: #ffae00">
                                                <tr>
                                                    <th class="text-center">Mã sản phẩm</th>             
                                                    <th class="text-center">Tên sản phẩm</th>
                                                    <th class="text-center">Ảnh sản phẩm</th>
                                                    <th class="text-center">Giá sản phẩm</th>
                                                    <th class="text-center">Ngày đặt sản phẩm</th>
                                                    <th class="text-center">Tổng số lượng</th>
                                                    <th class="text-center">Tổng tiền</th>
                                                </tr>
                                            <tbody>
                                                @foreach ($hoa_don_chi_tiet as $key => $value)
                                                    <tr>
                                                        <th class="align-middle text-center">{{ $value->id }}</th>
                                                        <th class="align-middle text-center">{{ $value->ten_san_pham }}</th>
                                                        <th class="align-middle text-center">
                                                            <img src="/img/{{ $value->hinh_anh }}" alt="Ảnh sản phẩm" style="width: 50px; height: 50px;">
                                                        </th>      
                                                        <th class="align-middle text-center">
                                                            {{ number_format($value->giam_gia_san_pham) }} ₫
                                                        </th>
                                                        <th class="align-middle text-center">{{ $value->created_at }}</th>
                                                        <th class="align-middle text-center">{{ $value->tong_so_luong }}</th>
                                                        <th class="align-middle text-center">{{  number_format($value->tong_tien) }} ₫</th>
                                                    </tr>        
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="align-middle text-center" colspan="7">
                                                    Tổng tiền bảo gồm cả thuế và phí ship : {{ number_format($hoa_don_moi->tong_tien_tat_ca) }} ₫
                                                    </th>
                                                </tr>
                                            </tfoot>        
                                        </table>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                           
                             
                        </div>
                    </div>
                </div>
            </div>
            <p class="a text-center">Trang này sẽ hiển thị hóa đơn của bạn trong vòng 5 giây. Nếu bạn muốn xem hoặc điều chỉnh đơn hàng, hãy truy cập lịch sử mua hàng để tùy chỉnh.</p>
        </div>
    </main>
@endsection
@section('js')
    <script>
        setTimeout(function() {
            window.location.href = '/'; // Thay thế '/your-target-page' bằng URL thực tế
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>


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

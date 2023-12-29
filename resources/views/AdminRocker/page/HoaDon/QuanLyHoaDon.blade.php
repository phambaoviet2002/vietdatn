@extends('AdminRocker.share.master')
@section('noi_dung')

<div class="row" id="app" v-cloak>

  <div class="col-md-12 mb-3">
    <div class="modal-category">
      <!-- Button trigger modal -->
      <a href="/admin/hoa-don/tao-hoa-don" class="btn btn-primary">
        Tạo hoá đơn
      </a>

      <!-- <button class="btn btn-primary mt-3" type="button" data-bs-toggle="modal" data-bs-target="#HoaDonModal">Tạo hoá
        đơn</button> -->

      <!-- Modal tai khoan-->
      <div class="modal fade" id="HoaDonModal" tabindex="-1" aria-labelledby="HoaDonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="HoaDonModalLabel">Tạo hoá đơn</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">

              <div class="form-group mt-3">
                <label>Email khách hàng</label>
                <select v-model="add_hoadon.ma_khach_hang" class="form-control" @change="LayTTKhachHang">
                  <option v-for="khachhang in data_khachhang" :value="khachhang.id">@{{ khachhang.email }}</option>
                </select>
                <div v-if="errors.ma_khach_hang" class="alert alert-warning">
                  @{{ errors.ma_khach_hang[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Họ và tên</label>
                <input v-model="add_hoadon.ho_va_ten" type="text" class="form-control" placeholder="Nhập vào Họ và tên">
                <div v-if="errors.ho_va_ten" class="alert alert-warning">
                  @{{ errors.ho_va_ten[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Địa chỉ</label>
                <input v-model="add_hoadon.dia_chi" type="text" class="form-control" placeholder="Nhập vào địa chỉ">
                <div v-if="errors.dia_chi" class="alert alert-warning">
                  @{{ errors.dia_chi[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Số điện thoại</label>
                <input v-model="add_hoadon.so_dien_thoai" type="number" class="form-control"
                  placeholder="Nhập vào số điện thoại">
                <div v-if="errors.so_dien_thoai" class="alert alert-warning">
                  @{{ errors.so_dien_thoai[0] }}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button v-on:click="them_hoa_don()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save
                changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-center">
        <h3> Danh Sách Hoá Đơn</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table_id" class="table table-bordered">
            <thead clas="bg-primary">
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Tên Khách Hàng</th>
                <th class="text-center">Số Điện Thoại</th>
                <th class="text-center">Địa chỉ</th>
                <th class="text-center">TT Đơn Hàng</th>
                <th class="text-center">TT Thanh Toán</th>
                <th class="text-center">Thao Tác</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(hoadon, key) in data_hoadon">
                <th class="align-middle text-center">@{{ key + 1 }}</th>
                <td class="align-middle text-center">@{{ hoadon.ho_va_ten }}</td>
                <td class="align-middle text-center">@{{ hoadon.so_dien_thoai }}</td>
                <td class="align-middle text-center">@{{ hoadon.dia_chi }}</td>
                <td class="align-middle text-center font-bold">
                  <div class="dropdown">
                    <button type="button"
                      :class="'dropdown-toggle ' + (hoadon.trang_thai_don == 2 ? 'btn btn-success' : '')" role="button"
                      id="dropdownTTDonHang" data-bs-toggle="dropdown" aria-expanded="false">
                      @{{ getTTDonhang(hoadon.trang_thai_don) }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownTTDonHang">
                      <a class="dropdown-item" href="#" @click="CapNhatTTDonHang(hoadon.id, 0)">Chờ Xác Nhận</a>
                      <a class="dropdown-item" href="#" @click="CapNhatTTDonHang(hoadon.id, 1)">Đang Vận Chuyển</a>
                      <a class="dropdown-item" href="#" @click="CapNhatTTDonHang(hoadon.id, 2)">Đã Nhận Hàng</a>
                      <a class="dropdown-item" href="#" @click="CapNhatTTDonHang(hoadon.id, -1)">Huỷ Đơn Hàng</a>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <button type="button"
                    :class="(hoadon.trang_thai_thanh_toan !== 0 ? 'btn btn-success' : ' btn btn-danger')"
                    @click="CapNhatTrangThaiThanhToan(hoadon.id, hoadon.trang_thai_thanh_toan)">
                    @{{ getTTThanhToan(hoadon.trang_thai_thanh_toan) }}
                  </button>
                </td>
                <td class="align-middle text-center text-nowrap">
                  <!-- Button trigger modal -->
                  <a :class="'btn btn-primary' + (hoadon.trang_thai_don !== 0 ? ' disabled-link' : '')"
                    :href="'{{ asset("admin/hoa-don/hoa-don-chi-tiet") }}/' + hoadon.id">
                    Sửa
                  </a>
                  <button v-on:click="setHoaDon(hoadon)" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#XemModal">Xem</i>
                  </button>
                </td>
              </tr>
            </tbody>

          </table>

          <!-- MODAL Xem hoa don chi tiet -->
          <div class="modal fade" id="XemModal" tabindex="-1" role="dialog" aria-labelledby="XemModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="XemModalLabel">Hoá đơn chi tiết</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="product-card">

                    <table class="table table-bordered">
                      <thead clas="bg-primary">
                        <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Tên Sản Phẩm</th>
                          <th class="text-center">Hình Ảnh</th>
                          <th class="text-center">Giá Sản Phẩm</th>
                          <th class="text-center">Số Lượng</th>
                          <th class="text-center">Mã Sảnm Phẩm</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(hdct, key) in data_hdct" v-if="hdct.ma_hoa_don == hoa_don.id">
                          <td class="align-middle text-center">@{{ key + 1 }}</td>
                          <td class="align-middle text-center">@{{ hdct.ten_san_pham }}</td>
                          <td class="align-middle text-center">
                            <img class="secondary-img" width="100px" :src="'/img/' + hdct.hinh_anh"
                              alt="Hình ảnh sản phẩm">
                          </td>
                          <td class="align-middle text-center">
                            @{{ formatCurrency(hdct.giam_gia_san_pham) }}
                          </td>
                          <td class="align-middle text-center">@{{ hdct.tong_so_luong }}</td>
                          <td class="align-middle text-center">@{{ hdct.ma_san_pham }}</td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="d-flex justify-content-end"> <span class="font-bold">Tổng tiền : </span> <span> @{{
                            formatCurrency(hoa_don.tong_tien_tat_ca) }} </span></h5>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- end modal xem hoa đơn -->

          <div></div>
        </div>
      </div>
    </div>


  </div>


  @endsection
  @section('js')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#table_id').DataTable();
    });
  </script>

  <script>
    new Vue({
      el: '#app',
      data: {
        errors: {},
        add_hoadon: {},
        xoa: {},
        data_hoadon: [],
        data_khachhang: [],
        data_hdct: [],
        hoa_don: {},
        data_sanpham: [],
      },
      created() {
        this.GetData();
      },

      methods: {
        // hien thi danh sach tai khoan
        GetData() {
          axios
            .get('/admin/hoa-don/du-lieu')
            .then((res) => {
              this.data_hoadon = res.data.data_hoadon;
              this.data_khachhang = res.data.data_khachhang;
              this.data_hdct = res.data.data_hdct;
              this.data_sanpham = res.data.data_sanpham;
            });
        },

        setHoaDon(hoadon) {
          this.hoa_don = hoadon;
        },

        cap_nhat(hoadon) {
          this.edit_user = hoadon;
        },

        getTTDonhang(roleDonhang) {
          switch (roleDonhang) {
            case 0:
              return 'Chờ Xác Nhận';
            case 1:
              return 'Đang Vận Chuyển';
            case 2:
              return 'Đã Nhận Hàng';
            case -1:
              return 'Huỷ Đơn Hàng';
            default:
              return 'Không xác định';
          }
        },

        getTTThanhToan(roleThanhToa) {
          switch (roleThanhToa) {
            case 0:
              return 'Chưa Thanh Toán';
            case 1:
              return 'Đã Thanh Toán';
            default:
              return 'Không xác định';
          }
        },

        them_hoa_don() {
          axios
            .post('/admin/hoa-don/them-hoa-don', this.add_hoadon)
            .then((res) => {
              if (res.data.status) {
                toastr.success(res.data.message);
                this.GetData();
              } else {
                toastr.error('Có lỗi không mong muốn!');
              }
            })
            .catch((error) => {
              if (error && error.response.data && error.response.data.errors) {
                this.errors = error.response.data.errors;
              } else {
                toastr.error('Có lỗi không mong muốn!');
              }
            })
        },

        LayTTKhachHang() {
          // Lấy id của khách hàng từ dropdown
          const ChonIDKhachHang = this.add_hoadon.ma_khach_hang;

          // Tìm thông tin của khách hàng tương ứng
          const ChonKhachHang = this.data_khachhang.find(customer => customer.id === ChonIDKhachHang);

          // Cập nhật thông tin vào đối tượng add_hoadon
          if (ChonKhachHang) {
            this.add_hoadon.ho_va_ten = ChonKhachHang.ho_va_ten;
            this.add_hoadon.dia_chi = ChonKhachHang.dia_chi;
            this.add_hoadon.so_dien_thoai = ChonKhachHang.so_dien_thoai;
          }
        },

        CapNhatTTDonHang(donHangId, TTMoi) {
          // Gửi yêu cầu cập nhật trạng thái đơn hàng lên server
          axios.post('/admin/hoa-don/cap-nhat-trang-thai-don-hang', {
            donHangId: donHangId,
            TTMoi: TTMoi,
          })
            .then((res) => {
              if (res.data.status) {
                toastr.success(res.data.message);
                this.GetData();
              } else {
                toastr.success(res.data.message);
                this.GetData();
              }
            })
        },

        CapNhatTrangThaiThanhToan(id_hoa_don, TTTT) {
          const TTTT_moi = TTTT === 0 ? 1 : 0;
          axios
            .post('/admin/hoa-don/cap-nhat-trang-thai-thanh-toan', {
              id_hoa_don: id_hoa_don,
              TTTT_moi: TTTT_moi,
            })
            .then((res) => {
              if (res.data.status) {
                toastr.success(res.data.message);
                this.GetData();
              } else {
                toastr.success(res.data.message);
                this.GetData();
              }
            })
        },

        formatCurrency(value) {
          const formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
          });
          return formatter.format(value);
        },

      }
    });
  </script>


  @endsection
@extends('AdminRocker.share.master')
@section('noi_dung')

<div class="row" id="app" v-cloak>

  <div class="col-md-12 mb-3">
    <div class="modal-category">
      <a class="btn btn-secondary" href="{{ asset('admin/hoa-don') }}">
        Quay Lại
      </a>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-center">
        <h3>Tạo Hoá Đơn</h3>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="card custom-column" style="height: 100%;">
              <h4 class="text-center">THÔNG TIN HOÁ ĐƠN</h4>
              <div class="form-group mt-3">
                <strong>Mã hoá đơn : <span>@{{ hoa_don_moi_nhat.ma_hoa_don }}</span></strong>
              </div>
              <div class="form-group mt-3">
                <label>Nhân viên báng hàng : </label>
                <input v-model="tai_khoan_dang_nhap.ten_tai_khoan" type="text" class="form-control" disabled>
              </div>
              <div class="form-group mt-3">
                <label>Thông tin đơn hàng</label>
                <select class="form-control" v-model="them_hoa_don.trang_thai_don">
                  <option value="0">Chờ xử lý</option>
                  <option value="1">Đang vận chuyển</option>
                  <option value="2">Giao hàng thành công</option>
                </select>
              </div>
              <div class="form-group mt-3">
                <label>Thông tin thanh toán</label>
                <select class="form-control" v-model="them_hoa_don.trang_thai_thanh_toan" :value="0">
                  <option value="0" selected>Chưa thanh toán</option>
                  <option value="1">Đã thanh toán</option>
                </select>
              </div>
              <div class="form-group mt-3">
                <label>Ngày tạo hoá đơn : </label>
                <input value="{{ date('Y-m-d') }}" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card custom-column" style="height: 100%;">
              <h4 class="text-center">THÔNG TIN KHÁCH HÀNG</h4>

              <div>
                <div class="form-group mt-3">
                  <label>Email khách hàng</label>
                  <select v-model="them_hoa_don.ma_khach_hang" class="form-control" @change="LayTTKhachHang">
                    <option v-for="khachhang in data_khachhang" :value="khachhang.id">@{{ khachhang.email }}</option>
                  </select>
                  <div v-if="errors.ma_khach_hang" class="alert alert-warning">
                    @{{ errors.ma_khach_hang[0] }}
                  </div>
                </div>
                <div class="form-group mt-3">
                  <label>Họ và tên</label>
                  <input v-model="them_hoa_don.ho_va_ten" type="text" class="form-control"
                    placeholder="Nhập vào Họ và tên">
                  <div v-if="errors.ho_va_ten" class="alert alert-warning">
                    @{{ errors.ho_va_ten[0] }}
                  </div>
                </div>
                <div class="form-group mt-3">
                  <label>Địa chỉ</label>
                  <input v-model="them_hoa_don.dia_chi" type="text" class="form-control" placeholder="Nhập vào địa chỉ">
                  <div v-if="errors.dia_chi" class="alert alert-warning">
                    @{{ errors.dia_chi[0] }}
                  </div>
                </div>
                <div class="form-group mt-3">
                  <label>Số điện thoại</label>
                  <input v-model="them_hoa_don.so_dien_thoai" type="number" class="form-control"
                    placeholder="Nhập vào số điện thoại">
                  <div v-if="errors.so_dien_thoai" class="alert alert-warning">
                    @{{ errors.so_dien_thoai[0] }}
                  </div>
                </div>
              </div>

              <div class="">
                <button class="btn btn-primary mt-3" type="button" data-bs-toggle="modal" data-bs-target="#ThemKHModal">
                  Thêm Tài Khoản Khách Hàng
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card custom-column">
              <h4 class="text-center">THÔNG TIN SẢN PHẨM</h4>
              <div class="box_form">
                <table id="select_table" class="table table-hover">
                  <thead class="bg-primary">
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Tên Sản Phẩm</th>
                      <th class="text-center">Hình Ảnh</th>
                      <th class="text-center">Giá Sản Phẩm Hiện Tại</th>
                      <th class="text-center">Số Lượng</th>
                      <th class="text-center">Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(SP, index) in SanPham" :key="index">
                      <td class="text-center">@{{ SP.id_SP }}</td>
                      <td class="text-center">@{{ getSanPham(SP.id_SP).ten_san_pham }}</td>
                      <td class="text-center">
                        <img :src="'/img/' + getSanPham(SP.id_SP).hinh_anh" :alt="getSanPham(SP.id_SP).hinh_anh">
                      </td>
                      <td class="text-center">@{{ formatCurrency(getSanPham(SP.id_SP).giam_gia_san_pham) }}</td>
                      <td class="text-center">
                        <div class="quantity d-flex align-items-center justify-content-between">
                          <button class="qty-btn dec-qty" @click="tru_so_luong(SP)"><img
                              src="/assets_client/img/icon/minus.svg" alt="minus"></button>
                          <input class="qty-input" type="number" v-model="SP.tong_so_luong" min="1" readonly>
                          <button class="qty-btn inc-qty" @click="them_so_luong(SP)"><img
                              src="/assets_client/img/icon/plus.svg" alt="plus"></button>
                        </div>
                        <!-- <input type="number" style="width: 50px;" v-model="SP.soluong" min="1" value="1"
                        class="form-control" /> -->
                      </td>
                      <td class="text-center">
                        <button class="btn btn-danger" @click="xoa_sp(index)">Xoá</button>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="5"><strong>Tổng Tiền</strong></td>
                      <td class="text-center">@{{ formatCurrency(tinhTongTien()) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>


              <div class="">
                <button class="btn btn-primary mt-3" type="button" data-bs-toggle="modal" data-bs-target="#ThemSPModal">
                  Thêm sản phẩm
                </button>
              </div>
            </div>
          </div>
        </div>
        <button v-on:click="tao_hoa_don()" type="button" class="btn btn-primary" style="float: right;">
          Tạo Hoá Đơn
        </button>
      </div>

      <!-- Modal them san pham-->
      <div class="modal fade" id="ThemSPModal" tabindex="-1" aria-labelledby="ThemSPModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ThemSPModalLabel">Thêm sản phẩm</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow">
              <div class="product-grid">
                <div v-for="sanpham in data_sanpham" class="product-box input_row">
                  <img :src="'/img/' + sanpham.hinh_anh" :alt="sanpham.hinh_anh">
                  <h3>@{{ sanpham.ten_san_pham }}</h3>
                  <p>Loại sản phẩm: <span>@{{ sanpham.ten_loai }}</span></p>
                  <p>Danh mục: <span>@{{ sanpham.ten_danh_muc }}</span></p>
                  <p class="price">@{{ formatCurrency(sanpham.giam_gia_san_pham) }}</p>
                  <input type="hidden" :id="'MaSP' + sanpham.id" :value="sanpham.id">
                  <button class="btn btn-primary" @click="themSanPham(sanpham.id)">Thêm mới</button>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <!-- END them san pham -->


      <!-- Modal them Khách Hàng -->
      <div class="modal fade" id="ThemKHModal" tabindex="-1" aria-labelledby="ThemKHModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ThemKHModalLabel">Thêm Khách Hàng</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group mt-3">
                <label>Họ và tên</label>
                <input v-model="add_user.ho_va_ten" type="text" class="form-control" placeholder="Nhập vào Họ và tên">
                <div v-if="errorss.ho_va_ten" class="alert alert-warning">
                  @{{ errorss.ho_va_ten[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Email</label>
                <input v-model="add_user.email" type="email" class="form-control" placeholder="Nhập vào email">
                <div v-if="errorss.email" class="alert alert-warning">
                  @{{ errorss.email[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Số điện thoại</label>
                <input v-model="add_user.so_dien_thoai" type="text" class="form-control"
                  placeholder="Nhập vào số điện thoại">
                <div v-if="errorss.so_dien_thoai" class="alert alert-warning">
                  @{{ errorss.so_dien_thoai[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Địa chỉ</label>
                <input v-model="add_user.dia_chi" type="text" class="form-control" placeholder="Nhập vào địa chỉ">
                <div v-if="errorss.dia_chi" class="alert alert-warning">
                  @{{ errorss.dia_chi[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Ngày sinh</label>
                <input v-model="add_user.ngay_sinh" type="date" class="form-control" placeholder="Nhập vào ngày sinh">
                <div v-if="errorss.ngay_sinh" class="alert alert-warning">
                  @{{ errorss.ngay_sinh[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Giới tính</label>
                <select v-model="add_user.gioi_tinh" class="form-control">
                  <option value="1">Nam</option>
                  <option value="0">Nữ</option>
                </select>
                <div v-if="errorss.gioi_tinh" class="alert alert-warning">
                  @{{ errorss.gioi_tinh[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Mật khẩu</label>
                <input v-model="add_user.password" type="password" class="form-control" placeholder="Nhập vào mật khẩu">
                <div v-if="errorss.password" class="alert alert-warning">
                  @{{ errorss.password[0] }}
                </div>
              </div>
              <div class="form-group mt-3">
                <label>Mật khẩu</label>
                <input v-model="add_user.nhap_lai_password" type="password" class="form-control"
                  placeholder="Nhập lại mật khẩu">
                <div v-if="errorss.nhap_lai_password" class="alert alert-warning">
                  @{{ errorss.nhap_lai_password[0] }}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
              <button v-on:click="them_nguoi_dung()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Thêm
                Khách Hàng</button>
            </div>
          </div>
        </div>
      </div>
      <!-- END them Khách Hàng -->

    </div>


  </div>


  @endsection
  @section('js')

  <script>
    new Vue({
      el: '#app',
      data: {
        errors: {},
        errorss: {},
        them_hoa_don: {
          trang_thai_thanh_toan: 0,
          trang_thai_don: 0,
        },
        add_user: {},
        SanPhamDaChon: [],
        data_khachhang: [],
        data_hoadon: [],
        data_hdct: [],
        data_sanpham: [],
        SanPham: [],
        tai_khoan_dang_nhap: {},
        hoa_don_moi_nhat: {},
      },
      created() {
        this.GetData();
        this.SanPhamDaChon = JSON.parse(sessionStorage.getItem('SanPhamDaChon')) || [];
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
              this.tai_khoan_dang_nhap = res.data.tai_khoan_dang_nhap;
              this.hoa_don_moi_nhat = res.data.hoa_don_moi_nhat;
            });
        },

        LayTTKhachHang() {
          // Lấy id của khách hàng từ dropdown
          const ChonIDKhachHang = this.them_hoa_don.ma_khach_hang;

          // Tìm thông tin của khách hàng tương ứng
          const ChonKhachHang = this.data_khachhang.find(customer => customer.id === ChonIDKhachHang);

          // Cập nhật thông tin vào đối tượng them_hoa_don
          if (ChonKhachHang) {
            this.them_hoa_don.ho_va_ten = ChonKhachHang.ho_va_ten;
            this.them_hoa_don.dia_chi = ChonKhachHang.dia_chi;
            this.them_hoa_don.so_dien_thoai = ChonKhachHang.so_dien_thoai;
          }
        },

        them_nguoi_dung() {
          axios
            .post('/admin/quan-ly-tai-khoan/them-tai-khoan', this.add_user)
            .then((res) => {
              if (res.data.status) {
                toastr.success(res.data.message);
                this.GetData();
                this.add_user = {};
                // Tắt modal xác nhận
                $('#exampleModal').modal('hide');
              } else {
                toastr.error('Có lỗi không mong muốn!');
              }
            })
            .catch((error) => {
              if (error && error.response.data && error.response.data.errors) {
                this.errorss = error.response.data.errors;
              } else {
                toastr.error('Có lỗi không mong muốn!');
              }
            })
        },

        tru_so_luong(SP) {
          if (SP.tong_so_luong > 1) {
            SP.tong_so_luong--;
          }
        },

        them_so_luong(SP) {
          SP.tong_so_luong++;
        },

        themSanPham(idSP) {
          const index = this.SanPham.findIndex(item => item.id_SP === idSP);

          if (index === -1) {
            this.SanPham.push({ id_SP: idSP, tong_so_luong: 1 });
            toastr.success('Đã thêm vào danh sách sản phẩm!');
            // this.displaySanPham();
          } else {
            toastr.warning("Sản phẩm đã tồn tại trong danh sách");
          }
        },

        tinhTongTien() {
          let tongTien = 0;
          for (const SP of this.SanPham) {
            const giaSanPham = this.getSanPham(SP.id_SP).giam_gia_san_pham;
            tongTien += giaSanPham * SP.tong_so_luong;
          }
          return tongTien;
        },

        getSanPham(id) {
          return this.data_sanpham.find(item => item.id === id) || {};
        },

        xoa_sp(index) {
          this.SanPham.splice(index, 1);
        },


        tao_hoa_don() {
          const du_lieu_yeu_cau = {
            them_hoa_don: this.them_hoa_don,
            SanPham: this.SanPham
          };

          axios
            .post('/admin/hoa-don/tao-hoa-don', du_lieu_yeu_cau)
            .then((res) => {
              if (res.data.status) {
                toastr.success(res.data.message);
                window.location.href = "/admin/hoa-don";
              } else {
                toastr.error('Có lỗi không mong muốn!');
              }
            })
            .catch((error) => {
              if (error && error.response.data && error.response.data.errors) {
                this.errorss = error.response.data.errors;
              } else {
                toastr.error('Có lỗi không mong muốn!');
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


      },
      // end methos
    });
  </script>



  @endsection
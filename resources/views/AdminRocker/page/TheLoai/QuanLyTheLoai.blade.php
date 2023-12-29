@extends('AdminRocker.share.master')
@section('noi_dung')
<main id="app" v-cloak>

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="DanhSachTong" data-bs-toggle="tab" data-bs-target="#nav-DanhSachTong" type="button" role="tab" aria-controls="nav-DanhSachTong" aria-selected="true">Danh sách sản phẩm</button>
      <!-- <button class="nav-link" id="TrangThai" data-bs-toggle="tab" data-bs-target="#nav-TrangThai" type="button" role="tab" aria-controls="nav-TrangThai" aria-selected="false">Trạng thái</button>
      <button class="nav-link" id="DanhMuc" data-bs-toggle="tab" data-bs-target="#nav-DanhMuc" type="button" role="tab" aria-controls="nav-DanhMuc" aria-selected="false">Danh mục</button> -->
      <button class="nav-link" id="ThungRac" data-bs-toggle="tab" data-bs-target="#nav-ThungRac" type="button" role="tab" aria-controls="nav-ThungRac" aria-selected="false">Thùng rác</button>
    </div>
  </nav>

  <div class="tab-content" id="nav-tabContent">



    <!-- ===================================================================================
    ///  =============================== Danh Sách Tổng =============================================
    ///  =================================================================================== -->

    <div class="tab-pane fade show active" id="nav-DanhSachTong" role="tabpanel" aria-labelledby="DanhSachTong" tabindex="0">
      <div class="col-md-12 mb-3 mt-3">
        <div class="modal-category">
          <!-- Button trigger modal -->
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
            Thêm Thể Loại
          </button>
          <!-- Modal them danh muc-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300" id="exampleModalLabel">Thêm Thể Loại
                  </h3>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tên Thể Loại</span>
                    <input placeholder="Nhập vào Tên Thể Loại" type="text" v-model="add_the_loai.ten_loai"
                      class="form-control">
                    <div v-if="errors.ten_loai" class="alert alert-warning">
                      @{{ errors.ten_loai[0] }}
                    </div>
                  </label>


                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tên Danh Mục</span>
                    <select v-model="add_the_loai.ma_danh_muc" class="form-control">
                      <option v-for="(danhmuc, index) in data_danhmuc" :value="danhmuc.id">@{{danhmuc.ten_danh_muc }}
                      </option>
                    </select>
                    <div v-if="errors.ma_danh_muc" class="alert alert-warning">
                      @{{ errors.ma_danh_muc[0] }}
                    </div>
                  </label>
                </div>


                <div class="modal-footer mt-3">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button v-on:click="them_the_loai()" type="button" class="btn btn-primary">
                    Thêm Thể Loại
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h3 class=" text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Các Thể Loại</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table_id" class="table table-bordered">
                <thead clas="bg-primary">
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Tên Thể Loại</th>
                    <th class="text-center">Tên Danh Mục</th>
                    <th class="text-center">Thao tác</th>
                  </tr>
                </thead>
                <tbody>

                  <tr v-for="(theloai, key) in data_theloai">
                    <td class="text-center">
                      @{{ key + 1 }}
                    </td>
                    <td class="text-center text-sm">
                      @{{ theloai ? theloai.ten_loai : 'Không có tên danh mục' }}
                    </td>
                    <td class="text-center text-sm">
                        @{{ theloai.ten_danh_muc }}
                    </td>
                    <td class="text-center text-xs">
                      <button v-on:click="cap_nhat(theloai)" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#ModalEdit">Edit</button>
                      <button v-on:click="xoa_the_loai = theloai" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Xóa</button>

                      <!-- Modal cap nhat-->
                      <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel">Cập Nhật Thể Loại</h3>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <label class="block text-left text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tên Thể Loại</span>
                                <input placeholder="Nhập vào Tên Thể Loại" type="text" v-model="edit_the_loai.ten_loai"
                                  class="form-control">
                                <div v-if="errors.ten_loai" class="alert alert-warning">
                                  @{{ errors.ten_loai[0] }}
                                </div>
                              </label>


                              <label class="block text-left text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tên Danh Mục</span>
                                <select v-model="edit_the_loai.ma_danh_muc" class="form-control">
                                  <option v-for="(danhmuc, index) in data_danhmuc"
                                    :checked="danhmuc.id === theloai.ma_danh_muc" :value="danhmuc.id">
                                    @{{danhmuc.ten_danh_muc }}</option>
                                </select>
                                <div v-if="errors.ma_danh_muc" class="alert alert-warning">
                                  @{{ errors.ma_danh_muc[0] }}
                                </div>
                              </label>
                            </div>


                            <div class="modal-footer mt-3">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button v-on:click="cap_nhat_the_loai()" type="button" class="btn btn-primary">
                                Cập Nhật Thể Loại
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>

                </tbody>

              </table>

            </div>
          </div>
        </div>



      </div>

      <!-- MODAL DELETE -->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xác Nhận Xoá Dữ Liệu</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc muốn xoá dữ liệu này không?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
              <button type="button" class="btn btn-danger" v-on:click="kich_hoat_xoa_the_loai()"
                data-bs-dismiss="modal">Xoá</button>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- ===================================================================================
    ///  =============================== Danh Sách Thùng Rác =============================================
    ///  =================================================================================== -->
    
    <div class="tab-pane fade" id="nav-ThungRac" role="tabpanel" aria-labelledby="ThungRac" tabindex="0">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h3 class=" text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Các Thể Loại Đã Xoá</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <button class="btn btn-info mb-3" style="float: right;" data-bs-toggle="modal"
              data-bs-target="#onlyTrashedModal">Phục hồi tất cả</button>
              <table id="table_thungrac" class="table table-bordered">
                <thead clas="bg-primary">
                  <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Tên Thể Loại</th>
                    <th class="px-4 py-3">Tên Danh Mục</th>
                    <th class="px-4 py-3">Thao tác</th>
                  </tr>
                </thead>
                <tbody>

                  <tr v-for="(TrashTheLoai, key) in TrashTheLoai">
                    <td class="px-4 py-3">
                      @{{ key + 1 }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @{{ TrashTheLoai ? TrashTheLoai.ten_loai : 'Không có tên Thể Loại' }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @{{ TrashTheLoai.ten_danh_muc }}
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <button v-on:click="phuc_hoi = TrashTheLoai" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#ModalRecover">Phục Hồi</button>
                      <button v-on:click="xoa_cung = TrashTheLoai" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#forceDeleteModal" :disabled="TrashTheLoai.disabled">Xóa</button>
                    </td>
                  </tr>

                </tbody>
              </table>

              <span class="text-danger">* Không thể xoá thể loại Khi có dữ liệu liên quan tới sản phẩm</span>

            </div>
          </div>
        </div>
      </div>

      <!-- MODAL PHUC HOI -->
      <div class="modal fade" id="ModalRecover" tabindex="-1" role="dialog" aria-labelledby="RecoverModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="RecoverModalLabel">Xác Nhận Phục Hồi Dữ Liệu</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc muốn phục hồi dữ liệu này không?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
              <button type="button" class="btn btn-primary" v-on:click="kich_hoat_phuc_hoi()"
                data-bs-dismiss="modal">Phục Hồi</button>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL PHUC HOI TAT CA DU LIEU DA XOA-->
      <div class="modal fade" id="onlyTrashedModal" tabindex="-1" role="dialog" aria-labelledby="RecoverModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="RecoverModalLabel">Xác Nhận Phục Hồi Tất Cả Dữ Liệu</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc muốn phục hồi tất cả dữ liệu này không?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
              <button type="button" class="btn btn-primary" v-on:click="kich_hoat_phuc_hoi_tat_ca()"
                data-bs-dismiss="modal">Phục Hồi</button>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL DELETE -->
      <div class="modal fade" id="forceDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xác Nhận Xoá Dữ Liệu</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc muốn xoá vĩnh viễn dữ liệu này không?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
              <button type="button" class="btn btn-danger" v-on:click="kich_hoat_xoa_cung()"
                data-bs-dismiss="modal">Xoá</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

</main>
@endsection
@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#table_id').DataTable();
      $('#table_thungrac').DataTable();
    });
  </script>


<script>
  new Vue({
    el: '#app',
    data: {
      data_danhmuc: [],
      data_theloai: [],
      TrashTheLoai:  [],
      add_the_loai: {},
      edit_the_loai: {},
      xoa_the_loai: {},
      errors: {},
    },
    created() {
      this.GetData();
    },
    methods: {
      // hien thi danh sach the loai
      GetData() {
        axios
          .get('/admin/theloai/du-lieu')
          .then((res) => {
            this.data_danhmuc = res.data.data_danhmuc;
            this.data_theloai = res.data.data_theloai;
            this.TrashTheLoai = res.data.TrashTheLoai;

          });
      },
      cap_nhat(theloai) {
        this.edit_the_loai = theloai; // Tạo một bản sao của user để tránh ảnh hưởng trực tiếp đến dữ liệu người dùng
      },
      kich_hoat_xoa_the_loai() {
        axios
          .post('/admin/theloai/xoa', this.xoa_the_loai)
          .then((res) => {
            if (res.data.status) {
              const message = "Dữ liệu đã được xoá thành công!";
              toastr.success(message);
              this.GetData();
            } else {
              toastr.error('Có lỗi không mong muốn!');
            }
          })
      },
      them_the_loai() {
        axios
          .post('/admin/theloai', this.add_the_loai)
          .then((res) => {
            if (res.data.status) {
              toastr.success(res.data.message);
              this.GetData();
              // Tắt modal xác nhận
              $('#exampleModal').modal('hide');
            } else {
              toastr.error('Có lỗi không mong muốn! 1');
            }
          })
          .catch((error) => {
            if (error && error.response.data && error.response.data.errors) {
              this.errors = error.response.data.errors;
            } else {
              toastr.error('Có lỗi không mong muốn! 2');
            }
          })
      },
      cap_nhat_the_loai() {
        axios
          .post('/admin/theloai/cap-nhat', this.edit_the_loai)
          .then((res) => {
            if (res.data.status) {
              toastr.success(res.data.message);
              this.GetData();
              // Tắt modal xác nhận
              $('#ModalEdit').modal('hide');
            } else {
              toastr.error('Có lỗi không mong muốn! 1');
            }
          })
          .catch((error) => {
            if (error && error.response.data && error.response.data.errors) {
              this.errors = error.response.data.errors;
            } else {
              toastr.error('Có lỗi không mong muốn! 2');
            }
          })
      },

      // ==============================
      // ========= withTrashed ========
      // ==============================

      kich_hoat_xoa_cung() {
        axios
          .post('/admin/theloai/xoa-cung', this.xoa_cung)
          .then((res) => {
            if (res.data.status) {
              toastr.success(res.data.message);
              this.GetData();
            } else {
              toastr.error('Có lỗi không mong muốn!');
            }
          })
      },

      kich_hoat_phuc_hoi() {
        axios
          .post('/admin/theloai/phuc-hoi', this.phuc_hoi)
          .then((res) => {
            if (res.data.status) {
              toastr.success(res.data.message);
              this.GetData();
            } else {
              toastr.error('Có lỗi không mong muốn!');
            }
          })
      },

      kich_hoat_phuc_hoi_tat_ca() {
        axios
          .post('/admin/theloai/phuc-hoi-all')
          .then((res) => {
            if (res.data.status) {
              toastr.success(res.data.message);
              this.GetData();
            } else {
              toastr.error('Có lỗi không mong muốn!');
            }
          })
      }




    },

  });
</script>
@endsection
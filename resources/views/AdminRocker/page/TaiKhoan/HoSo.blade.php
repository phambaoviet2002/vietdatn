@extends('AdminRocker.share.master')
@section('noi_dung')

<div class="page-content" id="app" v-cloak>
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Hồ Sơ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="/admin/"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Hồ Sơ</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->
  <div class="container">
    <div class="main-body">
      <div class="row" style="height: auto;">
        <div class="col-lg-4">
          <div class="card" style="height: 100%;">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <div v-if="edit_user.hinh_anh" style="width: 100px; height: 100px; border-radius: 50%; box-shadow: 0 0 10px #000; align-content: center; display: grid; overflow: hidden;">
                  <img :src="edit_user.hinh_anh" alt="" style="width: 100px; ">
                </div>
                <i v-else class="bx bx-user user-img" style="font-size: 35px;
                  background-color: #333;
                  text-align: center;
                  color: #fff;
                  align-items: center;
                  width: 70px;
                  display: grid;
                  height: 70px;"></i>
                <div class="mt-3">
                  <h4>@{{ edit_user.ten_tai_khoan }}</h4>
                  <p class="text-secondary mb-1">@{{ edit_user.email }}</p>
                  <p class="text-muted font-size-sm">@{{ edit_user.dia_chi }}</p>
                  <button class="btn btn-outline-primary" v-for="phanquyen in data_phanquyen"
                    v-if="phanquyen.role_phan_quyen == edit_user.loai_tai_khoan">@{{ phanquyen.ten_phan_quyen
                    }}</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card" style="height: 100%;">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Họ và tên</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" v-model="edit_user.ten_tai_khoan" />
                  <div v-if="errors.ten_tai_khoan" class="alert alert-warning">
                    @{{ errors.ten_tai_khoan[0] }}
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" v-model="edit_user.email" />
                  <div v-if="errors.email" class="alert alert-warning">
                    @{{ errors.email[0] }}
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Hình Ảnh</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <div class="input-group">
                    <input id="hinh_anh_update" class="form-control" type="text" name="filepath">
                    <span class="input-group-prepend">
                      <a id="lfm_update" data-input="hinh_anh_update" data-preview="holder_update" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                      </a>
                    </span>
                  </div>
                  <div id="holder_update" style="margin-top:15px;max-height:100px;"></div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Số điện thoại</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" v-model="edit_user.so_dien_thoai" />
                  <div v-if="errors.so_dien_thoai" class="alert alert-warning">
                    @{{ errors.so_dien_thoai[0] }}
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Địa chỉ</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" v-model="edit_user.dia_chi" />
                  <div v-if="errors.dia_chi" class="alert alert-warning">
                    @{{ errors.dia_chi[0] }}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                  <button type="button" v-on:click="cap_nhap_ho_so()" class="btn btn-primary px-4">Cập nhật hồ
                    sơ</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')

<script>
  new Vue({
    el: "#app",

    data: {
      edit_user: {},
      errors: {},
    },

    created() {
      this.GetData();
    },

    methods: {
      GetData() {
        axios
          .get('/admin/ho-so/du-lieu')
          .then((res) => {
            this.edit_user = res.data.tai_khoan;
            $("#hinh_anh_update").val(this.edit_user.hinh_anh);
            var text = '<img src="'+ this.edit_user.hinh_anh + '" style="margin-top:15px;max-height:100px;">'
            $("#holder_update").html(text);
            this.data_phanquyen = res.data.data_phanquyen;
          });
      },

      cap_nhap_ho_so() {
        this.edit_user.hinh_anh = $("#hinh_anh_update").val();
        axios
          .post('/admin/ho-so/cap-nhat', this.edit_user)
          .then((res) => {
            if (res.data.status) {
              toastr.success(res.data.message);
              this.GetData();
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
      }
    }
  });
</script>

{{--  --}}
<script>
  var route_prefix = "/laravel-filemanager";
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
  $("#lfm_update").filemanager('image', {prefix : route_prefix});
</script>

@endsection
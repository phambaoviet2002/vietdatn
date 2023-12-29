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
        <h3>Hoá Đơn Chi Tiết</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#HoaDonModal">
            Thêm sản phẩm
          </button>
          <table id="table" class="table table-bordered">
            <thead clas="bg-primary">
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Tên Sản Phẩm</th>
                <th class="text-center">Hình Ảnh</th>
                <th class="text-center">Giá Sản Phẩm</th>
                <th class="text-center">Số Lượng</th>
                <th class="text-center">Mã Sảnm Phẩm</th>
                <th class="text-center">Thao Tác</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_hdct as $index => $hdct)
              <tr id="hdct_{{$hdct->id}}">
                <td class="align-middle text-center">{{$index + 1}}</td>
                <td class="align-middle text-center">{{$hdct->ten_san_pham}}</td>
                <td class="align-middle text-center d-flex justify-content-center">
                  <img class="secondary-img" width="100px" src="/img/{{$hdct->hinh_anh}}" alt="Hình ảnh sản phẩm">
                </td>
                <td class="align-middle text-center">{{@currency($hdct->giam_gia_san_pham)}}</td>
                <td class="align-middle text-center">{{$hdct->tong_so_luong}}</td>
                <td class="align-middle text-center">{{$hdct->ma_san_pham}}</td>
                <td class="align-middle text-center text-nowrap">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#XoaHDCTModal{{$hdct->id}}">
                    Xoá
                  </button>
                </td>
                
              </tr>
              <!-- MODAL DELETE -->
              <div class="modal fade" id="XoaHDCTModal{{$hdct->id}}" tabindex="-1" role="dialog" aria-labelledby="XoaHDCTModalLabel{{$hdct->id}}"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="XoaHDCTModalLabel{{$hdct->id}}">Xác Nhận Xoá Dữ Liệu</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Bạn có chắc muốn xoá dữ liệu này không?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                      <button type="button" class="btn btn-danger" onclick="xoa_hdct({{$hdct->id}})"
                        data-bs-dismiss="modal">Xoá</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END MODAL DELETE -->
              @endforeach
            </tbody>

          </table>

          <div class="row">
            <div class="col-md-6">
              <h5>
                <span class="font-bold">Địa chỉ nhận hàng : </span> 
                <span>{{ $data_hoadon->dia_chi }}</span> 
              </h5>
            </div>
            <div class="col-md-6">
              <h5 class="d-flex justify-content-end"> 
                <span class="font-bold">Tổng tiền : </span> 
                <span> {{@currency( $data_hoadon->tong_tien_tat_ca )}} </span>
              </h5>
            </div>
          </div>

          <!-- Modal them san pham-->
          <div class="modal fade" id="HoaDonModal" tabindex="-1" aria-labelledby="HoaDonModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">

                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="HoaDonModalLabel">Thêm sản phẩm</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow">
                  <div class="product-grid">
                    @foreach ($data_sanpham as $sanpham)
                    <form action="/admin/hoa-don/them-san-pham-hdct" method="post" enctype="multipart/form-data">@csrf
                      <div class="product-box">
                        <img src="/img/{{ $sanpham->hinh_anh }}" alt="Sản Phẩm 1">
                        <h3>{{ $sanpham->ten_san_pham }}</h3>
                        <p>Loại sản phẩm : <span>{{ $sanpham->ten_loai }}</span></p>
                        <p>Danh mục : <span>{{ $sanpham->ten_danh_muc }}</span></p>
                        <p class="price">{{ @currency($sanpham->giam_gia_san_pham) }}</p>
                        <input type="number" name="tong_so_luong" value="1" min="1" max="100" class="border-1 form-control">
                        <input type="hidden" name="ma_san_pham" value="{{ $sanpham->id }}">
                        <input type="hidden" name="ma_hoa_don" value="{{ $data_hoadon->id }}">
                        <input type="hidden" name="tong_tien_tat_ca" value="{{ $data_hoadon->tong_tien_tat_ca }}">
                        <input type="hidden" name="gia_san_pham" value="{{ $sanpham->gia_san_pham }}">
                        <input type="hidden" name="giam_gia_san_pham" value="{{ $sanpham->giam_gia_san_pham }}">
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary m-1">Thêm</button>
                        </div>
                      </div>
                    </form>
                    @endforeach
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- END them san pham -->



          <div></div>
        </div>
      </div>
    </div>


  </div>


  @endsection
  @section('js')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>

    function xoa_hdct(id) {
      var id = id;
      // console.log(id);
      $.ajax({
        url: "/admin/hoa-don/xoa-san-pham-hdct",
        type: "get",
        data: { idsp: id },
        success: function () {
          // $("#hdct_" + id).hide();
          window.location.reload();
          toastr.success("Sản phẩm đã được xoá thành công!");
        }
      });
    };


    new Vue({
      el: '#app',
      data: {
      },
      created() {
        this.GetData();
      },
      methods: {
        GetData() {
          axios
            .get('/admin/hoa-don/du-lieu')
        },


      }
    });
  </script>


  @endsection
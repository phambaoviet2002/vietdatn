@extends('AdminRocker.share.master')
@section('noi_dung')
<div class="row" id="app">

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="DanhSachTong" data-bs-toggle="tab" data-bs-target="#nav-DanhSachTong"
        type="button" role="tab" aria-controls="nav-DanhSachTong" aria-selected="true">Danh sách sản phẩm</button>
      <button class="nav-link" id="TrangThai" data-bs-toggle="tab" data-bs-target="#nav-TrangThai" type="button"
        role="tab" aria-controls="nav-TrangThai" aria-selected="false">Trạng thái</button>
      <!-- <button class="nav-link" id="DanhMuc" data-bs-toggle="tab" data-bs-target="#nav-DanhMuc" type="button" role="tab" aria-controls="nav-DanhMuc" aria-selected="false">Danh mục</button> -->
      <button class="nav-link" id="ThungRac" data-bs-toggle="tab" data-bs-target="#nav-ThungRac" type="button"
        role="tab" aria-controls="nav-ThungRac" aria-selected="false">Thùng rác</button>
    </div>
  </nav>

  <div class="tab-content" id="nav-tabContent">


    <!-- ===================================================================================
    ///  =============================== Danh Sách Tổng =============================================
    ///  =================================================================================== -->


    <div class="tab-pane fade show active" id="nav-DanhSachTong" role="tabpanel" aria-labelledby="DanhSachTong"
      tabindex="0">

      <div class="col-md-12 mb-3 mt-3">
        <div class="modal-category">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Thêm Sản
            Phẩm
          </button>

          <!-- Modal -->
          <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <form id="sanphamForm" method="post" action="/admin/sanpham" enctype="multipart/form-data">@csrf
                  <div class="modal-header">
                    <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300" id="exampleModalLabel">Thêm Sản
                      Phẩm</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body row">
                    <!-- ---------------- -->
                    <div class="col-md-9">
                      <div class="col-md-12 p-1 form-group-item">
                        <label>Tên Sản Phẩm</label>
                        <input name="ten_san_pham" type="text" class="form-control" placeholder="Nhập vào Tên Sản Phẩm"
                          required>
                      </div>

                      <div class="form-group col-md-12 p-1 form-group-item">
                        <label>Mô Tả</label>
                        <textarea name="mo_ta" id="mo_ta" class="form-control" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                    <!-- --------------- -->
                    <div class="col-md-3">
                      <div class="col-md-12 p-1 form-group-item">
                        <label>Mã Loại Sản Phẩm</label>
                        <select name="ma_loai" class="form-control" required>
                          <option value=""> _ _ _ Chon Mã Loại Sản Phẩm _ _ _</option>
                          @foreach($data_Loaisanpham as $Loaisanpham)
                          <option value="{{$Loaisanpham->id}}">
                            {{$Loaisanpham->ten_loai}} - (Danh muc : @foreach($data_danhmuc as $danhmuc)
                            @if($danhmuc->id ==
                            $Loaisanpham->ma_danh_muc) {{$danhmuc->ten_danh_muc}} @endif @endforeach)
                          </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12 p-1 form-group-item">
                        <label>Số Lượng</label>
                        <input name="so_luong" type="number" class="form-control" placeholder="Nhập Số Lượng" required>
                      </div>
                      <div class="col-md-12 p-1 form-group-item">
                        <label>Giá Bán</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <span class="glyphicon glyphicon-usd"></span>
                          </div>
                          <input name="gia_san_pham" type="number" class="form-control form-icon-trailing"
                            placeholder="Nhập Giá Bán" min="1" required>
                        </div>
                      </div>
                      <div class="col-md-12 p-1 form-group-item">
                        <label>Giảm giá</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                          </div>
                          <input name="phan_tram_giam_gia" type="number" class="form-control"
                            placeholder="Nhập Giảm giá" min="1" max="100">
                        </div>
                      </div>
                      <div class="col-md-12 p-1 form-group-item">
                        <label>Đặt Biệt</label>
                        <select name="dat_biet" class="form-control" required>
                          <option value=""> _ _ _ Chon Loại Đặt Biệt _ _ _</option>
                          <option value="0">Khong</option>
                          <option value="1">Co</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 p-1">
                        <label>Ảnh Sản Phẩm</label>
                        <input id="hinh_anh" class="form-control" type="file" accept="image/*" name="hinh_anh[]"
                          multiple required>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-submit btn-primary">Thêm Sản Phẩm</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Các Sản Phẩm</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table_id" class="table table-bordered">
                <thead clas="bg-primary">
                  <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Tên Sản Phẩm</th>
                    <th class="text-center">Giá Bán</th>
                    <th class="text-center">Giảm Giá</th>
                    <th class="text-center">Hình Ảnh</th>
                    <th class="text-center">Số Lượng</th>
                    <th class="text-center">Mô Tả</th>
                    <th class="text-center">Tên Loại</th>
                    <th class="text-center">Danh Mục</th>
                    <th class="text-center">Trạng Thái</th>
                    <th class="text-center">Thao Tác</th>
                  </tr>
                </thead>
                <tbody>

                  @if($sanPhamsWithInfo->isEmpty())
                  <tr>
                    <td class="align-middle text-center text-nowrap" colspan="11">Không có dữ liệu</td>
                  </tr>
                  @else
                  @php
                  $shownProducts = []; // Mảng để theo dõi sản phẩm đã hiển thị
                  @endphp
                  @foreach($sanPhamsWithInfo as $sanpham)
                  @if (!in_array($sanpham->id, $shownProducts))

                  <tr id="sanpham_{{$sanpham->id}}">
                    <td class="align-middle text-center">
                      {{$sanpham->id}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      {{ $sanpham->gia_san_pham }}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->giam_gia_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      <!-- -- Kiểm tra xem sản phẩm có hình ảnh hay không -- -->
                      @if ($sanpham->hinh_anh)
                      <img height="100" src="{{ asset('img/') }}/{{ $sanpham->hinh_anh }}"
                        title="{{ $sanpham->hinh_anh }}">
                      @else
                      <p>Không có hình ảnh cho sản phẩm này.</p>
                      @endif
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->so_luong}}
                    </td>
                    <td class="align-middle text-center">
                      {!!Str::limit($sanpham->mo_ta, $limit = 30, $end = '...')!!}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_loai}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_danh_muc}}
                    </td>
                    <td class="align-middle text-center">
                      <div class="form-check form-switch">
                        <input class="form-check-input" onclick="toggleStatus(<?php echo $sanpham->id; ?>)"
                          type="checkbox" @if($sanpham->trang_thai == 1) checked @endif role="switch"
                        id="flexSwitchCheckDefault">
                      </div>
                    </td>
                    <td class="align-middle text-center text-nowrap">
                      <!-- Button trigger modal -->
                      <a class="btn btn-primary" name="btn_edit" href="#" data-bs-toggle="modal"
                        data-bs-target="#ModalEdit{{$sanpham->id}}">Edit</a>
                      <button class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#DeleteListModal{{$sanpham->id}}">Xóa</button>
                    </td>

                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="DeleteListModal{{$sanpham->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-danger"
                              onclick="kich_hoat_xoa_san_pham({{$sanpham->id}})" data-bs-dismiss="modal">Xoá</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal cap nhat-->
                    <div class="modal fade" id="ModalEdit{{$sanpham->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="ModalEditLabel" aria-hidden="true">

                      <div class="modal-dialog modal-xl">

                        <div class="modal-content">
                          <form id="validate_update" method="post" action="capnhatsanpham/{{$sanpham->id}}"
                            enctype="multipart/form-data">@csrf
                            <div class="modal-header">
                              <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300"
                                id="exampleModalLabel_update">Cập Nhật Sản Phẩm</h3>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="card m-3">

                              <div class="card-header text-center">
                                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Danh Sách Hình Ảnh
                                </h3>
                              </div>

                              <div class="card-body">
                                <div class="row">
                                  @foreach($data_hinhanh as $hinhanh)
                                  @if($hinhanh->ma_san_pham == $sanpham->id)
                                  <div class="col-md-3" id="hinhanh_{{$hinhanh->id}}">
                                    <div>
                                      <img src="{{asset('img')}}/{{$hinhanh->hinh_anh}}" width="100" title="image">
                                    </div>
                                    <div class="text-center">
                                      <a class="btn btn-danger btn_delete"
                                        onclick="deleteImg(<?php echo $hinhanh->id; ?>)">xoa</a>
                                    </div>
                                  </div>
                                  @endif
                                  @endforeach

                                </div>
                              </div>
                            </div>

                            <div class="card m-3">
                              <div class="card-header text-center">
                                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Thông Tin Sản Phẩm
                                </h3>
                              </div>

                              <div class="modal-body row">
                                <!-- ---------------- -->
                                <div class="col-md-9">
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Tên Sản Phẩm</label>
                                    <input name="ten_san_pham" type="text" class="form-control"
                                      placeholder="Nhập vào Tên Sản Phẩm" value="{{$sanpham->ten_san_pham}}" required>
                                  </div>

                                  <div class="form-group col-md-12 p-1 form-group-item">
                                    <label>Mô Tả</label>
                                    <textarea name="mo_ta" id="update_mo_ta" class="form-control ckeditor" cols="30"
                                      rows="10">
                                      {{$sanpham->mo_ta}}
                                    </textarea>
                                  </div>
                                </div>
                                <!-- --------------- -->
                                <div class="col-md-3">
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Mã Loại Sản Phẩm</label>
                                    <select name="ma_loai" class="form-control" required>
                                      @foreach($data_Loaisanpham as $Loaisanpham)
                                      <option value="{{$Loaisanpham->id}}" @if($Loaisanpham->id == $sanpham->ma_loai)
                                        selected="selected"; @endif>
                                        {{$Loaisanpham->ten_loai}} - (Danh muc : @foreach($data_danhmuc as $danhmuc)
                                        @if($danhmuc->id == $Loaisanpham->ma_danh_muc) {{$danhmuc->ten_danh_muc}} @endif
                                        @endforeach)
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Số Lượng</label>
                                    <input name="so_luong" type="number" class="form-control"
                                      placeholder="Nhập Số Lượng" value="{{$sanpham->so_luong}}" required>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Giá Bán</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-usd"></span>
                                      </div>
                                      <input name="gia_san_pham" type="number" class="form-control"
                                        placeholder="Nhập Giá Bán" value="{{$sanpham->gia_san_pham}}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Giảm giá</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                      </div>
                                      <input name="phan_tram_giam_gia" type="number" class="form-control"
                                        placeholder="Nhập Giảm giá" value="{{$sanpham->phan_tram_giam_gia}}">
                                    </div>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Đặt Biệt</label>
                                    <select name="dat_biet" class="form-control" required>
                                      <option value="0" @if($sanpham->dat_biet == 0) selected="selected"; @endif>Khong
                                      </option>
                                      <option value="1" @if($sanpham->dat_biet == 1) selected="selected"; @endif>Co
                                      </option>
                                    </select>
                                  </div>
                                  <div class="form-group col-md-12 p-1">
                                    <label>Ảnh Sản Phẩm</label>
                                    <div class="input-group">
                                      <input id="hinh_anh_update" class="form-control" type="file" accept="image/*"
                                        name="hinh_anh[]" multiple>
                                    </div>
                                  </div>
                                </div>
                              </div>


                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                                <button type="submit" class="btn btn-submit btn-primary">Cập Nhật Sản Phẩm</button>
                              </div>
                            </div>
                          </form>
                        </div>

                      </div>
                    </div>
                    <!-- end modal cap nhat -->
                  </tr>

                  @php
                  $shownProducts[] = $sanpham->id;
                  @endphp
                  @endif
                  @endforeach
                  @endif

                </tbody>

              </table>

            </div>
            <div>{{$sanPhamsWithInfo->links('AdminRocker.share.custom')}}</div>

          </div>
        </div>
      </div>

    </div>


    <!-- ===================================================================================
    ///  =============================== Danh Sách Trạng Thái =============================================
    ///  =================================================================================== -->

    <div class="tab-pane fade" id="nav-TrangThai" role="tabpanel" aria-labelledby="TrangThai" tabindex="0">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Các Trạng Thái Sản Phẩm Đã Tắt
            </h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-bordered">
                <thead clas="bg-primary">
                  <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Tên Sản Phẩm</th>
                    <th class="text-center">Giá Bán</th>
                    <th class="text-center">Giảm Giá</th>
                    <th class="text-center">Hình Ảnh</th>
                    <th class="text-center">Số Lượng</th>
                    <th class="text-center">Mô Tả</th>
                    <th class="text-center">Tên Loại</th>
                    <th class="text-center">Danh Mục</th>
                    <th class="text-center">Trạng Thái</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @if($StatusSanPhamsWithInfo->isEmpty())
                  <tr>
                    <td class="align-middle text-center text-nowrap" colspan="11">Không có dữ liệu</td>
                  </tr>
                  @else
                  @php
                  $shownProducts = []; // Mảng để theo dõi sản phẩm đã hiển thị
                  @endphp
                  @foreach($StatusSanPhamsWithInfo as $sanpham)
                  @if (!in_array($sanpham->id, $shownProducts))

                  <tr id="statussanpham_{{$sanpham->id}}">
                    <td class="align-middle text-center">
                      {{$sanpham->id}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->gia_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->giam_gia_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      <!-- -- Kiểm tra xem sản phẩm có hình ảnh hay không -- -->
                      @if ($sanpham->hinh_anh)
                      <img height="100" src="{{ asset('img/') }}/{{ $sanpham->hinh_anh }}"
                        title="{{ $sanpham->hinh_anh }}">
                      @else
                      <p>Không có hình ảnh cho sản phẩm này.</p>
                      @endif
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->so_luong}}
                    </td>
                    <td class="align-middle text-center">
                      {!!Str::limit($sanpham->mo_ta, $limit = 30, $end = '...')!!}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_loai}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_danh_muc}}
                    </td>
                    <td class="align-middle text-center">
                      <div class="form-check form-switch">
                        <input class="form-check-input" onclick="toggleStatus(<?php echo $sanpham->id; ?>)"
                          type="checkbox" @if($sanpham->trang_thai == 1) checked @endif role="switch" >
                      </div>
                    </td>
                    <td class="align-middle text-center text-nowrap">
                      <!-- Button trigger modal -->
                      <a class="btn btn-primary" name="btn_edit" href="#" data-bs-toggle="modal"
                        data-bs-target="#ModalEditStatus{{$sanpham->id}}">Edit</a>
                      <button class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#DeleteStatusModal{{$sanpham->id}}">Xóa</button>
                    </td>

                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="DeleteStatusModal{{$sanpham->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-danger"
                              onclick="kich_hoat_xoa_san_pham({{$sanpham->id}})" data-bs-dismiss="modal">Xoá</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal cap nhat-->
                    <div class="modal fade" id="ModalEditStatus{{$sanpham->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="ModalEditStatusLabel" aria-hidden="true">

                      <div class="modal-dialog modal-xl">

                        <div class="modal-content">
                          <form id="validate_update" method="post" action="capnhatsanpham/{{$sanpham->id}}"
                            enctype="multipart/form-data">@csrf
                            <div class="modal-header">
                              <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300"
                                id="exampleModalLabel_update">Cập Nhật Sản Phẩm</h3>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="card m-3">

                              <div class="card-header text-center">
                                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Danh Sách Hình Ảnh
                                </h3>
                              </div>

                              <div class="card-body">
                                <div class="row">
                                  @foreach($data_hinhanh as $hinhanh)
                                  @if($hinhanh->ma_san_pham == $sanpham->id)
                                  <div class="col-md-3">
                                    <div>
                                      <img src="{{asset('img')}}/{{$hinhanh->hinh_anh}}" width="100" title="image">
                                    </div>
                                    <div class="text-center">
                                      <a class="btn btn-danger btn_delete"
                                        onclick="deleteImg(<?php echo $hinhanh->id; ?>)">xoa</a>
                                    </div>
                                  </div>
                                  @endif
                                  @endforeach

                                </div>
                              </div>
                            </div>

                            <div class="card m-3">
                              <div class="card-header text-center">
                                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Thông Tin Sản Phẩm
                                </h3>
                              </div>

                              <div class="modal-body row">
                                <!-- ---------------- -->
                                <div class="col-md-9">
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Tên Sản Phẩm</label>
                                    <input name="ten_san_pham" type="text" class="form-control"
                                      placeholder="Nhập vào Tên Sản Phẩm" value="{{$sanpham->ten_san_pham}}" required>
                                  </div>

                                  <div class="form-group col-md-12 p-1 form-group-item">
                                    <label>Mô Tả</label>
                                    <textarea name="mo_ta" id="update_mo_ta" class="form-control ckeditor" cols="30"
                                      rows="10">
                                      {{$sanpham->mo_ta}}
                                    </textarea>
                                  </div>
                                </div>
                                <!-- --------------- -->
                                <div class="col-md-3">
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Mã Loại Sản Phẩm</label>
                                    <select name="ma_loai" class="form-control" required>
                                      @foreach($data_Loaisanpham as $Loaisanpham)
                                      <option value="{{$Loaisanpham->id}}" @if($Loaisanpham->id == $sanpham->ma_loai)
                                        selected="selected"; @endif>
                                        {{$Loaisanpham->ten_loai}} - (Danh muc : @foreach($data_danhmuc as $danhmuc)
                                        @if($danhmuc->id == $Loaisanpham->ma_danh_muc) {{$danhmuc->ten_danh_muc}} @endif
                                        @endforeach)
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Số Lượng</label>
                                    <input name="so_luong" type="number" class="form-control"
                                      placeholder="Nhập Số Lượng" value="{{$sanpham->so_luong}}" required>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Giá Bán</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-usd"></span>
                                      </div>
                                      <input name="gia_san_pham" type="number" class="form-control"
                                        placeholder="Nhập Giá Bán" value="{{$sanpham->gia_san_pham}}" required>
                                    </div>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Giảm giá</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                      </div>
                                      <input name="phan_tram_giam_gia" type="number" class="form-control"
                                        placeholder="Nhập Giảm giá" value="{{$sanpham->phan_tram_giam_gia}}">
                                    </div>
                                  </div>
                                  <div class="col-md-12 p-1 form-group-item">
                                    <label>Đặt Biệt</label>
                                    <select name="dat_biet" class="form-control" required>
                                      <option value="0" @if($sanpham->dat_biet == 0) selected="selected"; @endif>Khong
                                      </option>
                                      <option value="1" @if($sanpham->dat_biet == 1) selected="selected"; @endif>Co
                                      </option>
                                    </select>
                                  </div>
                                  <div class="form-group col-md-12 p-1">
                                    <label>Ảnh Sản Phẩm</label>
                                    <div class="input-group">
                                      <input id="hinh_anh_update" class="form-control" type="file" accept="image/*"
                                        name="hinh_anh[]" multiple>
                                    </div>
                                  </div>
                                </div>
                              </div>


                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                                <button type="submit" class="btn btn-submit btn-primary">Cập Nhật Sản Phẩm</button>
                              </div>
                            </div>
                          </form>
                        </div>

                      </div>
                    </div>
                    <!-- end modal cap nhat -->

                  </tr>

                  @php
                  $shownProducts[] = $sanpham->id;
                  @endphp
                  @endif
                  @endforeach
                  @endif

                </tbody>

              </table>

            </div>
            <div>{{$StatusSanPhamsWithInfo->links('AdminRocker.share.custom')}}</div>
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
            <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Các Sản Phẩm Đã Xoá</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <button class="btn btn-info mb-3" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#onlyTrashedModal">Phục hồi tất cả</button>
              <table class="table table-bordered">
                <thead clas="bg-primary">
                  <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Tên Sản Phẩm</th>
                    <th class="text-center">Giá Bán</th>
                    <th class="text-center">Giảm Giá</th>
                    <th class="text-center">Hình Ảnh</th>
                    <th class="text-center">Số Lượng</th>
                    <th class="text-center">Mô Tả</th>
                    <th class="text-center">Tên Loại</th>
                    <th class="text-center">Danh Mục</th>
                    <th class="text-center">Trạng Thái</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @if($TrashSanPhamsWithInfo->isEmpty())
                  <tr>
                    <td class="align-middle text-center text-nowrap" colspan="11">Không có dữ liệu</td>
                  </tr>
                  @else
                  @php
                  $shownProducts = []; // Mảng để theo dõi sản phẩm đã hiển thị
                  @endphp
                  @foreach($TrashSanPhamsWithInfo as $sanpham)
                  @if (!in_array($sanpham->id, $shownProducts))

                  <tr id="trashsanpham_{{$sanpham->id}}">
                    <td class="align-middle text-center">
                      {{$sanpham->id}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->gia_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->giam_gia_san_pham}}
                    </td>
                    <td class="align-middle text-center">
                      <!-- -- Kiểm tra xem sản phẩm có hình ảnh hay không -- -->
                      @if ($sanpham->hinh_anh)
                      <img height="100" src="{{ asset('img/') }}/{{ $sanpham->hinh_anh }}"
                        title="{{ $sanpham->hinh_anh }}">
                      @else
                      <p>Không có hình ảnh cho sản phẩm này.</p>
                      @endif
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->so_luong}}
                    </td>
                    <td class="align-middle text-center">
                      {!!Str::limit($sanpham->mo_ta, $limit = 30, $end = '...')!!}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_loai}}
                    </td>
                    <td class="align-middle text-center">
                      {{$sanpham->ten_danh_muc}}
                    </td>
                    <td class="align-middle text-center">
                      <div class="form-check form-switch">
                        <input class="form-check-input" onclick="toggleStatus(<?php echo $sanpham->id; ?>)"
                          type="checkbox" @if($sanpham->trang_thai == 1) checked @endif role="switch" >
                      </div>
                    </td>
                    <td class="align-middle text-center text-nowrap">
                      <!-- Button trigger modal -->
                      <button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#ModalRecover{{$sanpham->id}}">Phục Hồi</button>
                      <button class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#DeleteTrashModal{{$sanpham->id}}" @if ($sanpham->disabled) disabled @endif
                        ">Xóa</button>
                    </td>

                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="DeleteTrashModal{{$sanpham->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-danger"
                              onclick="kich_hoat_xoa_cung_san_pham({{$sanpham->id}})"
                              data-bs-dismiss="modal">Xoá</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- MODAL PHUC HOI -->
                    <div class="modal fade" id="ModalRecover{{$sanpham->id}}" tabindex="-1" role="dialog"
                      aria-labelledby="RecoverModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-primary" onclick="kich_hoat_phuc_hoi({{$sanpham->id}})"
                              data-bs-dismiss="modal">Phục Hồi</button>
                          </div>
                        </div>
                      </div>
                    </div>


                    <!-- MODAL PHUC HOI TAT CA DU LIEU DA XOA-->
                    <div class="modal fade" id="onlyTrashedModal" tabindex="-1" role="dialog"
                      aria-labelledby="RecoverModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-primary" onclick="kich_hoat_phuc_hoi_tat_ca()"
                              data-bs-dismiss="modal">Phục Hồi</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>

                  @php
                  $shownProducts[] = $sanpham->id;
                  @endphp
                  @endif
                  @endforeach
                  @endif

                </tbody>

              </table>

              <span class="text-danger">* Không thể xoá sản phẩm khi có dữ liệu liên quan tới hoá đơn</span>

            </div>
            <div>{{$TrashSanPhamsWithInfo->links('AdminRocker.share.custom')}}</div>
          </div>
        </div>
      </div>



    </div>
  </div>




  <style>
    /* Màu đỏ khi có lỗi */
    .has-error {
      color: #a94442;
      border-color: #ebccd1;
    }

    /* Màu xanh khi không có lỗi */
    .has-success {
      color: #3c763d;
      border-color: #d6e9c6;
    }
  </style>
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



<!-- toggle status -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function toggleStatus(id) {
    var id = id;
    $.ajax({
      url: "/admin/toggleStatus",
      type: "get",
      data: { idsta: id },
      success: function ($trangthai) {
        if ($trangthai == 1) {
          toastr.success("Đã bật trạng thái sản phẩm!");
        } else {
          toastr.success("Đã tắt trạng thái sản phẩm!");
        }
      }
    });
  }

  // kich_hoat_xoa_san_pham
  function kich_hoat_xoa_san_pham(id) {
    var id = id;
    // console.log(id);
    $.ajax({
      url: "/admin/xoasanpham",
      type: "get",
      data: { idsp: id },
      success: function () {
        $("#statussanpham_" + id).hide();
        $("#sanpham_" + id).hide();
        toastr.success("Sản phẩm đã được xoá thành công!");
        // window.location.replace("./sanpham");
      }
    });
  }

  // kich_hoat_xoa_san_pham
  function kich_hoat_xoa_cung_san_pham(id) {
    var id = id;
    $.ajax({
      url: "{{asset('admin/sanpham/xoa-cung')}}",
      type: "get",
      data: { idtrashsp: id },
      success: function () {
        $("#trashsanpham_" + id).hide();
        toastr.success("Sản phẩm đã được xoá thành công!");
      }
    });
  }

  // kich_hoat_phuc_hoi_san_pham
  function kich_hoat_phuc_hoi(id) {
    var id = id;
    // console.log(id);
    $.ajax({
      url: "{{asset('admin/sanpham/phuc-hoi')}}",
      type: "get",
      data: { idrestore: id },
      success: function () {
        $("#trashsanpham_" + id).hide();
        toastr.success("Sản phẩm đã được phục hồi thành công!");
      }
    });
  }

  // kich_hoat_phuc_hoi_san_pham
  function kich_hoat_phuc_hoi_tat_ca() {
    $.ajax({
      url: "{{asset('admin/sanpham/phuc-hoi-all')}}",
      type: "get",
      data: {},
      success: function () {
        toastr.success("Tất cả sản phẩm đã được phục hồi thành công!");
        window.location.replace("./sanpham");
      }
    });
  }

  // deleteImg
  function deleteImg(id) {
    var id = id;
    $.ajax({
      url: "/admin/xoahinhanh",
      type: "get",
      data: { idImg: id },
      success: function () {
        $("#hinhanh_" + id).hide();
        toastr.success("Xoá hình ảnh sản phẩm thành công!");
      }
    });
  }

  function formatCurrency(value) {
    const formatter = new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
    });
    return formatter.format(value);
  }
</script>



<!-- validation -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
<script>
  $(document).ready(function () {
    $('#sanphamForm').validate({
      reles: {
        'ten_san_pham': {
          required: true,
        },
        'ma_loai': {
          required: true,
        },
        'gia_san_pham': {
          required: true,
        },
        'phan_tram_giam_gia': {
          min: 1,
          max: 100,
        },
        'hinh_anh[]': {
          required: true,
        },
        'so_luong': {
          required: true,
        },
        'dat_biet': {
          required: true,
        },
      },
      messages: {
        'ten_san_pham': "Vui lòng không được bỏ trống tên sản phẩm.",
        'ma_loai': "Vui lòng không được bỏ trống mã loại.",
        'gia_san_pham': "Vui lòng không được bỏ trống giá sản phẩm.",
        'phan_tram_giam_gia': {
          min: 'Vui lòng nhập giảm giá lớn hơn hoặc bằng 1.',
          max: 'Vui lòng nhập giảm giá nhỏ hơn hoặc bằng 100.'
        },
        'hinh_anh[]': "Vui lòng không được bỏ trống hình ảnh sản phẩm.",
        'so_luong': "Vui lòng không được bỏ trống số lượng sản phẩm.",
        'dat_biet': "Vui lòng không được bỏ trống đặt biệt.",
      },
      errorElement: "em",
      errorPlacement: function (error, element) {
        // Add the `help-block` class to the error element
        error.addClass("alert alert-warning");

        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function (element, errorClass, validClass) {
        $(element).parents(".form-group-item").addClass("has-error").removeClass("has-success");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".form-group-item").addClass("has-success").removeClass("has-error");
      }
    });
  });
</script>
<style>
  .alert.alert-warning {
    display: block;
    width: 100%;
  }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
<script>
  CKEDITOR.replace('mo_ta')
  CKEDITOR.replace('update_mo_ta'); // replace name mô tả
</script>
<!--  -->
@endsection
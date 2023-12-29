@extends('AdminRocker.share.master')
@section('noi_dung')
<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
  Danh Sách Bài Viết
</h4>
<div>
  <button @click="openModal" data-bs-toggle="modal" data-bs-target="#themModal" class="btn btn-primary">
    Thêm bài viết
  </button>
<br>
  <!-- Modal -->
  @include('AdminRocker/page/BaiViet/thembaiviet')
</div>


<!-- table -->
<div class="col-md-12">
  <div class="table-responsive" >
    <table id="table_id" class="table table-bordered">
      <thead clas="bg-primary">
        <tr class="">
          <th class="text-center">#</th>
          <th class="text-center">Tiêu Đề</th>
          <th class="text-center">Ảnh đại diện</th>
          <th class="text-center">Mô tả ngắn</th>
          <th class="text-center">Người đăng</th>
          <th class="text-center">Trạng thái</th>
          <th class="text-center">Ngày đăng</th>
          <th class="text-center">Thao tác</th>
        </tr>
      </thead>
      <tbody >
        @foreach($data_baiviet as $baiviet)
        <tr >

          <td class="align-middle text-center">
            {{$baiviet->id}}
          </td>
          <td class="align-middle text-center">
            

              
                <p class="font-semibold">{{substr($baiviet->ten_bai_viet, 0, 30)}}</p>
                @if($baiviet->loai_tin==1)
                <p class="text-xs text-gray-600 dark:text-gray-400">
                  Tin Khuyến Mãi
                </p>
                @else
                <p class="text-xs text-gray-600 dark:text-gray-400">
                  Tin Mới
                </p>
                @endif
              
            
          </td>
          <td class="align-middle text-center">
            <img max-height="20px" width="100px" src="{{ asset('img/') }}/{{$baiviet->hinh_anh}}" title="{{$baiviet->hinh_anh}}">

          </td>
          <td class="align-middle text-center">

            {{substr($baiviet->mo_ta_ngan, 0, 30) }}
          </td>
          <td class="align-middle text-center">
            {{$baiviet->ten_tai_khoan}}
          </td>
          <td class="align-middle text-center">
            <div class="form-check form-switch">
              <input class="form-check-input" onclick="doitrangthai(<?php echo $baiviet->id; ?>)" type="checkbox" @if($baiviet->hien_thi == 1) checked @endif role="switch" id="flexSwitchCheckDefault">
            </div>
            <!-- @if($baiviet->hien_thi==1)
            <button class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
              Hiện
            </button>
            @else
            <button class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
              Ẩn
            </button>

            @endif -->
          </td>
          <td class="align-middle text-center">
            {{$baiviet->created_at}}
          </td>
          <td class="align-middle text-center">
              <a class="btn btn-primary trigger-modal" data-bs-toggle="modal" data-bs-target="#capnhatModal{{$baiviet->id}}" href="" aria-label=" Edit">
              <i class="bx bx-edit"></i>
              </a>
              <a id="btn_delete" class="btn btn-danger btn_delete trigger-modal" href="baiviet/{{$baiviet->id}}" aria-label="Delete">
                <i class="bx bx-trash"></i>
              </a>
            
          </td>
        </tr>
        <!-- Modal cập nhật-->
        @include('AdminRocker/page/BaiViet/capnhat')
        <!-- modal show -->
        @include('AdminRocker/page/BaiViet/show')
        @endforeach
      </tbody>
    </table>
    <!-- <a  class="btn btn-primary" href="baiviet/khoiphuc" aria-label="">
      Khôi Phục
    </a> -->
  </div>

</div>

<!-- end table -->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#table_id').DataTable();
    });
  </script>


<script>
  function doitrangthai(id) {
    var id = id;
    $.ajax({
      url: "/admin/baiviet/doitrangthai",
      type: "get",
      data: {
        idsta: id
      },
      success: function($hienthi) {
        if ($hienthi == 1) {
          swal("Thay đổi trạng thái thành công!", "", "success");
        } else {
          swal("Thay đổi trạng thái thành công!", "", "success");
        }
      }
    });
  }
  const delBtnEl = document.querySelectorAll("#btn_delete");
  delBtnEl.forEach(function(delBtn) {
    delBtn.addEventListener("click", function(event) {
      const message = confirm("Bạn có chắc muốn xoá dữ liệu này không?");
      if (message == false) {
        event.preventDefault();
      }
    });
  });

  CKEDITOR.replace('noi_dung')

  CKEDITOR.replace('noi_dung_cap_nhat');
</script>
<script src="/assets_admin_rocker/js/init-alpine.js"></script>
<script src="/assets_admin_rocker/js/focus-trap.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection
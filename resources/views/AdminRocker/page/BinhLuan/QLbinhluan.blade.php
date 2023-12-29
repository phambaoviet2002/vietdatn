@extends('AdminRocker.share.master')
@section('noi_dung')
<main id="app" v-cloak>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="binhluansanpham" data-bs-toggle="tab" data-bs-target="#nav-binhluansanpham" type="button" role="tab" aria-controls="binhluansanpham" aria-selected="true">Bình luận sản phẩm</button>
            <button class="nav-link" id="binhluanbaiviet" data-bs-toggle="tab" data-bs-target="#nav-binhluanbaiviet" type="button" role="tab" aria-controls="binhluanbaiviet" aria-selected="false">Bình luận bài viết</button>
            <!-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> -->
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-binhluansanpham" role="tabpanel" aria-labelledby="binhluansanpham">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class=" text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Các Bình Luận</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered">
                                <thead clas="bg-primary">
                                    <tr class="">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Người đăng</th>
                                        <th class="text-center">Nội dung</th>
                                        <th class="text-center">Tên sản phẩm</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th class="text-center">Ngày đăng</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_binhluan_sanpham as $binhluan_sanpham)
                                    <tr>

                                        <td class="align-middle text-center">
                                            {{$binhluan_sanpham->id}}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{$binhluan_sanpham->ho_va_ten}}
                                        </td>

                                        <td class="align-middle text-center">

                                            {{substr($binhluan_sanpham->noi_dung, 0, 30) }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{$binhluan_sanpham->ten_san_pham}}
                                        </td>
                                        <td class="align-middle text-center">
                                            <img max-height="20px" width="100px" src="{{ asset('img/') }}/{{$binhluan_sanpham->hinh_anh}}" title="{{$binhluan_sanpham->hinh_anh}}">

                                        </td>
                                        <td class="align-middle text-center">
                                            {{$binhluan_sanpham->created_at}}

                                        </td>
                                        <td class="align-middle text-center">

                                        </td>
                                        <td class="align-middle text-center">
                                            <!-- <a class="btn btn-primary trigger-modal" data-bs-toggle="modal" data-bs-target="#capnhatModal{{$binhluan_sanpham->id}}" href="" aria-label=" Edit">
                                        <i class="bx bx-edit"></i>
                                    </a> -->
                                            <a id="btn_delete" class="btn btn-danger btn_delete trigger-modal" href="xoa-binh-luan-san-pham/{{$binhluan_sanpham->id}}" aria-label="Delete">
                                                <i class="bx bx-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="nav-binhluanbaiviet" role="tabpanel" aria-labelledby="binhluanbaiviet">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class=" text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Các Bình Luận</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_baiviet" class="table table-bordered">
                                <thead clas="bg-primary">
                                    <tr class="">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Người đăng</th>
                                        <th class="text-center">Nội dung</th>
                                        <th class="text-center">Tên sản phẩm</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th class="text-center">Ngày đăng</th>

                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_binhluan_baiviet as $binhluan_baiviet)
                                    <tr>

                                        <td class="align-middle text-center">
                                            {{$binhluan_baiviet->id}}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{$binhluan_baiviet->ho_va_ten}}
                                        </td>

                                        <td class="align-middle text-center">

                                            {{substr($binhluan_baiviet->noi_dung, 0, 30) }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{$binhluan_baiviet->ten_bai_viet}}
                                        </td>
                                        <td class="align-middle text-center">
                                            <img max-height="20px" width="100px" src="{{ asset('img/') }}/{{$binhluan_baiviet->hinh_anh}}" title="{{$binhluan_baiviet->hinh_anh}}">

                                        </td>
                                        <td class="align-middle text-center">
                                            {{$binhluan_baiviet->created_at}}

                                        </td>

                                        <td class="align-middle text-center">
                                            <!-- <a class="btn btn-primary trigger-modal" data-bs-toggle="modal" data-bs-target="#capnhatModal{{$binhluan_baiviet->id}}" href="" aria-label=" Edit">
                                        <i class="bx bx-edit"></i>
                                    </a> -->
                                            <a id="btn_delete" class="btn btn-danger btn_delete trigger-modal" href="xoa-binh-luan-bai-viet/{{$binhluan_baiviet->id}}" aria-label="Delete">
                                                <i class="bx bx-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div> -->
    </div>

</main>

@endsection
@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
        $('#table_baiviet').DataTable();
    });
</script>


<script>
    new Vue({
        el: '#app',
        data: {

        },
        created() {

        },
        methods: {


        },
    });

    const delBtnEl = document.querySelectorAll("#btn_delete");
    delBtnEl.forEach(function(delBtn) {
        delBtn.addEventListener("click", function(event) {
            const message = confirm("Bạn có chắc muốn xoá dữ liệu này không?");
            if (message == false) {
                event.preventDefault();
            }
        });
    });
</script>
@endsection
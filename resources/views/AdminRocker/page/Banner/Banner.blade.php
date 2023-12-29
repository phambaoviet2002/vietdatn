@extends('AdminRocker.share.master')
@section('noi_dung')
<!-- <main id="app" v-cloak> -->

<!-- thêm mã -->
<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Thêm Banner</button>
<br>
<div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">

        <form id="formbanner" method="post" action="/admin/banner" enctype="multipart/form-data">@csrf
            <label class="block text-sm">
                <label></label>
                <label>Ảnh banner</label>
                <input id="anh_banner" class="form-control" type="file" accept="image/*" name="anh_banner" required>
            </label>

            <label class="block text-sm">
                <label>Chọn bài viết</label>
                <select name="ma_bai_viet" id="" class="form-control" required>
                    @foreach($data_bai_viet as $bai_viet)
                    <option value="{{$bai_viet->id}}">{{$bai_viet->ten_bai_viet}}</option>
                    @endforeach
                </select>

            </label>
            <label class="block text-sm">
                <button type="reset" class="btn btn-secondary">
                    Huỷ
                </button>
                <button type="submit" class="btn btn-primary">
                    Thêm
                </button>
            </label>
        </form>

    </div>
</div>
<br>
<!-- danh sach -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header text-center">
            <h3 class=" text-lg font-semibold text-gray-600 dark:text-gray-300"> Danh Sách Banner</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table_id" class="table table-bordered">
                    <thead clas="bg-primary">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Ảnh Banner</th>
                            <th class="text-center">Liên kết bài viết</th>
                            <!-- <th class="text-center">Hiển thị</th> -->
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle text-center">
                                0
                            </td>
                            <td class="align-middle text-center">
                            <img max-height="20px" width="100px" src="https://charleroi-duty-free.com/media/contentmanager/content/GucciBloomNDF_banner_1920x1080(2).jpg" title="banner mặc định">

                            </td>
                            <td class="align-middle text-center">
                            Giới thiệu
                            </td>
                            <td class="align-middle text-center">
                            Mặc định
                            </td>
                        </tr>
                        @foreach($data_banner as $banner)
                        <tr>
                            <td class="align-middle text-center">
                                {{$banner->id}}
                            </td>
                            <td class="align-middle text-center text-sm">
                                <img max-height="20px" width="100px" src="{{ asset('img/') }}/{{$banner->anh_banner}}" title="{{$banner->anh_banner}}">
                            </td>
                            <td class="align-middle text-center text-sm">
                                {{$banner->ten_bai_viet}}
                            </td>
                            <!-- <td class="align-middle text-center text-sm">

                                </td> -->
                            <td class="align-middle text-center text-xs">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#capnhatModal{{$banner->id}}">Cập nhật</button>
                                <a id="btn_delete" class="btn btn-danger btn_delete trigger-modal" href="banner/xoa/{{$banner->id}}" aria-label="Delete">
                                    Xoá
                                </a>
                            </td>


                            <!-- <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Xoá</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                        </tr>

                        <!-- Modal cap nhat-->
                        <div class="modal fade" id="capnhatModal{{$banner->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">

                                    <form method="post" action="/admin/banner/capnhat/{{$banner->id}}" enctype="multipart/form-data">@csrf
                                        <div class="modal-header">
                                            <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300" id="exampleModalLabel">Cập Nhật </h3>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="block text-sm">
                                                <label>Ảnh banner</label>
                                                <img class="justify-content-center" max-height="200px" width="400px" src="{{ asset('img/') }}/{{$banner->anh_banner}}" title="{{$banner->anh_banner}}">
                                                <br>
                                                <input id="anh_banner" class="form-control" type="file" accept="image/*" name="anh_banner" required>
                                            </label>

                                            <label class="block text-sm">
                                                <label>Chọn bài viết</label>
                                                <select name="ma_bai_viet" id="" class="form-control" required>
                                                    @foreach($data_bai_viet as $bai_viet)
                                                    <option value="{{$bai_viet->id}}">{{$bai_viet->ten_bai_viet}}</option>
                                                    @endforeach
                                                </select>

                                            </label>

                                        </div>

                                        <div class="modal-footer mt-3">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">
                                                Cập Nhật
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- </main> -->

@endsection
@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
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
<script>
    // new Vue({
    //     el: '#app',
    //     data: {
    //         data_banner: [],
    //         data_bai_viet: [],

    //         errors: {},
    //         xoa: {},
    //     },
    //     created() {

    //     },
    //     methods: {


    //     },
    // });
</script>
@endsection
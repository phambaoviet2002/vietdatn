@extends('AdminRocker.share.master')
@section('noi_dung')
<div class="row" id="app" v-cloak>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Danh sách liên hệ chờ xử lý
            </div>
            <div class="card-body">
                <table id="table_id" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Họ Và Tên</th>
                            <th class="text-center">Số Điện Thoại</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Nội Dung</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, key) in ds_lien_he">
                            <th>@{{ key + 1 }}</th>
                            <td>@{{ item.ten_khach_hang }}</td>
                            <td>@{{ item.so_dien_thoai }}</td>
                            <td>@{{ item.email }}</td>
                            <td>@{{ item.noi_dung }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning" v-if="item.xu_ly === 0">Chưa đọc</button>
                                <button class="btn btn-success" v-else>Đã đọc</button>
                            </td>
                            <td class="text-center">
                                <button v-on:click="xem_lien_he(item)" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#viewModal">Xem</button>
                                <button v-on:click="xoa_lien_he = item" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Xóa</button>
                            </td>

                        </tr>

                    </tbody>
                </table>

                <!-- Modal XEM-->
                <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="viewModalLabel">Nội dung liên hệ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" v-if="thong_tin_lien_he">
                                <h6>Gmail khách hàng : @{{thong_tin_lien_he.email}}</h6>
                                <div class="box_lienhe p-2" style="border: 1px solid rgb(212 212 212); border-radius: 7px;">
                                    <p>@{{thong_tin_lien_he.noi_dung}}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal XOA-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Bạn Có chắc muốn xóa không
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button v-on:click="kich_hoat_xoa_lien_he()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Xóa</button>
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
            ds_lien_he: [],
            xoa_lien_he: {},
            thong_tin_lien_he: {},
        },
        created() {
            this.loadData();

        },
        methods: {
            
            loadData() {
                axios
                    .get('/admin/lien-he/du-lieu')
                    .then((res) => {
                        this.ds_lien_he = res.data.du_lieu;
                    });
            },
            kich_hoat_xoa_lien_he() {
                axios
                    .post('/admin/lien-he/xoa-lien-he', this.xoa_lien_he)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                        } else {
                            toastr.error('Có lỗi không mong muốn!');
                        }
                    })
            },
            xem_lien_he(item) {
                this.thong_tin_lien_he = item;
                axios
                    .post('/admin/lien-he/xem-lien-he', this.thong_tin_lien_he)
                    .then(() => {
                        this.loadData();
                    })
            },

        }
    });
</script>
@endsection
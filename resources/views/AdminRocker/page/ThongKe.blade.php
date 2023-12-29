@extends('AdminRocker.share.master')
@section('noi_dung')
<div id="app" v-cloak>
  <h5 class="text-center">THỐNG KÊ DOANH SỐ</h5>
  <hr>
  <div class="d-flex">
    <div class="m-3">
      <label for="">Từ ngày</label>
      <input class="form-control" type="text" id="datepicker">
    </div>
    <div class="m-3">
      <label for="">Đến ngày</label>
      <input class="form-control" type="text" id="datepicker2">
    </div>
    <div class="m-3" style="align-content: end;display: grid;">
      <button class="btn btn-primary mt-3" type="button" v-on:click="cap_nhat_ngay()">
        Cập nhật
      </button>
    </div>
  </div>
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-info">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Tổng số đơn đặt hàng</p>
              <h4 class="my-1 text-info">@{{ tongSoDonHang }}</h4>
              <p class="mb-0 font-13">@{{ phanTramDonHang }}% so với tuần trước</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                class="bx bxs-cart"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-danger">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Tổng doanh thu</p>
              <h4 class="my-1 text-danger">$@{{ formatCurrency(TongDoanhThu) }}</h4>
              <p class="mb-0 font-13">@{{ phanTramDoanhThu }}% so với tuần trước</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                class="bx bxs-wallet"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-success">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Tổng sản phẩm</p>
              <h4 class="my-1 text-success">@{{ tongSoSanPham }}</h4>
              <p class="mb-0 font-13">@{{ phanTramSanPham }}% so với tuần trước</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                class="bx bxs-basket"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-warning">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Tổng số khách hàng</p>
              <h4 class="my-1 text-warning">@{{ tongSoKhachHang }}</h4>
              <p class="mb-0 font-13">@{{ phanTramTaiKhoan }}% so với tuần trước</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                class="bx bxs-group"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">


    <div class="col-12 col-lg-4 col-xl-4 d-flex">
      <div class="card w-100 radius-10">
        <div class="card-body" style="height: 365px;">
          <div class="card radius-10 border shadow-none mb-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <p class="mb-0 text-secondary">Tổng số lượt thích</p>
                  <h4 class="my-1">@{{ tongSoSanPhamYeuThich }}</h4>
                  <!-- <p class="mb-0 font-13">+6.2% from last week</p> -->
                </div>
                <div class="widgets-icons-2 bg-gradient-cosmic text-white ms-auto"><i class='bx bxs-heart-circle'></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card radius-10 border shadow-none mb-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <p class="mb-0 text-secondary">Tổng số bình luận sản phẩm</p>
                  <h4 class="my-1">@{{ tongSoBinhLuan }}</h4>
                  <!-- <p class="mb-0 font-13">+3.7% from last week</p> -->
                </div>
                <div class="widgets-icons-2 bg-gradient-ibiza text-white ms-auto"><i class='bx bxs-comment-detail'></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card radius-10 border shadow-none mb-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <p class="mb-0 text-secondary">Tổng số lượt liên hệ</p>
                  <h4 class="my-1">@{{ tongSoLienHe }}</h4>
                  <!-- <p class="mb-0 font-13">+4.6% from last week</p> -->
                </div>
                <div class="widgets-icons-2 bg-gradient-moonlit text-white ms-auto"><i class='bx bx-phone'></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <div class="col-12 col-lg-8">
      <div class="card radius-10">
        <div class="card-body" style="height: 365px;">
          <div class="d-flex align-items-center">
            <div>
              <h4 class="mb-3">Khách hàng đặt hàng nhiều nhất</h4>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Tên khách hàng</th>
                  <th>Gmail</th>
                  <th>ID khách hàng</th>
                  <th>Tổng tiền</th>
                  <th>Ngày tạo</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(KhachHang, key) in topKhachHangs">
                  <td>@{{KhachHang.ho_va_ten}}</td>
                  <td>@{{KhachHang.email}}</td>
                  <td>@{{KhachHang.ma_khach_hang}}</td>
                  <td>@{{ formatCurrency(KhachHang.tong_tien_mua) }}</td>
                  <td>@{{KhachHang.created_at_KH}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row" style="height: auto;">
    <div class="col-12 col-lg-4">
      <div class="card radius-10" style="height: 100%; display: grid; align-content: space-between;"
        style="justify-content: center; display: grid; padding: 10px 0;">
        <div class="card-header bg-transparent">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Biểu đồ sản phẩm yêu thích theo danh mục</h6>
            </div>
          </div>
        </div>
        <div id="columnchart_values"></div>
        <ul class="list-group list-group-flush"></ul>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card radius-10" style="height: 100%; display: grid; align-content: space-between;">
        <div class="card-header bg-transparent">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Biểu đồ khách hàng</h6>
            </div>
          </div>
        </div>

        <div id="donutchart">

        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Huỷ tài khoản
            <span class="badge bg-primary rounded-pill">@{{ TaiKhoanHuy }}</span>
          </li>
          <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Chưa kích hoạt
            <span class="badge bg-danger rounded-pill">@{{ TaiKhoanChuaKH }}</span>
          </li>
          <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Khách hàng <span
              class="badge bg-warning rounded-pill">@{{ TaiKhoanKhachHang }}</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card radius-10 " style="height: 100%; display: grid; align-content: space-between;">
        <div class="card-header bg-transparent">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Biểu đồ sản phẩm theo danh mục</h6>
            </div>
          </div>
        </div>

        <div id="piechart"></div>

        <ul class="list-group list-group-flush">
          <li v-for="(danhmuc, key) in DemTatCaSanPham"
            class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
            @{{ danhmuc[0].ten_danh_muc }}
            <span :class="'badge rounded-pill ' + mauDanhMuc(parseInt(key))">@{{ danhmuc[0].so_luong_san_pham }}</span>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection
@section('js')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  $(function () {
    $("#datepicker").datepicker({
      prevText: "tháng trước",
      nextText: "tháng sau",
      dateFormat: "yy/mm/dd",
      dayNamesMin: [
        "Thứ 2",
        "Thứ 3",
        "Thứ 4",
        "Thứ 5",
        "Thứ 6",
        "Thứ 7",
        "Chủ nhật",
      ],
      monthNames: [
        "Tháng 1",
        "Tháng 2",
        "Tháng 3",
        "Tháng 4",
        "Tháng 5",
        "Tháng 6",
        "Tháng 7",
        "Tháng 8",
        "Tháng 9",
        "Tháng 10",
        "Tháng 11",
        "Tháng 12",
      ],
      duration: "slow",
    });
    $("#datepicker2").datepicker({
      prevText: "tháng trước",
      nextText: "tháng sau",
      dateFormat: "yy/mm/dd",
      dayNamesMin: [
        "Thứ 2",
        "Thứ 3",
        "Thứ 4",
        "Thứ 5",
        "Thứ 6",
        "Thứ 7",
        "Chủ nhật",
      ],
      monthNames: [
        "Tháng 1",
        "Tháng 2",
        "Tháng 3",
        "Tháng 4",
        "Tháng 5",
        "Tháng 6",
        "Tháng 7",
        "Tháng 8",
        "Tháng 9",
        "Tháng 10",
        "Tháng 11",
        "Tháng 12",
      ],
      duration: "slow",
    });
  });
</script>

<script>

  new Vue({
    el: '#app',
    data: {

      phanTramTaiKhoan: 0,
      phanTramDoanhThu: 0,
      phanTramDonHang: 0,
      tongSoKhachHang: 0,
      tongSoDonHang: 0,
      tongSoSanPhamYeuThich: 0,
      tongSoBinhLuan: 0,
      tongSoLienHe: 0,
      TongDoanhThu: 0,
      TaiKhoanHuy: 0,
      TaiKhoanChuaKH: 0,
      TaiKhoanKhachHang: 0,
      data_danhmuc: [],
      DemTatCaSanPham: [],
      topKhachHangs: [],
      tongSoSanPham: 0,
      phanTramSanPham: 0,
    },
    created() {
      this.GetData();
    },
    methods: {
      GetData() {
        axios
          .get('/admin/du-lieu')
          .then((res) => {
            this.phanTramTaiKhoan = res.data.phanTramTaiKhoan;
            this.phanTramDoanhThu = res.data.phanTramDoanhThu;
            this.phanTramDonHang = res.data.phanTramDonHang;
            this.tongSoKhachHang = res.data.tongSoKhachHang
            this.tongSoDonHang = res.data.tongSoDonHang;
            this.TongDoanhThu = res.data.TongDoanhThu;
            this.TaiKhoanHuy = res.data.TaiKhoanHuy;
            this.TaiKhoanChuaKH = res.data.TaiKhoanChuaKH;
            this.TaiKhoanKhachHang = res.data.TaiKhoanKhachHang;
            this.data_danhmuc = res.data.data_danhmuc;
            this.DemTatCaSanPham = res.data.DemTatCaSanPham;
            this.topKhachHangs = res.data.topKhachHangs;
            this.tongSoSanPham = res.data.tongSoSanPham;
            this.tongSoSanPhamYeuThich = res.data.tongSoSanPhamYeuThich;
            this.tongSoBinhLuan = res.data.tongSoBinhLuan;
            this.tongSoLienHe = res.data.tongSoLienHe;
            this.phanTramSanPham = res.data.phanTramSanPham;

            // console.log(Object.keys(this.DemTatCaSanPham).length);
            // if (this.DemTatCaSanPham && Object.keys(this.DemTatCaSanPham).length > 0) {
            //   for (const key in this.DemTatCaSanPham) {
            //     if (this.DemTatCaSanPham.hasOwnProperty(key)) {
            //       const demSanPham = this.DemTatCaSanPham[key][0];
            //       console.log(demSanPham.ten_danh_muc);
            //     }
            //   }
            // } else {
            //   console.log('Dữ liệu không tồn tại hoặc là rỗng.');
            // }

            this.drawChart(
              this.TaiKhoanHuy,
              this.TaiKhoanChuaKH,
              this.TaiKhoanKhachHang,
            );

            this.columnchart_material();
          });
      },

      cap_nhat_ngay() {
        var tuNgay = $("#datepicker").val();
        var denNgay = $("#datepicker2").val();
        axios
          .post('/admin/du-lieu', {
            tuNgay: tuNgay,
            denNgay: denNgay,
          })
          .then((res) => {
            this.tongSoKhachHang = res.data.tongSoKhachHang
            this.tongSoSanPham = res.data.tongSoSanPham;
            this.tongSoSanPhamYeuThich = res.data.tongSoSanPhamYeuThich;
            this.tongSoBinhLuan = res.data.tongSoBinhLuan;
            this.tongSoLienHe = res.data.tongSoLienHe;
            this.tongSoDonHang = res.data.tongSoDonHang;
            this.TongDoanhThu = res.data.TongDoanhThu;
            this.topKhachHangs = res.data.topKhachHangs;
            this.TaiKhoanHuy = res.data.TaiKhoanHuy;
            this.TaiKhoanChuaKH = res.data.TaiKhoanChuaKH;
            this.TaiKhoanKhachHang = res.data.TaiKhoanKhachHang;
            this.DemTatCaSanPham = res.data.DemTatCaSanPham;


            this.drawChart(
              this.TaiKhoanHuy,
              this.TaiKhoanChuaKH,
              this.TaiKhoanKhachHang,
            );
          })
      },

      drawChart(TaiKhoanHuy, TaiKhoanChuaKH, TaiKhoanKhachHang,) {
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(() => {

          var data_donutchart = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Huỷ tài khoản', TaiKhoanHuy],
            ['Chưa kích hoạt', TaiKhoanChuaKH],
            ['Khách hàng', TaiKhoanKhachHang],
          ]);

          var options_donutchart = {
            pieHole: 0.4,
            height: 270,
            legend: 'none',
            pieSliceText: 'label', // 'none', 'label', 'value', 'percentage'
          };

          var chart_donutchart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart_donutchart.draw(data_donutchart, options_donutchart);

          // end chart donutchart ==================================

          var data_piechart = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            // Sử dụng map để tạo mảng con từ this.DemTatCaSanPham
            ...Object.keys(this.DemTatCaSanPham).map((key) => {
              const demSanPham = this.DemTatCaSanPham[key][0];
              return [demSanPham.ten_danh_muc, demSanPham.so_luong_san_pham];
            })
          ]);

          var options_piechart = {
            legend: 'none',
            height: 270,
          };

          var chart_piechart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart_piechart.draw(data_piechart, options_piechart);

          // end chart piechart =====================================

          var data_columnchart_values = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" }],
            ...Object.keys(this.DemTatCaSanPham).map((key) => {
              const demSanPham = this.DemTatCaSanPham[key][0];
              return [demSanPham.ten_danh_muc, demSanPham.so_luong_san_pham_yeu_thich, "#2d8f00"];
            })
          ]);

          var view_columnchart_values = new google.visualization.DataView(data_columnchart_values);
          view_columnchart_values.setColumns([0, 1,
            {
              calc: "stringify",
              sourceColumn: 1,
              type: "string",
              role: "annotation"
            },
            2]);

          var options_columnchart_values = {
            // title: "Density of Precious Metals, in g/cm^3",
            // width: 600,
            height: 350,
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view_columnchart_values, options_columnchart_values);

          // end chart columnchart_values =====================================


        });
      },

      columnchart_material() {
        google.charts.load('current', { 'packages': ['bar'] });
        google.charts.setOnLoadCallback(() => {
          var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses', 'Profit'],

            ['01', 887, 542, 633],
            ['02', 1000, 400, 200],
            ['03', 1000, 400, 200],
            ['04', 1000, 400, 200],
            //   ['05', 1000, 400, 200],
            //   ['06', 1000, 400, 200],
            //   ['07', 1000, 400, 200],
            //   ['08', 1000, 400, 200],
            //   ['09', 1000, 400, 200],
            //   ['10', 1000, 400, 200],
            //   ['11', 1000, 400, 200],
            //   ['12', 1000, 400, 200],
          ]);

          var options = {
            chart: {
              // title: 'Company Performance',
              subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            }
          };

          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
        });

      },

      mauDanhMuc(role) {
        switch (role) {
          case 1:
            return 'bg-primary';
          case 2:
            return 'bg-danger';
          case 3:
            return 'bg-warning';
          default:
            return 'bg-muted';
        }
      },

      formatCurrency(value) {
        const formatter = new Intl.NumberFormat('vi-VN', {
          style: 'currency',
          currency: 'VND',
        });
        return formatter.format(value);
      },
    },

  });

</script>


@endsection
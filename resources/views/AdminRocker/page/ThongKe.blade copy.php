@extends('AdminRocker.share.master')
@section('noi_dung')
<div id="app" v-cloak>
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
              <p class="mb-0 text-secondary">Bounce Rate</p>
              <h4 class="my-1 text-success">34.6%</h4>
              <p class="mb-0 font-13">-4.5% so với tuần trước</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                class="bx bxs-bar-chart-alt-2"></i>
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

    <div class="col-12 col-lg-4">
      <div class="card radius-10">
        <div id="donutchart" style="height: 400px;">
          
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-8">
      <div class="card radius-10">
        <div class="card-body" style="height: 400px;">
          <div class="d-flex align-items-center">
            <div>
              <h4 class="mb-3">Khách hàng đặt hàng nhiều nhất</h4>
            </div>
            <!-- <div class="dropdown ms-auto">
              <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                  class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
              </ul>
            </div> -->
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
                <tr v-for="(KhachHang, key) in topKhachHangs" >
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
  <div class="row">
    <div class="col-12 col-lg-6">
      <div class="card radius-10" style="justify-content: center; display: grid; padding: 10px 0;">
        <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>

  new Vue({
    el: '#app',
    data: {

      phanTramTaiKhoan: 0,
      phanTramDoanhThu: 0,
      phanTramDonHang: 0,
      tongSoKhachHang: 0,
      tongSoDonHang: 0,
      TongDoanhThu: 0,
      TaiKhoanHuy: 0,
      TaiKhoanChuaKH: 0,
      TaiKhoanKhachHang: 0,
      data_danhmuc: [],
      DemTatCaSanPham: [],
      topKhachHangs: [],
      // data_TaiKhoan: [],
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
            // this.data_TaiKhoan = res.data.data_TaiKhoan;

            this.drawChart(
              this.TaiKhoanHuy,
              this.TaiKhoanChuaKH,
              this.TaiKhoanKhachHang,
            ); 

            this.columnchart_material();
          });
      },

      drawChart(TaiKhoanHuy, TaiKhoanChuaKH, TaiKhoanKhachHang,) {
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(() => {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Huỷ tài khoản', TaiKhoanHuy],
            ['Chưa kích hoạt', TaiKhoanChuaKH],
            ['Khách hàng', TaiKhoanKhachHang],
          ]);

          var options = {
            title: 'Biểu đồ khách hàng',
            pieHole: 0.4,
            legend: 'bottom',
            pieSliceText: 'label', // 'none', 'label', 'value', 'percentage'

          };

          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart.draw(data, options);
        });
      },

      columnchart_material() {
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(() => {
        //   var data = google.visualization.arrayToDataTable([
        //   // ['Tháng', this.DemTatCaSanPham.forEach((danhmuc) => {
        //   //     data.addColumn('number', danhmuc.ten_danh_muc);
        //   //   });
        //   // ],
        //   ['01', '1', '2', '3'],
        //   ['02', 1000, 400, 200],
        //   ['03', 1000, 400, 200],
        //   ['04', 1000, 400, 200],
        // //   ['05', 1000, 400, 200],
        // //   ['06', 1000, 400, 200],
        // //   ['07', 1000, 400, 200],
        // //   ['08', 1000, 400, 200],
        // //   ['09', 1000, 400, 200],
        // //   ['10', 1000, 400, 200],
        // //   ['11', 1000, 400, 200],
        // //   ['12', 1000, 400, 200],
        // ]);
        // Tạo mảng dữ liệu với các cột đầu tiên là 'Tháng', sau đó là tên danh mục và số lượng sản phẩm tương ứng
          var dataTable = [['Tháng']];
          
          // Lặp qua mảng DemTatCaSanPham để thêm tên danh mục vào đầu mảng dữ liệu
          this.DemTatCaSanPham.forEach((demSanPham) => {
            dataTable[0].push(demSanPham.ten_danh_muc);
          });
        // // Thêm cột cho biểu đồ
        // data.addColumn('string', 'Tháng');
        
        // // Thêm cột cho mỗi loại sản phẩm
        // this.data_danhmuc.forEach((danhmuc) => {
        //   data.addColumn('number', danhmuc.ten_danh_muc);
        // });

        // // Thêm dữ liệu từ DemTatCaSanPham
        // var rows = [];
        // Object.entries(this.DemTatCaSanPham).forEach(([danhmucId, demSanPham]) => {
        //   var row = [danhmucId];
        //   this.data_danhmuc.forEach((danhmuc) => {
        //     var count = 0;
        //     demSanPham.forEach((dem) => {
        //       if (dem.ma_danh_muc == danhmuc.id) {
        //         count = dem.so_luong_san_pham;
        //       }
        //     });
        //     row.push(count);
        //   });
        //   rows.push(row);
        // });

        // data.addRows(rows);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      });

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
<div class="topbar d-flex align-items-center">
	<nav class="navbar navbar-expand">
		<div class="topbar-logo-header">
			<div class="">
				<img src="/assets_admin_rocker/images/icon-admin.jpeg" class="logo-icon" alt="logo icon" style="width: 50px;">
			</div>
			<div class="">
				<h4 class="logo-text">GUCCI</h4>
			</div>
		</div>
		<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
		<div class="search-bar flex-grow-1">
			<div class="position-relative search-bar-box">
				<input type="text" class="form-control search-control" placeholder="Type to search..."> <span
					class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
				<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
			</div>
		</div>
		<div class="top-menu ms-auto">
			<ul class="navbar-nav align-items-center">
				<li class="nav-item mobile-search-icon">
					<a class="nav-link" href="#"> <i class='bx bx-search'></i>
					</a>
				</li>

				<li class="nav-item dropdown dropdown-large">

					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button"
						data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">{{$LIENHE_xu_ly}}</span>
						<i class='bx bx-bell'></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a href="javascript:;">
							<div class="msg-header">
								<p class="msg-header-title">Thông báo liên hệ</p>
							</div>
						</a>
						<div class="header-notifications-list">
							@foreach ($LIENHE as $lienhe)
								<div class="d-flex align-items-center p-3">
									<div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
									</div>
									<div class="flex-grow-1">
										<h6 class="msg-name">
											{{$lienhe->ten_khach_hang}}
											<!-- <span class="msg-time float-end">14 phút trước</span> -->
										</h6>
										<p class="msg-info">{!!Str::limit($lienhe->noi_dung, $limit = 20, $end = '...')!!}</p>
									</div>
								</div>
							</button>
							@endforeach
							
						</div>
						<a href="javascript:;">
							<div class="text-center msg-footer">Xem tất cả thông báo</div>
						</a>
					</div>
				</li>

			</ul>
		</div>
		<div class="user-box dropdown" style="padding-left: 20px">
			<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
				data-bs-toggle="dropdown" aria-expanded="false">
				@if($TaiKhoanDangNhap->hinh_anh)

				<div style="width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 0 10px #000; align-content: center; display: grid; overflow: hidden;">
					<img src="{{$TaiKhoanDangNhap->hinh_anh}}" alt="" style="width: 40px; ">
				</div>
				@else
				<i class="bx bx-user user-img" style="font-size: 25px;
                  background-color: #333;
                  text-align: center;
                  color: #fff;
                  align-items: center;"></i>
				@endif
				<div class="user-info ps-3">
					<p class="user-name mb-0"></p>
					<p class="designattion mb-0"></p>
				</div>
			</a>
			<ul class="dropdown-menu dropdown-menu-end">
				<li>
					<a class="dropdown-item" href="{{asset('/admin/ho-so')}}"><i class="bx bx-user"></i><span>Hồ Sơ</span></a>
				</li>
				<li>
					<a class="dropdown-item" href="{{asset('/admin/ho-so/cap-nhat-mat-khau')}}"><i class="bx bx-repost"></i><span>Đổi mật khẩu</span></a>
				</li>
				<li>
					<a class="dropdown-item" href="{{asset('')}}"><i class='bx bx-home-circle'></i><span>Trang Chủ</span></a>
				</li>
				<li>
					<div class="dropdown-divider mb-0"></div>
				</li>
				<li>
					<a class="dropdown-item" href="/admin/dang-xuat"><i class='bx bx-log-out-circle'></i><span>Đăng
							Xuất</span></a>
				</li>
			</ul>
		</div>
	</nav>
</div>
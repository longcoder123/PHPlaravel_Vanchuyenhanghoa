	@extends('Backend.Trangchu')
    @section('main')
         <!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Trang chủ</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Tải PDF</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>100</h3>
						<p>Đơn hàng mới</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>1000</h3>
						<p>Khách hàng</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>10 tỉ</h3>
						<p>Tổng doanh thu</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Đơn hàng gần đây</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Người dùng</th>
								<th>Ngày đặt</th>
								<th>Trạng thái</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="{{asset('backend/img/peole.png')}}">
									<p>Nguyễn Văn A</p>
								</td>
								<td>5/11/2023</td>
								<td><span class="status completed">Hoàn Thành</span></td>
							</tr>
							<tr>
								<td>
									<img src="{{asset('backend/img/peole.png')}}">
									<p>Nguyễn Văn B</p>
								</td>
								<td>1/11/2023</td>
								<td><span class="status pending">Chưa giải quyết</span></td>
							</tr>
							<tr>
								<td>
									<img src="{{asset('backend/img/peole.png')}}">
									<p>Nguyễn Văn C</p>
								</td>
								<td>01/8/2024</td>
								<td><span class="status process">Đang vận chuyển</span></td>
							</tr>
							<tr>
								<td>
                                    <img src="{{asset('backend/img/peole.png')}}">
									<p>Nguyễn Văn D</p>
								</td>
								<td>10/7/2024</td>
								<td><span class="status pending">Chưa giải quết</span></td>
							</tr>
							<tr>
								<td>
									<img src="{{asset('backend/img/peole.png')}}">
									<p>Nguyễn Thị G</p>
								</td>
								<td>20/3/2024</td>
								<td><span class="status completed">Hoàn Thành</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Việc cần làm</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Giao hàng</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Kiểm tra hàng</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Sao kê</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Tổng doanh thu</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Kiểm tra xe</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
    @endsection
    
   

      
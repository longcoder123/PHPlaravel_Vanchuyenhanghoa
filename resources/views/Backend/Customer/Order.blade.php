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
                        <a class="active" href="#">Đơn hàng</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download' ></i>
                <span class="text">Tải PDF</span>
            </a>
        </div>



        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Đơn hàng</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            
                            <th>Tên người nhận </th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ người gửi</th>
                            <th>Địa chỉ người nhận</th>
                            <th>Ngày đặt</th>
                            <th>Ngày dự kiến giao</th>
                            <th>Xem hàng hóa</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                          <tr>
                              <td>
                                <p>Nguyễn Văn B</p></td>
                      
                              <td>012345678</td>
                              <td>Hai bà trưng - Hà Nội</td>
                              <td>Hưng yên</td>                        
                              <td>10/5/2024</td> 
                              <td>15/5/2024</td>
                              <td ><a href="{{route('backend.packages')}}"><i class='bx bx-folder'></i> chi tiết hàng</a></td>
                              <td>
                                  <a href="" class="btn btn-primary"><i class='bx bxs-edit'></i></a>
                                  <a href="" class="btn btn-danger"><i class='bx bx-x-circle'></i></a>
                              </td>
                          </tr>
                    
                      </tbody>
                </table>
            </div>
          
    </main>
    <!-- MAIN -->
  
@endsection



  
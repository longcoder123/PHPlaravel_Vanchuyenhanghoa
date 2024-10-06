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
                        <a class="active" href="#" style="text-decoration: none">Khách hàng</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn-download" style="text-decoration: none">
                <i class='bx bxs-cloud-download' ></i>
                <span class="text">Tải PDF</span>
            </a>
        </div>



        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Khách hàng</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            
                            <th>Tên </th>
             
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>CCCD</th>
                            <th>Giới tính</th>
                            <th>Xem đơn hàng</th>
                            <th>Id</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                          <tr>
                              <td><img src="">
                                <p>Nguyễn Văn A</p></td>
                      
                              <td>012345678</td>
                              <td>Hai bà trưng - Hà Nội</td>
                              <td>03132132133</td>                        
                              <td>Nam</td> 
                              <td ><a href="{{route('backend.order')}}" style="text-decoration: none"><i class='bx bx-folder'></i> chi tiết</a></td>
                              <td>1</td>
                              <td>
                                  <a href="" class="btn btn-primary" style="text-decoration: none"><i class='bx bxs-edit'></i></a>
                                  <a href="" class="btn btn-danger" style="text-decoration: none"><i class='bx bx-x-circle'></i></a>
                              </td>
                          </tr>
                    
                      </tbody>
                </table>
            </div>
          
    </main>
    <!-- MAIN -->
  
@endsection



  
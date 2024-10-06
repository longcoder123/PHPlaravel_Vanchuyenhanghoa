@extends('Backend.Trangchu')
@section('main')
     <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#" style="text-decoration: none">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li> 
                        <a class="active" href="#" style="text-decoration: none">Hàng hóa</a>
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
                    <h3>Hàng hóa</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            
                            <th>Hình ảnh </th>
                            <th>Mô Tả</th>
                            <th>Trọng Lượng</th>
                            <th>Kích thước</th>
                            <th>Giá trị</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                          <tr>
                              <td> <img src="" alt="">
                               </td>
                      
                              <td>Đồ dễ vỡ</td>
                              <td>100 tấn</td>
                              <td>26 m</td>                        
                              <td>10.000.000</td> 
                              <td>Đang chờ xử lý</td>
                         
                              <td>
                                  <a href="" class="btn btn-primary" style="text-decoration: none"><i class='bx bxs-edit'>Duyệt</i></a>
                                  <a href="" class="btn btn-danger" style="text-decoration: none"><i class='bx bx-x-circle'>Từ chối</i></a>
                              </td>
                          </tr>
                    
                      </tbody>
                </table>
            </div>
          
    </main>
    <!-- MAIN -->
  
@endsection



  
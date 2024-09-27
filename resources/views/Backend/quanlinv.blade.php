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
                        <a class="active" href="#">Quản lý nhân viên</a>
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
                    <h3>Quản lý nhân viên</h3>
                    <a href="{{route('themxe')}}"
                    class="btn btn-primary float-end">Thêm NV</a>
                  
                </div>
                <table>
                    <thead>
                        <tr>
                            
                            <th>Tên NV</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>CCCD</th>
                            <th>Trạng thái</th>
                            <th>Mã Xe</th>
                            {{-- <th>Tài xế </th> --}}
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                          <tr>
                              <td><img src="">
                                <p>Tên</p></td>
                              <td>SDT</td>
                              <td>Email</td>
                              <td>CCCD</td>
                              <td>1</td>
                              <td></td>  <!-- Hiển thị trạng thái xe -->
                              {{-- <td>{{$sp->driver_id ->name}}</td>              --}}
                              <td>
                                  <a href="" class="btn btn-primary">Sửa</a>
                                  <a href="" class="btn btn-danger">Xóa</a>
                              </td>
                          </tr>
                
                      </tbody>
                </table>
            </div>
          
    </main>
    <!-- MAIN -->
  
@endsection



  
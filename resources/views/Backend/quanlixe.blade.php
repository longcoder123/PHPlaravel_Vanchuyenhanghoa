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
                        <a class="active" href="#">Quản lý xe</a>
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
                    <h3>Quản lý xe</h3>
                    <a href="{{route('themxe')}}"
                    class="btn btn-primary float-end"><i class='bx bx-plus-circle' ></i></a>
                  
                </div>
                <table>
                    <thead>
                        <tr>
                            
                            <th>Tên Xe</th>
                            <th>Loại Xe</th>
                       
                            <th>Trọng Lượng</th>
                            <th>Trạng thái</th>
                            {{-- <th>Tài xế </th> --}}
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vh as $sp)  
                          <tr>
                              <td><img src="{{asset('Uploads/admin/' .$sp ->vehicle_image )}}">
                                <p>{{$sp->license_plate}}</p></td>
                              <td>{{$sp->vehicle_type}}</td>
                              <td>{{$sp->capacity}} Tấn</td>
                              <td>{{$sp->status}}</td>  <!-- Hiển thị trạng thái xe -->
                              {{-- <td>{{$sp->driver_id ->name}}</td>                        --}}
                              <td>
                                  <a href="{{route('suaxe',['vehicle_id' => $sp->vehicle_id])}}" class="btn btn-primary"><i class='bx bxs-edit'></i></a>
                                  <a href="{{route('xoaxe',['vehicle_id' => $sp->vehicle_id])}}" class="btn btn-danger"><i class='bx bx-x-circle'></i></a>
                              </td>
                          </tr>
                        @endforeach      
                      </tbody>
                </table>
            </div>
          
    </main>
    <!-- MAIN -->
  
@endsection



  
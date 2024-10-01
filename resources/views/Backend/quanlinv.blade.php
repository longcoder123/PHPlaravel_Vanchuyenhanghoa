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
                    <a href="{{route('themnv')}}"
                    class="btn btn-primary float-end" > <i class='bx bx-plus-circle' ></i></a>
                  
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
                      @foreach ($driver as $dr)
                          <tr>
                              <td><img src="{{asset('Uploads/admin/' .$dr ->driver_image )}}">
                                <p>{{$dr->name}}</p></td>
                              <td>{{$dr->phone}}</td>
                              <td>{{$dr->email}}</td>
                              <td>{{$dr->license_number}}</td>                        
                              <td>{{$dr->status}}</td> 
                              <td>{{ $dr->vehicle ? $dr->vehicle->license_plate : 'Chưa có xe' }}</td>
                             
                              <td>
                                  <a href="{{route('suanv',['driver_id' => $dr->driver_id])}}" class="btn btn-primary"><i class='bx bxs-edit'></i></a>
                                  <a href="{{route('xoanv',['driver_id' => $dr->driver_id])}}" class="btn btn-danger"><i class='bx bx-x-circle'></i></a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                </table>
            </div>
          
    </main>
    <!-- MAIN -->
  
@endsection



  
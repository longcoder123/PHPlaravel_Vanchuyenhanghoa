@extends('Backend.Trangchu')
@section('main')
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Quản lý nhân viên</a></li>
                </ul>
            </div>
            <a href="#" class="btn-download" style="text-decoration: none">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Tải PDF</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Quản lý nhân viên</h3>
                    <a href="{{ route('themnv') }}" class="btn btn-primary float-end">
                        <i class='bx bx-plus-circle'></i> Thêm nhân viên
                    </a>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Hình Ảnh</th>
                            <th class="text-center">Tên NV</th>
                            <th class="text-center">Số điện thoại</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">CCCD</th>
                            <th class="text-center">Trạng Thái</th>
                            <th class="text-center">Mã Xe</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($driver as $dr)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('Uploads/admin/' . $dr->driver_image) }}" alt="Hình ảnh NV" width="80">
                                </td>
                                <td class="text-center">{{ $dr->name }}</td>
                                <td class="text-center">{{ $dr->phone }}</td>
                                <td class="text-center">{{ $dr->email }}</td>
                                <td class="text-center">{{ $dr->license_number }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $dr->status == 'Hoạt động' ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $dr->status }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $dr->vehicle ? $dr->vehicle->license_plate : 'Chưa có xe' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('suanv', ['driver_id' => $dr->driver_id]) }}" class="btn btn-primary">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <a href="{{ route('xoanv', ['driver_id' => $dr->driver_id]) }}" class="btn btn-danger">
                                        <i class='bx bx-x-circle'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

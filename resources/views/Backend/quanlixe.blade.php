@extends('Backend.Trangchu')
@section('main')
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Quản lý xe</a></li>
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
                    <h3>Quản lý xe</h3>
                    <a href="{{ route('themxe') }}" class="btn btn-primary float-end">
                        <i class='bx bx-plus-circle'></i> Thêm xe
                    </a>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Hình Ảnh</th>
                            <th class="text-center">Biển Số Xe</th>
                            <th class="text-center">Loại Xe</th>
                            <th class="text-center">Trọng Lượng</th>
                            <th class="text-center">Trạng Thái</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vh as $sp)  
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('Uploads/admin/' . $sp->vehicle_image) }}" alt="Hình ảnh xe" width="80">
                                </td>
                                <td class="text-center">{{ $sp->license_plate }}</td>
                                <td class="text-center">{{ $sp->vehicle_type }}</td>
                                <td class="text-center">{{ $sp->capacity }} Tấn</td>
                                <td class="text-center">
                                    <span class="badge {{ $sp->status == 'Đang hoạt động' ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $sp->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('suaxe', ['vehicle_id' => $sp->vehicle_id]) }}" class="btn btn-primary">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <a href="{{ route('xoaxe', ['vehicle_id' => $sp->vehicle_id]) }}" class="btn btn-danger">
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

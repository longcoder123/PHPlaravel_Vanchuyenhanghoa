@extends('Backend.Trangchu')
@section('main')
<!-- MAIN -->
<Style>
    /* Giảm kích thước chữ */
table th, table td {
    font-size: 14px;
}

/* Căn giữa chữ trong các ô */
table th, table td {
    text-align: center;
}

/* Thêm các đường viền để ngăn cách các ô */
table {
    border-collapse: collapse;
    width: 100%;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
}

/* Tạo hiệu ứng hover cho hàng khi rê chuột */
table tr:hover {
    background-color: #f2f2f2;
}

/* Đặt khoảng cách giữa các ô */
table td, table th {
    padding: 12px;
}

</Style>
<main>
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#" style="text-decoration: none">Khách hàng</a>
                </li>
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
                <h3>Khách hàng</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-center">Tên</th>
                        <th class="text-center">Số điện thoại</th>
                        <th class="text-center">Địa chỉ</th>
                        <th class="text-center">CCCD</th>
                        <th class="text-center">Giới tính</th>
                        <th class="text-center">Xem đơn hàng</th>
                        <th class="text-center">Id</th>
                        <th class="text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($khachang as $kh)
                    <tr>
                        <td>{{$kh->name}}</td>
                        <td>{{$kh->phone}}</td>
                        <td>{{$kh->address}}</td>
                        <td>{{$kh->identity_number}}</td>
                        <td>{{$kh->gender}}</td>
                        <td>
                            <a href="{{ route('backend.orders', ['customer_id' => $kh->customer_id]) }}" style="text-decoration: none">
                                <i class='bx bx-folder'></i> chi tiết
                            </a>
                        </td>
                        <td>{{$kh->customer_id}}</td>
                        <td>
                            <a href="" class="btn btn-primary" style="text-decoration: none"><i class='bx bxs-edit'></i></a>
                            <a href="" class="btn btn-danger" style="text-decoration: none"><i class='bx bx-x-circle'></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
<!-- MAIN -->
@endsection

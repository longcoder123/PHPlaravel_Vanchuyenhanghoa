@extends('Backend.Trangchu')

@section('main')
<!-- Kiểm tra thông báo thành công -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Kiểm tra thông báo lỗi -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('delete'))
    <div class="alert alert-danger">
        {{ session('delete') }}
    </div>
@endif

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
    
    <!-- Nội dung trang -->
    <div class="head-title">
        <div class="left">
            <h1>Đơn hàng của khách hàng: {{ $customer->name }}</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active">Đơn hàng</a></li>
            </ul>
        </div>
        <a href="#" class="btn-download">
            <i class='bx bxs-cloud-download'></i>
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
                        <th>Tên người nhận</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ người gửi</th>
                        <th>Địa chỉ người nhận</th>
                        <th>Ngày đặt</th>
                        <th>Ngày dự kiến giao</th>
                        <th>Trạng thái</th>
                        <th>Hàng hóa</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->receiver_name }}</td>
                        <td>{{ $order->receiver_phone }}</td>
                        <td>{{ $order->sender_address }}</td>
                        <td>{{ $order->receiver_address }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->delivery_date }}</td>
                        <td>{{ $order->status }}</td>
                        <td><a href="{{ route('backend.package.details', $order->order_id) }}"><i class='bx bxs-package' style="font-size: 20px"></i></a></td>
                        <td>
                            <!-- Duyệt đơn hàng -->
                            <a href="{{ route('backend.order.approve', $order->order_id) }}" style="font-size: 20px;">
                                <i class='bx bxs-check-circle' style="color: green;"></i>
                            </a>
                            
                            <!-- Từ chối đơn hàng -->
                            <a href="{{ route('backend.order.reject', $order->order_id) }}" style="font-size: 20px;">
                                <i class='bx bxs-x-circle' style="color: red;"></i>
                            </a>

                            <a href="{{route('xoadonhang',['order_id' => $order->order_id])}}" style="font-size: 20px">
                                <i class='bx bxs-trash' ></i>
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

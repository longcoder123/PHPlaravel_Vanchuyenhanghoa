@extends('Backend.Trangchu')
@section('main')
<Style>
    table th, table td {
        font-size: 14px;
        text-align: center;
        padding: 12px;
        border: 1px solid #ddd;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    table tr:hover {
        background-color: #f2f2f2;
    }
</Style>

<main>
    <div class="head-title">
        <div class="left">
            <h1 style="font-size: 15px">Chi tiết hàng hóa của đơn hàng #{{ $order->order_id }}</h1>

            <ul class="breadcrumb">
                <li><a href="#" style="text-decoration: none">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#" style="text-decoration: none">Chi tiết hàng hóa</a></li>
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
                <h3>Chi tiết hàng hóa</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th  class="text-center">Hình ảnh</th>
                        <th  class="text-center">Mô tả</th>
                        <th  class="text-center">Trọng lượng</th>
                        <th  class="text-center">Kích thước</th>
                        <th  class="text-center">Giá trị</th>
                        <th  class="text-center">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pakages as $package)
                    <tr>
                        <td>
                            <img src="{{ asset('Uploads/admin/' . $package->product_image) }}" alt="Hình ảnh hàng hóa" width="80">
                        </td>
                        <td>{{ $package->description }}</td>
                        <td>{{ $package->weight }}</td>
                        <td>{{ $package->size }}</td>
                        <td>{{ number_format($package->value, 0, ',', '.') }}</td>
                        <td>{{ $package->status }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

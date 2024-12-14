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
                    <a class="active" href="#" style="text-decoration: none">Thanh toán</a>
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
                <h3>Thanh toán</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Order_ID</th>
                        <th class="text-center">Kiểu thanh toán</th>
                        <th class="text-center">Tổng tiền</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ngày thanh toán</th>
                        <th class="text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payment as $pay)
                    <tr>
                        <td>{{$pay->payment_id}}</td>
                        <td>{{$pay->order_id}}</td>
                        <td>{{$pay->payment_method}}</td>
                        <td>{{$pay->amount}}</td>
                        <td>{{$pay->status}}</td>
                        <td>{{$pay->payment_date}}</td>
                        <td>
                            <button class="btn btn-danger refund-btn" data-id="{{ $pay->payment_id }}" style="text-decoration: none">
                                <i class='bx bxs-credit-card'></i> Hoàn Tiền
                            </button>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.refund-btn', function() {
        var paymentId = $(this).data('id');
        
        $.ajax({
            url: '{{ route('payment.refund', ':id') }}'.replace(':id', paymentId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', 
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message); 
                    location.reload(); 
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Đã xảy ra lỗi khi hoàn tiền!');
            }
        });
    });
</script>

</main>

<!-- MAIN -->
@endsection

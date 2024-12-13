@extends('layoutMain.layout')
@section('content')
<div class="container-fluid d-flex justify-content-center">
    <div class="custom-container">
        <div class="col-12 custom-bg-cl rounded  mt-5">
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                        <tr>
                            <td>Trạng thái</td>
                            <td>Điểm gửi</td>
                            <td>Điểm nhận</td>
                            <td>Ngày giao dự kiến</td>
                            <td>Hành động</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                {{$order->order_status}}
                                <div id="myDiv-{{ $order->order_id }}" class="toggle-div" style="display: none;">
                                    <div>
                                        <p>Order ID: {{ $order->order_id }}</p>
                                        <p>Phần trăm giao hàng: {{ round($order->percentage, 2) }}%</p>
                                        <div style="width: 100%; background-color: #f3f3f3; border-radius: 5px;">
                                            <div style="width: {{ $order->percentage }}%; background-color: #ff7f50; height: 20px; border-radius: 5px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{$order->sender_address}}</td>
                            <td>{{$order->receiver_address}}</td>
                            <td>{{$order->delivery_date}}</td>
                            <td>
                                @if($order->order_status === 'Đã đặt')
                                <form action="{{ route('orders.cancel', $order->order_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger cancel-btn">Hủy đơn</button>
                                </form>
                                @else

                                @if($order->order_status === 'Đang vận chuyển')
                                <button class="toggleButton" data-target="myDiv-{{ $order->order_id }}">Thông tin vận chuyển</button>
                                @else
                                <Button>Đợi hoàn tiền</Button>
                                @endif
                                @endif



                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".toggleButton").click(function() {
            var targetDiv = $(this).data("target");
            $("#" + targetDiv).toggle();
        });
    });
</script>

@endsection

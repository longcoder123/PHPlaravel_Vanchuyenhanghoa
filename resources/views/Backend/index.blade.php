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
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Trang chủ</a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3>{{ $orderCount }}</h3> 
                    <p>Đơn hàng mới</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>{{ $customerCount }}</h3> 
                    <p>Khách hàng</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>{{ number_format($packagesCount, 0, ',', '.') }}</h3> 
                    <p>Tổng doanh thu</p>
                </span>
            </li>
        </ul>
        
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Thống kê doanh thu theo tháng</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>

                <!-- Bar chart for monthly revenue statistics -->
                <canvas id="revenueChart" width="400" height="200"></canvas>
            </div>
        </div>
    </main>
    <!-- MAIN -->

    <!-- Chart.js script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar chart for "Thống kê doanh thu theo tháng"
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: @json(array_values($monthlyRevenue)), // Chuyển đổi dữ liệu doanh thu theo tháng sang JSON
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString(); 
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection

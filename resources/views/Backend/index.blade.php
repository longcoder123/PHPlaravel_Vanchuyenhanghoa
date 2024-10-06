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
            <a href="#" class="btn-download" style="text-decoration: none">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Tải PDF</span>
            </a>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3>100</h3>
                    <p>Đơn hàng mới</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>1000</h3>
                    <p>Khách hàng</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>10 tỉ</h3>
                    <p>Tổng doanh thu</p>
                </span>
            </li>
        </ul>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Thống kê doanh số</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>

                <!-- Bar chart for order statistics -->
                <canvas id="orderStatusChart" width="400" height="200"></canvas>

            </div>
            <div class="todo">
                <div class="head">
                    <h3>Việc cần làm</h3>
                    <i class='bx bx-plus'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <!-- Bar chart for "Việc cần làm" -->
                <canvas id="todoChart" width="400" height="200"></canvas>
            </div>
        </div>
    </main>
    <!-- MAIN -->

    <!-- Chart.js script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar chart for "Thống kê doanh số"
        const ctx = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Nguyễn Văn A', 'Nguyễn Văn B', 'Nguyễn Văn C', 'Nguyễn Văn D', 'Nguyễn Thị G'], // Names of users
                datasets: [{
                    label: 'Phần trăm hoàn thành (%)',
                    data: [100, 25, 50, 25, 100], // Completion percentage from the table
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Bar chart for "Việc cần làm"
        const todoCtx = document.getElementById('todoChart').getContext('2d');
        const todoChart = new Chart(todoCtx, {
            type: 'bar',
            data: {
                labels: ['Giao hàng', 'Kiểm tra hàng', 'Sao kê', 'Tổng doanh thu', 'Kiểm tra xe'], // Task names
                datasets: [{
                    label: 'Tình trạng hoàn thành (%)',
                    data: [100, 100, 0, 100, 0], // Completion status (100% for completed, 0% for not completed)
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>
@endsection

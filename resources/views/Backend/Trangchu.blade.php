<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset ('backend/style.css') }}">

    <title>ADMIN</title>

    <style>
        /* Custom green color for success notifications */
        .toast-success {
            background-color: #28a745 !important; /* Green */
            color: #fff !important;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="{{route('admin')}}" class="brand" style="text-decoration: none">
        <i class='bx bxs-smile'></i>
        <span class="text">Flash-Ship</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="{{route('admin')}}" style="text-decoration: none">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Trang Chủ</span>
            </a>
        </li>
        <li>
            <a href="{{route('qlixe')}}" style="text-decoration: none">
                <i class='bx bxs-truck'></i>
                <span class="text">Quản lý xe</span>
            </a>
        </li>
        <li>
            <a href="{{route('qlynv')}}" style="text-decoration: none">
                <i class='bx bxs-group'></i>
                <span class="text">Quản lý nhân viên</span>
            </a>
        </li>
        <li>
            <a href="{{route('backend.customer')}}" style="text-decoration: none">
                <i class='bx bxs-message-dots'></i>
                <span class="text">Quản lý đơn hàng</span>
            </a>
        </li>
        <li>
            <a href="#" style="text-decoration: none">
                <i class='bx bxs-car'></i>
                <span class="text">Quá trình vận chuyển</span>
            </a>
        </li>
        <li>
            <a href="#" style="text-decoration: none">
                <i class='bx bxs-credit-card'></i>
                <span class="text">Thanh toán đơn hàng</span>
            </a>
        </li>
        <li>
            <a href="#" style="text-decoration: none">
                <i class='bx bxs-group'></i>
                <span class="text">Tài khoản người dùng</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#" class="logout" style="text-decoration: none">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Đăng xuất</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link" style="text-decoration: none">Thể loại</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="notification" style="text-decoration: none">
            <i class='bx bxs-bell'></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img src="img/people.png">
        </a>
    </nav>
    <!-- NAVBAR -->

    @yield('main')
</section>
<!-- CONTENT -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "1000",
        "positionClass": "toast-top-center" // Display centered at the top
    };

    @if (session('delete'))
        toastr.success("{{ session('delete') }}");
    @endif

	@if (session('deletenv'))
        toastr.success("{{ session('deletenv') }}");
    @endif
</script>

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('backend/script.js') }}"></script>

</body>
</html>

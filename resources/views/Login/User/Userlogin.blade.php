<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('delivery-background.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
        }

        #errorMessage {
            color: red;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
  
    <div class="login-container">
        @if (session('msg'))
        <div class="alert alert-danger text-center">
            <i class="fas fa-exclamation-circle"></i> {{ session('msg') }}
        </div>
        @endif

        <h2>Đăng nhập</h2>
        
        <form action="{{ route('userlogin') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" required placeholder="Nhập email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Nhập mật khẩu" autocomplete="off">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success btn-block">Đăng nhập</button>
           
            <p id="errorMessage"></p>
        </form>

        <!-- Social login options -->
        <div class="social-login text-center mt-3">
            <button class="btn btn-primary btn-block" onclick="alert('Đăng nhập với Facebook')">
                <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook
            </button>
            <button class="btn btn-danger btn-block" onclick="alert('Đăng nhập với Gmail')">
                <i class="fab fa-google"></i> Đăng nhập với Gmail
            </button>
        </div>

        <!-- Register link below social login -->
        <div class="text-center mt-3">
            <a href="#" data-toggle="modal" data-target="#registerModal">Đăng ký tài khoản</a>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if (session('mesage'))
                    <div class="alert alert-danger text-center">
                        <i class="fas fa-exclamation-circle"></i> {{ session('msg') }}
                    </div>
                    @endif
                    <h5 class="modal-title" id="registerModalLabel">Đăng ký tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('register.process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="newUsername">Tên đăng nhập:</label>
                            <input type="text" class="form-control" id="newUsername" name="name" required placeholder="Nhập tên đăng nhập">
                        </div>
                        <div class="form-group">
                            <label for="newEmail">Email:</label>
                            <input type="email" class="form-control" id="newEmail" name="email" required placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Mật khẩu:</label>
                            <input type="password" class="form-control" id="newPassword" name="password" required placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Xác nhận mật khẩu:</label>
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required placeholder="Nhập lại mật khẩu">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("registerForm").onsubmit = function() {
            alert("Tài khoản đã được tạo thành công!");
            $('#registerModal').modal('hide');  // Close modal after submission
            return false;  // Prevent page reload
        };
    </script>
</body>
</html>

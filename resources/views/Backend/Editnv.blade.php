<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <h5 class="alert alert-success">{{ session('status')}}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Sửa nhân viên <a href="{{ route('qlynv') }}" class="btn btn-danger float-end">BACK</a></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updatenv', ['driver_id' => $driver->driver_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Tên :</label>
                                <input type="text" name="tennv" class="form-control" value="{{ old('tennv', $driver->name) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Số Điện Thoại :</label>
                                <input type="text" name="sodienthoai" class="form-control" value="{{ old('sodienthoai', $driver->phone) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Ảnh :</label>
                                <input type="file" name="anhdaidien" class="form-control">
                                <img src="{{ asset('Uploads/admin/' . $driver->driver_image) }}" alt="Driver Image" style="width: 100px; height: auto;">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Email :</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $driver->email) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Căn cước công dân :</label>
                                <input type="text" name="cccd" class="form-control" value="{{ old('cccd', $driver->license_number) }}">
                            </div>

                            <div class="form-group">
                                <label for="trangthai">Trạng thái nhân viên</label>
                                <select name="trangthai" class="form-control">
                                    <option value="Có sẵn" {{ $driver->status == 'Có sẵn' ? 'selected' : '' }}>Sẵn sàng</option>
                                    <option value="Đang sử dụng" {{ $driver->status == 'Đang sử dụng' ? 'selected' : '' }}>Đang giao hàng</option>
                                    <option value="Đang bảo trì" {{ $driver->status == 'Đang bảo trì' ? 'selected' : '' }}>Nghỉ phép</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Mã xe :</label>
                                <input type="text" name="maxe" class="form-control" value="{{ old('maxe', $driver->vehicle_id) }}">
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary"> Sửa </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

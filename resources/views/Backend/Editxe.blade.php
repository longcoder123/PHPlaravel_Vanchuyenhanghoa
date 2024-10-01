<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm xe</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
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
                        <h3>Thông tin xe <a href="{{route('qlixe')}}"
                                class="btn btn-danger float-end">Back</a></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updatexe', ['vehicle_id' => $vh->vehicle_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Biển số xe:</label>
                                <input type="text" name="biensoxe" class="form-control" value="{{ old('biensoxe', $vh->license_plate) }}">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="">Loại xe:</label>
                                <input type="text" name="loaixe" class="form-control" value="{{ old('loaixe', $vh->vehicle_type) }}">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="">Trọng lượng:</label>
                                <input type="text" name="trongluong" class="form-control" value="{{ old('trongluong', $vh->capacity) }}">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="">Trạng thái:</label>
                                <select name="trangthai" class="form-control">
                                    <option value="Có sẵn" {{ $vh->status == 'Có sẵn' ? 'selected' : '' }}>Sẵn sàng</option>
                                    <option value="Đang sử dụng" {{ $vh->status == 'Đang sử dụng' ? 'selected' : '' }}>Đang giao hàng</option>
                                    <option value="Đang bảo trì" {{ $vh->status == 'Đang bảo trì' ? 'selected' : '' }}>Nghỉ phép</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="">Ảnh:</label>
                                <input type="file" name="anhdaidien" class="form-control">
                            </div>
                        
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Sửa</button>
                            </div>
                        </form>
                        
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

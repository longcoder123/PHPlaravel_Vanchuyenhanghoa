<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
        .form-group label {
            margin-bottom: 12px; /* Khoảng cách giữa label và input */
        }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                <h5 class="alert alert-success">{{ session('status')}}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Thêm nhân viên <a href="{{route('qlynv')}}"
                                class="btn btn-danger float-end">BACK</a></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('storenv')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                             <div class="form-group mb-3">
                                 <label for="">Tên :</label>
                                 <input type="text" name="tennv" id="" class="form-control">
                             </div>
                
                             <div class="form-group mb-3">
                                 <label for="">Số Điện Thoại :</label>
                                 <input type="text" name="sodienthoai" id="" class="form-control">
                             </div>
                             
                             <div class="form-group mb-3">
                                 <label for="">Ảnh :</label>
                                 <input type="file" name="anhdaidien" id="" class="form-control">
                             </div>
                             <div class="form-group mb-3">
                                 <label for="">Email :</label>
                                 <input type="text" name="email" id="" class="form-control">
                             </div>
                             <div class="form-group mb-3">
                                <label for="">Căn cước công dân :</label>
                                <input type="text" name="cccd" id="" class="form-control">
                            </div>
                             <div class="form-group">
                                <label for="trangthai">Trạng thái nhân viên</label>
                                <select name="trangthai" id="trangthai" class="form-control">
                                    <option value="Có sẵn">Sẵn sàng</option>
                                    <option value="Đang sử dụng">Đang giao hàng</option>
                                    <option value="Đang bảo trì">Nghỉ phép</option>
                                </select>
                            </div>
                             <div class="form-group mb-3">
                                 <label for="">Mã xe : </label>
                                 <input type="text" name="maxe" id="" class="form-control">
                             </div> 
                             <div class="form-group mb-3">
                                 <button type="submit" class="btn btn-primary"> Thêm </button>
                             </div>
                         </form>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

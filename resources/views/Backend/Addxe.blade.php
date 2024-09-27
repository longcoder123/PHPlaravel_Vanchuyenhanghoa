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
                        <h3>Thêm xe <a href="{{route('qlixe')}}"
                                class="btn btn-danger float-end">BACK</a></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('storexe')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                             <div class="form-group mb-3">
                                 <label for="">Loại Xe:</label>
                                 <input type="text" name="loaixe" id="" class="form-control">
                             </div>
                
                             <div class="form-group mb-3">
                                 <label for="">Biển số xe :</label>
                                 <input type="text" name="biensoxe" id="" class="form-control">
                             </div>
                             {{-- <div class="form-group mb-3">
                                 <label for="">Tên tài xế : </label>
                                 <input type="text" name="taixe" id="" class="form-control">
                             </div> --}}
                             <div class="form-group mb-3">
                                 <label for="">Ảnh :</label>
                                 <input type="file" name="anhdaidien" id="" class="form-control">
                             </div>
                             <div class="form-group mb-3">
                                 <label for="">Trọng lượng :</label>
                                 <input type="text" name="trongluong" id="" class="form-control">
                             </div>
                             <div class="form-group">
                                <label for="trangthai">Trạng thái xe</label>
                                <select name="trangthai" id="trangthai" class="form-control">
                                    <option value="Có sẵn">Có sẵn</option>
                                    <option value="Đang sử dụng">Đang sử dụng</option>
                                    <option value="Đang bảo trì">Đang bảo trì</option>
                                </select>
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

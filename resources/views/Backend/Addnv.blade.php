<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   
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
               <!-- Thông báo hiển thị thêm nv thành công -->
               <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
               <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
               
               <script>
                   // Hiển thị thời gian và căn giữa
                   toastr.options = {
                       "closeButton": true,
                       "progressBar": true,
                       "timeOut": "1000", // 3 giây
                       "extendedTimeOut": "1000",
                       "positionClass": "toast-top-center", // Căn giữa phía trên
                   }

                   @if (session('status'))
                       toastr.success("{{ session('status') }}");
                   @endif
                   @if (session('error'))
                       toastr.success("{{ session('error') }}");
                   @endif
                   @if (session('value'))
                       toastr.success("{{ session('value') }}");
                   @endif

                   
               </script>
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
                                    <option value="Sẵn sàng">Sẵn sàng</option>
                                    <option value="Đang giao hàng">Đang giao hàng</option>
                                    <option value="Nghỉ phép">Nghỉ phép</option>
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
     <!-- Latest compiled JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>

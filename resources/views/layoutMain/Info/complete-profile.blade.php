<!-- resources/views/complete-profile.blade.php -->
<form action="{{ route('complete-profile') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
        <label for="tennv">Tên :</label>
        <input type="text" name="tennv" class="form-control" value="{{ old('tennv') }}">
    </div>

    <div class="form-group mb-3">
        <label for="sodienthoai">Số Điện Thoại :</label>
        <input type="text" name="sodienthoai" class="form-control" value="{{ old('sodienthoai') }}">
    </div>

    <div class="form-group mb-3">
        <label for="diachi">Địa chỉ :</label>
        <input type="text" name="diachi" class="form-control" value="{{ old('diachi') }}">
    </div>

    <div class="form-group mb-3">
        <label for="ngaysinh">Ngày sinh :</label>
        <input type="date" name="ngaysinh" class="form-control" value="{{ old('ngaysinh') }}">
    </div>

    <div class="form-group mb-3">
        <label for="cccd">Căn cước công dân :</label>
        <input type="text" name="cccd" class="form-control" value="{{ old('cccd') }}">
    </div>

    <div class="form-group">
        <label for="trangthai">Giới tính</label>
        <select name="trangthai" class="form-control">
            <option value="Nam" {{ old('trangthai') == 'Nam' ? 'selected' : '' }}>Nam</option>
            <option value="Nữ" {{ old('trangthai') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            <option value="Khác" {{ old('trangthai') == 'Khác' ? 'selected' : '' }}>Khác</option>
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-info">Lưu thông tin</button>
    </div>
</form>

@extends('layoutMain.layout')

@section('content')
<form action="{{ route('updateInfouser') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
        <label for="">Tên :</label>
        <input type="text" name="tennv" class="form-control" value="{{ old('tennv', $customer->name) }}">
    </div>

    <div class="form-group mb-3">
        <label for="">Số Điện Thoại :</label>
        <input type="text" name="sodienthoai" class="form-control" value="{{ old('sodienthoai', $customer->phone) }}">
    </div>

    <div class="form-group mb-3">
        <label for="">Địa chỉ :</label>
        <input type="text" name="diachi" class="form-control" value="{{ old('diachi', $customer->address) }}">
    </div>

    <div class="form-group mb-3">
        <label for="">Ngày sinh :</label>
        <input type="date" name="ngaysinh" class="form-control" value="{{ old('ngaysinh', $customer->dob) }}">
    </div>

    <div class="form-group mb-3">
        <label for="">Căn cước công dân :</label>
        <input type="text" name="cccd" class="form-control" value="{{ old('cccd', $customer->identity_number) }}">
    </div>

    <div class="form-group">
        <label for="trangthai">Giới tính</label>
        <select name="trangthai" class="form-control">
            <option value="Nam" {{ old('trangthai', $customer->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
            <option value="Nữ" {{ old('trangthai', $customer->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            <option value="Khác" {{ old('trangthai', $customer->gender) == 'Khác' ? 'selected' : '' }}>Khác</option>
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-info">Lưu thông tin</button>
    </div>
</form>
@endsection

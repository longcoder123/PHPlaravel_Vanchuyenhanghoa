@extends('layoutMain.layout')
@section('content')
<div class="container-fluid d-flex justify-content-center">
    <div class="custom-container">
        <div class="col-12 custom-bg-cl-box mt-5">
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                    <th>
                        <td>Mã đơn vận chuyển</td>
                        <td>Trạng thái</td>
                        <td>Điểm gửi</td>
                        <td>Điểm nhận</td>
                        <td>Ngày giao dự kiến</td>
                        <td>Hành động</td>
                    </th>
                    </thead>
                    <tbody>
                    <th>
                        <td></td>
                        <td><span class="badge">Đã giao</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                        <button class="btn btn-sm btn-outline-danger cancel-btn">
                            Hủy đơn
                        </button>
                    </td>
                    </th>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

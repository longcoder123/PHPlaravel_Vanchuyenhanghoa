@extends('Backend.Trangchu')
@section('main')
    <main>
        <div class="container mt-5">
            <div class="head-title text-center">
                <h1>Quản lý tài khoản</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($User as $us)
                            <tr>
                                <td>{{ $us->name }}</td>
                                <td>{{ $us->email }}</td>
                                <td>
                                    @if ($currentUser && $currentUser->id === $us->id)
                                        <span class="badge badge-success">Online</span>
                                    @else
                                        <span class="badge badge-secondary">Offline</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Biểu tượng con mắt (Font Awesome) -->
                                    <button class="btn btn-info" data-toggle="modal" data-target="#detailModal" 
                                            onclick="fillUserDetail('{{ $us->name }}', 
                                            '{{ $currentUser && $currentUser->id === $us->id ? 'Online' : 'Offline' }}', 
                                            '{{ $us->customer ? $us->customer->phone : '' }}', 
                                            '{{ $us->customer ? $us->customer->address : '' }}', 
                                            '{{ $us->customer ? $us->customer->gender : '' }}', 
                                            '{{ $us->customer ? $us->customer->dob : '' }}', 
                                            '{{ $us->customer ? $us->customer->identity_number : '' }}')">
                                        <i class="fas fa-eye"></i> 
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Chi Tiết Tài Khoản -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Chi tiết tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên:</label>
                            <input type="text" id="detail-name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <input type="text" id="detail-status" class="form-control" readonly>
                        </div>
                        <!-- Thêm thông tin của Customer -->
                        <div class="form-group">
                            <label>Số điện thoại:</label>
                            <input type="text" id="detail-phone" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ:</label>
                            <input type="text" id="detail-address" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Giới tính:</label>
                            <input type="text" id="detail-gender" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh:</label>
                            <input type="text" id="detail-dob" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Căn cước công dân:</label>
                            <input type="text" id="detail-identity_number" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<script>
    function fillUserDetail(name, status, phone, address, gender, dob, identity_number) {
        document.getElementById('detail-name').value = name;
        document.getElementById('detail-status').value = status;
        document.getElementById('detail-phone').value = phone;
        document.getElementById('detail-address').value = address;
        document.getElementById('detail-gender').value = gender;
        document.getElementById('detail-dob').value = dob;
        document.getElementById('detail-identity_number').value = identity_number;
    }
</script>

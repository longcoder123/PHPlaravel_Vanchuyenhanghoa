@extends('layoutMain.layout')
@section('content')
<form method="POST" id="calculateForm" enctype="multipart/form-data">
    @csrf <!-- Laravel's CSRF protection -->
    <div class="container-fluid d-flex justify-content-center">
        <div class="custom-container">
            <div class="col-12 custom-bg-cl-box h-auto p-3 mt-5">
                <h3 class="col-12 text-center p-4">Tính giá cước vận chuyển</h3>
                <div class="px-5 col-12">
                    <!-- From Address -->
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="from" class="form-label">Từ*</label>
                            <input type="text" id="from" name="from" class="form-control" placeholder="Nhập địa chỉ gửi" oninput="fetchLocationSuggestions(this.value, 'from-suggestions',0)">
                            <div id="from-suggestions" class="suggestions"></div>
                        </div>
                        @error('from')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="col-md-12 mb-3">
                            <label for="to" class="form-label">Tới*</label>
                            <input type="text" id="to" name="to" class="form-control" placeholder="Nhập địa chỉ nhận" oninput="fetchLocationSuggestions(this.value, 'to-suggestions',1)">
                            <div id="to-suggestions" class="suggestions"></div>
                        </div>
                        @error('to')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" id="quangduong" name="quangduong">
                    <input type="hidden" id="tongtien" name="tongtien">

                    <!-- Address Confirmation -->
                    <div class="row mb-3">
                        <div class="col">
                            <div class="position-a">
                                @if (session('thongbaohetxe'))
                                <div class="alert alert-warning">
                                    {{ session('thongbaohetxe') }}
                                </div>
                                @endif
                            </div>
                            <div class="position-a">
                                @if (session('thongbaoloidiachi'))
                                <div class="alert alert-danger">
                                    {{ session('thongbaoloidiachi') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Package Information -->
                    <h5>Cho chúng tôi biết thêm về lô hàng của bạn</h5>

                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <label for="quantity" class="form-label">Gói hàng*</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" min="0" value="0">
                        </div>
                        <div class="row mb-3">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="weight" class="form-label">Trọng lượng gói hàng*</label>
                            <div class="input-group">
                                <input type="number" id="weight" min="0" name="weight" class="form-control" value="0">
                                <select class="form-select" name="weight_unit">
                                    <option value="lb" selected>lb</option>
                                    <option value="kg">kg</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dimensions" class="form-label">Kích thước D x R x C*</label>
                            <div class="input-group">
                                <input type="number" name="length" min="0" value="0" class="form-control" placeholder="D">
                                <input type="number" name="width" min="0" value="0" class="form-control" placeholder="R">
                                <input type="number" name="height" min="0" value="0" class="form-control" placeholder="C">
                                <select class="form-select" name="dimension_unit">
                                    <option value="in" selected>in</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="position-a">
                            @if (session('thongbaosoluong'))
                            <div class="alert alert-danger">
                                {{ session('thongbaosoluong') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="position-a">
                            @if (session('thongbaotrongluong'))
                            <div class="alert alert-danger">
                                {{ session('thongbaotrongluong') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="position-a">
                            @if (session('thongbaokichthuoc'))
                            <div class="alert alert-danger">
                                {{ session('thongbaokichthuoc') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="container mt-3">
                        <label for="quantity" class="form-label">Ảnh hàng*</label>
                        <div class="row">
                            <div class="col-3">
                                <div class="image-upload">
                                    <label for="file-input-main" class="file-input-main">
                                        <div class="upload-box">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </label>
                                    <input class="col-3" id="file-input-main" type="file" accept="image/*" style="display:none;" onchange="addImage()">
                                </div>
                            </div>


                            <div class="col-3" id="image-slot-1">
                                <div class="image-upload">
                                    <img id="preview-1" src="#" alt="Ảnh 1" style="display:none;" class="img-thumbnail" onclick="editImage(1)">
                                </div>
                            </div>

                            <div class="col-3" id="image-slot-2">
                                <div class="image-upload">
                                    <img id="preview-2" src="#" alt="Ảnh 2" style="display:none;" class="img-thumbnail" onclick="editImage(2)">
                                </div>
                            </div>

                            <div class="col-3" id="image-slot-3">
                                <div class="image-upload">
                                    <img id="preview-3" src="#" alt="Ảnh 3" style="display:none;" class="img-thumbnail" onclick="editImage(3)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="product-images" name="product_images" value=""> -->


                    <label for="images">Upload Images:</label>
                    <input type="file" name="images[]" id="images" multiple>
                    <!-- Shipping Date -->
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <label for="shipping-date" class="form-label">Bạn muốn gửi hàng khi nào?*</label>
                            <select id="shipping-date" name="shipping_date" class="form-select">
                                <option selected>Thứ Bảy, 21 tháng 9, 2024</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="position-a">
                            @if (session('thongbaongay_gui'))
                            <div class="alert alert-danger">
                                {{ session('thongbaongay_gui') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- Submit Button -->
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <h5>Thông tin người nhận hàng hóa</h5>
                    <div class="row mb-4 mt-3">
                        <div class="col-md-5 mb-3">
                            <label for="shipping-date" class="form-label">Nhập họ và tên*</label>
                            <input type="text" name="recipien_name" class="form-control" placeholder="Họ và tên người nhận">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="shipping-date" class="form-label">Nhập số điện thoại*</label>
                            <input type="text" name="recipient_phone_number" class="form-control" placeholder="Số điện thoại người nhận" onkeypress="return isNumber(event)">
                        </div>

                    </div>
                    <div class="col">
                        <div class="position-a">
                            @if (session('thongbaoten'))
                            <div class="alert alert-danger">
                                {{ session('thongbaoten') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="position-a">
                            @if (session('thongbaosdt'))
                            <div class="alert alert-danger">
                                {{ session('thongbaosdt') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @endif -->

                    <div id="resultMessage" class="mt-3 text-center"></div>
                    <div class="row mb-3 ">
                        <div class="col text-center">
                            <button id="calculateButton" onclick="showThanhToan()" class="btn btn-primary">Hiển thị giá</button>
                        </div>
                        <div class="col text-center">
                            <button formaction="{{ route('saveData') }}" id="buttonThanhToan" class="btn btn-primary" style="display: none;">Thanh Toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    function isNumber(event) {
        const char = String.fromCharCode(event.which);
        return /^[0-9]$/.test(char); // Chỉ cho phép ký tự số
    }
    let imageIndex = 0; // Biến để theo dõi vị trí hình ảnh hiện tại để thêm
    let editingImageIndex = null; // Biến để theo dõi ảnh nào đang được sửa

    // Hàm này sẽ được gọi khi chọn ảnh mới
    let imagePaths = []; // Mảng chứa đường dẫn ảnh

    function addImage() {
        const input = document.getElementById('file-input-main');
        const file = input.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(e) {
            if (editingImageIndex !== null) {
                // Nếu đang sửa một ảnh
                document.getElementById(`preview-${editingImageIndex}`).src = e.target.result;
                imagePaths[editingImageIndex - 1] = e.target.result; // Cập nhật đường dẫn trong mảng
                document.getElementById(`preview-${editingImageIndex}`).style.display = 'block';
                editingImageIndex = null;
            } else if (imageIndex < 3) {
                // Nếu chưa chọn đủ 3 ảnh
                imageIndex++;
                document.getElementById(`preview-${imageIndex}`).src = e.target.result;
                imagePaths.push(e.target.result); // Thêm đường dẫn vào mảng
                document.getElementById(`preview-${imageIndex}`).style.display = 'block';
            } else {
                alert('Bạn chỉ được thêm tối đa 3 ảnh.');
            }
        };

        reader.readAsDataURL(file);
    }

    // Hàm này sẽ được gọi khi nhấp vào một ảnh để sửa
    function editImage(index) {
        editingImageIndex = index;
        document.getElementById('file-input-main').click(); // Mở hộp thoại để chọn ảnh mới
    }

    function updateImageInput() {
        document.getElementById('product-images').value = JSON.stringify(imagePaths);
    }
</script>
<script>
    let timeoutId;

    async function fetchLocationSuggestions(query, suggestionBoxId, index) {
        if (!query) {
            document.getElementById(suggestionBoxId).innerHTML = '';
            return;
        }

        clearTimeout(timeoutId);
        timeoutId = setTimeout(async () => {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?q=${query}&format=json&addressdetails=1&limit=5`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                const suggestionBox = document.getElementById(suggestionBoxId);
                suggestionBox.innerHTML = '';

                data.forEach((location) => {
                    const div = document.createElement('div');
                    div.textContent = location.display_name;
                    div.onclick = () => {
                        const selectedLocation = {
                            name: location.display_name,
                            lat: location.lat,
                            lon: location.lon
                        };
                        document.getElementById(suggestionBoxId.replace('-suggestions', '')).value = selectedLocation.name;
                        suggestionBox.innerHTML = '';

                        // Lưu tọa độ để tính toán quãng đường
                        if (window.selectedLocations.length < 2) {

                            window.selectedLocations.push(selectedLocation);
                            if (index === 0) {
                                window.selectedLocations[0] = selectedLocation;
                                document.getElementById('tu').value = selectedLocation.name;
                            }
                            if (index === 1) {
                                window.selectedLocations[1] = selectedLocation;
                            }
                        }
                        if (window.selectedLocations.length === 2) {
                            if (index === 0) {
                                window.selectedLocations[0] = selectedLocation;
                            }
                            if (index === 1) {
                                window.selectedLocations[1] = selectedLocation;
                            }
                            calculateDistance(window.selectedLocations[0], window.selectedLocations[1]);

                        }

                    };
                    suggestionBox.appendChild(div);
                });
            } catch (error) {
                console.error('Error fetching location suggestions:', error);
            }
        }, 300);
    }

    // Khai báo biến toàn cục để lưu tọa độ đã chọn
    window.selectedLocations = [];

    // Hàm tính quãng đường giữa hai địa điểm
    async function calculateDistance(locationA, locationB) {
        const url = `https://router.project-osrm.org/route/v1/driving/${locationA.lon},${locationA.lat};${locationB.lon},${locationB.lat}?overview=false`;

        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.routes && data.routes.length > 0) {
                const distance = data.routes[0].distance;
                document.getElementById('quangduong').value = (distance / 1000).toFixed(2);

            } else {
                console.log('Không có kết quả');
            }
        } catch (error) {
            console.error('Error fetching route distance:', error);
        }
    }

    $(document).ready(function() {
        $('#calculateButton').click(function(e) {
            e.preventDefault(); // Ngăn chặn hành vi gửi form mặc định

            // Lấy dữ liệu từ form
            var formData = $('#calculateForm').serialize();

            // Gửi yêu cầu AJAX đến server để tính toán
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('calculateShippingCost') }}", // Thay thế bằng URL xử lý trên Laravel
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Kiểm tra xem yêu cầu có thành công không
                    if (response.success) {
                        // Nếu thành công, hiển thị chi phí
                        $('#resultMessage').html('<div class="alert alert-success">Chi phí là: ' + response.costFormatted + ' VND</div>');
                        document.getElementById('tongtien').value = response.costFormatted;
                    } else {
                        // Nếu không thành công, hiển thị thông báo lỗi
                        $('#resultMessage').html('<div class="alert alert-danger">' + response.error + '</div>');
                    }
                    $('#resultMessage').show();
                },
                error: function(xhr, status, error) {
                    // Hiển thị thông báo lỗi nếu có vấn đề trong quá trình xử lý
                    $('#resultMessage').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại.</div>');
                    $('#resultMessage').show();
                }
            });
        });
    });

    function showThanhToan() {
        document.getElementById("buttonThanhToan").style.display = "block";
    }
</script>
@endsection

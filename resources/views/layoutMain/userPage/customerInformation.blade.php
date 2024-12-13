@extends('layoutMain.layout')
@section('content')
<form method="POST" id="calculateForm" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid d-flex justify-content-center">
        <div class="custom-container">
            <div class="col-12 custom-bg-cl-box h-auto p-3 mt-5">
                <h3 class="col-12 text-center p-4">Tính giá cước vận chuyển</h3>
                <div class="px-5 col-12">
                    <!-- From Address -->
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="from" class="form-label">Từ*</label>
                            <input type="text" id="from" name="from" class="form-control" placeholder="Nhập địa chỉ gửi" required oninput="fetchLocationSuggestions(this.value, 'from-suggestions',0)">
                            <div id="from-suggestions" class="suggestions"></div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="to" class="form-label">Tới*</label>
                            <input type="text" id="to" name="to" class="form-control" placeholder="Nhập địa chỉ nhận" required oninput="fetchLocationSuggestions(this.value, 'to-suggestions',1)">
                            <div id="to-suggestions" class="suggestions"></div>
                        </div>
                    </div>
                    <input type="hidden" id="quangduong" name="quangduong">
                    <input type="hidden" id="tongtien" name="tongtien">
                    <h5>Cho chúng tôi biết thêm về lô hàng của bạn</h5>

                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <label for="quantity" class="form-label">Gói hàng*</label>
                            <input type="number" id="quantity" required name="quantity" class="form-control" value="1">
                        </div>
                        <div class="row mb-3">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="weight" class="form-label">Trọng lượng gói hàng*</label>
                            <div class="input-group">
                                <input type="number" id="weight" name="weight" required class="form-control" value="1">
                                <select class="form-select" name="weight_unit">
                                    <option value="lb" selected>lb</option>
                                    <option value="kg">kg</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dimensions" class="form-label">Kích thước D x R x C*</label>
                            <div class="input-group">
                                <input type="number" name="length" required value="1" class="form-control" placeholder="D">
                                <input type="number" name="width" required value="1" class="form-control" placeholder="R">
                                <input type="number" name="height" required value="1" class="form-control" placeholder="C">
                                <select class="form-select" name="dimension_unit">
                                    <option value="in" selected>in</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3">
                        <label for="quantity" class="form-label">Ảnh hàng*</label>
                        <div class="row">
                            <div class="col-3">
                                <div class="image-upload">
                                    <label for="file-input-1" class="file-input-main">
                                        <div class="upload-box">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </label>
                                    <input class="col-3" id="file-input-1"  type="file" accept="image/*" style="display:none;" onchange="addImage(event, 1)" name="package_image[]">
                                </div>
                                <img id="preview-1" src="#" alt="Ảnh 1"  style="display:none;" class="img-thumbnail" onclick="editImage(1)">
                                <input type="hidden"  id="image-1" name="package_image[]">
                            </div>

                            <div class="col-3">
                                <div class="image-upload">
                                    <label for="file-input-2" class="file-input-main">
                                        <div class="upload-box">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </label>
                                    <input class="col-3" id="file-input-2" type="file" accept="image/*" style="display:none;" onchange="addImage(event, 2)" name="package_image[]">
                                </div>
                                <img id="preview-2" src="#" alt="Ảnh 2" style="display:none;" class="img-thumbnail" onclick="editImage(2)">
                                <input type="hidden" id="image-2" name="package_image[]">
                            </div>

                            <div class="col-3">
                                <div class="image-upload">
                                    <label for="file-input-3" class="file-input-main">
                                        <div class="upload-box">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </label>
                                    <input class="col-3" id="file-input-3" type="file" accept="image/*" style="display:none;" onchange="addImage(event, 3)" name="package_image[]">
                                </div>
                                <img id="preview-3" src="#" alt="Ảnh 3" style="display:none;" class="img-thumbnail" onclick="editImage(3)">
                                <input type="hidden" id="image-3" name="package_image[]">
                            </div>
                        </div>
                    </div>


                    <!-- Shipping Date -->
                    <h5>Thông tin người nhận hàng hóa</h5>
                    <div class="row mb-4 mt-3">
                        <div class="col-md-5 mb-3">
                            <label for="shipping-date" class="form-label">Nhập họ và tên*</label>
                            <input type="text" name="recipien_name" class="form-control" required placeholder="Họ và tên người nhận">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="shipping-date" class="form-label">Nhập số điện thoại*</label>
                            <input type="text" name="recipient_phone_number" class="form-control" placeholder="Số điện thoại người nhận" required onkeypress="return isNumber(event)">
                        </div>

                    </div>
                    <div class="position-a">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div id="resultMessage" class="mt-3 text-center"></div>
                    <div class="row mb-3 ">
                        <div class="col text-center">
                            <button id="calculateButton" onclick="showThanhToan()" class="btn btn-primary">Hiển thị giá</button>
                        </div>
                        <div class="col text-center">
                            <button formaction="{{ route('saveData') }}" id="buttonThanhToan" name="redirect" class="btn btn-primary" style="display: none;">Thanh toán tiền đặt cọc</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


{{-- <script>
    function isNumber(event) {
        const char = String.fromCharCode(event.which);
        return /^[0-9]$/.test(char);
    }
    let imageIndex = 0;
    let editingImageIndex = null;
    function addImage() {
        const input = document.getElementById('file-input-main');
        const file = input.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(e) {
            if (editingImageIndex !== null) {
                document.getElementById(`preview-${editingImageIndex}`).src = e.target.result;
                document.getElementById(`preview-${editingImageIndex}`).style.display = 'block';
                editingImageIndex = null;
            } else if (imageIndex < 3) {
                imageIndex++;
                document.getElementById(`preview-${imageIndex}`).src = e.target.result;
                document.getElementById(`preview-${imageIndex}`).style.display = 'block';
            } else {
                alert('Bạn chỉ được thêm tối đa 3 ảnh.');
            }
        };

        reader.readAsDataURL(file);
    }
    function editImage(index) {
        editingImageIndex = index;
        document.getElementById('file-input-main').click();
    }
</script> --}}
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
            e.preventDefault();
            var formData = $('#calculateForm').serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('calculateShippingCost') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#resultMessage').html('<div class="alert alert-success">Chi phí là: ' + response.costFormatted + ' VND</div>');
                        document.getElementById('tongtien').value = response.costFormatted;
                    } else {
                        $('#resultMessage').html('<div class="alert alert-danger">' + response.error + '</div>');
                    }
                    $('#resultMessage').show();
                },
                error: function(xhr, status, error) {
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
<script>
    function addImage(event, slot) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('preview-' + slot);
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                document.getElementById('image-' + slot).value = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    function editImage(slot) {
        const fileInput = document.getElementById('file-input-' + slot);
        fileInput.click();
    }
</script>
@endsection

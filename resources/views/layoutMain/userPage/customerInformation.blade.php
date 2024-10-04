@extends('layoutMain.layout')
@section('content')
<form method="POST" id="calculateForm" action="{{ route('calculateShippingCost') }}">
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
                            <input type="text" id="from" name="from" class="form-control" placeholder="Nhập địa chỉ gửi" oninput="fetchLocationSuggestions(this.value, 'from-suggestions')">
                            <div id="from-suggestions" class="suggestions"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="to" class="form-label">Tới*</label>
                            <input type="text" id="to" name="to" class="form-control" placeholder="Nhập địa chỉ nhận" oninput="fetchLocationSuggestions(this.value, 'to-suggestions')">
                            <div id="to-suggestions" class="suggestions"></div>
                        </div>
                    </div>
                    <input type="text" class="" id="quangduong" name="quangduong">
                    <!-- Address Confirmation -->
                    <div class="row mb-3">
                        <div class="col">
                            <div class="alert alert-info">
                                10038 và LE17RJ là những kết quả phù hợp nhất mà chúng tôi tìm được. Nếu thấy không đúng, bạn có thể thay đổi trong các trường ở trên.
                            </div>
                        </div>
                    </div>

                    <!-- Package Information -->
                    <h5>Cho chúng tôi biết thêm về lô hàng của bạn</h5>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="packaging" class="form-label">Bao bì*</label>
                            <select id="packaging" name="packaging" class="form-select">
                                <option selected>Your Packaging</option>
                                <option value="FedEx">FedEx Packaging</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="insurance" name="insurance">
                                <label class="form-check-label" for="insurance">
                                    Mua mức giới hạn trách nhiệm pháp lý cao hơn từ FedEx
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Package Details -->
                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <label for="quantity" class="form-label">Gói hàng*</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" value="1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="weight" class="form-label">Trọng lượng gói hàng*</label>
                            <div class="input-group">
                                <input type="number" id="weight" name="weight" class="form-control" value="1">
                                <select class="form-select" name="weight_unit">
                                    <option value="lb" selected>lb</option>
                                    <option value="kg">kg</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dimensions" class="form-label">Kích thước D x R x C*</label>
                            <div class="input-group">
                                <input type="number" name="length" class="form-control" placeholder="D">
                                <input type="number" name="width" class="form-control" placeholder="R">
                                <input type="number" name="height" class="form-control" placeholder="C">
                                <select class="form-select" name="dimension_unit">
                                    <option value="in" selected>in</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Date -->
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <label for="shipping-date" class="form-label">Bạn muốn gửi hàng khi nào?*</label>
                            <select id="shipping-date" name="shipping_date" class="form-select">
                                <option selected>Thứ Bảy, 21 tháng 9, 2024</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <!-- @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @endif -->
                    <div id="resultMessage" class="mt-3 text-center"></div>
                    <div class="row mb-3">
                        <div class="col text-center">
                            <button type="submit" id="calculateButton" class="btn btn-primary">Hiển thị giá</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
   let timeoutId;

async function fetchLocationSuggestions(query, suggestionBoxId) {
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
                    const selectedLocation = { name: location.display_name, lat: location.lat, lon: location.lon };
                    document.getElementById(suggestionBoxId.replace('-suggestions', '')).value = selectedLocation.name;
                    suggestionBox.innerHTML = '';

                    // Lưu tọa độ để tính toán quãng đường
                    if (window.selectedLocations.length < 2) {
                        window.selectedLocations.push(selectedLocation);
                        if (window.selectedLocations.length === 2) {
                            calculateDistance(window.selectedLocations[0], window.selectedLocations[1]);
                            const origin = `${window.selectedLocations[0].lat},${window.selectedLocations[0].lon}`;
                        const destination = `${window.selectedLocations[1].lat},${window.selectedLocations[1].lon}`;
                        }
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
            console.log(`Quảng đường: ${(distance / 1000).toFixed(2)} km`);

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
</script>
@endsection

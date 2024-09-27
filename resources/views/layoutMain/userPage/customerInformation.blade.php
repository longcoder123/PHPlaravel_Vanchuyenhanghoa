@extends('layoutMain.layout')
@section('content')
<div class="container-fluid d-flex justify-content-center">
      <div class="custom-container">
        <div class="col-12 custom-bg-cl-box h-auto p-3 mt-5">
          <h3 class="col-12 text-center p-4">Tính giá cước vận chuyển</h3>
          <div class="px-5 col-12">
            <div class="row mb-3">
              <div class="col-md-12 mb-3">
                <label for="from" class="form-label">Từ*</label>
                <input type="text" id="from" class="form-control" placeholder="Nhập địa chỉ gửi" oninput="fetchLocationSuggestions(this.value, 'from-suggestions')">
                <div id="from-suggestions" class="suggestions"></div>
              </div>
              <div class="col-md-12 mb-3">
                <label for="to" class="form-label">Tới*</label>
                <input type="text" id="to" class="form-control" placeholder="Nhập địa chỉ nhận" oninput="fetchLocationSuggestions(this.value, 'to-suggestions')">
<div id="to-suggestions" class="suggestions"></div>
              </div>
            </div>
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
                <select id="packaging" class="form-select">
                  <option selected>Your Packaging</option>
                  <option value="1">FedEx Packaging</option>
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="insurance">
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
                <input type="number" id="quantity" class="form-control" value="1">
              </div>
              <div class="col-md-3 mb-3">
                <label for="weight" class="form-label">Trọng lượng gói hàng*</label>
                <div class="input-group">
                  <input type="number" id="weight" class="form-control" value="1">
                  <select class="form-select">
                    <option selected>lb</option>
                    <option value="kg">kg</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="dimensions" class="form-label">Kích thước D x R x C*</label>
                <div class="input-group">
                  <input type="number" class="form-control" placeholder="D">
                  <input type="number" class="form-control" placeholder="R">
                  <input type="number" class="form-control" placeholder="C">
                  <select class="form-select">
                    <option selected>in</option>
                    <option value="cm">cm</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Add Another Package -->
            <div class="row mb-3">
              <div class="col">
                <a href="#" class="text-primary">+ Thêm gói hàng khác</a>
              </div>
            </div>

            <!-- Shipping Date -->
            <div class="row mb-4">
              <div class="col-md-12 mb-3">
                <label for="shipping-date" class="form-label">Bạn muốn gửi hàng khi nào?*</label>
                <select id="shipping-date" class="form-select">
                  <option selected>Thứ Bảy, 21 tháng 9, 2024</option>
                </select>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="row mb-3">
              <div class="col text-center">
                <button class="btn btn-secondary" disabled>Hiển thị giá</button>
              </div>
            </div>

        </div>

      </div>
    </div>
    <script>
      let timeoutId;

      async function fetchLocationSuggestions(query, suggestionBoxId) {
        // Xóa nội dung nếu không có truy vấn
        if (!query) {
          document.getElementById(suggestionBoxId).innerHTML = '';
          return;
        }

        // Xóa timeout cũ nếu có
        clearTimeout(timeoutId);

        // Thiết lập timeout mới
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
                document.getElementById(suggestionBoxId.replace('-suggestions', '')).value = location.display_name;
                suggestionBox.innerHTML = '';
              };
              suggestionBox.appendChild(div);
            });
          } catch (error) {
            console.error('Error fetching location suggestions:', error);
          }
        }, 300); // Thời gian trì hoãn (500ms)
      }
    </script>
@endsection

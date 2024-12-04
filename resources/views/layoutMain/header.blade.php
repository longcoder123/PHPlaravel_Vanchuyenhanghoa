
    <div class="container-fluild p-4">
      <div class="col-12 d-flex">
        <div class="col-2 align-self-center" style="font-weight: 200px">Long FAST</div>
        <div class="col-8 d-flex justify-content-around px-3 align-self-center">
          <a href="" style="text-decoration: none">Giới thiệu</a><a href="" style="text-decoration: none">Các dịch vụ</a
          ><a href="" style="text-decoration: none ">Tra cứu đơn hàng</a>
        </div>
      {{-- Dropdown menu for login or user profile --}}
        <div class="dropdown">
          @if (Auth::check())
              <!-- If the user is logged in, show avatar and name -->
              <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ Auth::user()->avatar }}" alt="User Avatar" class="rounded-circle" width="30" height="30">
                  <span class="ms-2">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="{{route("infouser")}}">Thông tin</a></li>
                  <li><a class="dropdown-item" >
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                      @csrf
                      <button type="submit" class="btn btn-secondary">Đăng xuất</button>
                  </form>
                  
                  </a></li>
              </ul>
          @else
              <!-- If the user is not logged in, show 'Tương tác' button -->
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  Tương tác
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
          
              </ul>
          @endif
        </div>

      </div>
      <hr />
    </div>
    <div class="container-fluid banner">
      <div class="row">
        <div class="col-12">
          <h1>Chào mừng đến với dịch vụ vận chuyển</h1>
          <h2>Nhanh chóng, an toàn, và đáng tin cậy</h2>
        </div>
      </div>
      <div class="banner-buttons">
        <a href="{{ route('infor') }}" class="text-decoration-none text-white btn btn-primary fs-4">
          <i class="fa-solid fa-plus"></i> Tạo đơn hàng ngay
        </a>
        <a href="{{ route('detailpackage') }}"  class="btn btn-secondary fs-4">
          <i class="fa-solid fa-truck-arrow-right"></i> Theo dõi đơn hàng
        </a>
      </div>
    </div>

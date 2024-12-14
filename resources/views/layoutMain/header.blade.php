
    <div class="container-fluild p-4">
      <div class="col-12 d-flex">
        <div class="col-2 align-self-center" style="font-weight: bold; font-size: 24px;">
          <a href="/" class="text-decoration-none text-white">
              <i class="fas fa-truck"></i> FAST AND FURIOUS
          </a>
      </div>
      
      <div class="col-8 d-flex justify-content-around px-3 align-self-center">
        <a href="" class="nav-link">Giới thiệu</a>
        <a href="" class="nav-link">Các dịch vụ</a>
        <a href="" class="nav-link">Tra cứu đơn hàng</a>
    </div>
    
    <style>
        .nav-link {
            text-decoration: none;
            padding: 10px 20px; 
            border: 2px solid #fff; 
            border-radius: 5px; 
            color: white; /* Màu chữ */
            transition: background-color 0.3s, border-color 0.3s;
        }
    
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); 
            border-color: #f1c40f; 
        }
        a{
          font-weight: bold; font-size: 14px;
        }
    </style>
    
    
    <div class="dropdown">
      @if (Auth::check())  
          <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="ms-2" style="font-weight: bold; text-transform: uppercase; color: aliceblue;">
                  {{ Auth::user()->name }}
              </span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="{{route("infouser")}}">Thông tin</a></li>
              <li>
                  <a class="dropdown-item">
                      <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                          @csrf
                          <button type="submit" class="btn btn-secondary">Đăng xuất</button>
                      </form>
                  </a>
              </li>
          </ul>
      @else
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

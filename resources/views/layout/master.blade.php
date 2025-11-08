<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Cairo', sans-serif;
      background-color: #f9f9f9;
      color: #333;
    }

    /* Navbar */
    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .navbar-brand,
    .nav-link {
      color: #333 !important;
      font-weight: 600;
      transition: color 0.3s;
    }

    .nav-link:hover {
      color: #0d6efd !important;
    }

    .search-box {
      position: relative;
      width: 250px;
    }

    .search-box input {
      width: 100%;
      border-radius: 25px;
      border: 1px solid #ccc;
      padding: 8px 40px 8px 15px;
      outline: none;
      transition: 0.3s;
      background: #fff;
    }

    .search-box input:focus {
      box-shadow: 0 0 8px rgba(13, 110, 253, 0.3);
    }

    .search-box button {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      border: none;
      background: transparent;
      color: #555;
      font-size: 1.2rem;
      cursor: pointer;
    }

    /* Hero Section */
    .hero-section {
      position: relative;
      height: 70vh;
      background: url('https://images.unsplash.com/photo-1616627989410-59a2f7c57c9e?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .hero-overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.55);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      color: #fff;
      max-width: 700px;
      padding: 0 15px;
    }

    .hero-content h1 {
      font-size: 3rem;
      font-weight: 700;
      line-height: 1.4;
    }

    .hero-content p {
      font-size: 1.3rem;
      margin-top: 15px;
    }

    .hero-content .btn {
      padding: 0.8rem 2rem;
      border-radius: 30px;
      margin-top: 25px;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* Category Cards */
    .category-card {
      border: none;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: transform 0.3s;
    }

    .category-card:hover {
      transform: translateY(-5px);
    }

    .category-card img {
      height: 200px;
      object-fit: cover;
      transition: transform 0.4s;
    }

    .category-card:hover img {
      transform: scale(1.05);
    }

    .category-card .card-body {
      background-color: #fff;
      text-align: center;
    }

    /* Footer */
    footer {
      background-color: #f1f1f1;
      color: #666;
      padding: 40px 0;
      text-align: center;
    }

    footer a {
      color: #0d6efd;
      text-decoration: none;
      transition: 0.3s;
    }

    footer a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2rem;
      }

      .hero-content p {
        font-size: 1rem;
      }

      .search-box input {
        width: 180px;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
<nav class="navbar navbar-expand-lg py-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('shop.index') }}">المتجر الذهبي</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center gap-3">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('shop.index') }}">الأقسام</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#featured">عروض اليوم</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reviews.show') }}">آراء العملاء</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">اتصل بنا</a>
        </li>
      </ul>

      <!-- Search Form -->
      <form class="d-flex ms-lg-3 mt-3 mt-lg-0 search-box" action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="ابحث عن منتج..." required>
        <button type="submit"><i class="bi bi-search"></i></button>
      </form>

      @guest
  <!-- زر تسجيل الدخول للزائر -->
  <div class="ms-3 mt-3 mt-lg-0">
    <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 rounded-pill fw-semibold">
      <i class="bi bi-person-circle me-1"></i> تسجيل الدخول
    </a>
  </div>
@endguest

@auth
  <!-- Dropdown للمستخدم المسجل -->
  <div class="dropdown ms-3 mt-3 mt-lg-0">
    <button class="btn btn-outline-success px-4 rounded-pill fw-semibold dropdown-toggle"
            type="button" id="accountDropdown" data-bs-toggle="dropdown">
      <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
    </button>

    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="{{ route('profile') }}">حسابي</a>
      </li>
      <li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="dropdown-item">تسجيل الخروج</button>
        </form>
      </li>
    </ul>
  </div>
@endauth

    </div>
  </div>
</nav>


  <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>تسوق إلكتروني بأمان وسهولة مع <span class="text-warning">المتجر الذهبي</span></h1>
      <p>منتجات مميزة، عروض يومية، وخدمة توصيل سريعة إلى باب منزلك</p>
      <a class="btn btn-primary me-2" href="{{ route('shop.index') }}">تسوق الآن</a>
      <a class="btn btn-outline-light" href="#featured">اكتشف العروض</a>
    </div>
  </section>

  <!-- Main Content -->
  <div class="container my-5">
    @yield('content')
  </div>

  <!-- Footer -->
  <footer id="contact">
    <div class="container">
      <p>© 2025 المتجر الذهبي. جميع الحقوق محفوظة.</p>
      <p>تواصل معنا: <a href="mailto:info@goldstore.com">info@goldstore.com</a> | 0100000000</p>
    </div>
  </footer>

  <!-- Bootstrap + Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html>


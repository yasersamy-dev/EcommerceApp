@extends('layout.master')

@section('title', 'تسجيل الدخول')

@section('content')
<section class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4 fw-bold">تسجيل الدخول</h3>

    <form action="{{ route('login.submit') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">كلمة المرور</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
    </form>

    <p class="text-center mt-3">
      ليس لديك حساب؟
      <a href="{{ route('register') }}" class="text-decoration-none">أنشئ حسابًا الآن</a>
    </p>
  </div>
</section>
@endsection

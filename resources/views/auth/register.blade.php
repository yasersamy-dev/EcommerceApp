@extends('layout.master')

@section('title', 'إنشاء حساب')

@section('content')
<section class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 450px;">
    <h3 class="text-center mb-4 fw-bold">إنشاء حساب جديد</h3>

    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">الاسم الكامل</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">كلمة المرور</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100">إنشاء الحساب</button>
    </form>

    <p class="text-center mt-3">
      لديك حساب بالفعل؟
      <a href="{{ route('login') }}" class="text-decoration-none">سجّل الدخول الآن</a>
    </p>
  </div>
</section>
@endsection

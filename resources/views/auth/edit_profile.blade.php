@extends('layout.master')

@section('title', 'تعديل الملف الشخصي')

@section('content')
<div class="container my-5">
  <div class="card p-4 shadow-lg border-0" style="max-width: 600px; margin: auto;">
    <h4 class="text-center mb-4">تعديل الملف الشخصي</h4>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label fw-semibold">الاسم</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
        @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
        @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">صورة الملف الشخصي</label>
        <input type="file" name="profile_image" class="form-control" accept="image/*">
        @error('profile_image') <div class="text-danger mt-1">{{ $message }}</div> @enderror

        @if(Auth::user()->profile_image && file_exists(public_path(Auth::user()->profile_image)))
          <div class="mt-3 text-center">
            <p class="text-muted">الصورة الحالية:</p>
            <img src="{{ asset(Auth::user()->profile_image) }}" alt="الصورة الحالية" width="120" class="rounded shadow">
          </div>
        @endif
      </div>

      <div class="text-center mt-4 d-flex justify-content-center gap-2">
        <button type="submit" class="btn btn-success px-4 fw-semibold">حفظ البيانات</button>
        <a href="{{ route('profile') }}" class="btn btn-secondary px-4 fw-semibold">العودة</a>
      </div>
    </form>
  </div>
</div>
@endsection

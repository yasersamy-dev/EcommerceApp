@extends('layout.master')

@section('title', 'الملف الشخصي')

@section('content')
<div class="container my-5">
  <div class="card p-4 shadow-lg border-0" style="max-width: 600px; margin: auto;">
    
    <div class="text-center mb-4">
      @if(Auth::user()->profile_image && file_exists(public_path(Auth::user()->profile_image)))
          <img src="{{ asset(Auth::user()->profile_image) }}" 
               alt="صورة المستخدم" 
               class="rounded-circle shadow" 
               width="120" height="120" 
               style="object-fit: cover;">
      @else
          <i class="bi bi-person-circle text-secondary" style="font-size: 100px;"></i>
      @endif
      <h3 class="mt-3">{{ Auth::user()->name }}</h3>
      <p class="text-muted">{{ Auth::user()->email }}</p>
    </div>

    <hr>

    <div class="mt-3">
      <p class="fw-semibold">نوع الحساب: <span class="text-primary">مستخدم عادي</span></p>
      <p class="fw-semibold">تاريخ الإنضمام:
        <span class="text-success">{{ Auth::user()->created_at->format('Y-m-d') }}</span>
      </p>
    </div>

    <div class="text-center mt-4 d-flex justify-content-center gap-2">
      <a href="{{ route('profile.edit') }}" class="btn btn-warning px-4 fw-semibold">تعديل الملف الشخصي</a>
      <a href="{{ url('/') }}" class="btn btn-primary px-4 fw-semibold">العودة للرئيسية</a>
    </div>
  </div>
</div>
@endsection



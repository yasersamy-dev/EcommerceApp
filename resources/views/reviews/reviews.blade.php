@extends('layout.master')
@section('content')
{{-- 🗣️ إضافة رأي جديد --}}
<div class="container my-5">
  <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <form action="{{ route('reviews.store') }}" method="POST" class="p-4 shadow rounded bg-white" style="width: 100%; max-width: 500px;">
      @csrf
      <h4 class="text-center mb-4">أضف رأيك</h4>

      @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
      @endif

      <div class="mb-3">
        <label for="username" class="form-label">اسم المستخدم</label>
        <input type="text" name="name" class="form-control" id="username" placeholder="اكتب اسمك هنا" required>
      </div>

      <div class="mb-3">
        <label for="comment" class="form-label">التعليق</label>
        <textarea name="comment" class="form-control" id="comment" rows="4" placeholder="اكتب تعليقك هنا" required></textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-success px-4">إضافة تعليق</button>
      </div>
    </form>
  </div>
</div>

{{-- 💬 عرض آراء العملاء --}}
<div class="container my-5">
  <h3 class="text-center mb-4">آراء العملاء</h3>

  @forelse ($reviews as $review)
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="card-title text-success fw-bold">{{ $review->name }}</h5>
        <p class="card-text">{{ $review->comment }}</p>
        <p class="text-muted small mb-0">تمت الإضافة في {{ $review->created_at->format('Y-m-d / h:i A') }}</p>
      </div>
    </div>
  @empty
    <p class="text-center text-muted">لا توجد آراء بعد.</p>
  @endforelse
</div>
@endsection
@extends('layout.master')
@section('content')

<!-- الأقسام -->
<section id="categories" class="container my-5">
  <h2 class="text-center mb-5">الأقسام</h2>
  <div class="row g-4">
      @foreach ($categories as $category)
          <div class="col-md-4 col-lg-4">
              <div class="card category-card shadow-sm">
                  <div class="overflow-hidden rounded">
                    <img src="{{ asset($category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                  </div>
                  <div class="card-body text-center">
                      <h5 class="fw-bold">{{ $category->name }}</h5>
                      <a href="{{ route('shop.show', $category->id) }}" class="btn btn-outline-dark mt-3 px-4">تصفح</a>
                  </div>
              </div>
          </div>
      @endforeach
  </div>
</section>


<!-- إضافات CSS صغيرة -->
@push('styles')
<style>
  .category-card:hover img, .product-card:hover img {
      transform: scale(1.05);
      transition: transform 0.4s;
  }
  .product-card .badge {
      font-size: 0.9rem;
      padding: 0.4em 0.6em;
      border-radius: 0.5rem;
  }
</style>
@endpush

@endsection

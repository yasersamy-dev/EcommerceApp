@extends('layout.master')

@section('content')
<section class="container my-5">
  <h2 class="text-center mb-4">نتائج البحث عن: "{{ $query }}"</h2>

  @if($products->count() > 0)
    <div class="row g-4">
      @foreach($products as $product)
        <div class="col-md-4 col-lg-3">
          <div class="card product-card">
            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body text-center">
              <h5>{{ $product->name }}</h5>
              <p class="text-muted">{{ $product->price }} جنيه</p>
              <a href="#" class="btn btn-sm btn-warning">عرض التفاصيل</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="alert alert-warning text-center">لا توجد نتائج مطابقة لبحثك.</div>
  @endif
</section>
@endsection

@extends('layout.master')

@section('content')
<div class="container">
    <div class="card mx-auto" style="max-width: 600px;">
        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body">
            <h3 class="card-title">{{ $product->name }}</h3>
            <p class="card-text">{{ $product->description }}</p>
            <h4 class="text-success">{{ $product->price }} جنيه</h4>

            <a href="{{ route('products.checkout', $product->id) }}" class="btn btn-primary w-100 mt-3">
                شراء الآن
            </a>
        </div>
    </div>
</div>
@endsection

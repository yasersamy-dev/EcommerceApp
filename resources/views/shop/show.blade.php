@extends('layout.master')

@section('content')
<section id="categories" class="container my-5">
    <h2 class="text-center mb-4">منتجات قسم {{ $category->name }}</h2>

    {{-- زر إضافة منتج جديد --}}
    @auth
        @if (auth()->user()->role === 'admin')
            <div class="text-end mb-4">
                <a href="{{ route('products.create', $category->id) }}" class="btn btn-success">إضافة منتج جديد</a>
            </div>  
        @endif
    @endauth
    

    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover; border-radius: 10px 10px 0 0;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                        <p class="text-muted mb-2">{{ number_format($product->price, 2) }} جنيه</p>

                        {{-- أزرار التعديل والحذف (للمشرف فقط) --}}
                        @auth
                            @if (auth()->user()->role === 'admin') 
                                <div class="mt-3 d-flex justify-content-center gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">تعديل</a>

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المنتج؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                        {{-- زر الشراء يظهر فقط للمستخدم العادي أو الزائر --}}
                        @guest
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-sm mt-3">تسوّق الآن</a>
                        @endguest

                        @auth
                            @if (auth()->user()->role !== 'admin')
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-sm mt-3">تسوّق الآن</a>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection


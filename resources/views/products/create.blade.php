@extends('layout.master')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">اضافه منتج</h2>

    <div class="card shadow p-4">
        {{-- ✅ نوجه الفورم إلى Route اضافه--}}
        <form action="{{ route('products.store', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- اسم المنتج --}}
            <div class="mb-3">
                <label class="form-label">اسم المنتج</label>
                <input type="text" 
                       name="name" 
                       class="form-control" 
                       placeholder="اكتب اسم المنتج" 
                       value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- الوصف --}}
            <div class="mb-3">
                <label class="form-label">الوصف</label>
                <textarea name="description" 
                          class="form-control" 
                          rows="4" 
                          placeholder="اكتب وصف المنتج">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- السعر --}}
            <div class="mb-3">
                <label class="form-label">السعر</label>
                <input type="number" 
                       name="price" 
                       class="form-control" 
                       placeholder="ادخل السعر" 
                       step="0.01" 
                       value="{{ old('price', $category->price) }}">
                @error('price')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- الصورة --}}
            <div class="mb-3">
                <label class="form-label">صورة المنتج</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @error('image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                {{-- عرض الصورة الحالية --}}
                @if($category->image)
                    <div class="mt-3">
                        <p>الصورة الحالية:</p>
                        <img src="{{ asset($category->image) }}" alt="صورة المنتج" width="120" class="rounded shadow">
                    </div>
                @endif
            </div>

            {{-- القسم --}}
            <div class="mb-3">
                <label class="form-label">القسم</label>
                <input type="text" value="{{ $category->name }}" class="form-control" readonly>
            </div>

            {{-- الزر --}}
            <button type="submit" class="btn btn-success w-100">اضافه المنتج </button>
        </form>
    </div>
</div>
@endsection



@extends('layout.master')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 500px; width: 100%;">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary">💳 إتمام عملية الشراء</h3>
            <hr>
            <p class="mb-1">المنتج: <strong>{{ $product->name }}</strong></p>
            <p class="text-muted">السعر: <strong class="text-success">{{ $product->price }} جنيه</strong></p>
        </div>

        <form>
            <div class="mb-3">
                <label class="form-label fw-semibold">الاسم الكامل</label>
                <input type="text" class="form-control form-control-lg" placeholder="ادخل اسمك الكامل">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">العنوان</label>
                <input type="text" class="form-control form-control-lg" placeholder="ادخل عنوان التوصيل">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">رقم الهاتف</label>
                <input type="text" class="form-control form-control-lg" placeholder="ادخل رقم الهاتف">
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">طريقة الدفع</label>
                <select class="form-select form-select-lg">
                    <option selected disabled>اختر طريقة الدفع</option>
                    <option value="cash">الدفع عند الاستلام</option>
                    <option value="credit">بطاقة بنكية</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100 rounded-3 shadow-sm">
                <i class="bi bi-check-circle me-2"></i> تأكيد الدفع
            </button>
        </form>
    </div>
</div>
@endsection


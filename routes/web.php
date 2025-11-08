<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckAdmin;


// 🏪 صفحات المتجر العامة (للزوار + المستخدمين)
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/search', [ShopController::class, 'search'])->name('search');

// 🛒 صفحة المنتج الفردي + صفحة الدفع (تحتاج تسجيل دخول)
Route::middleware('auth')->group(function () {
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/checkout/{id}', [ProductController::class, 'checkout'])->name('products.checkout');
 
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
  

// 🔐 تسجيل الدخول والتسجيل
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showloginform'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegisterform'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// 🚪 تسجيل الخروج
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 🛠️ صفحات الأدمن (تحتاج auth + checkadmin)
Route::middleware(['auth', CheckAdmin::class])->group(function () {
    // إنشاء منتج جديد
    Route::get('/products/create/{category_id}', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store/{category_id}', [ProductController::class, 'store'])->name('products.store');

    // تعديل وحذف المنتجات
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// 💬 آراء العملاء (مفتوحة للجميع)
Route::get('/reviews', [CustomerReviewController::class, 'showReviews'])->name('reviews.show');
Route::post('/reviews', [CustomerReviewController::class, 'store'])->name('reviews.store');

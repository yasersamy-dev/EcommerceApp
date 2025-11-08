<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\updateProductRequest;
use Illuminate\Support\Facades\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function create($category_id){
        if (!Auth::check() || Auth::user()->role !== 'admin') {
    abort(403, 'Unauthorized Access');
   }

        $category = Category::findOrFail($category_id);
        return view('products.create', compact('category'));
    }

    public function store( StoreProductRequest $request , $category_id){
        // dd('validation شغال');

          $imageName = time() . '.' . $request->image->extension();
          $request->image->move(public_path('categories'), $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = 'categories/' . $imageName; // المسار النسبي
        $product->category_id = $category_id;
        $product->save();

    // ✅ إعادة التوجيه بعد الإضافة
    return redirect()->route('shop.show', ['id' => $category_id]);
    }

   public function edit($id)
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
    abort(403, 'Unauthorized Access');
}

    $product = Product::findOrFail($id);
    $category = $product->category;
    return view('products.edit', compact('product', 'category'));
}

public function update(UpdateProductRequest $request, $id)
{
    $product = Product::findOrFail($id);

    // تحديث الصورة لو تم رفع جديدة
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('categories'), $imageName);
        $product->image = 'categories/' . $imageName;
    }

    // تحديث باقي البيانات
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->save();

    // إعادة التوجيه إلى صفحة القسم مع رسالة نجاح
    return redirect()
        ->route('shop.show', ['id' => $product->category_id])
        ->with('success', 'تم تحديث المنتج بنجاح!');
}
public function destroy($id){
    if (!Auth::check() || Auth::user()->role !== 'admin') {
    abort(403, 'Unauthorized Access');
  }

    $product = Product::findOrFail($id);
     if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }
    $product->delete();
    return redirect()->back()->with('success', 'تم حذف المنتج بنجاح!');
}
public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}

public function checkout($id)
{
    $product = Product::findOrFail($id);
    return view('products.checkout', compact('product'));
}


}

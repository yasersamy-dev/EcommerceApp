<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class ShopController extends Controller
{
    public function index(){
        $categories = Category::all();

        return view('shop.index', compact('categories'));
    }
    public function show($id){

        $category =  Category::findorFail($id);
        $products = $category->products;


        return view('shop.show', compact('category','products'));
    }
public function search(Request $request)
{
    $query = trim($request->input('query'));

    $products = \App\Models\Product::query()
        ->where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->get();

    return view('shop.search', compact('products', 'query'));
}


}

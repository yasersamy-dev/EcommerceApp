<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerReview;

class CustomerReviewController extends Controller
{
    public function showReviews(){
        $reviews = CustomerReview::latest()->get();
        return view('reviews.reviews',compact('reviews'));
    }
    public function store(Request $request){
        $request->validate([
            'name'=> 'required|string|max:255',
            'comment' => 'required|string|max:1000',
        ]);

         CustomerReview::create([
            'name'=>$request->name,
            'comment'=>$request->comment,
        ]);
        return redirect()->route('reviews.show')->with('success', 'تم إضافة رأيك بنجاح!');
    }
}

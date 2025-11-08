<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function edit()
    {
        return view('auth.edit_profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_image')) {
            // حذف القديمة إن وجدت
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            // رفع الجديدة داخل public/categories
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('categories'), $imageName);
            $user->profile_image = 'categories/' . $imageName;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}


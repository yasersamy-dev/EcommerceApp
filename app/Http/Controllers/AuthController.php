<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showloginform(){
        return view('auth.login');
    }
    public function login(Request $request){
        // validation and authentication logic here
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // Attempt to authenticate the user
        $user = $request->only('email','password');
        if(Auth::attempt($user)){
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحه']);
    }

    public function showRegisterform(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:5',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        
       
        return redirect()->route('login')->with('success', 'تم إنشاء الحساب بنجاح، يمكنك تسجيل الدخول الآن');
    
    }


public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
}
// if (Auth::user()->role !== 'admin') {
//     abort(403, 'Unauthorized Access');
// }

}

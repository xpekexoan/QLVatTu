<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Login\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect(route('index'));
        }
        return view('login');
    }
 
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['TaiKhoan', 'MatKhau']);
        $bool = $request->has('remember') ? true : false;
        if (Auth::attempt($credentials, $bool)) {
            return redirect(route('index'));
        };
        return back()->with('alert-fail', 'Đăng nhập thất bại!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}

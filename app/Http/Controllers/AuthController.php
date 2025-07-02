<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công (Admin)');
            }

            // 👇 Chuyển về trang chủ nếu không phải admin
            return redirect()->route('client.home')->with('success', 'Đăng nhập thành công');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user', // hoặc để mặc định trong migration
        ]);

        Auth::login($user); // 👈 Tự động đăng nhập

        return redirect()->route('client.home')->with('success', 'Đăng ký thành công');
    }
}

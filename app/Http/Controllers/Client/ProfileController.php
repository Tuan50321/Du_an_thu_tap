<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Kiểm tra và tạo profile nếu chưa tồn tại
        if (!$user->profile) {
            $profile = new UserProfile();
            $profile->user_id = $user->id;
            $profile->save();
        }
        
        return view('client.profile.index', compact('user'));
    }

    public function edit()
    {
        return view('client.profile.edit');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:0,1',
            'province' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $profile = $user->profile ?? new UserProfile(['id' => $user->id]);
        $profile->phone = $request->phone;
        $profile->birthday = $request->birthday;
        $profile->gender = $request->gender;
        $profile->province = $request->province;
        $profile->district = $request->district;
        $profile->ward = $request->ward;
        $profile->street = $request->street;
        $profile->save();

        return Redirect::route('client.profile.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function password()
    {
        return view('client.profile.password');
    }

    public function updatePassword(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'new_password_confirmation.required' => 'Vui lòng xác nhận mật khẩu mới'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return Redirect::back()->withErrors([
                'current_password' => 'Mật khẩu hiện tại không đúng'
            ])->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Tạo thông báo thành công
        return Redirect::route('client.profile.password')->with('success', 'Đổi mật khẩu thành công!');
    }
}

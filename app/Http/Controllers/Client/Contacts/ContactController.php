<?php

namespace App\Http\Controllers\Client\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('client.contacts.formcontact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'phone'   => ['nullable', 'regex:/^(0|\+84)[0-9]{9}$/'],
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required'    => 'Vui lòng nhập họ tên.',
            'email.email'      => 'Email không đúng định dạng.',
            'phone.regex'      => 'Số điện thoại không hợp lệ.',
            'subject.required' => 'Vui lòng nhập tiêu đề liên hệ.',
            'message.required' => 'Vui lòng nhập nội dung liên hệ.',
            'message.min'      => 'Nội dung liên hệ tối thiểu 10 ký tự.',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('client.contacts.index')->with('success', 'Gửi liên hệ thành công!');
    }
}

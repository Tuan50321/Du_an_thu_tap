<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact; // Sử dụng model Contact

class ContactAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%");
        }

        $contacts = $query->latest()->paginate(10);

        return view('admin.contact.index', compact('contacts'));
    }


    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]); // đánh dấu đã đọc
        return view('admin.contact.show', compact('contact'));
    }


    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Đã xoá liên hệ.');
    }
}

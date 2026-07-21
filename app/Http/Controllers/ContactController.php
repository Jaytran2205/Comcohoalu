<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Setting;
use App\Mail\AdminContactNotificationMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Trang liên hệ (1 cơ sở duy nhất).
     */
    public function index()
    {
        $settings = Setting::allCached();

        return view('pages.contact', compact('settings'));
    }

    /**
     * Xử lý gửi form liên hệ.
     */
    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        // Gửi email thông báo cho Admin
        $adminEmail = Setting::get('site_email', 'contact@comcohoalu.vn');
        Mail::to($adminEmail)->send(new AdminContactNotificationMail($contact));

        return back()->with('success', 'Tin nhắn của bạn đã được gửi thành công! Chúng tôi sẽ liên hệ lại sớm nhất.');
    }
}

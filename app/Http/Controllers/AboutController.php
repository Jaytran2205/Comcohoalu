<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $settings = Setting::allCached();

        return view('pages.about', compact('settings'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Post;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = MenuItem::available()
            ->featured()
            ->ordered()
            ->with('category')
            ->take(10)
            ->get();

        $latestPosts = Post::latestPublished()
            ->with('category')
            ->take(6)
            ->get();

        $settings = Setting::allCached();

        return view('pages.home', compact('featuredItems', 'latestPosts', 'settings'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Post;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = \Illuminate\Support\Facades\Cache::remember('home.featured_items', 3600, function () {
            return MenuItem::available()
                ->featured()
                ->ordered()
                ->with('category')
                ->take(10)
                ->get();
        });

        $latestPosts = \Illuminate\Support\Facades\Cache::remember('home.latest_posts', 3600, function () {
            return Post::latestPublished()
                ->with('category')
                ->take(6)
                ->get();
        });

        $settings = Setting::allCached();

        return view('pages.home', compact('featuredItems', 'latestPosts', 'settings'));
    }
}

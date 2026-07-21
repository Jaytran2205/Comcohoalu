<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;

class PostController extends Controller
{
    /**
     * Danh sách bài viết theo danh mục (Tin tức, Khuyến mãi, Tuyển dụng).
     */
    public function category(string $slug)
    {
        $category = PostCategory::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->byCategory($slug)
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('pages.posts.category', compact('category', 'posts'));
    }

    /**
     * Chi tiết bài viết.
     */
    public function show(string $slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->with(['category', 'author'])
            ->firstOrFail();

        // Tăng lượt xem
        $post->incrementViews();

        // Bài viết liên quan (cùng danh mục, trừ bài hiện tại)
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        return view('pages.posts.show', compact('post', 'relatedPosts'));
    }
}

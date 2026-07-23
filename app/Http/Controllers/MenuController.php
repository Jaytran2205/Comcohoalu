<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\SetMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Trang thực đơn chính (SSR).
     */
    public function index()
    {
        $categories = \Illuminate\Support\Facades\Cache::remember('menu.categories', 3600, function () {
            return MenuCategory::active()->ordered()->get();
        });

        $items = MenuItem::available()
            ->ordered()
            ->with('category')
            ->paginate(12);

        $setMenus = \Illuminate\Support\Facades\Cache::remember('menu.set_menus', 3600, function () {
            return SetMenu::active()
                ->ordered()
                ->with('items')
                ->get();
        });

        return view('pages.menu', compact('categories', 'items', 'setMenus'));
    }

    /**
     * Trang thực đơn ảnh quét/thiết kế công khai.
     */
    public function menuBoard()
    {
        $boards = \Illuminate\Support\Facades\Cache::remember('menu.boards', 3600, function () {
            return \App\Models\MenuBoard::active()->ordered()->get();
        });

        return view('pages.menu-board', compact('boards'));
    }

    /**
     * AJAX: Lọc món theo danh mục và tìm kiếm, hỗ trợ phân trang.
     */
    public function filter(Request $request): JsonResponse
    {
        $categoryId = $request->integer('category_id');
        $search = $request->string('search')->trim();

        $items = MenuItem::available()
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->byCategory($categoryId);
            })
            ->when($search->isNotEmpty(), function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->ordered()
            ->with('category')
            ->paginate(12);

        $html = view('partials.menu-grid', ['menuItems' => $items->items()])->render();

        return response()->json([
            'html' => $html,
            'count' => $items->total(),
            'hasMore' => $items->hasMorePages(),
            'nextPage' => $items->currentPage() + 1
        ]);
    }

    /**
     * AJAX: Tìm kiếm món ăn theo tên (đồng bộ với API filter).
     */
    public function search(Request $request): JsonResponse
    {
        $categoryId = $request->integer('category_id');
        $search = $request->string('q')->trim();

        $items = MenuItem::available()
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->byCategory($categoryId);
            })
            ->when($search->isNotEmpty(), function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->ordered()
            ->with('category')
            ->paginate(12);

        $html = view('partials.menu-grid', ['menuItems' => $items->items()])->render();

        return response()->json([
            'html' => $html,
            'count' => $items->total(),
            'hasMore' => $items->hasMorePages(),
            'nextPage' => $items->currentPage() + 1
        ]);
    }

    /**
     * AJAX: Quick view chi tiết món ăn.
     */
    public function quickView(int $id): JsonResponse
    {
        $item = MenuItem::with('category')->findOrFail($id);

        return response()->json([
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'formatted_price' => $item->formatted_price,
            'image' => $item->image,
            'badge' => $item->badge?->label(),
            'category' => $item->category->name,
        ]);
    }
}

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
        $categories = MenuCategory::active()->ordered()->get();

        $items = MenuItem::available()
            ->whereIn('image', $this->getCustomImages())
            ->ordered()
            ->with('category')
            ->paginate(12);

        $setMenus = SetMenu::active()
            ->ordered()
            ->with('items')
            ->get();

        return view('pages.menu', compact('categories', 'items', 'setMenus'));
    }

    /**
     * Trang thực đơn ảnh quét/thiết kế công khai.
     */
    public function menuBoard()
    {
        $boards = \App\Models\MenuBoard::active()->ordered()->get();

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
            ->whereIn('image', $this->getCustomImages())
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
            ->whereIn('image', $this->getCustomImages())
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

    /**
     * Danh sách ảnh món ăn tự tải lên bởi người dùng.
     */
    private function getCustomImages(): array
    {
        return [
            'images/dishes/khoai-tay-chien.png',
            'images/dishes/ngo-chien.png',
            'images/dishes/muc-chien.png',
            'images/dishes/ca-thu-sot-ca.png',
            'images/dishes/bo-xao-ngong-toi.png',
            'images/dishes/bo-xao-mang-truc.png',
            'images/dishes/tiet-canh-de.png',
            'images/dishes/de-xao-lan.png',
            'images/dishes/chan-de-ham.png',
            'images/dishes/ca-chuoi-kho-to.png',
            'images/dishes/tom-dong-rang.png',
            'images/dishes/chep-gion-xao-can.png',
            'images/dishes/ca-tam-rang-muoi.png',
            'images/dishes/cua-dong-rang.png',
            'images/dishes/cha-oc.png',
            'images/dishes/thit-chao-rieng.png',
            'images/dishes/thit-rang.png',
            'images/dishes/thit-mam-tep.png',
            'images/dishes/ga-rang-muoi.png',
            'images/dishes/ga-luoc.png'
        ];
    }
}

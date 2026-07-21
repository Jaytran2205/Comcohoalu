<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = MenuCategory::withCount('items')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.menu-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:menu_categories,name'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.max' => 'Tên danh mục không vượt quá 100 ký tự.',
            'name.unique' => 'Tên danh mục này đã tồn tại.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        MenuCategory::create($validated);

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'Đã thêm danh mục món ăn mới.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuCategory $menuCategory)
    {
        return view('admin.menu-categories.edit', compact('menuCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:menu_categories,name,' . $menuCategory->id],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.max' => 'Tên danh mục không vượt quá 100 ký tự.',
            'name.unique' => 'Tên danh mục này đã tồn tại.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        $menuCategory->update($validated);

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', "Đã cập nhật danh mục \"{$menuCategory->name}\".");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuCategory $menuCategory)
    {
        // Safety check: Don't delete category if it still has items
        if ($menuCategory->items()->count() > 0) {
            return back()->with('error', "Không thể xóa danh mục \"{$menuCategory->name}\" vì vẫn còn món ăn trực thuộc. Hãy di chuyển hoặc xóa các món ăn trước.");
        }

        $menuCategory->delete();

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', "Đã xóa danh mục \"{$menuCategory->name}\".");
    }
}

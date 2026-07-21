<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boards = MenuBoard::ordered()->paginate(20);

        return view('admin.menu-boards.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu-boards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ], [
            'image.required' => 'Vui lòng chọn hình ảnh thực đơn.',
            'image.image' => 'File tải lên phải là hình ảnh (JPG, PNG, WEBP).',
            'image.max' => 'Hình ảnh tải lên không quá 4MB.',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu_boards', 'public');
        }

        MenuBoard::create($validated);

        return redirect()
            ->route('admin.menu-boards.index')
            ->with('success', 'Đã tải lên trang thực đơn ảnh mới.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuBoard $menuBoard)
    {
        return view('admin.menu-boards.edit', compact('menuBoard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuBoard $menuBoard)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ], [
            'image.image' => 'File tải lên phải là hình ảnh (JPG, PNG, WEBP).',
            'image.max' => 'Hình ảnh tải lên không quá 4MB.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // Delete old file if exists
            if ($menuBoard->image) {
                Storage::disk('public')->delete($menuBoard->image);
            }
            $validated['image'] = $request->file('image')->store('menu_boards', 'public');
        }

        $menuBoard->update($validated);

        return redirect()
            ->route('admin.menu-boards.index')
            ->with('success', 'Đã cập nhật trang thực đơn ảnh.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuBoard $menuBoard)
    {
        // Delete image file from storage
        if ($menuBoard->image) {
            Storage::disk('public')->delete($menuBoard->image);
        }

        $menuBoard->delete();

        return redirect()
            ->route('admin.menu-boards.index')
            ->with('success', 'Đã xóa trang thực đơn ảnh.');
    }
}

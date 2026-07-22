<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\SetMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SetMenuController extends Controller
{
    public function index(Request $request)
    {
        $query = SetMenu::with('items');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $setMenus = $query->ordered()->paginate(15)->withQueryString();

        return view('admin.set-menus.index', compact('setMenus'));
    }

    public function create()
    {
        $menuItems = MenuItem::available()->orderBy('name')->get();

        return view('admin.set-menus.create', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'people_count' => ['required', 'integer', 'min:1'],
            'price_per_person' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
            'items' => ['nullable', 'array'],
            'items.*' => ['exists:menu_items,id'],
            'item_quantities' => ['nullable', 'array'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        $originalSlug = $validated['slug'];
        $count = 1;
        while (SetMenu::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$originalSlug}-{$count}";
            $count++;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('set-menus', 'public');
        }

        $setMenu = SetMenu::create($validated);

        if (!empty($request->input('items'))) {
            $attachData = [];
            $quantities = $request->input('item_quantities', []);
            foreach ($request->input('items') as $itemId) {
                $qty = isset($quantities[$itemId]) ? max(1, (int)$quantities[$itemId]) : 1;
                $attachData[$itemId] = ['quantity' => $qty];
            }
            $setMenu->items()->sync($attachData);
        }

        return redirect()
            ->route('admin.set-menus.index')
            ->with('success', 'Đã thêm set mâm cơm mới thành công!');
    }

    public function edit(SetMenu $setMenu)
    {
        $setMenu->load('items');
        $menuItems = MenuItem::available()->orderBy('name')->get();

        return view('admin.set-menus.edit', compact('setMenu', 'menuItems'));
    }

    public function update(Request $request, SetMenu $setMenu)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'people_count' => ['required', 'integer', 'min:1'],
            'price_per_person' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
            'items' => ['nullable', 'array'],
            'items.*' => ['exists:menu_items,id'],
            'item_quantities' => ['nullable', 'array'],
        ]);

        if ($validated['name'] !== $setMenu->name) {
            $validated['slug'] = Str::slug($validated['name']);
            $originalSlug = $validated['slug'];
            $count = 1;
            while (SetMenu::where('slug', $validated['slug'])->where('id', '!=', $setMenu->id)->exists()) {
                $validated['slug'] = "{$originalSlug}-{$count}";
                $count++;
            }
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('set-menus', 'public');
        } elseif (is_string($request->input('image'))) {
            $validated['image'] = $request->input('image');
        }

        $setMenu->update($validated);

        $syncData = [];
        if (!empty($request->input('items'))) {
            $quantities = $request->input('item_quantities', []);
            foreach ($request->input('items') as $itemId) {
                $qty = isset($quantities[$itemId]) ? max(1, (int)$quantities[$itemId]) : 1;
                $syncData[$itemId] = ['quantity' => $qty];
            }
        }
        $setMenu->items()->sync($syncData);

        return redirect()
            ->route('admin.set-menus.index')
            ->with('success', 'Đã cập nhật mâm cơm set thành công!');
    }

    public function destroy(SetMenu $setMenu)
    {
        $setMenu->delete();

        return redirect()
            ->route('admin.set-menus.index')
            ->with('success', 'Đã xóa set mâm cơm thành công!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_delete', 0)->get();
        return view('category.index', ['categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::where('is_delete', 0)->get();
        return view('category.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id'   => 'nullable|exists:categories,id',
            'is_active'   => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $imagePath,
            'parent_id'   => $request->parent_id,
            'is_active'   => $request->is_active ?? 1,
        ]);

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id'   => 'nullable|exists:categories,id',
            'is_active'   => 'nullable|boolean',
        ]);

        $imagePath = $category->image; // giữ ảnh cũ
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($category->image) {
                \Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category->update([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $imagePath,
            'parent_id'   => $request->parent_id,
            'is_active'   => $request->is_active ?? 1,
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        // Lấy tất cả ID con cháu để loại khỏi danh sách chọn
        $excludeIds = $this->getDescendantIds($category);
        $excludeIds[] = $category->id; // loại chính nó

        $categories = Category::where('is_delete', 0)
            ->whereNotIn('id', $excludeIds)
            ->get();

        return view('category.edit', [
            'category'   => $category,
            'categories' => $categories,
        ]);
    }

    // public function update(Request $request, string $id)
    // {
    //     $category = Category::findOrFail($id);

    //     $request->validate([
    //         'name'        => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'image'       => 'nullable|string',
    //         'parent_id'   => 'nullable|exists:categories,id',
    //         'is_active'   => 'nullable|boolean',
    //     ]);

    //     $category->update([
    //         'name'        => $request->name,
    //         'description' => $request->description,
    //         'image'       => $request->image,
    //         'parent_id'   => $request->parent_id,
    //         'is_active'   => $request->is_active ?? 1,
    //     ]);

    //     return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
    // }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
    }

    // Hàm đệ quy lấy tất cả ID con cháu
    private function getDescendantIds(Category $category): array
    {
        $ids = [];
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getDescendantIds($child));
        }
        return $ids;
    }
}

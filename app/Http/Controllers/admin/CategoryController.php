<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('user')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'top_category' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imageName);

      
        } else {
            $imageName = null;
        }
        $request->merge(['image' => $imageName]);

        $category = new Category();
        $category->user_id = Auth::id();
         $category->name = $request->name;
        $category->slug = $request->slug;
        $category->top_category = $request->top_category;
        $category->status = $request->status;
        $category->image = $imageName;
        $category->title = $request->title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
            'top_category' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);
    
        $imageName = $category->image;
    
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($category->image && file_exists(public_path('uploads/categories/'.$category->image))) {
                    unlink(public_path('uploads/categories/'.$category->image));
                }
        
                // Upload new image
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/categories'), $imageName);
            }
    
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'top_category' => $request->top_category,
            'status' => $request->status,
            'image' => $imageName,
            'title' => $request->title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);
    
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        
        $category->find($id)->delete();
        
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
    public function getCategoryById($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
}

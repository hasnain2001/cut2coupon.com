<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('employee.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('employee.blog.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',

        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
        } else {
            $imageName = null;
        }

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->name = $request->input('name');
        $blog->status = $request->input('status', 0);
        $blog->category_id = $request->input('category_id');
        $blog->slug = $request->input('slug');
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->meta_description = $request->input('meta_description');
        $blog->meta_keyword = $request->input('meta_keyword');
        $blog->image = $imageName;

        if ($blog->save()) {
            return redirect()->route('employee.blog.index')->withInput()->with('success', 'Blog created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create blog.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('employee.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('employee.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',

        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
        } else {
            $imageName = $blog->image;
        }
        $request->merge(['image' => $imageName]);

        $blog->user_id = Auth::id();
        $blog->name = $request->input('name');
        $blog->slug = $request->input('slug');
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->meta_description = $request->input('meta_description');
        $blog->meta_keyword = $request->input('meta_keyword');
        $blog->status = $request->input('status');
        $blog->image = $imageName;
        if ($blog->save()) {
            return redirect()->route('employee.blog.show',['blog' => Str::slug($blog->slug)])->with('success', 'Blog updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update blog.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->delete()) {
            return redirect()->route('employee.blog.index')->with('success', 'Blog deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete blog.');
        }
    }
}

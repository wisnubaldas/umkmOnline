<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$categories = Category::orderBy('created_at', 'desc')->paginate(20)->appends(request()->except('page'));
    	return view('back.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'category_name' => 'required|unique:categories,name'
    	]);

    	Category::create([
    		'name' => $request->category_name,
    		'slug' => str_slug($request->category_name)
    	]);

    	$categories = Category::orderBy('created_at', 'desc')->paginate(20)->appends(request()->except('page'));
    	return view('back.category.index', compact('categories'));
    }

    public function destroy(Category $category)
    {
    	$category->delete();
    	return redirect()->route('admin.setting.index');
    }
}

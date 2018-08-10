<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Store;

class PageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->only('dashboard');
	}

    public function index()
    {
    	$products = Product::orderBy('created_at', 'desc')->take(12)->get();
    	return view('front.page.index', compact('products'));
    }

    public function belanja()
    {
    	if (request()->ajax()) {
    		$query = request('query');
    		$category_id = request('category_id');
    		if ($category_id == '0') {
    			$products = Product::where('name', 'like', '%'.$query.'%')->orderBy('created_at', 'desc')
    			->paginate(16)->appends(request()->except('page'));
    		} else {
    			$products = Product::where('name', 'like', '%'.$query.'%')
    			->where('category_id', $category_id)->orderBy('created_at', 'desc')
    			->paginate(16)->appends(request()->except('page'));
    		}
    		return view('front.page.product_list', compact('products'));
    	}

    	$categories = Category::all();
    	return view('front.page.belanja', compact('categories'));	
    }

    public function detailProduct($slug)
    {
    	$product = Product::where('slug', $slug)->firstOrFail();
    	$store = $product->store;
    	$storeProducts = $store->products()->where('id', '!=', $product->id)->take(8)->get();
    	return view('front.page.detail_product', compact('product', 'store', 'storeProducts'));
    }

    public function detailToko($slug)
    {
    	$store = Store::where('slug', $slug)->firstOrFail();
    	$storeProducts = $store->products()->orderBy('created_at', 'desc')->get();
    	return view('front.page.detail_toko', compact('store', 'storeProducts'));
    }
}

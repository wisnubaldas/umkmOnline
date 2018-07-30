<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Auth;
use Image;
use File;

class ProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except([
			'show'
		]);
	}

	public function create()
	{
		$categories = Category::all();
		return view('front.product.create', compact('categories'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'product_name' => 'required|string|max:200',
			'category_id' => 'required',
			'product_weight' => 'required|numeric',
			'product_price' => 'required|numeric',
			'product_image' => 'required|image|mimes:jpeg,png|max:200',
			'product_desc' => 'required|string|min:100'
		]);

		//save database
		$product = new Product();
		$product->name = $request->product_name;
		$product->category_id = $request->category_id;
		$product->description = $request->product_desc;
		$product->weight = $request->product_weight;
		$product->price = $request->product_price;
		$product->store_id = Auth::user()->store->id;
		$product->save();

		$slug = $product->id . '-' . str_slug($product->name);

		//upload image
    	$image = $this->upload_image($request, $slug);

    	//update product
    	$product->slug = $slug;
    	$product->image = $image;
    	$product->save();

    	return redirect()->route('product.yours')
    	->with('success', 'Berhasil menambahkan produk baru');
	}

	public function yours()
	{
		$store = Auth::user()->store;
		$products = $store->products()->orderBy('created_at', 'desc')->paginate('12');
		return view('front.product.yours', compact('products'));
	}

    public function show(Request $request, Product $product)
    {
    	if ($request->ajax()) {
    		if ($request->get('src') == 'yours') {
    			return view('front.product.show', compact('product'));
    		}
    		return response()->json($product);
    	}
    }

    public function edit(Product $product)
    {
    	$categories = Category::all();
		return view('front.product.edit', compact('categories', 'product'));
    }

    public function update(Request $request, Product $product)
    {
    	$request->validate([
			'product_name' => 'required|string|max:200',
			'category_id' => 'required',
			'product_weight' => 'required|numeric',
			'product_price' => 'required|numeric',
			'product_image' => 'required|image|mimes:jpeg,png|max:200',
			'product_desc' => 'required|string|min:100'
		]);

		//hapus image sebelumnya
		File::delete(public_path('img/product/'.$product->image));

		//update daatabase
		$product->name = $request->product_name;
		$product->category_id = $request->category_id;
		$product->description = $request->product_desc;
		$product->weight = $request->product_weight;
		$product->price = $request->product_price;
		$product->store_id = Auth::user()->store->id;
		$product->save();

		$slug = $product->id . '-' . str_slug($product->name);

		//upload image
    	$image = $this->upload_image($request, $slug);

    	//update product
    	$product->slug = $slug;
    	$product->image = $image;
    	$product->save();

    	return redirect()->route('product.yours')
    	->with('success', 'Berhasil Memperbaharui produk');
    }

    public function destroy(Product $product)
    {
    	File::delete(public_path('img/product/'.$product->image));
    	$product->delete();
    	return redirect()->route('product.yours')
    	->with('success', 'Berhasil Hapus produk');
    }

    public function setKosong(Request $request, Product $product)
    {
    	if (!$request->ajax()) {
    		abort(404);
    	}

    	$product->is_in_stock = 0;
    	$product->save();
    	return view('front.product.show', compact('product'));
    }

    public function setTersedia(Request $request, Product $product)
    {
    	if (!$request->ajax()) {
    		abort(404);
    	}

    	$product->is_in_stock = 1;
    	$product->save();
    	return view('front.product.show', compact('product'));
    }

    private function upload_image($request, $slug)
    {
         // upload image
        $filename = $slug . '.' . $request->product_image->getClientOriginalExtension();
        $path = public_path('img/product/' . $filename);
        $image = Image::make($request->product_image->getRealpath());
        $height = $image->height();
        $width = $image->width();
        if ($height < $width) {
            $image->crop($height, $height)->save($path); 
        } elseif ($height > $width) {
            $image->crop($width, $width)->save($path); 
        } else {
            $image->save($path);
        }
        return $filename;
    }
}

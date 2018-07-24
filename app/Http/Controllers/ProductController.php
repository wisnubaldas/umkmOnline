<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show(Request $request, Product $product)
    {
    	if ($request->ajax()) {
    		return response()->json($product);
    	}
    }
}
